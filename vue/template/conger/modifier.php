<form id="conger.creer" action= "<?= $_SESSION['action']; ?>" method="POST" onsubmit="return form_action('conger.creer')" class="form-horizontal">
    <fieldset>
        <fieldset class="container">
            <legend>Demande de conge</legend>

            <div class="form-group-6">
                <label for="" class="col-sm-4 col-md-3 control-label">Date de début : </label>
                <div class="col-sm-2 col-md-1">
                    <input type="text" class="form-control" name="jourDebut" id="jourDebut" placeholder="jour" maxlength="2" pattern="[0-9]{1,2}"value="<?= $_POST['debut'][2] ?>" title="seulement des chiffres"/>
                </div>
                <div class="col-sm-2 col-md-1">
                    <input type="text" class="form-control" name="moisDebut" id="moisDebut" placeholder="mois" maxlength="2"  pattern="[0-9]{1,2}"value="<?= $_POST['debut'][1] ?>" title="seulement des chiffres"/>
                </div>
                <div class="col-sm-2 col-md-1">
                    <input type="text" class="form-control" name="anneeDebut" id="anneeDebut" placeholder="année" maxlength="4" pattern="[0-9]{4}"value="<?= $_POST['debut'][0] ?>" title="seulement des chiffres"/>
                </div>
            </div>
            <div class="form-group-6">
                <label for="" class="col-sm-4 col-md-3 control-label">Date de fin : </label>
                <div class="col-sm-2 col-md-1">
                    <input type="text" class="form-control" name="jourFin" id="jourFin" placeholder="jour" maxlength="2" value="<?= $_POST['fin'][2] ?>" pattern="[0-9]{1,2}" title="seulement des chiffres"/>
                </div>
                <div class="col-sm-2 col-md-1">
                    <input type="text" class="form-control" name="moisFin" id="moisFin" placeholder="mois" maxlength="2" value="<?= $_POST['fin'][1] ?>"  pattern="[0-9]{1,2}" title="seulement des chiffres"/>
                </div>
                <div class="col-sm-2 col-md-1">
                    <input type="text" class="form-control" name="anneeFin" id="anneeFin" placeholder="année" maxlength="4" value="<?= $_POST['fin'][0] ?>" pattern="[0-9]{4}" title="seulement des chiffres"/>
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
