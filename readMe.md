# FitLife360

## Introduction au projet
Lors de la conception de ce projet de coaching en ligne, je me suis trouvé(e) dans une situation unique : pas de stage trouvé, mais une forte motivation à réaliser un site innovant en utilisant Symfony 7.

## Objectif
L'objectif principal de ce projet est de créer une plateforme permettant des interactions enrichissantes entre des membres et des coachs sportifs, facilitant ainsi la réservation de bilans, la participation à des événements flash, l'accès à des vidéos sportives et la possibilité pour les coachs de proposer des plans personnalisés.

## Technologies utilisées
- Symfony 7
- Bootstrap 5
- HTML5
- SCSS/SASS/BEM
- JavaScript
- Stripe
- ChatGPT 3.5

## Fonctionnalités principales
- Connexion et inscription
- Interaction entre utilisateurs & coachs
- Réservations
- Stripe pour les paiements
- Interaction avec les utilisateurs (commentaires vidéos)
- Espace Admin
- Formulaire de contact : inscription, envoi de message, connexion
- Page Error404

## Sécurité
- `AccesDeniedHandler`: gestion de permission
- Regex
- CSRF
- `AppAuthenticator`: Authentification et autorisation
- Gestion des rôles et des permissions

## Défis rencontrés
Le principal défi a été de gérer les différentes interactions entre les utilisateurs et les coachs tout en assurant une expérience utilisateur intuitive. La gestion des réservations et des événements flash a également nécessité une attention particulière, et l'installation de Stripe fut une épreuve de 3 jours.

## Conclusion
Grâce à l'utilisation de Symfony 7, de Stripe pour les paiements et à une conception centrée sur l'utilisateur, ce projet de coaching en ligne est sur la bonne voie pour devenir une plateforme de référence pour les amateurs de sport et les coachs professionnels.

## Installation du projet avec Symfony 7

### Front-End
1. Changer le nom du projet (`nomProjet`)
    ```bash
    symfony new nomProjet --webapp
    ```

2. Installation du bundle Symfony Webpack Encore
    ```bash
    composer require symfony/webpack-encore-bundle
    ```

3. Installation de Bootstrap 5, SASS, FontAwesome
    ```bash
    npm install bootstrap --save-dev
    npm install sass-loader@^14.0.0 sass --save-dev
    npm install @fortawesome/fontawesome-free
    ```

4. Import de FontAwesome dans `app.js`
    ```javascript
    require('@fortawesome/fontawesome-free/css/all.min.css')
    ```

5. Utilisation du thème Bootstrap 5 pour les formulaires Twig (`config/packages/twig.yaml`)
    ```yaml
    twig:
        form_themes: ['bootstrap_5_layout.html.twig']
    ```

6. Import de Bootstrap dans `app.scss`
    ```scss
    @import "~bootstrap/scss/bootstrap";
    ```

7. Import de Bootstrap dans `app.js`
    ```javascript
    import 'bootstrap';
    ```

8. Compilation de l'application
    ```bash
    npm run dev
    npm run watch
    ```

9. Exemple de la configuration de la la twig `base.html.twig` :
    ```twig
    <body>
        {{ include('commons/test.html.twig') }}
        {{ include('commons/test.html.twig') }}
        {% block body %}{% endblock %}
        {{ include('commons/test.html.twig')}}
        {{ include('commons/test.html.twig') }}
    </body>
    ```

10. Création de message flash (exemple)
    ```bash
    {% for label, messages in app.flashes %}
    {% for message in messages %}
        <div class="m-0 alert alert-{{ label }}">
            {{ message }}
        </div>
    ```
    
### Back-End
1. Configuration de l'environnement (`.env.local`)
    ```bash
    DATABASE_URL="mysql://app:!ChangeMe!@127.0.0.1:3306/app?serverVersion=8.0.32&charset=utf8mb4"
    ```

2. Création de la base de données
    ```bash
    symfony console doctrine:database:create
    ```

3. Création d'un contrôleur
    ```bash
    symfony make:controller ExempleController
    ```

4. Installation et configuration de EasyAdmin
    ```bash
    composer require easycorp/easyadmin-bundle
    symfony console make:admin:dashboard
    ```

5. Mise en place des migrations
    ```bash
    symfony console make:migration
    symfony console doctrine:migrations:migrate
    ```

6. Création d'un formulaire
    ```bash
    symfony console make:form ExempleFormType
    ```

7. Lancement de l'application
    ```bash
    symfony server:start
    ```
