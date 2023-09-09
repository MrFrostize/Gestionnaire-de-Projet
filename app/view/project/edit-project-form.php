<!-- Lien vers la feuille de style CSS de Bootstrap pour le design de la page -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<div class="container mt-5">
    <!-- Titre de la section -->
    <h2 class="mb-4">Modifier le projet</h2>

    <!-- Formulaire pour mettre à jour les détails du projet -->
    <form action="/edit-project?id=<?= $projectDetails['ID_Projet'] ?>" method="post" class="bg-light p-4 rounded">
        
        <!-- Champ pour modifier le titre du projet -->
        <div class="form-group">
            <label for="title">Titre:</label>
            <input type="text" id="title" name="title" class="form-control" placeholder="Titre du projet" value="<?= $projectDetails['Titre'] ?>" required>
        </div>

        <!-- Zone de texte pour modifier la description du projet -->
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description" class="form-control" rows="5" placeholder="Description détaillée du projet" required><?= $projectDetails['Description'] ?></textarea>
        </div>

        <!-- Bouton pour soumettre le formulaire et mettre à jour le projet -->
        <div class="form-group">
            <input type="submit" value="Modifier" class="btn btn-primary">
        </div>
    </form>
</div>

<!-- Scripts nécessaires pour le bon fonctionnement de Bootstrap et ses dépendances -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
