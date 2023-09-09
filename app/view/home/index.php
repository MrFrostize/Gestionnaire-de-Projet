<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Métadonnées de base pour le bon affichage et le bon encodage -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Titre de la page -->
    <title>Gestion - Accueil</title>

    <!-- Lien vers la feuille de style principale -->
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
    <div class="container">
        <!-- Titre principal de la page -->
        <h1>Bienvenue sur Gestion</h1>

        <!-- Section de connexion pour les utilisateurs existants -->
        <div class="login-section">
            <h2>Connexion</h2>
            <form action="/login-process" method="post">
                <!-- Champ pour l'adresse e-mail -->
                <input type="email" name="email" placeholder="Email" required>
                <!-- Champ pour le mot de passe -->
                <input type="password" name="password" placeholder="Mot de passe" required>
                <!-- Bouton pour soumettre le formulaire de connexion -->
                <input type="submit" value="Se connecter">
            </form>
        </div>

        <!-- Section d'inscription pour les nouveaux utilisateurs -->
        <div class="register-section">
            <h2>Inscription</h2>
            <form action="/register-process" method="post">
                <!-- Champ pour le nom -->
                <input type="text" name="nom" placeholder="Nom" required>
                <!-- Champ pour le prénom -->
                <input type="text" name="prenom" placeholder="Prénom" required>
                <!-- Champ pour l'adresse e-mail -->
                <input type="email" name="email" placeholder="Email" required>
                <!-- Champ pour le mot de passe -->
                <input type="password" name="password" placeholder="Mot de passe" required>
                <!-- Bouton pour soumettre le formulaire d'inscription -->
                <input type="submit" value="S'inscrire">
            </form>
        </div>
    </div>

    <!-- Script JavaScript pour des fonctionnalités supplémentaires (si nécessaire) -->
    <script src="/js/scripts.js"></script>
</body>
</html>
