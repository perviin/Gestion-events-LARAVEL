<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Participation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ParticipationController extends Controller
{
    /**
     * Affiche la liste des participations de l'utilisateur courant.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $participations = Participation::with(['event' => function($query) {
            $query->with('category');
        }])
        ->where('user_id', Auth::id())
        ->latest()
        ->paginate(6);
        
        // exemple d'affichage dans la vue
        foreach ($participations as $participation) {
            echo $participation->user->name;  // Récupère le nom de l'utilisateur
            echo $participation->user->email; // Récupère l'email de l'utilisateur
        }
        

        // récupérer les événements à venir auxquels l'utilisateur participe
        $upcomingEvents = $participations->filter(function($participation) {
            return $participation->event->date > now();
        });

        // récupérer les événements passés auxquels l'utilisateur a participé
        $pastEvents = $participations->filter(function($participation) {
            return $participation->event->date <= now();
        });

        return view('participations.index', compact('participations', 'upcomingEvents', 'pastEvents'));
    }

    /**
     * Affiche le formulaire d'inscription à un événement.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\View\View
     */
    public function create(Event $event)
    {
        // vérifier si l'événement est plein
        if ($event->isFull()) {
            return redirect()->back()->with('error', 'Cet événement est complet.');
        }
        
        // vérifier si l'utilisateur est déjà inscrit
        if ($event->isUserRegistered(Auth::id())) {
            return redirect()->back()->with('error', 'Vous êtes déjà inscrit à cet événement.');
        }
        
        // vérifier si l'événement est passé
        if ($event->date < now()) {
            return redirect()->back()->with('error', 'Cet événement est déjà passé, vous ne pouvez plus vous y inscrire.');
        }

        return view('participations.create', compact('event'));
    }

    /**
     * Enregistre une nouvelle participation à un événement.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Event $event)
    {
        // vérifier si l'événement est plein
        if ($event->isFull()) {
            return redirect()->back()->with('error', 'Cet événement est complet.');
        }
        
        // vérifier si l'utilisateur est déjà inscrit
        if ($event->isUserRegistered(Auth::id())) {
            return redirect()->back()->with('error', 'Vous êtes déjà inscrit à cet événement.');
        }
        
        // vérifier si l'événement est passé
        if ($event->date < now()) {
            return redirect()->back()->with('error', 'Cet événement est déjà passé, vous ne pouvez plus vous y inscrire.');
        }

        // validation des données
        $validatedData = $request->validate([
            'notes' => 'nullable|string|max:500',
        ]);

        try {
            DB::beginTransaction();
        
            $participation = new Participation();
            $participation->user_id = Auth::id();
            $participation->event_id = $event->id;
            $participation->notes = $validatedData['notes'] ?? null;
            $participation->registration_date = now();
            $participation->save();
            
            DB::commit();

            if ($event->price > 0) {
                return redirect()->route('payments.create', ['participation' => $participation->id])
                    ->with('success', 'Votre inscription a été enregistrée. Veuillez procéder au paiement.');
            }

            return redirect()->route('participations.index')
                ->with('success', 'Votre inscription à l\'événement a été confirmée.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Une erreur est survenue lors de l\'inscription: ' . $e->getMessage());
        }
    }

    /**
     * Affiche les détails d'une participation.
     *
     * @param  \App\Models\Participation  $participation
     * @return \Illuminate\View\View
     */
    public function show(Participation $participation)
    {
        // vérifier que l'utilisateur a le droit de voir cette participation
        if ($participation->user_id !== Auth::id() && 
            $participation->event->organizer_id !== Auth::id()) {
            abort(403, 'Vous n\'êtes pas autorisé à voir cette participation.');
        }

        $event = $participation->event;
        return view('participations.show', compact('participation', 'event'));
    }

    /**
     * Annule une participation à un événement.
     *
     * @param  \App\Models\Participation  $participation
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Participation $participation)
    {
        // vérifier que l'utilisateur a le droit d'annuler cette participation
        if ($participation->user_id !== Auth::id()) {
            abort(403, 'Vous n\'êtes pas autorisé à annuler cette participation.');
        }

        // vérifier si l'événement est déjà passé
        if ($participation->event->date < now()) {
            return redirect()->back()
                ->with('error', 'Vous ne pouvez pas annuler votre participation à un événement passé.');
        }

        // vérifier si l'annulation est encore possible (si moins de X jours avant l'événement)
        $cancelDeadline = $participation->event->date->subDays(2);
        if (now() > $cancelDeadline) {
            return redirect()->back()
                ->with('error', 'L\'annulation n\'est plus possible à moins de 48 heures de l\'événement.');
        }

        try {
            DB::beginTransaction();
            
            /* Si un paiement a été effectué, créer un remboursement (à implémenter)
            if ($participation->payment && $participation->payment->status === 'paid') {
                $refund = new Refund();
                $refund->participation_id = $participation->id;
                $refund->amount = $participation->event->price;
                $refund->status = 'pending';
                $refund->save();
            } */
            
            // Supprimer la participation
            $eventName = $participation->event->name;
            $participation->delete();
            
            /* Envoyer une notification au créateur de l'événement (à implémenter)
            event(new ParticipationCancelled($participation));*/
            
            DB::commit();
            
            return redirect()->route('participations.index')
                ->with('success', 'Votre participation à l\'événement "' . $eventName . '" a été annulée.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Une erreur est survenue lors de l\'annulation: ' . $e->getMessage());
        }
    }

    /**
     * Affiche la liste des participants à un événement (pour l'organisateur).
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\View\View
     */
    public function eventParticipants(Event $event)
    {
        if ($event->organizer_id !== Auth::id()) {
            abort(403, 'Vous n\'êtes pas autorisé à voir les participants de cet événement.');
        }
    
        // Récupère les participants via la relation many-to-many avec les infos du pivot
        $participants = $event->participants()->withPivot('registration_date', 'notes')->get();
    
        return view('participations.participants', compact('event', 'participants'));
    }


    /**
     * Exporte la liste des participants à un événement au format CSV.
     *
     * @param  \App\Models\Event  $event
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportParticipants(Event $event)
    {
        // vérifier que l'utilisateur est l'organisateur de l'événement
        if ($event->organizer_id !== Auth::id()) {
            abort(403, 'Vous n\'êtes pas autorisé à exporter les participants de cet événement.');
        }

        $participants = Participation::with('user')
            ->where('event_id', $event->id)
            ->orderBy('registration_date', 'asc')
            ->get();

        $filename = 'participants_' . $event->id . '_' . date('Y-m-d') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        // Créer le fichier CSV
        $callback = function() use ($participants) {
            $file = fopen('php://output', 'w');
            
            // En-tête du CSV
            fputcsv($file, ['Nom', 'Email', 'Date d\'inscription', 'Notes']);
            
            // Données des participants
            foreach ($participants as $participant) {
                fputcsv($file, [
                    $participant->user->name,
                    $participant->user->email,
                    $participant->registration_date->format('d/m/Y H:i'),
                    $participant->notes ?? 'Aucune note'
                ]);
            }
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function showParticipateForm(Event $event)
    {
        // Vérifier si l'utilisateur est déjà inscrit
        $isAlreadyParticipating = $event->participants()->where('user_id', auth()->id())->exists();

        return view('participations.form', [
            'event' => $event,
            'isAlreadyParticipating' => $isAlreadyParticipating
        ]);
    }

    public function participate(Event $event)
{ 
    // Vérifier si l'utilisateur est déjà inscrit à l'événement
    if ($event->participants()->where('user_id', auth()->id())->exists()) {
        return back()->with('error', 'Vous êtes déjà inscrit à cet événement.');
    }

    // Récupérer l'utilisateur actuel
    $user = auth()->user();

    // Si l'utilisateur n'est pas encore inscrit, on l'ajoute
    $participation = new Participation();
    $participation->user_id = auth()->id();
    $participation->event_id = $event->id;
    $participation->registration_date = now();
    // Ajoutez d'autres champs nécessaires selon votre schéma de base de données
    $participation->save();

    // Rediriger vers la page des participations avec un message de succès
    return redirect()->route('participations.index')->with('success', 'Votre inscription a été enregistrée.');
}

    // App\Http\Controllers\ParticipationController.php

    public function cancel(Participation $participation)
    {
        // Vérifie si l'utilisateur a bien la permission d'annuler
        if ($participation->user_id !== auth()->id()) {
            return redirect()->route('participations.index')->with('error', 'Vous ne pouvez pas annuler cette participation.');
        }

        // Supprime la participation
        $participation->delete();

        return redirect()->route('participations.index')->with('success', 'Votre participation a été annulée avec succès.');
    }
}