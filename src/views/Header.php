<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/header.css">
    <link rel="stylesheet" href="./assets/css/smart-social-network.css">
    <link rel="stylesheet" href="./assets/css/styles.css">
    <script src="./assets/js/modal.js" defer></script>
    <title>Smart Social Network</title>
</head>

<body>
    <nav>
        <ul class="nav">
            <li class="logo">Smart Social Network 🎋🧸 🐒❤️</li>

            <!-- Bouton de connexion -->
            <li tabindex="0"></i>
                <?php
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }

                if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
                    echo '<a href="/logout">Se déconnecter</a>';
                } else {
                    echo '<a href="/login">Se connecter</a>';
                } ?>
            </li>
        </ul>
    </nav>