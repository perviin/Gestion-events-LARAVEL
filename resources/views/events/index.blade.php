@extends('layouts.app')

@section('content')
<div class="container events-container">
    <div class="events-header">
        <h1>Événements à venir</h1>
        <a href="{{ route('events.create') }}" class="btn btn-create">
            <i class="fas fa-plus"></i> Créer un événement
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="events-grid">
        @forelse ($events as $event)
            <div class="event-item">
                <div class="event-image">
                    @if($event->image)
                        <img src="{{ asset('storage/'.$event->image) }}" alt="{{ $event->name }}">
                    @else
                        <div class="no-image">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                    @endif
                </div>
                <div class="event-content">
                    <h3 class="event-title">{{ $event->name }}</h3>
                    <div class="event-meta">
                        <div class="event-location">
                            <i class="fas fa-map-marker-alt"></i> {{ $event->location }}
                        </div>
                        <div class="event-date">
                            <i class="fas fa-clock"></i> {{ \Carbon\Carbon::parse($event->date)->format('d/m/Y H:i') }}
                        </div>
                    </div>
                    <div class="event-price">
                        <span>{{ number_format($event->price, 2, ',', ' ') }} €</span>
                    </div>
                    <div class="event-actions">
                        <a href="{{ route('events.show', $event) }}" class="btn-view">
                            <i class="fas fa-eye"></i> Voir
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="no-events">
                <div class="no-events-icon">
                    <i class="far fa-calendar-times"></i>
                </div>
                <p>Aucun événement disponible pour le moment.</p>
                <a href="{{ route('events.create') }}" class="btn btn-primary">Créer votre premier événement</a>
            </div>
        @endforelse
    </div>

    <div class="pagination-container">
        {{ $events->links() }}
    </div>
</div>
@endsection