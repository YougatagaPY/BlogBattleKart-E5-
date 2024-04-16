# BattleKart - BLOG

Bienvenue sur le projet **Blog BattleKart **, un blog  basée sur Symfony 6.3.9 et utilisant SQLite comme système de gestion de base de données. 
BattleKart souhaite lancer un blog où les clients pourront partager leurs expériences. Ce blog servira de plateforme pour les amateurs de karting électrique et de réalité augmentée afin de raconter leurs courses, échanger des astuces et célébrer leurs victoires. Cela aidera à construire une communauté plus engagée autour de l'expérience unique que propose BattleKart, tout en offrant un espace pour des retours précieux qui pourront guider les améliorations futures.
## Prérequis

Pour lancer ce projet sur votre machine, assurez-vous de disposer des prérequis suivants :

- **PHP** version 8.2.7
- **Composer** pour la gestion des dépendances PHP
- **Symfony CLI** pour exécuter et gérer l'application Symfony
- **Extension PDO SQLite pour PHP** pour la gestion de la base de données SQLite :
Dans votre fichier "php.ini" enlevez le commentaire pour "extension=pdo_sqlite" : 
(Ctrl + F pour trouver le pdo_sqlite)


## Installation rapide

Voici comment configurer et démarrer le projet Blog BattleKart sur votre système local :

### 1. Clonage du projet

Clonez le dépôt GitHub à l'aide de la commande suivante :

```bash
git clone https://github.com/YougatagaPY/BlogBattleKart-E5-.git
cd BlogBattleKart-E5-
```
### 2. Installation des dépendances

Dans le dossier du projet, exécutez Composer pour installer toutes les dépendances nécessaires :

```php
COMPOSER install
```

### 3. Démarrage du serveur de développement
```php
SYMFONY server:start
```
