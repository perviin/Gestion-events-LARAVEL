<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Événements Connect</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <style>
        .login-bg {
            background: url('/api/placeholder/1600/900') no-repeat center center/cover;
            min-height: 100vh;
        }
    </style>
</head>
<body class="font-poppins">

    <!-- Section de connexion -->
    <div class="login-bg flex items-center justify-center">
        <div class="container mx-auto px-4 py-24">
            <div class="max-w-md mx-auto bg-white rounded-lg shadow-xl overflow-hidden">
                <h2 class="text-2xl font-bold text-center">Connexion</h2>
                
                <div class="py-8 px-6">
                    <form class="space-y-6">
                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-gray-700 font-medium mb-2">Adresse email</label>
                            <input type="email" id="email" name="email" class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" placeholder="votre@email.com" required>
                        </div>
                        
                        <!-- Mot de passe -->
                        <div>
                            <div class="flex justify-between mb-2">
                                <label for="password" class="block text-gray-700 font-medium">Mot de passe</label>
                                <a href="#" class="text-sm text-purple-600 hover:text-purple-800">Mot de passe oublié ?</a>
                            </div>
                            <input type="password" id="password" name="password" class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" placeholder="••••••••" required>
                        </div>
                        
                        <!-- Se souvenir de moi -->
                        <div class="flex items-center">
                            <input type="checkbox" id="remember" name="remember" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                            <label for="remember" class="ml-2 block text-gray-700">Se souvenir de moi</label>
                        </div>
                        
                        <!-- Bouton de connexion -->
                        <div>
                            <button type="submit" class="w-full bg-purple-600 hover:bg-purple-700 text-white font-bold py-3 px-4 rounded transition duration-300">
                                Se connecter
                            </button>
                        </div>
                    </form>
                    
                    <!-- Séparateur -->
                    <div class="relative my-6">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white text-gray-500">Ou</span>
                        </div>
                    </div>
                    
                    <!-- Connexion avec réseaux sociaux -->
                    <div class="space-y-4">
                        <button class="w-full flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded transition duration-300">
                            <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M22.675 0H1.325C.593 0 0 .593 0 1.325v21.351C0 23.407.593 24 1.325 24H12.82v-9.294H9.692v-3.622h3.128V8.413c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12V24h6.116c.73 0 1.323-.593 1.323-1.325V1.325C24 .593 23.407 0 22.675 0z"/>
                            </svg>
                            Continuer avec Facebook
                        </button>
                        <button class="w-full flex items-center justify-center bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-4 rounded transition duration-300">
                            <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M12.545 10.239v3.821h5.445c-.712 2.315-2.647 3.972-5.445 3.972-3.332 0-6.033-2.701-6.033-6.032s2.701-6.032 6.033-6.032c1.498 0 2.866.554 3.921 1.465l2.814-2.814A9.996 9.996 0 0 0 12.545 2C7.021 2 2.543 6.477 2.543 12s4.478 10 10.002 10c8.396 0 10.249-7.85 9.426-11.748l-9.426-.013z"/>
                            </svg>
                            Continuer avec Google
                        </button>
                    </div>
                    
                    <!-- Inscription -->
                    <div class="text-center mt-6">
                        <p class="text-gray-600">
                            Vous n'avez pas de compte ? 
                            <a href="/register" class="text-purple-600 hover:text-purple-800 font-medium">S'inscrire</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-4">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; 2025 Événements Connect. Tous droits réservés.</p>
        </div>
    </footer>
</body>
</html>