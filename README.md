# Gestionnaire de Projet

Un système simple de gestion de projets avec des fonctionnalités d'authentification, de création de projets, de tâches, etc.

## Structure du projet

### Dossiers et fichiers principaux

- **Controllers** : Contient la logique de traitement des requêtes et des réponses.
  - `HomeController.php`: Gère la page d'accueil.
  - `ProjectController.php`: Gère les fonctionnalités liées aux projets.
  - `TaskController.php`: Gère les fonctionnalités liées aux tâches.
  - `UserController.php`: Gère l'authentification et les fonctionnalités liées aux utilisateurs.

- **Models** : Contient la logique métier et les interactions avec la base de données.
  - `Database.php`: Singleton pour la connexion à la base de données.
  - `db.php`: Configuration de la base de données.
  - `Project.php`: Modèle pour les projets.
  - `Task.php`: Modèle pour les tâches.
  - `User.php`: Modèle pour les utilisateurs.

- **Views** : Contient les fichiers HTML pour l'affichage.
  - `home/index.php`: Vue de la page d'accueil.

- `styles.css`: Fichier CSS pour le style du site.
- `scripts.js`: Fichier JavaScript pour la logique côté client.

## Comment démarrer

### Prérequis

- Avoir PHP installé sur votre machine.

### Étapes

1. Clonez le dépôt.
2. Accédez au dossier du projet via le terminal.
3. Lancez le serveur PHP intégré avec la commande suivante :
   ```bash
   php -S localhost:3000 -t public
1. Dans votre navigateur, accédez à http://localhost:3000 pour voir la page d'accueil.
2. Configurez votre base de données en utilisant les informations dans db.php.
### Contribution
- Les contributions sont les bienvenues ! Veuillez créer une issue ou une pull request pour toute contribution ou suggestion.

### Licence
- Ce projet est sous licence MIT.
