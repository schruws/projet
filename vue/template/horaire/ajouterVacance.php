<form id="horaire.creerVacance" action= "horaire.creerVacance" method="POST" onsubmit="return form_action('horaire.creerVacance')" class="form-horizontal">
    <div id="personne">
        <fieldset class="container" class="container">
            <div class="form-group-6">
                <legend>Horaires de vacances</legend>
                <label for="" class="col-sm-4 col-md-3 control-label">Date de début : </label>
                <div class="col-sm-2 col-md-1">
                    <input type="text" class="form-control" name="jourDebut" id="jour" placeholder="jour" maxlength="2" value="<?php echo date('d');?>" pattern="[0-9]{2}" title="seulement des chiffres"/>
                </div>
                <div class="col-sm-2 col-md-1">
                    <input type="text" class="form-control" name="moisDebut" id="mois" placeholder="mois" maxlength="2" value="<?php echo date('m');?>"  pattern="[0-9]{2}" title="seulement des chiffres"/>
                </div>
                <div class="col-sm-2 col-md-1">
                    <input type="text" class="form-control" name="annéeDebut" id="annee" placeholder="année" maxlength="4" value="<?php echo date('Y');?>" pattern="[0-9]{4}" title="seulement des chiffres"/>
                </div>
            </div>
            <div class="form-group-6">
                <label for="" class="col-sm-4 col-md-3 control-label">Date de fin : </label>
                <div class="col-sm-2 col-md-1">
                    <input type="text" class="form-control" name="jourFin" id="jour" placeholder="jour" maxlength="2" pattern="[0-9]{2}" title="seulement des chiffres"/>
                </div>
                <div class="col-sm-2 col-md-1">
                    <input type="text" class="form-control" name="moisFin" id="mois" placeholder="mois" maxlength="2"  pattern="[0-9]{2}" title="seulement des chiffres"/>
                </div>
                <div class="col-sm-2 col-md-1">
                    <input type="text" class="form-control" name="annéeFin" id="annee" placeholder="année" maxlength="4" pattern="[0-9]{4}" title="seulement des chiffres"/>
                </div>
            </div>
            <div class="form-group-6">
                <label for="" class="col-sm-4 col-md-3 control-label">Moment : </label>
                <div class="col-sm-2 col-md-3">
                    <select class="form-control" id="select" name="moment" required placeholder="">
                    <?php foreach ($_POST['jour'] as $value) : ?>
                        <option><?= $value ?></option>
                    <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group-6">
                <label for="" class="col-sm-4 col-md-3 control-label">Ouvert : </label>
                <div class="col-sm-2 col-md-3">
                    <select class="form-control" id="select" name="ouvertFerme">
                        <option>oui</option>
                        <option>non</option>
                    </select>
                </div>
            </div>
        </fieldset>
        <br><br>
        <button type="button" class="btn btn-warning" id="retour">annuler</button>
        <button type="submit" class="btn btn-success pull-right" >ajouter</button>
</form>