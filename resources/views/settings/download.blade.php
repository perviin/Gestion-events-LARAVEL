<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Données personnelles</title>
    <style>
        body { font-family: sans-serif; }
    </style>
</head>
<body>
    <h1>Données personnelles</h1>
    <p><strong>Nom :</strong> {{ $user->name }}</p>
    <p><strong>Email :</strong> {{ $user->email }}</p>
    <p><strong>Date de création du compte :</strong> {{ $user->created_at }}</p>
</body>
</html>
