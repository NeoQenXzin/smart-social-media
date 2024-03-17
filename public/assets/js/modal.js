function openEditDialog(id, titre, contenu) {
    document.getElementById('editPostId').value = id;
    document.getElementById('editTitre').value = titre;
    document.getElementById('editContenu').value = contenu;
    document.getElementById('editDialog').style.display = 'block';
    document.querySelector('.overlay').style.display = 'block';
}

document.getElementById('cancelEdit').addEventListener('click', function () {
    document.getElementById('editDialog').style.display = 'none';
    document.querySelector('.overlay').style.display = 'none';
});


