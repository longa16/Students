<link href="css/update_form.css" rel="stylesheet">

<h2>Ajouter un cours</h2>
<form action="main.php" method="post">
    <input type="hidden" name="operation" value="creation">
    <label for="intitule">Intitulé :</label>
    <input type="text" id="intitule" name="intitule" required>
    <label for="credits">Crédits :</label>
    <input type="number" id="credits" name="credits" required>
    <button type="submit">Ajouter</button>
</form>


