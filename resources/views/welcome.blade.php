<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Événements Connect</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <style>
        .hero-section {
            background: url('img/events-bg.jpg') no-repeat center center/cover;
            height: 100vh;
        }
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>
<body class="font-poppins">
    <!-- Barre de navigation -->
    <nav class="fixed top-0 w-full bg-black bg-opacity-70 text-white p-4 z-50">
        <div class="container mx-auto flex justify-between items-center">
            <div class="text-2xl font-bold"><a href="#">Evently</a></div>
            <div class="space-x-4">
                <a href="#apropos" class="hover:text-purple-300">À propos</a>
                <a href="#services" class="hover:text-purple-300">Services</a>
                <a href="#contact" class="hover:text-purple-300">Contact</a>
                <a href="{{ route('login') }}" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded transition duration-300">Se connecter</a>
                <a href="{{ route('register') }}" class="bg-white hover:bg-purple-100 text-purple-700 font-bold py-2 px-4 rounded border-2 border-purple-600 transition duration-300">S'inscrire</a>
            </div>
        </div>
    </nav>

    <!-- Section Hero -->
    <section class="hero-section flex items-center justify-center">
        <div class="bg-black bg-opacity-50 p-10 rounded-lg text-center text-white">
            <h1 class="text-5xl font-bold mb-4">Bienvenue sur Evently</h1>
            <p class="text-xl mb-8">Créez et participez à des évènements divers et variés !</p>
            <a href="#services" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-3 px-6 rounded-lg text-lg transition duration-300">
                Découvrir les services proposés
            </a>
        </div>
    </section>

    <!-- Section À propos -->
    <section id="apropos" class="bg-white py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-12 text-gray-800">À propos d'Evently</h2>
            <div class="flex flex-col md:flex-row items-center gap-8">
                <div class="md:w-1/2">
                    <img src="img/about-us.jpg" alt="Événement" class="rounded-lg shadow-lg w-full">
                </div>
                <div class="md:w-1/2">
                    <p class="text-lg text-gray-700 mb-4">
                        <span class="font-semibold">Evently</span> est la plateforme de référence pour tous vos besoins en matière d'organisation et de gestion d'événements. Que vous soyez un organisateur professionnel ou un particulier, notre solution vous offre tous les outils nécessaires pour créer des expériences mémorables.
                    </p>
                    <p class="text-lg text-gray-700 mb-4">
                        Fondée en 2025, notre mission est de simplifier l'organisation d'événements grâce à des outils innovants et une interface intuitive. Nous vous accompagnons à chaque étape, de la planification à l'exécution.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Services -->
    <section id="services" class="bg-gray-100 py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-12 text-gray-800">Nos Services</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Service 1 -->
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition duration-300">
                    <div class="bg-purple-500 text-white rounded-full w-16 h-16 flex items-center justify-center mb-4 mx-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-center mb-2">Planification d'événements</h3>
                    <p class="text-gray-600 text-center">
                        Créez et planifiez vos événements avec notre interface intuitive. Gérez les invitations et les inscriptions.
                    </p>
                </div>
                
                <!-- Service 2 -->
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition duration-300">
                    <div class="bg-purple-500 text-white rounded-full w-16 h-16 flex items-center justify-center mb-4 mx-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-center mb-2">Gestion des participants</h3>
                    <p class="text-gray-600 text-center">
                        Suivez les inscriptions, envoyez des rappels et gérez les listes de présence. Accédez aux statistiques en temps réel.
                    </p>
                </div>
                
                <!-- Service 3 -->
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition duration-300">
                    <div class="bg-purple-500 text-white rounded-full w-16 h-16 flex items-center justify-center mb-4 mx-auto">
                        <div class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <img src="img/qr-code.svg" alt="qr-code" color="white">
                        </div>
                    </div>
                    <h3 class="text-xl font-semibold text-center mb-2">QR code</h3>
                    <p class="text-gray-600 text-center">
                        Utilisation de QR Code unique pour avoir un accès protégés à vos évènements favoris !
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Contact -->
    <section id="contact" class="bg-white py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-12 text-gray-800">Contactez-nous</h2>
            
            <div class="max-w-lg mx-auto">
                <form class="space-y-4">
                    <div>
                        <label class="block text-gray-700 mb-2" for="name">Nom</label>
                        <input type="text" id="name" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-2" for="email">Email</label>
                        <input type="email" id="email" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-2" for="message">Message</label>
                        <textarea id="message" rows="4" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500"></textarea>
                    </div>
                    <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300 w-full">
                        Envoyer
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer avec Mentions légales -->
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
                        <li><a href="#apropos" class="text-gray-400 hover:text-purple-300">À propos</a></li>
                        <li><a href="#services" class="text-gray-400 hover:text-purple-300">Services</a></li>
                        <li><a href="#contact" class="text-gray-400 hover:text-purple-300">Contact</a></li>
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