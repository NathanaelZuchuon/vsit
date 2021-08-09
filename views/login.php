<!DOCTYPE html>
<html lang="fr">

<head>
	<?php include __DIR__ . '\..\views\head.php'; ?>
    <title>Login | VSIT</title>
    <link rel="stylesheet" href="http://127.0.0.1/bhent_prods/vsit/public/assets/css/login.css">
</head>

<body>
    <?php include __DIR__ . '\..\views\cursor.php'; ?>

    <main id="wrapper">
        <div id="login-form">
            <div id="header">
                <h2>Login</h2>
                <img src="http://127.0.0.1/bhent_prods/vsit/public/assets/icons/vsit-logo.svg">
            </div>
            <div id="form-container">
                <form autocomplete="off" autofocus method="post" id="form">
                    <div class="fields">
                        <label for="pseudo">Pseudo</label>
                        <input type="text" id="pseudo" name="pseudo" required>
                    </div>
                    <div class="fields">
                        <label for="password">Mot de passe</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div class="fields">
                        <button type="submit" id="btn">Allons-y <i class="fa fa-arrow-circle-right"></i></button>
                    </div>
                    <div class="fields">
                        Pas encore enregistré? <a href="http://127.0.0.1/bhent_prods/vsit/login/registration">Créer un compte</a>
                    </div>
                </form>
            </div>
        </div>
        <div id="login-icon">
            <img src="http://127.0.0.1/bhent_prods/vsit/public/assets/icons/login-icon.svg">
            <div id="desc">
                <span><h2>Et que vos idées</h2>deviennent réalité</span>
                <span>Qualité et expérience garantient sur tout appareil</span>
            </div>
        </div>
    </main>

    <script src="http://127.0.0.1/bhent_prods/vsit/public/assets/js/cursor.js"></script>
    <script src="http://127.0.0.1/bhent_prods/vsit/public/assets/js/login.js"></script>
    <?php include __DIR__ . '\..\views\footer.php'; ?>
</body>

</html>
