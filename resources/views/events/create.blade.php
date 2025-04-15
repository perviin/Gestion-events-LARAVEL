<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un événement - Evently</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
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
                        <a href="#" class="flex items-center space-x-2 py-2 px-4 rounded bg-purple-600 text-white">
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
                <h1 class="text-3xl font-bold">Créer un événement</h1>
                <p class="mt-2">Organisez un nouvel événement et partagez-le avec la communauté</p>
            </div>
            
            <!-- form de création d'events -->
            <div class="p-6">
                <div class="bg-white rounded-lg shadow-md p-6">
                    @if ($errors->any())
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                        <p class="font-bold">Attention</p>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    
                    <form method="POST" action="{{ route('events.store') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nom de l'événement*</label>
                                    <input type="text" name="name" id="name" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-purple-500 focus:border-purple-500" value="{{ old('name') }}" required>
                                </div>
                                
                                <div>
                                    <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Catégorie*</label>
                                    <select name="category" id="category" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-purple-500 focus:border-purple-500" required>
                                        <option value="">Sélectionnez une catégorie</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div>
                                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description*</label>
                                    <textarea name="description" id="description" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-purple-500 focus:border-purple-500" required>{{ old('description') }}</textarea>
                                </div>
                                
                                <div>
                                    <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Image de couverture</label>
                                    <input type="file" name="image" id="image" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-purple-500 focus:border-purple-500">
                                    <p class="mt-1 text-sm text-gray-500">Format recommandé: JPG ou PNG, max 2MB</p>
                                </div>
                            </div>
                            
                            <!-- date, lieu et capacité -->
                            <div class="space-y-4">
                                <div>
                                    <label for="date" class="block text-sm font-medium text-gray-700 mb-1">Date et heure*</label>
                                    <input type="datetime-local" name="date" id="date" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-purple-500 focus:border-purple-500" value="{{ old('date') }}" required>
                                </div>
                                
                                <div>
                                    <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Lieu*</label>
                                    <input type="text" name="location" id="location" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-purple-500 focus:border-purple-500" value="{{ old('location') }}" required>
                                </div>
                                
                                <div>
                                    <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Adresse complète*</label>
                                    <input type="text" name="address" id="address" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-purple-500 focus:border-purple-500" value="{{ old('address') }}" required>
                                </div>
                                
                                <div>
                                    <label for="capacity" class="block text-sm font-medium text-gray-700 mb-1">Capacité (nombre de participants)*</label>
                                    <input type="number" name="capacity" id="capacity" min="1" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-purple-500 focus:border-purple-500" value="{{ old('capacity', 20) }}" required>
                                </div>
                                
                                <div>
                                    <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Prix*</label>
                                    <div class="relative rounded-md shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500 sm:text-sm">€</span>
                                        </div>
                                        <input type="number" step="0.01" name="price" id="price" class="w-full pl-7 px-4 py-2 border border-gray-300 rounded-md focus:ring-purple-500 focus:border-purple-500" value="{{ old('price', 0) }}" required>
                                    </div>
                                </div>
                                
                                <div class="flex items-center mt-4">
                                    <input type="checkbox" name="is_private" id="is_private" class="rounded text-purple-600 focus:ring-purple-500" {{ old('is_private') ? 'checked' : '' }}>
                                    <label for="is_private" class="ml-2 text-sm text-gray-700">Événement privé (uniquement visible sur invitation)</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-8 flex justify-end">
                            <a href="{{ route('events.index') }}" class="px-6 py-2 border border-gray-300 rounded-md text-gray-700 mr-4 hover:bg-gray-50">Annuler</a>
                            <button type="submit" class="px-6 py-2 bg-purple-600 border border-transparent rounded-md font-medium text-white hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                                Créer l'événement
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

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

        $(document).ready(function() {
            // script pour l'autocomplétion du champ location
            $("#location").autocomplete({
                source: "{{ route('locations.index') }}",
                minLength: 1,
                select: function(event, ui) {
                    console.log("Lieu sélectionné: " + ui.item.value);
                }
            });
        });
    </script>
</body>
</html>