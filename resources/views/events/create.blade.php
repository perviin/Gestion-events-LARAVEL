@extends('layouts.app')

@section('content')
<div class="container event-form-container">
    <h1 class="mb-4">Créer un nouvel événement</h1>
    
    <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="form-group">
            <label for="name">Nom de l'événement</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
            @error('name')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="location">Lieu</label>
            <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location" value="{{ old('location') }}" required>
            @error('location')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="date">Date et heure</label>
            <input type="datetime-local" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ old('date') }}" required>
            @error('date')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="capacity">Capacité</label>
            <input type="number" class="form-control @error('capacity') is-invalid @enderror" id="capacity" name="capacity" value="{{ old('capacity') }}" required>
            @error('capacity')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="price">Prix</label>
            <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}" required>
            @error('price')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4">{{ old('description') }}</textarea>
            @error('description')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image" name="image">
            @error('image')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Créer l'événement</button>
            <a href="{{ route('events.index') }}" class="btn btn-secondary">Annuler</a>
        </div>
    </form>
</div>
@endsection