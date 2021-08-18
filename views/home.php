<!DOCTYPE html>
<html lang="fr">

<head>
	<?php include __DIR__ . '/../views/head.php'; ?>
    <title>Home | VSIT</title>
    <link rel="stylesheet" href=<?="http://vsit.bhent.org/vsit/" . "public/assets/css/home.css"?>>
</head>

<body>
    <?php include __DIR__ . '/../views/cursor.php'; ?>
    
    <nav id="nav-bar">
        <img src=<?="http://vsit.bhent.org/vsit/" . "public/assets/icons/vsit-logo.svg"?>>
        <ul>
            <li><a href=<?="http://vsit.bhent.org/vsit/" . "login/"?>>Se connecter</a></li>
            <li class="focus"><a href=<?="http://vsit.bhent.org/vsit/" . "login/registration"?>>S'enregistrer</a></li>
        </ul>
    </nav>
    
    <section id="titles">
        <p>Business</p>
        <p><span>Needs</span></p>
        <p>Security</p>
    </section>
    
    <script src=<?="http://vsit.bhent.org/vsit/" . "public/assets/js/home.js"?>></script>
    <script src=<?="http://vsit.bhent.org/vsit/" . "public/assets/js/cursor.js"?>></script>
    <?php include __DIR__ . '/../views/footer.php'; ?>
</body>

</html>
