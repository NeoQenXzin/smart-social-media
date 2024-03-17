<?php include 'Header.php'; ?>

<h2 style='margin: 40px auto 25px auto;'>Connexion</h2>
<form action="/login" method="post">
    <div>
        <label class="neumorphic-card__text" for="username">Nom d'utilisateur :</label>
        <input class="neumorphic-input" type="text" id="username" name="username" required>
    </div>
    <div>
        <label class="neumorphic-card__text" for="password">Mot de passe :</label>
        <input class="neumorphic-input" type="password" id="password" name="password" required>
    </div>
    <div>
        <button class="neumorphic-btn" type="submit">Se connecter</button>
    </div>
    <div>
        Pas encore membre ? <a href="/signup">Créez un compte</a>
    </div>
</form>