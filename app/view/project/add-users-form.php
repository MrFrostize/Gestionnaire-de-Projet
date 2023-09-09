<!-- Lien vers la feuille de style CSS de Bootstrap pour le design de la page -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<div class="container mt-5">
    <!-- Titre de la section -->
    <h2 class="mb-4">Ajouter un utilisateur au projet</h2>

    <!-- Formulaire pour ajouter un nouvel utilisateur au projet -->
    <form action="/process-add-users" method="post" class="bg-light p-4 rounded">
        <!-- Champ caché pour stocker l'ID du projet -->
        <input type="hidden" name="project_id" value="<?= $projectId ?>">

        <!-- Champ pour entrer le nom de l'utilisateur -->
        <div class="form-group">
            <label for="user_nom">Nom :</label>
            <input type="text" name="user_nom" class="form-control" placeholder="Dupont" required>
        </div>

        <!-- Champ pour entrer le prénom de l'utilisateur -->
        <div class="form-group">
            <label for="user_prenom">Prénom :</label>
            <input type="text" name="user_prenom" class="form-control" placeholder="Jean" required>
        </div>

        <!-- Champ pour entrer l'adresse e-mail de l'utilisateur -->
        <div class="form-group">
            <label for="user_email">Adresse e-mail de l'utilisateur :</label>
            <input type="email" name="user_email" class="form-control" placeholder="jean.dupont@example.com" required>
        </div>

        <!-- Champ pour entrer le mot de passe par défaut pour l'utilisateur -->
        <div class="form-group">
            <label for="user_password_default">Mot de passe par défaut :</label>
            <input type="password" name="user_password_default" class="form-control" placeholder="Mot de passe sécurisé" required>
        </div>

        <!-- Bouton pour soumettre le formulaire et ajouter l'utilisateur -->
        <div class="form-group">
            <input type="submit" value="Ajouter" class="btn btn-primary">
        </div>
    </form>
</div>

<!-- Scripts nécessaires pour le bon fonctionnement de Bootstrap et ses dépendances -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
