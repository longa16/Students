<link href="css/update_form.css" rel="stylesheet">

<h2>Ajouter un étudiant</h2>
<form action="main.php" method="post">
    <input type="hidden" name="operation" value="create">
    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" required>
    <label for="prenom">Prénom :</label>
    <input type="text" id="prenom" name="prenom" required>
    <label for="date_naissance">date_naissance :</label>
    <input type="date" id="date_naissance" name="date_naissance" required>
    <button type="submit">Ajouter</button>
</form>

