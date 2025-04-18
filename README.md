
# Plateforme de Gestion d'Événements

Une application web permettant aux utilisateurs de consulter des événements et de s’y inscrire facilement. Les administrateurs peuvent créer, modifier et supprimer des événements, ainsi que suivre les participations.

## Fonctionnalités principales

-   Création et gestion d'événements
    
-   Inscription aux événements pour les utilisateurs
    
-   Système d'authentification
    
-   Interface d'administration
    
-   Gestion des participations avec date et notes
    

----------

##  Technologies utilisées

-   PHP 8+
    
-   Laravel 10
    
-   MySQL
    
-   Blade (template engine)
    
-   Tailwind CSS
    
-   Laravel Breeze
    

----------

##  Installation

1.  **Cloner le dépôt**
    

```
git clone https://github.com/perviin/Gestion-events-Laravel.git
cd Gestion-events-Laravel
```

2.  **Installer les dépendances PHP**
    

```
composer install
```

3.  **Copier le fichier d'environnement**
    

```
cp .env.example .env
```

4.  **Générer la clé de l'application**
    

```
php artisan key:generate
```

5.  **Configurer la base de données**
    

Dans le fichier `.env`, configure tes identifiants de base de données :

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nom_de_ta_base
DB_USERNAME=ton_utilisateur
DB_PASSWORD=ton_mot_de_passe
```

6.  **Lancer les migrations**
    

```
php artisan migrate
```

7.  **Lancer le serveur de développement**
    

```
php artisan serve
```

Accède à ton projet sur `http://localhost:8000`

