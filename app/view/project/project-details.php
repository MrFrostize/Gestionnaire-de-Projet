<!-- project-details.php -->

<!-- Lien vers le CSS de Bootstrap pour le style de la page -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<div class="container mt-5">
    <h1 class="mb-4">Détails du Projet</h1>
    
    <!-- Section affichant les détails du projet -->
    <div class="bg-light p-4 rounded">
        <h2><?= $projectDetails['Titre'] ?></h2>
        <p><?= $projectDetails['Description'] ?></p>
    </div>

    <!-- Section pour ajouter une nouvelle tâche au projet -->
    <div class="task-section mt-5">
        <h2 class="mb-4">Ajouter une tâche</h2>
        
        <!-- Formulaire pour soumettre les détails d'une nouvelle tâche -->
        <form action="/add-task-to-project" method="post" class="bg-light p-4 rounded">
            
            <div class="form-group">
                <label for="title">Titre de la tâche:</label>
                <input type="text" id="title" name="title" class="form-control" placeholder="Titre de la tâche" required>
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" class="form-control" rows="5" placeholder="Description détaillée de la tâche" required></textarea>
            </div>

            <div class="form-group">
                <label for="priority">Priorité:</label>
                <select id="priority" name="priority" class="form-control">
                    <option value="Haute">Haute</option>
                    <option value="Moyenne">Moyenne</option>
                    <option value="Basse">Basse</option>
                </select>
            </div>

            <!-- Champ caché pour stocker l'ID du projet -->
            <input type="hidden" name="projectId" value="<?= $projectDetails['ID_Projet'] ?>">

            <div class="form-group">
                <input type="submit" value="Ajouter la tâche" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>

<!-- Scripts nécessaires pour le fonctionnement de Bootstrap et ses dépendances -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
