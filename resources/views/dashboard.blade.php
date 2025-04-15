<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord - Evently</title>
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
                        <a href="#" class="flex items-center space-x-2 py-2 px-4 rounded bg-purple-600 text-white">
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
                <h1 class="text-3xl font-bold">Tableau de bord</h1>
                <p class="mt-2">Bienvenue {{ Auth::user()->name }}, voici un aperçu de vos activités</p>
            </div>
            
            <!-- stats -->
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <!-- stat 1 -->
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500">Événements créés</p>
                                <h3 class="text-3xl font-bold text-gray-800">{{ $eventsCreated }}</h3>
                            </div>
                            <div class="bg-purple-100 p-3 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <!-- stat 2 -->
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500">Participations</p>
                                <h3 class="text-3xl font-bold text-gray-800">{{ $participationsCount }}</h3>
                            </div>
                            <div class="bg-green-100 p-3 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <!-- stat 3 -->
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500">Événements à venir</p>
                                <h3 class="text-3xl font-bold text-gray-800">{{ $upcomingEvents }}</h3>
                            </div>
                            <div class="bg-blue-100 p-3 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- events à venir -->
                <div class="bg-white p-6 rounded-lg shadow-md mb-8">
                    <h2 class="text-xl font-bold mb-4 text-gray-800">Prochains événements</h2>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Événement</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lieu</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Participants</th>
                                    <th class="px-6 py-3 bg-gray-50"></th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($userUpcomingEvents as $event)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $event->name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($event->date)->locale('fr')->translatedFormat('d F Y') }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">{{ $event->location }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">{{ $event->participations->count() }} / {{ $event->capacity }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{ route('events.show', $event->id) }}" class="text-purple-600 hover:text-purple-900">Détails</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                                        Vous n'avez pas d'événements à venir. <a href="{{ route('events.index') }}" class="text-purple-600 hover:text-purple-900">Découvrir des événements</a>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- activités -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-bold mb-4 text-gray-800">Activité récente</h2>
                    
                    <div class="space-y-4">
                        @forelse($recentActivities as $activity)
                        <div class="flex items-start space-x-4">
                            <div class="bg-{{ $activity->type_color }}-100 p-2 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-{{ $activity->type_color }}-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $activity->icon_path }}" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-gray-700">{!! $activity->description !!}</p>
                                <p class="text-sm text-gray-500">{{ $activity->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        @empty
                        <p class="text-gray-500">Aucune activité récente.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- scripts -->
    <script>
        // gérer le menu du profil
        const profileButton = document.getElementById('profileButton');
        const profileDropdown = document.getElementById('profileDropdown');
        
        profileButton.addEventListener('click', function() {
            profileDropdown.classList.toggle('hidden');
        });
        
        // fermer le menu déroulant en cliquant ailleurs
        document.addEventListener('click', function(event) {
            if (!profileButton.contains(event.target) && !profileDropdown.contains(event.target)) {
                profileDropdown.classList.add('hidden');
            }
        });
    </script>
</body>
</html>