<h1 class="chat-title">Post ton gentil message 🦋</h1>

<div class="chat-container">
    <div id="chatWindow" class="chat-screen">

        <?php foreach ($posts as $post) : ?>
            <div class="post">
                <div class="post-header">
                    <h4 class="post-title"><?= htmlspecialchars($post['titre']) ?></h4>
                    <small>Posté par <?= htmlspecialchars($post['auteur']) ?> le <?= $post['created_at'] ?></small>
                </div>
                <p class="post-content"><?= nl2br(htmlspecialchars($post['contenu'])) ?></p>
                <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $post['user_id']) : ?>
                    <div class="post-actions">
                        <button class="btn-edit" onclick='openEditDialog(<?= $post["id"] ?>, <?= json_encode(htmlspecialchars($post["titre"], ENT_QUOTES)) ?>, <?= json_encode(htmlspecialchars($post["contenu"], ENT_QUOTES)) ?>)'>Modifier</button>

                        <form action="/chat" method="post" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce post ?');">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($post['id']); ?>">
                            <button class="btn-delete1" type="submit">Supprimer</button>
                        </form>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>

    </div>



    <!-- Formulaire de nouveau post -->
    <form class="new-post-form" action="/chat" method="post">
        <input type="text" name="titre" placeholder="Titre" required>
        <textarea name="contenu" placeholder="Message" required></textarea>
        <button type="submit" class="post-button">Poster</button>
    </form>
</div>


<!-- Modale edit  -->
<div class="overlay"></div>
<dialog id="editDialog">
    <form action="/chat" method="post">
        <input type="hidden" name="action" value="update">
        <input type="hidden" name="id" id="editPostId">
        <p><label>Titre: <input type="text" name="titre" id="editTitre"></label></p>
        <p><label>Contenu: <textarea name="contenu" id="editContenu"></textarea></label></p>
        <menu>
            <button class="btn-cancel" type="button" id="cancelEdit">Annuler</button>
            <button class="btn-edit" type="submit">Confirmer</button>
        </menu>
    </form>
</dialog>



</div>