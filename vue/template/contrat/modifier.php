<form id="contrat.creer" action= "<?= $_SESSION['action']; ?>" method="POST" onsubmit="return form_action('contrat.creer')" class="form-horizontal">
    <fieldset>
        <legend>Contrat</legend>

        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Type de contrat : <span style="color: #FF8C00;" class="glyphicon glyphicon-asterisk small "></span></label>
            <div class="col-sm-2 col-md-3">
                <select class="form-control" id="selectContrat" name="typeContrat" <?php echo $_SESSION["disabled"]?> onchange="contrat(this)" >
                    <option <?php if($_SESSION['contratConsulter']->getTypeContrat() === "CDI") echo "selected" ?>>CDI</option>
                    <option <?php if($_SESSION['contratConsulter']->getTypeContrat() === "CDD") echo "selected" ?>>CDD</option>
                    <option <?php if($_SESSION['contratConsulter']->getTypeContrat() === "Etudiant") echo "selected" ?>>Etudiant</option>
                </select>
            </div>
        </div>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Remunération : </label>
            <div class="col-sm-2 col-md-3 input-group">
                <input type="text" name="remunerationBrut" <?php echo $_SESSION["disabled"]?> class="form-control"  value="<?= $_SESSION['contratConsulter']->getRemunerationBrut() ?>"/><span class="input-group-addon"> €</span>
            </div>
        </div>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Date de début : <span style="color: #FF8C00;" class="glyphicon glyphicon-asterisk small "></span></label>
            <div class="col-sm-2 col-md-1">
                <input type="text" class="form-control" name="jourDebut" id="jourDebut" placeholder="jour" maxlength="2" pattern="[0-9]{2}" value="<?= $_POST['debut'][2] ?>" <?php echo $_SESSION["disabled"]?> title="seulement des chiffres"/>
            </div>
            <div class="col-sm-2 col-md-1">
                <input type="text" class="form-control" name="moisDebut" id="moisDebut" placeholder="mois" maxlength="2"  pattern="[0-9]{2}" value="<?= $_POST['debut'][1] ?>" <?php echo $_SESSION["disabled"]?> title="seulement des chiffres"/>
            </div>
            <div class="col-sm-2 col-md-1">
                <input type="text" class="form-control" name="anneeDebut" id="anneeDebut" placeholder="année" maxlength="4" pattern="[0-9]{4}" value="<?= $_POST['debut'][0] ?>" <?php echo $_SESSION["disabled"]?> title="seulement des chiffres"/>
            </div>
        </div>
        <div class="form-group-6"  id="dateFin" style="display: none">
            <label for="" class="col-sm-4 col-md-3 control-label">Date de fin : <span style="color: #FF8C00;" class="glyphicon glyphicon-asterisk small "></span></label>
            <div class="col-sm-2 col-md-1">
                <input type="text" class="form-control" name="jourFin" id="jourFin" placeholder="jour" maxlength="2" pattern="[0-9]{2}" value="<?php if(isset($_POST['fin'])){echo $_POST['fin'][2];}  ?>" <?php echo $_SESSION["disabled"]?> title="seulement des chiffres"/>
            </div>
            <div class="col-sm-2 col-md-1">
                <input type="text" class="form-control" name="moisFin" id="moisFin" placeholder="mois" maxlength="2"  pattern="[0-9]{2}" value="<?php if(isset($_POST['fin'])) {echo $_POST['fin'][1];} ?>" <?php echo $_SESSION["disabled"]?> title="seulement des chiffres"/>
            </div>
            <div class="col-sm-2 col-md-1">
                <input type="text" class="form-control" name="anneeFin" id="anneeFin" placeholder="année" maxlength="4" pattern="[0-9]{4}" value="<?php if(isset($_POST['fin'])) {echo $_POST['fin'][0];} ?>" <?php echo $_SESSION["disabled"]?> title="seulement des chiffres"/>
            </div>
        </div>
    </fieldset>
    <fieldset>
        <legend>Fonction</legend>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Competence : </label>
            <div class="col-sm-2 col-md-3">
                <select class="form-control" id="select" name="nomComp" <?php echo $_SESSION["disabled"]?>>
                    <?php foreach ($_POST['competence'] as $value) : ?>
                        <option   <?php if($_SESSION["competence"]->getNomComp() === $value->getNomComp()) echo "selected" ?>><?= $value->getNomComp()?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label"> Type de fonction : </label>
            <div class="col-sm-2 col-md-3">
                <input type="text" name="type" class="form-control"  value="<?= $_SESSION['fonction']->getType() ?>" <?php echo $_SESSION["disabled"]?>/>
            </div>
        </div>
    </fieldset>
    <fieldset class="container">
        <legend>Avis</legend>

        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Notes : </label>
            <div class="col-sm-2 col-md-3">
                <input type="number" min="0" max="10" step="2" <?php echo $_SESSION["disabled"]?> value="<?= $_SESSION['contratNotes']->getNote() ?>" name="note" pattern="[0-9]{1}" title="un seul chiffre">
            </div>
        </div>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Commentaire : </label>
            <textarea name="avis" cols="5" rows="5" <?php echo $_SESSION["disabled"]?>><?= $_SESSION['contratNotes']->getAvis() ?></textarea>
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