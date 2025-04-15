<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Événements - Evently</title>
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
    </style>
</head>
<body class="font-poppins">
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
                        <a href="{{ route('events.index') }}" class="flex items-center space-x-2 py-2 px-4 rounded bg-purple-600 text-white">
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
                        <a href="{{ route('participations.index') }}" class="flex items-center space-x-2 py-2 px-4 rounded hover:bg-gray-700 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span>Mes participations</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="flex-1">
            <div class="content-header text-white p-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-3xl font-bold">Mes événements</h1>
                        <p class="mt-2">Gérez les événements que vous avez créés</p>
                    </div>
                    <a href="{{ route('events.create') }}" class="px-4 py-2 bg-white text-purple-600 rounded-md font-medium hover:bg-gray-100 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Créer un événement
                    </a>
                </div>
            </div>
            
            <!-- liste des events -->
            <div class="p-6">
                <!-- Messages de statut -->
                @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
                @endif
                
                <!-- filtres et recherche -->
                <div class="bg-white rounded-lg shadow-sm p-4 mb-6">
                    <form action="{{ route('events.index') }}" method="GET" class="flex flex-wrap gap-4 items-center">
                        <div class="flex-grow">
                            <input type="text" name="search" placeholder="Rechercher un événement..." class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-purple-500 focus:border-purple-500" value="{{ request('search') }}">
                        </div>
                        <div class="flex space-x-2">
                            <select name="category" class="px-4 py-2 border border-gray-300 rounded-md focus:ring-purple-500 focus:border-purple-500">
                                <option value="">Toutes les catégories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <select name="status" class="px-4 py-2 border border-gray-300 rounded-md focus:ring-purple-500 focus:border-purple-500">
                                <option value="">Tous les statuts</option>
                                <option value="upcoming" {{ request('status') == 'upcoming' ? 'selected' : '' }}>À venir</option>
                                <option value="past" {{ request('status') == 'past' ? 'selected' : '' }}>Passés</option>
                            </select>
                            <button type="submit" class="px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700">Filtrer</button>
                        </div>
                    </form>
                </div>
                
                <!-- events -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse ($events as $event)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden event-card">
                        <div class="relative">
                            @php
                                // Convertir le nom du lieu en slug pour le nom de fichier
                                $locationSlug = Str::slug($event->location);
                                $imagePath = "img/locations/{$locationSlug}.jpg";
                                $imageExists = file_exists(public_path($imagePath));
                            @endphp
    
                            @if($imageExists)
                                <img src="{{ asset($imagePath) }}" alt="{{ $event->location }}" class="w-full h-48 object-cover {{ $event->is_past ? 'opacity-60' : '' }}">
                            @else
                                <img src="{{ asset('images/locations/default.jpg') }}" alt="{{ $event->name }}" class="w-full h-48 object-cover {{ $event->is_past ? 'opacity-60' : '' }}">
                            @endif
                            <div class="absolute top-3 right-3 {{ $event->is_past ? 'bg-gray-500' : 'bg-green-500' }} text-white text-xs font-bold px-2 py-1 rounded-full">
                                {{ $event->is_past ? 'Terminé' : 'À venir' }}
                            </div>
                        </div>
                        <div class="p-5">
                            <div class="text-xs text-gray-500 mb-2">{{ $event->category }} • {{ $event->date->format('d F Y') }}</div>
                            <h3 class="text-xl font-bold mb-2">{{ $event->name }}</h3>
                            <p class="text-gray-600 mb-4 line-clamp-2">{{ $event->description }}</p>
                            <div class="flex justify-between items-center mb-3">
                                <span class="text-sm {{ $event->is_past ? 'bg-gray-100 text-gray-800' : 'bg-purple-100 text-purple-800' }} px-2 py-1 rounded-full">
                                    {{ $event->participants_count }}/{{ $event->capacity }} participants
                                </span>
                                <span class="text-sm font-medium text-green-700">
                                    {{ $event->price > 0 ? number_format($event->price, 2, ',', ' ') . ' €' : 'Gratuit' }}
                                </span>
                            </div>
                            @if (!$event->is_past)
                                @if ($event->participants->contains(auth()->user()))
                                    <form action="{{ route('participations.cancel', $event->participations->where('user_id', auth()->id())->first()->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 text-sm">
                                            Annuler l'inscription
                                        </button>
                                        </form>
                                @else
                                    <a href="{{ route('participations.form', $event->id) }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 text-sm">
                                        S'inscrire
                                    </a>
                                @endif
                            @endif

                            <div class="flex justify-end space-x-1">
                                @if (auth()->check() && auth()->id() === $event->organizer_id)
                                <a href="{{ route('events.edit', $event) }}" class="text-gray-500 hover:text-purple-600 p-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </a>

                                <form action="{{ route('events.destroy', $event) }}" method="POST" class="inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-gray-500 hover:text-red-600 p-2 delete-button" data-event-title="{{ $event->name }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                                @endif
                            </div>
                            
                            
                            @if (auth()->check() && auth()->id() === $event->organizer_id)        
                                <a href="{{ route('participations.participants', ['event' => $event->id]) }}" 
                                class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                            d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M16 7a4 4 0 11-8 0 4 4 0 018 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM6 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    Voir les participants
                                </a>
                            @endif
                        </div>
                    </div>
                    @empty
                    <div class="col-span-3 text-center py-10">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <p class="mt-2 text-xl text-gray-500">Aucun événement trouvé</p>
                        <a href="{{ route('events.create') }}" class="mt-4 inline-block px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700">
                            Créer votre premier événement
                        </a>
                    </div>
                    @endforelse
                </div>
                
                <!-- les pages -->
                <div class="flex justify-center mt-8">
                    {{ $events->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- retour en haut de page -->
    <button id="backToTopButton" class="fixed bottom-5 right-5 bg-purple-600 text-white p-2 rounded-full shadow-lg opacity-0 invisible transition-all duration-300">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
        </svg>
    </button>

    <script>
        const profileButton = document.getElementById('profileButton');
        const profileDropdown = document.getElementById('profileDropdown');
        
        profileButton.addEventListener('click', function() {
            profileDropdown.classList.toggle('hidden');
        });
        
        document.addEventListener('click', function(event) {
            if (!profileButton.contains(event.target) && !profileDropdown.contains(event.target)) {
                profileDropdown.classList.add('hidden');
            }
        });

        // gérer le menu des notifications
        const notificationButton = document.getElementById('notificationButton');
        let notificationPanel = null;

        notificationButton.addEventListener('click', function() {
            // créer le panneau de notifications s'il n'existe pas encore
            if (!notificationPanel) {
                notificationPanel = document.createElement('div');
                notificationPanel.className = 'absolute right-0 mt-2 w-80 bg-white rounded-md shadow-lg py-1 z-10';
                notificationPanel.style.top = '100%';
                
                // ajouter le contenu des notifications
                notificationPanel.innerHTML = `
                    <div class="px-4 py-2 border-b border-gray-100">
                        <h3 class="text-sm font-semibold text-gray-700">Notifications</h3>
                    </div>
                `;
                
                // ajouter le panneau au bouton de notifications
                notificationButton.parentNode.appendChild(notificationPanel);
            } else {
                // basculer la visibilité du panneau de notifications
                notificationPanel.classList.toggle('hidden');
            }
        });

        // fermer le panneau de notifications en cliquant ailleurs
        document.addEventListener('click', function(event) {
            if (notificationPanel && !notificationButton.contains(event.target) && !notificationPanel.contains(event.target)) {
                notificationPanel.classList.add('hidden');
            }
        });

        // animation des cartes d'événements
        document.querySelectorAll('.event-card').forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.style.transform = 'translateY(-5px)';
                card.style.boxShadow = '0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05)';
            });
            
            card.addEventListener('mouseleave', () => {
                card.style.transform = 'translateY(0)';
                card.style.boxShadow = '';
            });
        });

        // confirmer la suppression d'un événement
        document.querySelectorAll('.delete-button').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const title = this.getAttribute('data-event-title');
                
                if (confirm(`Êtes-vous sûr de vouloir supprimer l'événement "${title}" ? Cette action est irréversible.`)) {
                    this.closest('form').submit();
                }
            });
        });

        // afficher/masquer le bouton de retour en haut de page
        const backToTopButton = document.getElementById('backToTopButton');

        window.addEventListener('scroll', () => {
            if (window.scrollY > 300) {
                backToTopButton.classList.replace('opacity-0', 'opacity-100');
                backToTopButton.classList.replace('invisible', 'visible');
            } else {
                backToTopButton.classList.replace('opacity-100', 'opacity-0');
                setTimeout(() => {
                    backToTopButton.classList.replace('visible', 'invisible');
                }, 300);
            }
        });

        // revenir en haut de page quand on clique sur le bouton
        backToTopButton.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Initialiser les tooltips pour les boutons d'action
        const buttons = document.querySelectorAll('.event-card a[href], .event-card button');
        buttons.forEach(button => {
            // Ignorer les liens qui ne sont pas des boutons d'action
            if (!button.querySelector('svg')) return;
            
            const isEdit = button.querySelector('svg path').getAttribute('d').includes('M15.232');
            const tooltip = document.createElement('div');
            tooltip.className = 'absolute bg-gray-800 text-white text-xs rounded py-1 px-2 -mt-10 opacity-0 transition-opacity duration-200';
            tooltip.textContent = isEdit ? 'Modifier' : 'Supprimer';
            tooltip.style.left = '50%';
            tooltip.style.transform = 'translateX(-50%)';
            
            button.style.position = 'relative';
            button.appendChild(tooltip);
            
            button.addEventListener('mouseenter', () => {
                tooltip.classList.remove('opacity-0');
                tooltip.classList.add('opacity-100');
            });
            
            button.addEventListener('mouseleave', () => {
                tooltip.classList.remove('opacity-100');
                tooltip.classList.add('opacity-0');
            });
        });
    </script>
</body>
</html>