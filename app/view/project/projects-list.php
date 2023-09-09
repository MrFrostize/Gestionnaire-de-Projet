<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Projets</title>
    <!-- Lien vers le fichier CSS pour le style de la page -->
    <link rel="stylesheet" href="/css/styles.css">
</head>

<body>
    <div class="container">
        <h1>Mes Projets</h1>
        
        <!-- Vérification si l'utilisateur n'a aucun projet -->
        <?php if (empty($projects)) : ?>
            <p class="no-projects">Vous n'avez actuellement aucun projet.</p>
        <?php else : ?>
            <!-- Liste des projets de l'utilisateur -->
            <ul class="project-list">
                <?php foreach ($projects as $project) : ?>
                    <li class="project-item">
                        <h2><?= $project['Titre'] ?></h2>
                        <p><?= $project['Description'] ?></p>

                        <!-- Options disponibles uniquement pour l'administrateur du projet -->
                        <?php if ($_SESSION['user_id'] == $project['ID_Administrateur']) : ?>
                            <a href="/edit-project?id=<?= $project['ID_Projet'] ?>" class="btn">Modifier le projet</a>
                            <a href="/delete-project?id=<?= $project['ID_Projet'] ?>" class="btn">Supprimer le projet</a>
                            <a href="/project-details?id=<?= $project['ID_Projet'] ?>" class="btn">Ajouter des tâches</a>
                            <a href="/add-users-to-project?id=<?= $project['ID_Projet'] ?>" class="btn">Ajouter des utilisateurs</a>
                        <?php endif; ?>

                        <!-- Affichage des tâches associées à ce projet -->
                        <?php if (isset($project['tasks']) && is_array($project['tasks']) && !empty($project['tasks'])) : ?>
                            <ul class="task-list">
                                <?php foreach ($project['tasks'] as $task) : ?>
                                    <li class="task-item">
                                        <strong><?= $task['Titre'] ?></strong> - <?= $task['Description'] ?>

                                        <!-- Options pour modifier la priorité de la tâche, disponibles uniquement pour l'administrateur -->
                                        <?php if ($project['isAdmin']) : ?>
                                            <select onchange="updateTaskAttribute(<?= $task['ID_Tâche'] ?>, 'Priorité', this.value)">
                                                <option value="Haute" <?= $task['Priorité'] == 'Haute' ? 'selected' : '' ?>>Haute</option>
                                                <option value="Moyenne" <?= $task['Priorité'] == 'Moyenne' ? 'selected' : '' ?>>Moyenne</option>
                                                <option value="Basse" <?= $task['Priorité'] == 'Basse' ? 'selected' : '' ?>>Basse</option>
                                            </select>
                                        <?php else : ?>
                                            <!-- Si l'utilisateur n'est pas l'administrateur, il voit simplement la priorité -->
                                            Priorité: <?= $task['Priorité'] ?>
                                        <?php endif; ?>

                                        <!-- Sélecteur pour modifier le statut de la tâche -->
                                        <select onchange="updateTaskStatus(<?= $task['ID_Tâche'] ?>, this.value)">
                                            <option value="Non débuté" <?= $task['Statut'] == 'Non débuté' ? 'selected' : '' ?>>Non débuté</option>
                                            <option value="En cours" <?= $task['Statut'] == 'en cours' ? 'selected' : '' ?>>En cours</option>
                                            <option value="Terminé" <?= $task['Statut'] == 'terminé' ? 'selected' : '' ?>>Terminé</option>
                                        </select>
                                        
                                        <!-- Options pour supprimer ou modifier la tâche, disponibles uniquement pour l'administrateur -->
                                        <?php if ($_SESSION['user_id'] == $project['ID_Administrateur']) : ?>
                                            <a href="/delete-task?id=<?= $task['ID_Tâche'] ?>" class="btn">Supprimer la tâche</a>
                                            <a href="/edit-task?id=<?= $task['ID_Tâche'] ?>" class="btn btn-warning">Modifier la tâche</a>
                                        <?php endif; ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php else : ?>
                            <!-- Message affiché s'il n'y a pas de tâches pour ce projet -->
                            <p class="no-tasks">Aucune tâche pour ce projet.</p>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
    <!-- Script JS pour gérer les interactions avec les tâches -->
    <script src="/js/tasks.js"></script>
</body>

</html>
