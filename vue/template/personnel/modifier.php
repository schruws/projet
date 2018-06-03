<form id="personnel.modification" action= "<?= $_SESSION['action']; ?>" method="POST" onsubmit="return form_action('personnel.modification')" class="form-horizontal">
    <fieldset>
        <div class="form-group-6">
            <legend>Données personnelles<div class="pull-right"><small>champs obligatoires : </small> <span style="color: #FF8C00;" class="glyphicon glyphicon-asterisk "></span></div></legend>
            <label for="nom" class="col-sm-4 col-md-3 control-label">Nom :  <span style="color: #FF8C00;" class="glyphicon glyphicon-asterisk small "></span></label>
            <div class="col-sm-2 col-md-3">
                    <input type="text" id="nom" name="nomPers" class="form-control" required placeholder="" <?php echo $_SESSION["disabled"]?> value="<?= $_SESSION['consulter']->getNomPers() ?>" maxlength="15" pattern="[a-zA-ZÀ-ÿ -]{1,15}" title="seulement que des lettres" />
            </div>
        </div>

        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Prenom :  <span style="color: #FF8C00;" class="glyphicon glyphicon-asterisk small "></span></label>
            <div class="col-sm-2 col-md-3">
                <input type="text" name="prenom" class="form-control"required placeholder="votre nom que des lettres" <?php echo $_SESSION["disabled"]?> value="<?= $_SESSION['consulter']->getPrenom() ?>" maxlength="15" pattern="[a-zA-ZÀ-ÿ -]{1,15}" title="seulement des lettres"/>
            </div>
        </div>
        <?php if(isset($_POST['naissance'][2])) : ?>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Date de naissance : </label>
            <div class="col-sm-2 col-md-1">
                <input type="text" class="form-control" name="jour" id="start_date" placeholder="jour" maxlength="2" <?php echo $_SESSION["disabled"]?> value="<?= $_POST['naissance'][2] ?>" pattern="[0-9]{2}" title="seulement des chiffres">
            </div>
            <div class="col-sm-2 col-md-1">
                <input type="text" class="form-control" name="mois" id="start_date" placeholder="mois" maxlength="2" <?php echo $_SESSION["disabled"]?> value="<?= $_POST['naissance'][1] ?>" pattern="[0-9]{2}" title="seulement des chiffres">
            </div>
            <div class="col-sm-2 col-md-1">
                <input type="text" class="form-control" name="année" id="start_date" placeholder="année" maxlength="4" <?php echo $_SESSION["disabled"]?> value="<?= $_POST['naissance'][0] ?>" pattern="[0-9]{4}" title="seulement des chiffres">
            </div>
        </div>
        <?php else : ?>
            <div class="form-group-6">
                <label for="" class="col-sm-4 col-md-3 control-label">Date de naissance : </label>
                <div class="col-sm-2 col-md-1">
                    <input type="text" class="form-control" name="jour" id="start_date" placeholder="jour" maxlength="2" <?php echo $_SESSION["disabled"]?> pattern="[0-9]{2}" title="seulement des chiffres">
                </div>
                <div class="col-sm-2 col-md-1">
                    <input type="text" class="form-control" name="mois" id="start_date" placeholder="mois" maxlength="2" <?php echo $_SESSION["disabled"]?> pattern="[0-9]{2}" title="seulement des chiffres">
                </div>
                <div class="col-sm-2 col-md-1">
                    <input type="text" class="form-control" name="année" id="start_date" placeholder="année" maxlength="4" <?php echo $_SESSION["disabled"]?> pattern="[0-9]{4}" title="seulement des chiffres">
                </div>
            </div>
        <?php endif; ?>

        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Gsm :  <span style="color: #FF8C00;" class="glyphicon glyphicon-asterisk small "></span></label>
            <div class="col-sm-2 col-md-3">
                <input type="text" name="gsm" class="form-control"required placeholder="" <?php echo $_SESSION["disabled"]?> value="<?= $_SESSION['consulter']->getGsm() ?>"/>
            </div>
        </div>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Téléphone :  <span style="color: #FF8C00;" class="glyphicon glyphicon-asterisk small "></span></label>
            <div class="col-sm-2 col-md-3">
                <input type="text" name="telephone" class="form-control"required placeholder="exemple : 0x/xxx xx xx" <?php echo $_SESSION["disabled"]?> value="<?= $_SESSION['consulter']->getTelephone() ?>" pattern="^[0-9]?[-. /0-9]*$"/>
            </div>
        </div>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Nationalité : </label>
            <div class="col-sm-2 col-md-3">
                <input list="restaurant" type="text" name="nationalite" class="form-control" placeholder="Recherche" <?php echo $_SESSION["disabled"]?> value="<?=  $_POST['nationalite']->getNationalite(); ?>" maxlength="15" pattern="[a-zA-ZÀ-ÿ -]{1,15}" title="seulement des lettres" >
                <datalist id="restaurant" oninput="recherch(this)" >
                    <?php foreach ($_SESSION['nationalite'] as  $donnees): ?>
                        <option><?php echo $donnees->getNationalite();?></option>
                    <?php endforeach; ?>
                </datalist>
            </div>
        </div>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Etat civil : </label>
            <div class="col-sm-2 col-md-3">
                <select class="form-control" id="select" name="etatCivil" <?php echo $_SESSION["disabled"]?>  required placeholder="">
                    <option <?php if($_SESSION["consulter"]->getEtatCivil() === "Célibataire") echo "selected" ?> >Célibataire</option>
                    <option <?php if($_SESSION["consulter"]->getEtatCivil() === "Marié") echo "selected" ?> >Marié</option>
                    <option <?php if($_SESSION["consulter"]->getEtatCivil() === "Divorcé") echo "selected" ?> >Divorcé</option>
                    <option <?php if($_SESSION["consulter"]->getEtatCivil() === "Veuf") echo "selected" ?> >Veuf</option>
                </select>
            </div>
        </div>

        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Email :  <span style="color: #FF8C00;" class="glyphicon glyphicon-asterisk small "></span></label>
            <div class="col-sm-2 col-md-3">
                <input type="email" name="email" class="form-control"required  <?php echo $_SESSION["disabled"]?> value="<?= $_SESSION['consulter']->getEmail() ?>"/>
            </div>
        </div>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Sexe : </label>
            <div class="col-sm-2 col-md-3">
                <select class="form-control" id="select" name="sexe" <?php echo $_SESSION["disabled"]?> value="<?= $_SESSION['consulter']->getSexe() ?>">
                    <option>Homme</option>
                    <option>Femme</option>
                </select>
            </div>
        </div>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Compte bancaire :  <span style="color: #FF8C00;" class="glyphicon glyphicon-asterisk small "></span></label>
            <div class="col-sm-2 col-md-3">
                <input type="text" name="compteBancaire" class="form-control" placeholder="exemple : xxxx xxxx xxxx xxxx x" pattern="([0-9]{4}[-. /]?){4}[0-9]" title="xxxx xxxx xxxx xxxx x" <?php echo $_SESSION["disabled"]?> value="<?= $_SESSION['consulter']->getCompteBancaire() ?>"/>
            </div>
        </div>
        <?php if($_SESSION['user']->getNomPers() === "admin") :?>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Responsable :  <span style="color: #FF8C00;" class="glyphicon glyphicon-asterisk small "></span></label>
            <div class="col-sm-2 col-md-3">
                <input type="checkbox" name="responsable" class="form-control" <?php echo $_SESSION["disabled"]?>  <?php if($_SESSION['consulter']->getResponsable() ) echo 'checked'; ?>/>
            </div>
        </div>
        <?php endif; ?>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Permis de travail : </label>
            <div class="col-sm-2 col-md-3">
                <input type="text" name="permisDeTravail" class="form-control" <?php echo $_SESSION["disabled"]?> value="<?= $_SESSION['consulter']->getPermisDeTravail() ?>"/>
            </div>
        </div>
    </fieldset>
    <fieldset >
        <legend>Adresse de domicile</legend>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Rue :  <span style="color: #FF8C00;" class="glyphicon glyphicon-asterisk small "></span></label>
            <div class="col-sm-2 col-md-3">
                <input type="text" name="rue" class="form-control"required placeholder="que des lettres" maxlength="30" pattern="([a-zA-ZÀ-ÿ -]?){1,30}" title="seulement des lettres ou ./-" <?php echo $_SESSION["disabled"]?> value="<?php echo $_SESSION['lieuDomicile']->getRue() ?>"/>
            </div>
        </div>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Numéro :  <span style="color: #FF8C00;" class="glyphicon glyphicon-asterisk small "></span></label>
            <div class="col-sm-2 col-md-3">
                <input type="text" name="numero" class="form-control"required placeholder="" maxlength="3" pattern="[0-9]{1,3}" title="seulement des chiffres" <?php echo $_SESSION["disabled"]?> value="<?= $_SESSION['lieuDomicile']->getNumero() ?>"/>
            </div>
        </div>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Code postal :  <span style="color: #FF8C00;" class="glyphicon glyphicon-asterisk small "></span></label>
            <div class="col-sm-2 col-md-3">
                <input type="text" name="codePostal" class="form-control"required placeholder=""  maxlength="4" pattern="[0-9]{1,4}" title="seulement des chiffres" <?php echo $_SESSION["disabled"]?> value="<?= $_SESSION['lieuDomicile']->getCodePostal() ?>"/>
            </div>
        </div>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Localite :  <span style="color: #FF8C00;" class="glyphicon glyphicon-asterisk small "></span></label>
            <div class="col-sm-2 col-md-3">
                <input type="text" name="localite" class="form-control"required placeholder="" maxlength="30" pattern="([a-zA-ZÀ-ÿ -]?){1,30}" <?php echo $_SESSION["disabled"]?> value="<?= $_SESSION['lieuDomicile']->getLocalite() ?>"/>
            </div>
        </div>
    </fieldset>
    <fieldset>
        <legend>Adresse résidentielle</legend>
        <div class="form-group-6 form-group-sm-4">
            <label for="" class="col-sm-4 col-md-3 control-label">Rue : </label>
            <div class="col-sm-2 col-md-3">
                <input type="text" name="Residentiel[]" class="form-control" maxlength="30" pattern="([a-zA-ZÀ-ÿ -]?){ ,30}" title="seulement des lettres ou ./-" <?php echo $_SESSION["disabled"]?> value="<?php if(isset($_SESSION['lieuResidentiel'])) echo $_SESSION['lieuResidentiel']->getRue()?>"/>
            </div>
        </div>
        <div class="form-group-6 form-group-sm-4">
            <label for="" class="col-sm-4 col-md-3 control-label">Numéro : </label>
            <div class="col-sm-2 col-md-3">
                <input type="text" name="Residentiel[]" class="form-control" maxlength="3" pattern="[0-9]{ ,3}"  title="seulement des chiffres" <?php echo $_SESSION["disabled"]?> value="<?php if(isset($_SESSION['lieuResidentiel'])) echo  $_SESSION['lieuResidentiel']->getNumero() ?>"/>
            </div>
        </div>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Code postal : </label>
            <div class="col-sm-2 col-md-3">
                <input type="text" name="Residentiel[]" class="form-control" maxlength="4" pattern="[0-9]{ ,4}"  title="seulement des chiffres" <?php echo $_SESSION["disabled"]?> value="<?php if(isset($_SESSION['lieuResidentiel'])) echo $_SESSION['lieuResidentiel']->getCodePostal() ?>"/>
            </div>
        </div>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Ville : </label>
            <div class="col-sm-2 col-md-3">
                <input type="text" name="Residentiel[]" class="form-control"  maxlength="30" pattern="([a-zA-ZÀ-ÿ -]?){ ,30}" title="seulement des lettres ou ./-" <?php echo $_SESSION["disabled"]?> value="<?php if(isset($_SESSION['lieuResidentiel'])) echo $_SESSION['lieuResidentiel']->getLocalite() ?>"/>
            </div>
        </div>
    </fieldset>
    <fieldset>
        <legend>Permis</legend>
        <table class="table table-bordered" >
            <thead>
            <tr>

                <th class="col-md-3">Vélomoteur</th>
                <th class="col-md-3">Motocyclette</th>
                <th class="col-md-3">Voiture</th>
                <th class="col-md-3">Camion</th>
            </tr>
            </thead>
            <tbody>
            <tr>

                <th>-A3 <input type="checkbox" name="permis[]" <?php echo $_SESSION["disabled"]?>  <?php if(isset($_POST['-A3']) ) echo 'checked'; ?> value="-A3" ></th>
                <th>-A <input type="checkbox" name="permis[]" <?php echo $_SESSION["disabled"]?>  <?php if(isset($_POST['-A']) ) echo 'checked'; ?> value="-A"></th>
                <th>
                    -B <input type="checkbox" name="permis[]" <?php echo $_SESSION["disabled"]?>  <?php if(isset($_POST['-B']) ) echo 'checked'; ?> value="-B">
                    B+E <input type="checkbox" name="permis[]" <?php echo $_SESSION["disabled"]?>  <?php if(isset($_POST['B+E']) ) echo 'checked'; ?> value="B+E">
                </th>
                <th>
                    -C   <input type="checkbox" name="permis[]" <?php echo $_SESSION["disabled"]?> <?php if(isset($_POST['-C']) ) echo 'checked'; ?> value="-C">
                    C1   <input type="checkbox" name="permis[]" <?php echo $_SESSION["disabled"]?> <?php if(isset($_POST['C1']) ) echo 'checked'; ?> value="C1">
                    c+E  <input type="checkbox" name="permis[]" <?php echo $_SESSION["disabled"]?> <?php if(isset($_POST['C+E']) ) echo 'checked'; ?> value="C+E">
                    C1+E <input type="checkbox" name="permis[]" <?php echo $_SESSION["disabled"]?> <?php if(isset($_POST['C1+E']) ) echo 'checked'; ?> value="C1+E">
                </th>
            </tr>
            </tbody>
        </table>
    </fieldset>
    <fieldset>
        <legend>Disponibilitées</legend>
        <table class="table table-bordered" >
            <thead>
            <tr>
                <th class="col-md-1"></th>
                <th class="col-md-1">Lundi</th>
                <th class="col-md-1">Mardi</th>
                <th class="col-md-1">Mecredi</th>
                <th class="col-md-1">Jeudi</th>
                <th class="col-md-1">Vendredi</th>
                <th class="col-md-1">Samedi</th>
                <th class="col-md-1">Dimanche</th>
            </tr>
            </thead>
            <tbody>
            <tr>

                <th>Midi</th>
                <th><input type="checkbox" name="lundiMidi" <?php echo $_SESSION["disabled"]?>  <?php if($_SESSION['disponibiliter']->getLundiMidi() ) echo 'checked'; ?>></th>
                <th><input type="checkbox" name="mardiMidi" <?php echo $_SESSION["disabled"]?>  <?php if($_SESSION['disponibiliter']->getMardiMidi() ) echo 'checked'; ?>></th>
                <th><input type="checkbox" name="mercrediMidi" <?php echo $_SESSION["disabled"]?>  <?php if($_SESSION['disponibiliter']->getMercrediMidi() ) echo 'checked'; ?>></th>
                <th><input type="checkbox" name="jeudiMidi" <?php echo $_SESSION["disabled"]?>  <?php if($_SESSION['disponibiliter']->getJeudiMidi()  ) echo 'checked'; ?>></th>
                <th><input type="checkbox" name="vendrediMidi" <?php echo $_SESSION["disabled"]?>  <?php if($_SESSION['disponibiliter']->getVendrediMidi()  ) echo 'checked'; ?>></th>
                <th><input type="checkbox" name="samediMidi" <?php echo $_SESSION["disabled"]?>  <?php if($_SESSION['disponibiliter']->getSamediMidi()  ) echo 'checked'; ?>></th>
                <th><input type="checkbox" name="dimancheMidi" <?php echo $_SESSION["disabled"]?>  <?php if($_SESSION['disponibiliter']->getDimancheMidi()) echo 'checked'; ?>></th>
            </tr>
            <tr>
                <th>Soir</th>
                <th><input type="checkbox" name="lundiSoir" <?php echo $_SESSION["disabled"]?> <?php if($_SESSION['disponibiliter']->getLundiSoir()) echo 'checked'; ?>></th>
                <th><input type="checkbox" name="mardiSoir" <?php echo $_SESSION["disabled"]?> <?php if($_SESSION['disponibiliter']->getMardiSoir()) echo 'checked'; ?>></th>
                <th><input type="checkbox" name="mercrediSoir" <?php echo $_SESSION["disabled"]?> <?php if($_SESSION['disponibiliter']->getMercrediSoir()) echo 'checked'; ?>></th>
                <th><input type="checkbox" name="jeudiSoir" <?php echo $_SESSION["disabled"]?> <?php if($_SESSION['disponibiliter']->getJeudiSoir()) echo 'checked'; ?>></th>
                <th><input type="checkbox" name="vendrediSoir" <?php echo $_SESSION["disabled"]?> <?php if($_SESSION['disponibiliter']->getVendrediSoir()) echo 'checked'; ?>></th>
                <th><input type="checkbox" name="samediSoir" <?php echo $_SESSION["disabled"]?> <?php if($_SESSION['disponibiliter']->getSamediSoir()) echo 'checked'; ?>></th>
                <th><input type="checkbox" name="dimancheSoir" <?php echo $_SESSION["disabled"]?> <?php if($_SESSION['disponibiliter']->getDimancheSoir()) echo 'checked'; ?>></th>

            </tr>
            </tbody>
        </table>
    </fieldset>
    <br><br>
    <?php if($_SESSION['user']->getNomPers() === "admin") : ?>
    <button type="button" class="btn btn-warning" onclick="retourAdmin()">annuler</button>
   <?php else : ?>
        <button type="button" class="btn btn-warning" id="retour">annuler</button>
    <?php endif; ?>
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
<script src="vue/js/action-form.js"></script>