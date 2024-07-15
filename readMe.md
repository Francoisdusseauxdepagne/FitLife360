# FitLife360

## Introduction au projet
Lors de la conception de ce projet de coaching en ligne, je me suis trouvé(e) dans une situation unique : pas de stage trouvé, mais une forte motivation à réaliser un site innovant en utilisant Symfony 7

## Objectif
L'objectif principal de ce projet est de créer une plateforme permettant des interactions enrichissantes entre des membres et des coachs sportifs, facilitant ainsi la réservation de bilans, la participation à des événements flash, l'accès à des vidéos sportives et la possibilité pour les coachs de proposer des plans personnalisés

## Technologies utilisées
- Symfony 7
- Bootstrap 5
- HTML5
- SCSS/SASS/BEM
- Javascript

## Fonctionnalités principales
- Connexion et inscription
- Interaction entre utilisateurs & coach
- Reservations
- Stripe
- Interaction avec les utilisateurs (commentaires vidéos)
- Espacde Admin
- Formulaire de contact : inscription, envoi de message, connexion
- Page Error404

## Sécurité
- AccesDeniedHandler: gestion de permission
- Regex
- CSRF
- AppAuthenticator : Authentification et autorisation
- Gestion des rôles et des permission

## Défis rencontrés
Le principal défi a été de gérer les différentes interactions entre les utilisateurs et les coachs tout en assurant une expérience utilisateur intuitive. La gestion des réservations et des événements flash a également nécessité une attention particulière pour garantir un système sans faille

## Conclusion
Grâce à l'utilisation de Symfony 7, de Stripe pour les paiements et à une conception centrée sur l'utilisateur, ce projet de coaching en ligne est sur la bonne voie pour devenir une plateforme de référence pour les amateurs de sport et les coachs professionnels

## Installation projet avec Symfony 7
- Changer le nom du projet (nomProjet)
```bash
symfony new nomProjet --webapp
```

### Front-End
- Installation du bundle Symfony Webpack Encore
```bash
composer require symfony/webpack-encore-bundle
```

#### Installation de Boostrap 5, SASS, fontawesome
```bash
npm install bootstrap --save-dev

npm install sass-loader@^14.0.0 sass --save-dev

npm install @fortawesome/fontawesome-free
(app.js > require('@fortawesome/fontawesome-free/css/all.min.css'))
```

#### Utilisation du theme bootstrap5 pour nos form twig dans le projet
(# config/packages/twig.yaml)
```bash
twig:
    form_themes: ['bootstrap_5_layout.html.twig']
```
#### Utilisation du theme bootstrap5 dans le projet
- assets > styles > app.scss > @import "~bootstrap/scss/bootstrap";
- app.js > import 'bootstrap';

#### Installation de SASS (exemple)
- assets > styles > test.scss
- app.js > import './styles/test.scss'
- compilation de l'application :
```bash
npm run dev

npm run watch (continue)
```

### SASS :
- Décommenter les lignes suivantes dans le webpack.config.js :
    ```bash
    .enableSassLoader()
    ```

### Back-End
#### Installation environnement de base
- Configuration du env.local
- Changer l'url de la base de données : 8889 macOS, 3306 windows
- changeMe pour le mot de passe,
- Premier app pour le nom de l'utlisation phpMyAdmin
- Second app pour le nom de la base de données
```bash
DATABASE_URL="mysql://app:!ChangeMe!@127.0.0.1:3306/app?serverVersion=8.0.32&charset=utf8mb4""
```

#### Création de la base de données
```bash
symfony console d:d:c
```

#### Création d'un controller
- Changer le nom du controller (ExempleController)
```bash
symfony make:controller ExempleController
```

#### Mise en place de l'administrateur et du dashboard
```bash
composer require easycorp/easyadmin-bundle

symfony console make:admin:dashboard
```

#### Mise en place des migrations
```bash
symfony console make:migration

symfony console doctrine:migrations:migrate
(symfony console d:m:m)
```

#### Création de formulaire
- Changer le nom du formulaire (ExempleFormType)
```bash
symfony console make:form ExempleFormType
```

#### Lancement de l'application
```bash
symfony server:start
(symfony serve)
```