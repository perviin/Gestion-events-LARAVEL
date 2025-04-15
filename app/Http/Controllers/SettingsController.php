<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class SettingsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('settings.index', compact('user'));
    }

    public function updateLanguage(Request $request)
    {
        $request->validate([
            'language' => 'required|in:fr,en,es',
        ]);

        $user = Auth::user();
        $user->language = $request->language;
        $user->save();

        return back()->with('success', 'Langue mise à jour avec succès.');
    }

    public function downloadData()
    {
        $user = Auth::user();

        $pdf = Pdf::loadView('settings.download', compact('user'));
    
        return $pdf->download('mes-donnees.pdf');
    }
}