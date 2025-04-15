<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Participations - Evently</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <style>
        .dashboard-bg {
            background-color: #f9fafb;
            min-height: 100vh;
        }
        .sidebar {
            background-color: #1f2937;
            min-height: calc(100vh - 64px);
        }
        .content-header {
            background: linear-gradient(to right, #8b5cf6, #7c3aed);
        }
        .event-card {
            transition: transform 0.2s;
        }
        .event-card:hover {
            transform: translateY(-5px);
        }
        html {
            scroll-behavior: smooth;
        }
        .tabs-container {
            overflow-x: auto;
        }
        .status-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 0.75rem;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-weight: 600;
        }
        .tab-active {
            color: #7c3aed;
            border-bottom: 2px solid #7c3aed;
        }
    </style>
</head>
<body class="font-poppins">
    <!-- Barre de navigation -->
    <nav class="bg-black bg-opacity-90 text-white p-4 z-50">
        <div class="container mx-auto flex justify-between items-center">
            <div class="text-2xl font-bold"><a href="/">Evently</a></div>
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <button id="notificationButton" class="text-white hover:text-purple-300 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </button>
                </div>
                
                <div class="relative" x-data="{ open: false }">
                    <button id="profileButton" class="flex items-center space-x-2 focus:outline-none">
                        <div class="w-8 h-8 bg-purple-600 rounded-full flex items-center justify-center">
                            <span class="text-white font-semibold">{{ Auth::user()->name[0] }}</span>
                        </div>
                        <span>{{ Auth::user()->name }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    
                    <div id="profileDropdown" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 hidden z-10">
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Mon profil</a>
                        <a href="{{ route('settings.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Paramètres</a>
                        <hr class="my-1">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Se déconnecter
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="dashboard-bg flex">
        <!-- Sidebar -->
        <div class="sidebar w-64 text-white">
            <div class="p-4">
                <h2 class="text-xl font-bold mb-6">Menu</h2>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('dashboard') }}" class="flex items-center space-x-2 py-2 px-4 rounded hover:bg-gray-700 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            <span>Tableau de bord</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('events.index') }}" class="flex items-center space-x-2 py-2 px-4 rounded hover:bg-gray-700 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span>Mes événements</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('events.create') }}" class="flex items-center space-x-2 py-2 px-4 rounded hover:bg-gray-700 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            <span>Créer un événement</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('participations.index') }}" class="flex items-center space-x-2 py-2 px-4 rounded bg-purple-600 text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span>Mes participations</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        
        <!-- Contenu principal -->
        <div class="flex-1">
            <!-- En-tête du contenu -->
            <div class="content-header text-white p-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-3xl font-bold">Mes participations</h1>
                        <p class="mt-2">Suivez les événements auxquels vous participez</p>
                    </div>
                    <a href="{{ route('events.index') }}" class="px-4 py-2 bg-white text-purple-600 rounded-md font-medium hover:bg-gray-100 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        Découvrir des événements
                    </a>
                </div>
            </div>
            
            <!-- Contenu des participations -->
            <div class="p-6">
                <!-- Messages de statut -->
                @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
                @endif
                
                @if (session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                    <p>{{ session('error') }}</p>
                </div>
                @endif
                
                <!-- Onglets de navigation -->
                <div class="bg-white rounded-lg shadow-sm mb-6 overflow-hidden">
                    <div class="tabs-container border-b">
                        <div class="flex">
                            <button id="all-tab" class="tab-button tab-active py-4 px-6 font-medium text-base focus:outline-none">
                                Tous <span class="ml-2 bg-gray-200 text-gray-700 px-2 py-1 rounded-full text-xs">{{ $participations->count() }}</span>
                            </button>
                            <button id="upcoming-tab" class="tab-button py-4 px-6 font-medium text-base text-gray-600 focus:outline-none">
                                À venir <span class="ml-2 bg-purple-100 text-purple-700 px-2 py-1 rounded-full text-xs">{{ $upcomingEvents->count() }}</span>
                            </button>
                            <button id="past-tab" class="tab-button py-4 px-6 font-medium text-base text-gray-600 focus:outline-none">
                                Passés <span class="ml-2 bg-gray-200 text-gray-700 px-2 py-1 rounded-full text-xs">{{ $pastEvents->count() }}</span>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Zone de recherche et filtres -->
                    <div class="p-4 bg-gray-50 border-b">
                        <div class="flex flex-wrap gap-3 items-center">
                            <div class="flex-grow">
                                <input type="text" id="search-input" placeholder="Rechercher un événement..." class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-purple-500 focus:border-purple-500">
                            </div>
                            <div>
                                <button id="filterButton" class="px-4 py-2 bg-white border border-gray-300 rounded-md hover:bg-gray-50 flex items-center space-x-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                                    </svg>
                                    <span>Filtrer</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Contenu des onglets -->
                <div id="all-content" class="tab-content">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse ($participations as $participation)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden event-card">
                            <div class="relative">
                                @php
                                    // Convertir le nom du lieu en slug pour le nom de fichier
                                    $locationSlug = Str::slug($participation->event->location);
                                    $imagePath = "img/locations/{$locationSlug}.jpg";
                                    $imageExists = file_exists(public_path($imagePath));
                                    $isPast = $participation->event->date <= now();
                                @endphp
        
                                @if($imageExists)
                                    <img src="{{ asset($imagePath) }}" alt="{{ $participation->event->location }}" class="w-full h-48 object-cover {{ $isPast ? 'opacity-60' : '' }}">
                                @else
                                    <img src="{{ asset('images/locations/default.jpg') }}" alt="{{ $participation->event->name }}" class="w-full h-48 object-cover {{ $isPast ? 'opacity-60' : '' }}">
                                @endif

                                <div class="status-badge {{ $isPast ? 'bg-gray-500' : 'bg-green-500' }} text-white">
                                    {{ $isPast ? 'Terminé' : 'À venir' }}
                                </div>
                            </div>
                            <div class="p-5">
                            <div class="text-xs text-gray-500 mb-2">
                                @if(is_object($participation->event->category) && isset($participation->event->category->name))
                                    {{ $participation->event->category->name }} •
                                @else
                                    Aucune catégorie •
                                @endif
    
                                @if($participation->event->date)
                                    {{ \Carbon\Carbon::parse($participation->date)->locale('fr')->translatedFormat('d F Y') }}
                                @else
                                    Date non définie
                                @endif
                                </div>

                                
                                <div class="flex items-center mb-3 text-sm text-gray-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span>{{ $participation->event->location }}</span>
                                </div>
                                
                                <div class="flex justify-between items-center mb-3">
                                    <span class="text-sm {{ $isPast ? 'bg-gray-100 text-gray-800' : 'bg-purple-100 text-purple-800' }} px-2 py-1 rounded-full">
                                        Inscrit le {{ \Carbon\Carbon::parse($participation->date)->locale('fr')->translatedFormat('d F Y') }}
                                    </span>
                                    <span class="text-sm font-medium text-green-700">
                                        {{ $participation->event->price > 0 ? number_format($participation->event->price, 2, ',', ' ') . ' €' : 'Gratuit' }}
                                    </span>
                                </div>
                                
                                <div class="flex justify-end space-x-2 mt-4">
                                    
                                    @if(!$isPast && now() < $participation->event->date->subDays(2))
                                    <form action="{{ route('participations.cancel', $participation) }}" method="POST" class="inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1 bg-red-100 text-red-700 rounded-md hover:bg-red-200 transition text-sm font-medium delete-button" data-event-title="{{ $participation->event->name }}">
                                            Annuler
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-span-3 text-center py-10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <p class="mt-2 text-xl text-gray-500">Vous n'avez pas encore participé à des événements</p>
                            <a href="{{ route('events.index') }}" class="mt-4 inline-block px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700">
                                Découvrir des événements
                            </a>
                        </div>
                        @endforelse
                    </div>
                </div>
                
                <div id="upcoming-content" class="tab-content hidden">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse ($upcomingEvents as $participation)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden event-card">
                            <div class="relative">
                                @php
                                    $locationSlug = Str::slug($participation->event->location);
                                    $imagePath = "img/locations/{$locationSlug}.jpg";
                                    $imageExists = file_exists(public_path($imagePath));
                                @endphp
        
                                @if($imageExists)
                                    <img src="{{ asset($imagePath) }}" alt="{{ $participation->event->location }}" class="w-full h-48 object-cover">
                                @else
                                    <img src="{{ asset('images/locations/default.jpg') }}" alt="{{ $participation->event->name }}" class="w-full h-48 object-cover">
                                @endif

                                <div class="status-badge bg-green-500 text-white">
                                    À venir
                                </div>
                            </div>
                            <div class="p-5">
                                <div class="text-xs text-gray-500 mb-2">
                                @if(is_object($participation->event->category) && isset($participation->event->category->name))
                                    {{ $participation->event->category->name }} •
                                @else
                                    Aucune catégorie •
                                @endif
    
                                @if($participation->event->date)
                                    {{ \Carbon\Carbon::parse($participation->date)->locale('fr')->translatedFormat('d F Y') }}
                                @else
                                    Date non définie
                                @endif
                                </div>
                                <h3 class="text-xl font-bold mb-2">{{ $participation->event->name }}</h3>
                                <p class="text-gray-600 mb-4 line-clamp-2">{{ $participation->event->description }}</p>
                                
                                <div class="flex items-center mb-3 text-sm text-gray-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span>{{ $participation->event->location }}</span>
                                </div>
                                
                                <div class="flex justify-between items-center mb-3">
                                    <span class="text-sm bg-purple-100 text-purple-800 px-2 py-1 rounded-full">
                                        Inscrit le {{ \Carbon\Carbon::parse($participation->date)->locale('fr')->translatedFormat('d F Y') }}
                                    </span>
                                    <span class="text-sm font-medium text-green-700">
                                        {{ $participation->event->price > 0 ? number_format($participation->event->price, 2, ',', ' ') . ' €' : 'Gratuit' }}
                                    </span>
                                </div>
                                
                                <div class="flex justify-end space-x-2 mt-4">
                                    
                                    @if(now() < $participation->event->date->subDays(2))
                                    <form action="{{ route('participations.cancel', $participation) }}" method="POST" class="inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1 bg-red-100 text-red-700 rounded-md hover:bg-red-200 transition text-sm font-medium delete-button" data-event-title="{{ $participation->event->name }}">
                                            Annuler
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-span-3 text-center py-10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <p class="mt-2 text-xl text-gray-500">Vous n'avez pas d'événements à venir</p>
                            <a href="{{ route('events.index') }}" class="mt-4 inline-block px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700">
                                Découvrir des événements
                            </a>
                        </div>
                        @endforelse
                    </div>
                </div>
                
                <div id="past-content" class="tab-content hidden">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse ($pastEvents as $participation)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden event-card">
                            <div class="relative">
                                @php
                                    $locationSlug = Str::slug($participation->event->location);
                                    $imagePath = "img/locations/{$locationSlug}.jpg";
                                    $imageExists = file_exists(public_path($imagePath));
                                @endphp
        
                                @if($imageExists)
                                    <img src="{{ asset($imagePath) }}" alt="{{ $participation->event->location }}" class="w-full h-48 object-cover opacity-60">
                                @else
                                    <img src="{{ asset('images/locations/default.jpg') }}" alt="{{ $participation->event->name }}" class="w-full h-48 object-cover opacity-60">
                                @endif

                                <div class="status-badge bg-gray-500 text-white">
                                    Terminé
                                </div>
                            </div>
                            <div class="p-5">
                                <div class="text-xs text-gray-500 mb-2">{{ $participation->event->category->name }} • {{ $participation->event->date->format('d F Y à H:i') }}</div>
                                <h3 class="text-xl font-bold mb-2">{{ $participation->event->name }}</h3>
                                <p class="text-gray-600 mb-4 line-clamp-2">{{ $participation->event->description }}</p>
                                
                                <div class="flex items-center mb-3 text-sm text-gray-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span>{{ $participation->event->location }}</span>
                                </div>
                                
                                <div class="flex justify-between items-center mb-3">
                                    <span class="text-sm bg-gray-100 text-gray-800 px-2 py-1 rounded-full">
                                        Inscrit le {{ $participation->registered_at->format('d/m/Y') }}
                                    </span>
                                    <span class="text-sm font-medium text-green-700">
                                        {{ $participation->event->price > 0 ? number_format($participation->event->price, 2, ',', ' ') . ' €' : 'Gratuit' }}
                                    </span>
                                </div>
                            
                            </div>
                        </div>
                        @empty
                        <div class="col-span-3 text-center py-10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <p class="mt-2 text-xl text-gray-500">Vous n'avez pas d'événements passés</p>
                            <a href="{{ route('events.index') }}" class="mt-4 inline-block px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700">
                                Découvrir des événements
                            </a>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de confirmation pour l'annulation de participation -->
    <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white rounded-lg p-6 max-w-md mx-4 md:mx-auto">
            <h3 class="text-xl font-bold mb-4">Confirmer l'annulation</h3>
            <p class="mb-6">Êtes-vous sûr de vouloir annuler votre participation à l'événement "<span id="event-title-placeholder"></span>" ?</p>
            <div class="flex justify-end space-x-3">
                <button id="cancelDelete" class="px-4 py-2 bg-gray-200 rounded-md hover:bg-gray-300 focus:outline-none">
                    Retour
                </button>
                <button id="confirmDelete" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none">
                    Confirmer
                </button>
            </div>
        </div>
    </div>

    <script>
        // gestion onglets
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('.tab-button');
            const contents = document.querySelectorAll('.tab-content');
            
            tabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    // désactiver tous les onglets
                    tabs.forEach(t => t.classList.remove('tab-active'));
                    t.classList.add('text-gray-600');
                    
                    // cacher tous les contenus
                    contents.forEach(content => content.classList.add('hidden'));
                    
                    // activer l'onglet cliqué
                    tab.classList.add('tab-active');
                    tab.classList.remove('text-gray-600');
                    
                    // afficher le contenu correspondant
                    const contentId = tab.id.replace('-tab', '-content');
                    document.getElementById(contentId).classList.remove('hidden');
                });
            });
            
            // pour le menu du profil
            const profileButton = document.getElementById('profileButton');
            const profileDropdown = document.getElementById('profileDropdown');
            
            profileButton.addEventListener('click', () => {
                profileDropdown.classList.toggle('hidden');
            });
            
            document.addEventListener('click', (event) => {
                if (!profileButton.contains(event.target) && !profileDropdown.contains(event.target)) {
                    profileDropdown.classList.add('hidden');
                }
            });
            
            // gestion de la recherche
            const searchInput = document.getElementById('search-input');
            searchInput.addEventListener('input', filterEvents);
            
            function filterEvents() {
                const query = searchInput.value.toLowerCase();
                const eventCards = document.querySelectorAll('.event-card');
                
                eventCards.forEach(card => {
                    const title = card.querySelector('h3').textContent.toLowerCase();
                    const description = card.querySelector('p').textContent.toLowerCase();
                    const location = card.querySelector('.flex.items-center.mb-3 span').textContent.toLowerCase();
                    
                    if (title.includes(query) || description.includes(query) || location.includes(query)) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            }
            
            // gestion de d'annulation
            const deleteButtons = document.querySelectorAll('.delete-button');
            const deleteModal = document.getElementById('deleteModal');
            const cancelDelete = document.getElementById('cancelDelete');
            const confirmDelete = document.getElementById('confirmDelete');
            const eventTitlePlaceholder = document.getElementById('event-title-placeholder');
            let currentForm = null;
            
            deleteButtons.forEach(button => {
                button.addEventListener('click', (e) => {
                    e.preventDefault();
                    const eventTitle = button.getAttribute('data-event-title');
                    eventTitlePlaceholder.textContent = eventTitle;
                    deleteModal.classList.remove('hidden');
                    currentForm = button.closest('form');
                });
            });
            
            cancelDelete.addEventListener('click', () => {
                deleteModal.classList.add('hidden');
                currentForm = null;
            });
            
            confirmDelete.addEventListener('click', () => {
                if (currentForm) {
                    currentForm.submit();
                }
            });
        });
    </script>
</body>
</html>