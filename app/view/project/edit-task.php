<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Métadonnées de base pour l'encodage et la mise en page responsive -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Titre de la page -->
    <title>Modifier la Tâche</title>

    <!-- Lien vers la feuille de style CSS pour le design de la page -->
    <link rel="stylesheet" href="/css/styles.css">
</head>

<body>
    <div class="container">
        <!-- Titre de la section -->
        <h1>Modifier la Tâche</h1>

        <!-- Formulaire pour mettre à jour les détails de la tâche -->
        <form action="/update-task" method="post">
            <!-- Champ caché pour stocker l'ID de la tâche -->
            <input type="hidden" name="task_id" value="<?= $task->ID_Tâche ?>">

            <!-- Champ pour modifier le titre de la tâche -->
            <div class="form-group">
                <label for="title">Titre :</label>
                <input type="text" name="title" value="<?= $task->Titre ?>" required>
            </div>
            
            <!-- Zone de texte pour modifier la description de la tâche -->
            <div class="form-group">
                <label for="description">Description :</label>
                <textarea name="description" required><?= $task->Description ?></textarea>
            </div>

            <!-- Sélecteur déroulant pour modifier la priorité de la tâche -->
            <div class="form-group">
                <label for="priority">Priorité :</label>
                <select name="priority">
                    <option value="Haute" <?= $task->Priorité == 'Haute' ? 'selected' : '' ?>>Haute</option>
                    <option value="Moyenne" <?= $task->Priorité == 'Moyenne' ? 'selected' : '' ?>>Moyenne</option>
                    <option value="Basse" <?= $task->Priorité == 'Basse' ? 'selected' : '' ?>>Basse</option>
                </select>
            </div>

            <!-- Sélecteur déroulant pour modifier le statut de la tâche -->
            <div class="form-group">
                <label for="status">Statut :</label>
                <select name="status">
                    <option value="Non débuté" <?= $task->Statut == 'Non débuté' ? 'selected' : '' ?>>Non débuté</option>
                    <option value="En cours" <?= $task->Statut == 'En cours' ? 'selected' : '' ?>>En cours</option>
                    <option value="Terminé" <?= $task->Statut == 'Terminé' ? 'selected' : '' ?>>Terminé</option>
                </select>
            </div>

            <!-- Bouton pour soumettre le formulaire et mettre à jour la tâche -->
            <div class="btn-container">
                <input type="submit" value="Mettre à jour" class="btn">
            </div>
        </form>
    </div>
</body>

</html>
