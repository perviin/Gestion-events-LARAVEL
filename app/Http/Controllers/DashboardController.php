<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Participation;
use App\Models\Activity;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // récupérer les événements créés par l'utilisateur
        $eventsCreated = Event::where('user_id', $user->id)->count();
        
        // récupérer les participations de l'utilisateur
        $participationsCount = Participation::where('user_id', $user->id)->count();
        
        // récupérer les événements à venir (tous les événements)
        $upcomingEvents = Event::where('date', '>=', now())->count();
        
        // récupérer les événements à venir de l'utilisateur (créés ou participations)
        $userUpcomingEvents = Event::where(function($query) use ($user) {
            $query->where('user_id', $user->id)
                  ->orWhereHas('participations', function($query) use ($user) {
                      $query->where('user_id', $user->id);
                  });
        })
        ->where('date', '>=', now())
        ->orderBy('date')
        ->get();
        
        // récupérer l'activité récente
        $recentActivities = Activity::where('user_id', $user->id)
                                   ->orderBy('created_at', 'desc')
                                   ->take(5)
                                   ->get();
        
        return view('dashboard', compact(
            'eventsCreated', 
            'participationsCount', 
            'upcomingEvents', 
            'userUpcomingEvents', 
            'recentActivities'
        ));
    }
}