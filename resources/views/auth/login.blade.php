<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Evently</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <style>
        .login-bg {
            background: url('img/events-bg.jpg') no-repeat center center/cover;
            min-height: 100vh;
        }
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>
<body class="font-poppins">
    <nav class="fixed top-0 w-full bg-black bg-opacity-70 text-white p-4 z-50">
        <div class="container mx-auto flex justify-between items-center">
            <div class="text-2xl font-bold"><a href="#">Evently</a></div>
            <div class="space-x-4">
                <a href="/#apropos" class="hover:text-purple-300">À propos</a>
                <a href="/#services" class="hover:text-purple-300">Services</a>
                <a href="/#contact" class="hover:text-purple-300">Contact</a>
                <a href="{{ route('login') }}" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded transition duration-300">Se connecter</a>
                <a href="{{ route('register') }}" class="bg-white hover:bg-purple-100 text-purple-700 font-bold py-2 px-4 rounded border-2 border-purple-600 transition duration-300">S'inscrire</a>
            </div>
        </div>
    </nav>

    <!-- section de connexion -->
    <section class="login-bg flex items-center justify-center pt-16">
        <div class="container mx-auto px-4 py-16">
            <div class="max-w-md mx-auto bg-white bg-opacity-95 p-8 rounded-lg shadow-xl">
                <h1 class="text-3xl font-bold text-center mb-8 text-gray-800">Connexion à Evently</h1>
                
                <!-- affichage des erreurs d'authentification -->
                @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                
                <!-- formulaire de connexion -->
                <form action="{{ route('login') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-gray-700 mb-2" for="email">Email ou nom d'utilisateur</label>
                        <input type="text" id="email" name="email" class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                    </div>
                    
                    <div>
                        <div class="flex justify-between mb-2">
                            <label class="block text-gray-700" for="password">Mot de passe</label>
                            <a href="{{ route('password.request') }}" class="text-sm text-purple-600 hover:underline">Mot de passe oublié?</a>
                        </div>
                        <input type="password" id="password" name="password" class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                    </div>
                    
                    <div>
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" id="remember" name="remember" class="form-checkbox h-5 w-5 text-purple-600">
                            <span class="text-gray-700">Se souvenir de moi</span>
                        </label>
                    </div>
                    
                    <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300 w-full">
                        Se connecter
                    </button>
                    
                    <p class="text-center text-gray-600 pt-4">
                        Vous n'avez pas de compte? <a href="{{ route('register') }}" class="text-purple-600 hover:underline">S'inscrire</a>
                    </p>
                </form>
            </div>
        </div>
    </section>

    <footer class="bg-gray-800 text-white py-8">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between">
                <div class="mb-6 md:mb-0">
                    <h3 class="text-xl font-bold mb-4">Evently</h3>
                    <p class="text-gray-400">La solution complète pour vos événements</p>
                </div>
                
                <div class="mb-6 md:mb-0">
                    <h3 class="text-xl font-bold mb-4">Liens rapides</h3>
                    <ul class="space-y-2">
                        <li><a href="/#apropos" class="text-gray-400 hover:text-purple-300">À propos</a></li>
                        <li><a href="/#services" class="text-gray-400 hover:text-purple-300">Services</a></li>
                        <li><a href="/#contact" class="text-gray-400 hover:text-purple-300">Contact</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-xl font-bold mb-4">Mentions légales</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-purple-300">Conditions générales</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-purple-300">Politique de confidentialité</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-purple-300">Mentions légales</a></li>
                    </ul>
                </div>
            </div>
            
            <hr class="border-gray-700 my-6">
            
            <div class="text-center text-gray-400">
                <p>&copy; 2025 Evently. Tous droits réservés.</p>
            </div>
        </div>
    </footer>
</body>
</html>