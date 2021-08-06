<!DOCTYPE html>
<html lang="fr">

<head>
	<?php include __DIR__ . '\..\views\head.php'; ?>
    <title>Home | VSIT</title>
    <link rel="stylesheet" href="http://127.0.0.1/bhent_prods/vsit/public/assets/css/home.css">
</head>

<body>
    <?php include __DIR__ . '\..\views\cursor.php'; ?>
    
    <main>
        <div class="box">
            <div id="filter">
                <nav>
                    <img src="http://127.0.0.1/bhent_prods/vsit/public/assets/icons/vsit-logo.svg">
                    <ul>
                        <li><a href="http://127.0.0.1/bhent_prods/vsit/login/">Se connecter</a></li>
                        <li><a href="http://127.0.0.1/bhent_prods/vsit/login/registration">S'enregistrer</a></li>
                    </ul>
                    <button>Rejoignez nous</button>
                </nav>
                <div id="wrapper">
                    <h1>EFFICACITÉ.</h1>
                    <h1>FLEXIBILITÉ.</h1>
                    <h1>ERGONOMIE.</h1>
                </div>
            </div>
        </div>
    </main>
    
    <script src="http://127.0.0.1/bhent_prods/vsit/public/assets/js/home.js"></script>
    <script src="http://127.0.0.1/bhent_prods/vsit/public/assets/js/cursor.js"></script>
    <?php include __DIR__ . '\..\views\footer.php'; ?>
</body>

</html>
