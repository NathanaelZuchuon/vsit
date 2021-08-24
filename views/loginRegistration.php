<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include __DIR__ . '/../views/head.php'; ?>
	<title>Login Registration | VSIT</title>
    <link rel="stylesheet" href=<?=$host . "public/assets/css/loginRegistration.css"?>>
</head>

<body>
    <?php include __DIR__ . '/../views/cursor.php'; ?>

    <main id="wrapper">
        <section id="registration-icon">
            <img src=<?=$host . "public/assets/icons/registration-icon.svg"?>>
        </section>
        <section id="registration-form">
            <h1>Registration</h1>
            <form autocomplete="off" autofocus method="post" id="form">
                <div class="form-box">
                    <div class="fields">
                        <label for="firstname">Nom</label>
                        <input type="text" id="firstname" name="firstname" required="required">
                    </div>
                    <div class="fields">
                        <label for="lastname">Prénom</label>
                        <input type="text" id="lastname" name="lastname" required="required">
                    </div>
                </div>
                <div class="form-box">
                    <div class="fields">
                        <div id="cni-block">
                            <label for="cni">N° de la CNI</label>
                            <div id="cni-error-box"></div>
                        </div>
                        <input type="number" id="cni" name="cni" required="required">
                    </div>
                </div>
                <div class="form-box">
                    <div class="fields">
                        <div id="pseudo-block">
                            <label for="pseudo">Pseudo</label>
                            <div id="pseudo-error-box"></div>
                        </div>
                        <input type="text" id="pseudo" name="pseudo" required="required">
                    </div>
                    <div class="fields">
                        <label for="password">Mot de passe</label>
                        <div id="pass-block">
                            <input type="password" id="password" name="password" required="required">
                            <div id="eye"><i class="fa fa-eye" id="eye-icon"></i></div>
                        </div>
                    </div>
                </div>
                <div class="form-box">
                    <div class="fields">
                        <button type="submit" id="btn">S'enregistrer <i class="fa fa-check-circle"></i></button>
                    </div>
                </div>
            </form>
        </section>
    </main>
    
    <script src=<?=$host . "public/assets/js/cursor.js"?>></script>
    <script src=<?=$host . "public/assets/js/loginRegistration.js"?>></script>
    <?php include __DIR__ . '/../views/footer.php'; ?>
</body>

</html>
