<div class="form-container">

    <form class="neumorphic-card-form" action="/signup" method="post">
        <th>
            <legend class='neumorphic-card-form__title'><b>Créer un compte</b></legend>
        </th>
        <input class="neumorphic-input" type="text" name="username" placeholder="Nom d'utilisateur" required>
        <input class="neumorphic-input" type="email" name="email" placeholder="Adresse Email" required>
        <input class="neumorphic-input" type="password" name="password" placeholder="Mot de passe" required>
        <button class="neumorphic-btn" type="submit">S'inscrire</button>
        <p>Vous avez déjà un compte ? <a href="/login">Connexion</a></p>
    </form>
</div>