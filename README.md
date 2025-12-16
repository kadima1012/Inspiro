# Inspiro

## Description
Inspiro est une plateforme en ligne permettant aux artistes de vendre leurs œuvres, de recevoir des commandes personnalisées et de présenter leurs créations au public. Les utilisateurs peuvent parcourir différentes catégories d’art, interagir avec les artistes, passer des commandes et effectuer des transactions en ligne.

## Objectif
Fournir un espace centralisé pour que les artistes puissent commercialiser leur art et se connecter avec des acheteurs potentiels.  

## Public cible
Artistes professionnels et amateurs, collectionneurs, et clients souhaitant acheter de l'art.

## Types d'utilisateurs
- **Visiteurs non connectés :** parcourent les œuvres et les profils des artistes.  
- **Membres connectés :** suivent des artistes, reçoivent des notifications et passent des commandes.  
- **Artistes :** gèrent leur portfolio, téléversent des œuvres et reçoivent des commandes.  
- **Administrateurs :** gèrent les utilisateurs, les œuvres et effectuent des actions CRUD sur la base de données.

## Fonctionnalités
- Gestion de compte et profils pour utilisateurs, artistes et administrateurs.  
- Publication et gestion des œuvres d’art.  
- Gestion des commandes et paiements (simulation).  
- Upload de fichiers et gestion des médias.  
- Notifications et communication par email.  
- Système de rôles et permissions granulaire.

## Technologies
- **Backend :** PHP 8.3, Laravel  
- **Base de données :** MariaDB  
- **Frontend :** HTML, CSS, JavaScript, Tailwind CSS, Blade Templates  
- **Dépendances :** Composer  
- **Gestion des rôles :** Laravel Spatie  
- **Tests :** PHPUnit  

## Installation
1. Copier le projet dans le serveur local (`www` ou équivalent).  
2. Copier `.env.example` en `.env` et configurer la base de données :
   DB_DATABASE=Inspiro
   DB_USERNAME=root
   DB_PASSWORD=''
composer install
php artisan migrate --seed
Accéder à l'application via http://localhost/Inspiro/public.

## Structure du projet

app/ : logique applicative et modèles.

routes/ : routage Laravel.

resources/views/ : templates Blade.

public/ : fichiers accessibles depuis le navigateur.

database/migrations et database/seeders : gestion base de données.

storage/ : fichiers uploadés et logs.

Auteur

Auner Eduard