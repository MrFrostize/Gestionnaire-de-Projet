<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de Projet</title>
    <!-- Lien vers le fichier CSS pour le style de la page -->
    <link rel="stylesheet" href="/css/styles.css">
</head>

<body>
    <div class="container">
        <h1>Gestion de Projet</h1>

        <!-- Section pour naviguer vers la liste des projets de l'utilisateur -->
        <div class="my-projects-button">
            <a href="/my-projects">Mes Projets</a>
        </div>

        <!-- Section pour créer un nouveau projet -->
        <div class="project-section">
            <h2>Créer un nouveau projet</h2>
            <!-- Formulaire pour soumettre les détails d'un nouveau projet -->
            <form action="/create-project" method="post">
                <input type="text" name="title" placeholder="Titre du projet" required>
                <textarea name="description" placeholder="Description du projet" required></textarea>
                <input type="submit" value="Créer le projet">
            </form>
        </div>

        <!-- Section pour afficher la liste des projets existants -->
        <div class="project-list">
            <h2>Mes Projets</h2>
            <ul>
                <?php
                // Si l'utilisateur a des projets, ils sont listés ici
                if ($projects) {
                    foreach ($projects as $project) {
                        echo "<li>" . htmlspecialchars($project['Titre']) . "</li>";
                    }
                } else {
                    // Si l'utilisateur n'a pas de projets, un message est affiché
                    echo "<li>Vous n'avez pas encore de projets.</li>";
                }
                ?>
            </ul>
        </div>

        <!-- Bouton pour se déconnecter -->
        <div class="logout-section">
            <button><a href="/logout">Déconnexion</a></button>
        </div>
    </div>

    <!-- Script JS pour gérer les interactions supplémentaires sur la page -->
    <script src="/js/scripts.js"></script>
</body>

</html>
