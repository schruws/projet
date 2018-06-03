<form id="contrat.creer" action= "contrat.creer" method="POST" onsubmit="return form_action('contrat.creer')" class="form-horizontal">
<fieldset>
    <fieldset class="container">
        <legend>Contrat <div class="pull-right"><small>champs obligatoires : </small> <span style="color: #FF8C00;" class="glyphicon glyphicon-asterisk "></span></div></legend>

        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Type de contrat :  <span style="color: #FF8C00;" class="glyphicon glyphicon-asterisk small "></span></label>
            <div class="col-sm-2 col-md-3">
                <select class="form-control" id="selectContrat" name="typeContrat" onchange="contrat(this)">
                    <option>CDI</option>
                    <option>CDD</option>
                    <option>Etudiant</option>
                </select>
            </div>
        </div>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Remunération : </label>
            <div class="col-sm-2 col-md-3 input-group">
                <input type="text" name="remunerationBrut" placeholder="5.50" class="form-control"/><span class="input-group-addon"> €</span>
            </div>
        </div>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Date de début :  <span style="color: #FF8C00;" class="glyphicon glyphicon-asterisk small "></span></label>
            <div class="col-sm-2 col-md-1">
                <input type="text" class="form-control" required name="jourDebut" id="jourDebut" placeholder="jour" maxlength="2" pattern="[0-9]{1,2}"value="<?php echo date('d');?>" title="seulement des chiffres"/>
            </div>
            <div class="col-sm-2 col-md-1">
                <input type="text" class="form-control" required name="moisDebut" id="moisDebut" placeholder="mois" maxlength="2"  pattern="[0-9]{1,2}"value="<?php echo date('m');?>" title="seulement des chiffres"/>
            </div>
            <div class="col-sm-2 col-md-1">
                <input type="text" class="form-control" required name="anneeDebut" id="anneeDebut" placeholder="année" maxlength="4" pattern="[0-9]{4}"value="<?php echo date('Y');?>" title="seulement des chiffres"/>
            </div>
        </div>
        <div class="form-group-6" id="dateFin" style="display:none;">
            <label for="" class="col-sm-4 col-md-3 control-label">Date de fin :  <span style="color: #FF8C00;" class="glyphicon glyphicon-asterisk small "></span></label>
            <div class="col-sm-2 col-md-1">
                <input type="text" class="form-control" name="jourFin" id="jourFin" placeholder="jour" maxlength="2" pattern="[0-9]{1,2}"/>
            </div>
            <div class="col-sm-2 col-md-1">
                <input type="text" class="form-control" name="moisFin" id="moisFin" placeholder="mois" maxlength="2"  pattern="[0-9]{1,2}"/>
            </div>
            <div class="col-sm-2 col-md-1">
                <input type="text" class="form-control" name="anneeFin" id="anneeFin" placeholder="année" maxlength="4" pattern="[0-9]{4}"/>
            </div>
        </div>
    </fieldset>
    <fieldset class="container">
        <legend>Fonction</legend>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Competence : </label>
            <div class="col-sm-2 col-md-3">
                <select class="form-control" id="select" name="nomComp">
                    <?php foreach ($_POST['competence'] as $value) : ?>
                        <option><?= $value->getNomComp()?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label"> Type de fonction : </label>
            <div class="col-sm-2 col-md-3">
                <input type="text" name="type" class="form-control"/>
            </div>
        </div>
</fieldset>
<br><br>
<button type="button" class="btn btn-warning" id="retour">annuler</button>
<button type="submit" class="btn btn-success pull-right" >ajouter</button>
</form>