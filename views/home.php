<!DOCTYPE html>
<html lang="fr">

<head>
	<?php include __DIR__ . '/../views/head.php'; ?>
    <title>Home | VSIT</title>
    <link rel="stylesheet" href=<?=$host . "public/assets/css/home.css"?>>
</head>

<body>
    <?php include __DIR__ . '/../views/cursor.php'; ?>
    
    <nav id="nav-bar">
        <img src=<?=$host . "public/assets/icons/vsit-logo.svg"?>>
        <ul>
            <li><a href=<?=$host . "login/"?>>Se connecter</a></li>
            <li class="focus"><a href=<?=$host . "login/registration"?>>S'enregistrer</a></li>
        </ul>
    </nav>
    
    <section id="titles">
        <p>Business</p>
        <p>Needs</p>
        <p>Security</p>
    </section>
    
    <script src=<?=$host . "public/assets/js/home.js"?>></script>
    <?php include __DIR__ . '/../views/footer.php'; ?>
</body>

</html>
