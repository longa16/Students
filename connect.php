<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>sign up </title>
</head>
<body>
<form action="action/connectaction.php" method="post">
<div class="row g-3 align-items-center">
    <div class="col-auto">
        <label for="inputPassword6" class="col-form-label">Email</label>
        <div class="col-auto">
            <input type="email" id="inputPassword6" name="email" class="form-control" aria-describedby="passwordHelpInline">
        </div>

    </div>
    <div class="col-auto">
        <label for="inputPassword6" class="col-form-label">Password</label>
        <div class="col-auto">
            <input type="password" id="inputPassword6" name="password" class="form-control" aria-describedby="passwordHelpInline">
        </div>
    </div>

    <button type="submit" name="confirm" class="btn btn-dark">Valider</button>

</div>
</form>

</body>
</html>