<link href="css/update_form.css" rel="stylesheet">

<h2>Inscrire un étudiant à un cours</h2>
<form action="inscription.php" method="post">
    <input type="hidden" name="operation" value="inscription">
    <label for="etudiant_id">ID Étudiant :</label>
    <input type="number" id="etudiant_id" name="etudiant_id" required>
    <label for="cours_id">ID Cours :</label>
    <input type="number" id="cours_id" name="cours_id" required>
    <button type="submit">Inscrire</button>
</form>