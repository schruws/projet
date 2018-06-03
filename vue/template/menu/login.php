<div class="col-md-4 .col-md-offset-4 center-block" id="login">
<h1>Se connecter</h1>

<form id="menu.login" action= "menu.login" method="POST" onsubmit="return form_action('menu.login')">

    <div class="form-group">
        <label for="">Nom ou email</label>
        <input type="text" name="nom" class="form-control" required placeholder="indiquez votre pseudo ou votre email"/>
    </div>

    <div class="form-group">
        <label for="">Mot de passe <a href="?page=menu.reset">(J'ai oublié mon mot de passe)</a></label>
        <input type="password" name="password" class="form-control" required placeholder="votre mot de passe"/>
    </div>
    <div class="form-group">

    <?php if($_SESSION['activationCaptcha'] >= 3) {
        echo $_SESSION['Captcha']->html();
    } ?>
    </div>

    <button type="submit" class="btn btn-primary">Se connecter</button>

</form>
</div>
<script src="vue/js/action-form.js"></script>
