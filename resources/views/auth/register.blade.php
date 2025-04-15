<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Evently</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <style>
        .register-bg {
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

    <!-- inscription -->
    <section class="register-bg flex items-center justify-center pt-16">
        <div class="container mx-auto px-4 py-16">
            <div class="max-w-xl mx-auto bg-white bg-opacity-95 p-8 rounded-lg shadow-xl">
                <h1 class="text-3xl font-bold text-center mb-8 text-gray-800">Créez votre compte Evently</h1>
                
                <form action="{{ route('register') }}" method="POST" class="space-y-6" id="register-form">
                    @csrf
                    <!-- infos persos -->
                    <div class="space-y-4">
                        <h2 class="text-xl font-semibold text-purple-700 border-b pb-2 border-gray-200">Informations personnelles</h2>
                        
                        <div>
                            <label class="block text-gray-700 mb-2" for="firstname">Nom complet</label>
                            <input type="text" id="name" name="name" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                        </div>
                        
                        <div>
                            <label class="block text-gray-700 mb-2" for="email">Email</label>
                            <input type="email" id="email" name="email" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                        </div>
                        
                        <div>
                            <label class="block text-gray-700 mb-2" for="phone">Téléphone (optionnel)</label>
                            <input type="tel" id="phone" name="phone" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                        </div>
                    </div>
                    
                    <!-- infos compte -->
                    <div class="space-y-4">
                        <h2 class="text-xl font-semibold text-purple-700 border-b pb-2 border-gray-200">Informations de compte</h2>
                        
                        <div>
                            <label class="block text-gray-700 mb-2" for="username">Nom d'utilisateur</label>
                            <input type="text" id="username" name="username" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                        </div>
                        
                        <div>
                            <label class="block text-gray-700 mb-2" for="password">Mot de passe</label>
                            <input type="password" id="password" name="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                            <p class="text-xs text-gray-500 mt-1">Le mot de passe doit contenir au moins 8 caractères, incluant majuscules, minuscules et chiffres.</p>
                        </div>
                        
                        <div>
                            <label class="block text-gray-700 mb-2" for="password_confirmation">Confirmer le mot de passe</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                        </div>
                    </div>
                    
                    <!-- préférences -->
                    <div class="space-y-4">
                        <h2 class="text-xl font-semibold text-purple-700 border-b pb-2 border-gray-200">Préférences</h2>
                        
                        <div>
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" id="newsletter" name="newsletter" class="form-checkbox h-5 w-5 text-purple-600">
                                <span class="text-gray-700">Je souhaite recevoir des actualités et offres par email</span>
                            </label>
                        </div>
                        
                        <div>
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" id="terms" name="terms" class="form-checkbox h-5 w-5 text-purple-600" required>
                                <span class="text-gray-700">J'accepte les <a href="#" class="text-purple-600 hover:underline">conditions générales</a> et la <a href="#" class="text-purple-600 hover:underline">politique de confidentialité</a></span>
                            </label>
                        </div>
                    </div>
                    
                    <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300 w-full">
                        Créer mon compte
                    </button>
                    
                    <p class="text-center text-gray-600">
                        Vous avez déjà un compte? <a href="{{ route('login') }}" class="text-purple-600 hover:underline">Se connecter</a>
                    </p>
                </form>
            </div>
        </div>
    </section>

    <!-- footer -->
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

    <!-- Script pour la redirection -->
    <!--<script>
        document.getElementById('register-form').addEventListener('submit', function(e) {
            e.preventDefault();
            // Simulation d'enregistrement
            setTimeout(function() {
                window.location.href = "/dashboard";
            }, 1000);
    }) 
    </script> -->
</body>
</html>