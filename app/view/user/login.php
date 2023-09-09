<!-- Formulaire de connexion pour les utilisateurs -->
<form action="/login-process" method="post">
    <!-- Champ pour l'adresse e-mail de l'utilisateur. 
         Le type "email" permet une validation basique du format de l'e-mail côté client. -->
    <input type="email" name="email" placeholder="Email">
    
    <!-- Champ pour le mot de passe de l'utilisateur. 
         Le type "password" masque les caractères saisis pour la confidentialité. -->
    <input type="password" name="password" placeholder="Mot de passe">
    
    <!-- Bouton pour soumettre le formulaire et tenter de se connecter -->
    <input type="submit" value="Se connecter">
</form>
