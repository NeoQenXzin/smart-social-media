<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


if (isset($_SESSION['user_id'])) {
    if (isset($_SESSION['user_id']) && !isset($_GET['view_posts'])) {
        echo "<p class='bienvenue'>✋🐸  _ Bienvenue {$_SESSION['username']} ! </p>";
        echo "<br>";
        echo "<a  class='display' href='/chat?view_posts=1'>Voir les posts</a>";
    } else {
        require_once 'Chat.php';
    }
} else {

?>
    <div class="form-container">
        <form class="neumorphic-card-form" action="/login" method="post">
            <th>
                <legend class='form-action-title'><b>Connexion</b></legend>
            </th>
            <input class="neumorphic-input" type="text" name="username" placeholder="Nom d'utilisateur" required>
            <input class="neumorphic-input" type="password" name="password" placeholder="Mot de passe" required>
            <button style="margin-left: 15px; margin-top: 2px;" class="neumorphic-btn" type="submit">Se connecter</button>
        </form>

    </div>
    <p>ou <a href="/signup">Créez un compte</a></p>
    <p>Mot de passe oublié ? <a href="reset_password.php">Réinitialiser le mot de passe</a></p>

<?php

}
?>