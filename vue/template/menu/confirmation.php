
<div class="col-md-6 .col-md-offset-6 center-block" id="login">
<h1>Réinitialiser mon mot de passe</h1>

<form id="menu.renitialisation" action="menu.renitialisation" method="POST" onsubmit="return form_action('menu.renitialisation')">


    <div class="form-group-6">
        <label for="">Mot de passe </label>
        <input type="password" name="password_ancien" id="password1" class="form-control col-md-4" onkeyup="Check(this)"/>
    </div>

    <div class="form-group-6">
        <label for="">Confirmation du mot de passe</label>
        <input type="password" name="password" id="password2" class="form-control col-md-4"/>
        <br><br>
        <label for="">Sécurité du mot de passe</label>
        <table border="2" width="300">
            <tr>
                <td id="faible" align="center" style="background-color :white;">Faible</td>
                <td id="moyen" align="center" style="background-color :white;">Moyen</td>
                <td id="elevee" align="center" style="background-color :white;">Elevee</td>
            </tr>
        </table>
    </div>
    <br><br>
    <button type="submit" class="btn btn-primary">Réinitialiser votre mot de passe</button>
</form>

</div>
<script src="vue/js/action-form.js"></script>