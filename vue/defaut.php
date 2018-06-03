<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <title>Projet de fin d'etude</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/app.css" rel="stylesheet">
    <link href="../css/css.css" rel="stylesheet">


</head>

<body>

<nav class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <?php if(isset($_SESSION['user']) && ($_SESSION['user']->getNomPers() !== "admin")): ?>
                <?php $_SESSION['lierContrat'] = null; ?>
            <a class="navbar-brand" href="?page=menu.menu">GestRest</a>
            <?php elseif(isset($_SESSION['user']) && ($_SESSION['user']->getNomPers() === "admin")): ?>
                <a class="navbar-brand" href="?page=personnel.afficherResponsable">GestRest</a>
                <?php else : ?>
                <a class="navbar-brand" href="?page=menu.index">GestResta</a>
            <?php endif; ?>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <?php if (isset( $_SESSION['user'])): ?>
                    <li><a href="?page=menu.deco">Se déconnecter</a></li>
                <?php else: ?>
                    <li><a href="?page=menu.index">Se connecter</a></li>
                <?php endif; ?>

            </ul>
        </div>
    </div>
</nav>

<div class="container">

    <?php if(\controlleur\message::getInstance()->hasFlashes()): ?>
        <?php foreach(\controlleur\message::getInstance()->getFlashes() as $type => $message): ?>
            <div style="text-align: center" class="alert alert-<?= $type; ?>">
                <?= $message; ?>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php if (isset( $_SESSION['user'])): ?>

    <?php endif; ?>

    <div id="erreur" class="alert alert-danger" style="display: none; text-align: center"></div>

    <?= $content; ?>



</div>
</body>
<script src="vue/js/action-form.js"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
</html>