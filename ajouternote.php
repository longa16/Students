<link href="css/update_form.css" rel="stylesheet">

<h2>Ajouter une note</h2>
<form action="inscription.php" method="post">
    <input type="hidden" name="operation" value="ajouter_note">
    <label for="etudiant_id">ID Étudiant :</label>
    <input type="number" id="etudiant_id" name="etudiant_id" required>
    <label for="cours_id">ID Cours :</label>
    <input type="number" id="cours_id" name="cours_id" required>
    <label for="note">Note :</label>
    <input type="number" step="0.01" id="note" name="note" required>
    <button type="submit">Ajouter la note</button>
</form>
