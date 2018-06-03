
<form id="horaire.creerVacance" action= "<?= $_SESSION['action']; ?>" method="POST" onsubmit="return form_action('horaire.creerVacance')" class="form-horizontal">
    <div id="personne">
        <fieldset class="container" class="container">
            <div class="form-group-6">
                <legend>Horaires de vacances</legend>
                <label for="" class="col-sm-4 col-md-3 control-label">Date de début : </label>
                <div class="col-sm-2 col-md-1">
                    <input type="text" class="form-control" name="jourDebut" id="jour" placeholder="jour" maxlength="2" pattern="[0-9]{2}" title="seulement des chiffres" value="<?= $_POST['debut'][2] ?>" <?php echo $_SESSION["disabled"]?>/>
                </div>
                <div class="col-sm-2 col-md-1">
                    <input type="text" class="form-control" name="moisDebut" id="mois" placeholder="mois" maxlength="2"  pattern="[0-9]{2}" title="seulement des chiffres" value="<?= $_POST['debut'][1] ?>" <?php echo $_SESSION["disabled"]?>/>
                </div>
                <div class="col-sm-2 col-md-1">
                    <input type="text" class="form-control" name="annéeDebut" id="annee" placeholder="année" maxlength="4" pattern="[0-9]{4}" title="seulement des chiffres" value="<?= $_POST['debut'][0] ?>" <?php echo $_SESSION["disabled"]?>/>
                </div>
            </div>
            <div class="form-group-6">
                <label for="" class="col-sm-4 col-md-3 control-label">Date de fin : </label>
                <div class="col-sm-2 col-md-1">
                    <input type="text" class="form-control" name="jourFin" id="jour" placeholder="jour" maxlength="2" pattern="[0-9]{2}" title="seulement des chiffres" value="<?= $_POST['fin'][2] ?>" <?php echo $_SESSION["disabled"]?>/>
                </div>
                <div class="col-sm-2 col-md-1">
                    <input type="text" class="form-control" name="moisFin" id="mois" placeholder="mois" maxlength="2"  pattern="[0-9]{2}" title="seulement des chiffres" value="<?= $_POST['fin'][1] ?>" <?php echo $_SESSION["disabled"]?>/>
                </div>
                <div class="col-sm-2 col-md-1">
                    <input type="text" class="form-control" name="annéeFin" id="annee" placeholder="année" maxlength="4" pattern="[0-9]{4}" title="seulement des chiffres" value="<?= $_POST['fin'][0] ?>" <?php echo $_SESSION["disabled"]?>/>
                </div>
            </div>
            <div class="form-group-6">
                <label for="" class="col-sm-4 col-md-3 control-label">Moment : </label>
                <div class="col-sm-2 col-md-3">
                    <select class="form-control" id="select" name="moment" required placeholder="" <?php echo $_SESSION["disabled"]?>>
                        <?php foreach ($_POST['jour'] as $value) : ?>
                            <option <?php if($_SESSION["congerRestaurant"]->getMoment() === $value) echo "selected" ?>><?= $value ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group-6">
                <label for="" class="col-sm-4 col-md-3 control-label">Ouvert : </label>
                <div class="col-sm-2 col-md-3">
                    <select class="form-control" id="select" name="ouvertFerme"  <?php echo $_SESSION["disabled"]?>>
                        <option <?php if($_SESSION["congerRestaurant"]->getOuvertFerme() == 1) echo "selected" ?>>oui</option>
                        <option <?php if($_SESSION["congerRestaurant"]->getOuvertFerme() == 0) echo "selected" ?>>non</option>
                    </select>
                </div>
            </div>
        </fieldset>
        <br><br>
        <button type="button" class="btn btn-warning" id="retour">annuler</button>
        <?php if(isset($_SESSION['effacer'])): ?>
            <?php unset($_SESSION['effacer']) ?>
            <button type="submit"   class="btn btn-danger pull-right" >supprimer</button>

        <?php  elseif (isset($_SESSION["retablir"])): ?>
            <?php unset($_SESSION['retablir']) ?>
            <button type="submit"  class="btn btn-success pull-right" >rétablir</button>
        <?php else: ?>
            <?php if ($_SESSION["disabled"] === "false") : ?>
                <button type="submit"    class="btn btn-danger pull-right" >modifier</button>
            <?php elseif( $_SESSION["disabled"] !== "disabled") :?>
                <button type="submit"    class="btn btn-success pull-right" >ajouter</button>
            <?php endif;?>
        <?php endif; ?>
</form>