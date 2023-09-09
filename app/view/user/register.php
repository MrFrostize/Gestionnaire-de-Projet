<!-- Formulaire d'inscription pour les utilisateurs -->
<form action="app/controller/UserController.php" method="post">
    <!-- Champ pour le nom de l'utilisateur -->
    <input type="text" name="nom" placeholder="Nom">
    
    <!-- Champ pour le prénom de l'utilisateur -->
    <input type="text" name="prenom" placeholder="Prénom">
    
    <!-- Champ pour l'adresse e-mail de l'utilisateur. 
         Le type "email" permet une validation basique du format de l'e-mail côté client. -->
    <input type="email" name="email" placeholder="Email">
    
    <!-- Champ pour le mot de passe de l'utilisateur. 
         Le type "password" masque les caractères saisis pour la confidentialité. -->
    <input type="password" name="password" placeholder="Mot de passe">
    
    <!-- Bouton pour soumettre le formulaire -->
    <input type="submit" value="S'inscrire">
</form>
