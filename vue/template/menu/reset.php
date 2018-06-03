<div class="col-md-4 .col-md-offset-4 center-block" id="login">
<h1>Mot de passe oublié</h1>

<form id="menu.reset" action= "menu.reset" method="POST" onsubmit="return form_action('menu.reset')">

    <div class="form-group">
        <label for="">Email</label>
        <input type="email" name="email" class="form-control" required placeholder="votre adresse email"/>
    </div>

    <div class="form-group">
    <?php
        echo $_SESSION['Captcha']->html();
    ?>
    </div>

    <button type="submit" class="btn btn-primary">Envoyer</button>
</form>
</div>

