@extends('layouts.app')

@section('content')
<div class="container event-container">
    <div class="event-header">
        <h1>{{ $event->name }}</h1>
        <div class="event-actions">
            <a href="{{ route('events.edit', $event) }}" class="btn btn-primary"><i class="fas fa-edit"></i> Modifier</a>
            <form action="{{ route('events.destroy', $event) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet événement?')">
                    <i class="fas fa-trash-alt"></i> Supprimer
                </button>
            </form>
            <a href="{{ route('events.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Retour</a>
        </div>
    </div>

    <div class="event-card">
        @if($event->image)
            <div class="event-image">
                <img src="{{ asset('storage/'.$event->image) }}" alt="{{ $event->name }}">
            </div>
        @else
            <div class="event-image">
                <div class="no-image">
                    <i class="fas fa-calendar-day"></i>
                </div>
            </div>
        @endif
        
        <div class="event-details">
            <div class="event-info">
                <i class="fas fa-map-marker-alt"></i>
                <span>{{ $event->location ?: 'Lieu non spécifié' }}</span>
            </div>
            <div class="event-info">
                <i class="fas fa-calendar-alt"></i>
                <span>{{ \Carbon\Carbon::parse($event->date)->format('d/m/Y H:i') }}</span>
            </div>
            <div class="event-info">
                <i class="fas fa-users"></i>
                <span>{{ $event->capacity }} places</span>
            </div>
            <div class="event-info">
                <i class="fas fa-euro-sign"></i>
                <span>{{ number_format($event->price, 2, ',', ' ') }} €</span>
            </div>
        </div>
    </div>

    <div class="event-description">
        <h3>Description</h3>
        <p>{{ $event->description ?? 'Aucune description disponible.' }}</p>
    </div>
    
    @if($event->additional_information)
    <div class="event-additional-info">
        <h3>Informations complémentaires</h3>
        <p>{{ $event->additional_information }}</p>
    </div>
    @endif
    
    <div class="event-footer">
        <div class="event-share">
            <span>Partager :</span>
            <a href="https://facebook.com/sharer/sharer.php?u={{ urlencode(route('events.show', $event)) }}" target="_blank" class="social-share facebook">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('events.show', $event)) }}&text={{ urlencode($event->name) }}" target="_blank" class="social-share twitter">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="mailto:?subject={{ urlencode($event->name) }}&body={{ urlencode(route('events.show', $event)) }}" class="social-share email">
                <i class="fas fa-envelope"></i>
            </a>
        </div>
        
        <div class="event-dates">
            <div class="event-date-item">
                <span>Créé le :</span> {{ \Carbon\Carbon::parse($event->created_at)->format('d/m/Y') }}
            </div>
            <div class="event-date-item">
                <span>Dernière mise à jour :</span> {{ \Carbon\Carbon::parse($event->updated_at)->format('d/m/Y') }}
            </div>
        </div>
    </div>
</div>
@endsection