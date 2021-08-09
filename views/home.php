<!DOCTYPE html>
<html lang="fr">

<head>
	<?php include __DIR__ . '\..\views\head.php'; ?>
    <title>Home | VSIT</title>
    <link rel="stylesheet" href="http://127.0.0.1/bhent_prods/vsit/public/assets/css/home.css">
</head>

<body>
    <?php include __DIR__ . '\..\views\cursor.php'; ?>
    
    <nav id="nav-bar">
        <img src="http://127.0.0.1/bhent_prods/vsit/public/assets/icons/vsit-logo.svg">
        <ul>
            <li><a href="http://127.0.0.1/bhent_prods/vsit/login">Se connecter</a></li>
            <li class="focus"><a href="http://127.0.0.1/bhent_prods/vsit/login/registration">S'enregistrer</a></li>
        </ul>
    </nav>
    
    <section id="titles">
        <p>Business</p>
        <p><span>Needs</span></p>
        <p>Security</p>
    </section>
    
    <script src="http://127.0.0.1/bhent_prods/vsit/public/assets/js/home.js"></script>
    <script src="http://127.0.0.1/bhent_prods/vsit/public/assets/js/cursor.js"></script>
    <?php include __DIR__ . '\..\views\footer.php'; ?>
</body>

</html>
