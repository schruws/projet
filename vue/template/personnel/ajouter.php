<!--
le premier if : permet de créer un membre du personnel pour un restaurant.
le else : permet en temps administrateur de créer une personne pour la gestion du restaurant.
-->

<?php if($_SESSION['user']->getNomPers() !== "admin"): ?>
<div>
    <ul class="progressBar">
        <li class="active" >donnée de l'employé</li>
        <li id="2">contrat</li>
        <li id="3">confirmé</li>
    </ul>
</div>
<form id="personnel.creer" action= "personnel.creer" method="POST" onsubmit="return form_action('personnel.creer')" class="form-horizontal">
    <div id="personne">
    <fieldset class="container" >
    <div class="form-group-6">
            <legend>Données personnelles<div class="pull-right"><small>champs obligatoires : </small> <span style="color: #FF8C00;" class="glyphicon glyphicon-asterisk "></span></div></legend>
        <label for="nom" class="col-sm-4 col-md-3 control-label">Nom : <span style="color: #FF8C00;" class="glyphicon glyphicon-asterisk small "></span></label>
        <div class="col-sm-2 col-md-3">
        <input type="text" id="nom" name="nomPers" class="form-control" required placeholder="en lettres uniquement" maxlength="15" pattern="[a-zA-ZÀ-ÿ -]{1,15}" title="seulement des lettres"/>
        </div>
    </div>

    <div class="form-group-6">
        <label for="" class="col-sm-4 col-md-3 control-label">Prénom : <span style="color: #FF8C00;" class="glyphicon glyphicon-asterisk small "></span></label>
        <div class="col-sm-2 col-md-3">
        <input type="text" name="prenom" class="form-control" required placeholder="en lettres uniquement" maxlength="15" pattern="[a-zA-ZÀ-ÿ -]{1,15}" title="seulement des lettres"/>
        </div>
    </div>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Date de naissance : </label>
            <div class="col-sm-2 col-md-1">
                <input type="text" class="form-control" name="jour" id="jour" placeholder="jour" maxlength="2" pattern="[0-9]{2}" title="seulement des chiffres"/>
            </div>
            <div class="col-sm-2 col-md-1">
                <input type="text" class="form-control" name="mois" id="mois" placeholder="mois" maxlength="2"  pattern="[0-9]{2}" title="seulement des chiffres"/>
            </div>
            <div class="col-sm-2 col-md-1">
                <input type="text" class="form-control" name="année" id="annee" placeholder="année" maxlength="4" pattern="[0-9]{4}" title="seulement des chiffres"/>
            </div>
        </div>

        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Gsm : <span style="color: #FF8C00;" class="glyphicon glyphicon-asterisk small "></span></label>
            <div class="col-sm-2 col-md-3">
                <input type="text" name="gsm" id="GSM" class="form-control" required placeholder="exemple : 04xx/xx xx xx" pattern="^0[0-9]?[-. /0-9]*$" title="04xx/xx xx xx"/>
            </div>
        </div>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Téléphone : <span style="color: #FF8C00;" class="glyphicon glyphicon-asterisk small "></span></label>
            <div class="col-sm-2 col-md-3">
                <input type="text" name="telephone" id="telephone" class="form-control" required placeholder="exemple : 0x/xxx xx xx" pattern="^0[0-9]?[-. /]?[0-9]{3}([-. /]?[0-9]{2}){2}$" title="0x/xxx xx xx"/>
            </div>
        </div>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Nationalité : </label>
            <div class="col-sm-2 col-md-3">
                <input list="restaurant" type="text" name="nationalite" class="form-control" placeholder="Recherche" onkeyup="afficher(this)"maxlength="15" pattern="[a-zA-ZÀ-ÿ -]{1,15}" title="seulement des lettres">
                <datalist id="restaurant" oninput="recherch(this)">
                    <?php foreach ($_SESSION['nationalite'] as  $donnees): ?>
                            <option><?php echo $donnees->getNationalite();?></option>
                    <?php endforeach; ?>
                </datalist>
            </div>
        </div>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Etat civil : </label>
            <div class="col-sm-2 col-md-3">
                <select class="form-control" id="select" name="etatCivil"  placeholder="">
                    <option>Célibataire</option>
                    <option>Marié</option>
                    <option>Divorcé</option>
                    <option>Veuf</option>
                </select>
            </div>
        </div>

        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Email : <span style="color: #FF8C00;" class="glyphicon glyphicon-asterisk small "></span></label>
            <div class="col-sm-2 col-md-3">
                <input type="email" name="email" id="email" class="form-control" required placeholder=""/>
            </div>
        </div>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Sexe : </label>
            <div class="col-sm-2 col-md-3">
                <select class="form-control" id="select" name="sexe">
                    <option>Homme</option>
                    <option>Femme</option>
                </select>
            </div>
        </div>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Compte bancaire : <span style="color: #FF8C00;" class="glyphicon glyphicon-asterisk small "></span></label>
            <div class="col-sm-2 col-md-3">
                <input type="text" name="compteBancaire" id="compteBancaire" class="form-control" required placeholder="exemple : xxxx xxxx xxxx xxxx x" pattern="([0-9]{4}[-. /]?){4}[0-9]" title="xxxx xxxx xxxx xxxx x"/>
            </div>
        </div>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Permis de travail : </label>
            <div class="col-sm-2 col-md-3">
                <select class="form-control" id="select" name="permisDeTravail">
                    <option>oui</option>
                    <option>non</option>
                </select>
            </div>
        </div>
    </fieldset>
    <fieldset class="container" >
        <legend>Adresse du domicile</legend>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Rue : <span style="color: #FF8C00;" class="glyphicon glyphicon-asterisk small "></span></label>
            <div class="col-sm-2 col-md-3">
                <input type="text" name="rue" class="form-control" required placeholder="que des lettres" maxlength="30" pattern="([a-zA-ZÀ-ÿ -]?){1,30}" title="seulement des lettres ou ./-"/>
            </div>
        </div>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Numéro : <span style="color: #FF8C00;" class="glyphicon glyphicon-asterisk small "></span></label>
            <div class="col-sm-2 col-md-3">
                <input type="text" name="numero" class="form-control" required placeholder="" maxlength="3" pattern="[0-9]{1,3}" title="seulement des chiffres"/>
            </div>
        </div>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Code postal : <span style="color: #FF8C00;" class="glyphicon glyphicon-asterisk small "></span></label>
            <div class="col-sm-2 col-md-3">
                <input type="text" name="CodePostal" class="form-control" required placeholder=""  maxlength="4" pattern="[0-9]{1,4}" title="seulement des chiffres"/>
            </div>
        </div>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Localité : <span style="color: #FF8C00;" class="glyphicon glyphicon-asterisk small "></span></label>
            <div class="col-sm-2 col-md-3">
                <input type="text" name="localite" class="form-control" required placeholder="" maxlength="30" pattern="([a-zA-ZÀ-ÿ -]?){1,30}" title="seulement des lettres ou ./-"/>
            </div>
        </div>
    </fieldset>
    <fieldset class="container">
        <legend>Adresse résidentielle</legend>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Rue : </label>
            <div class="col-sm-2 col-md-3">
                <input type="text" name="Residentiel[]" class="form-control" maxlength="30" pattern="([a-zA-ZÀ-ÿ -]?){ ,30}" title="seulement des lettres ou ./-"/>
            </div>
        </div>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Numéro : </label>
            <div class="col-sm-2 col-md-3">
                <input type="text" name="Residentiel[]" class="form-control" maxlength="3" pattern="[0-9]{ ,3}"  title="seulement des chiffres"/>
            </div>
        </div>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Code Postal : </label>
            <div class="col-sm-2 col-md-3">
                <input type="text" name="Residentiel[]" class="form-control" maxlength="4" pattern="[0-9]{ ,4}"  title="seulement des chiffres"/>
            </div>
        </div>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Localité : </label>
            <div class="col-sm-2 col-md-3">
                <input type="text" name="Residentiel[]" class="form-control" maxlength="30" pattern="([a-zA-ZÀ-ÿ -]?){ ,30}" title="seulement des lettres ou ./-"/>
            </div>
        </div>
    </fieldset>
    <fieldset class="container">
        <legend>Permis</legend>
        <table class="table table-bordered" >
            <thead>
            <tr>

                <th>Vélomoteur</th>
                <th>Motocyclette</th>
                <th>Voiture</th>
                <th>Camion</th>
            </tr>
            </thead>
            <tbody>
            <tr>

                <th><input type="checkbox" name="permis[]" value="-A3" >-A3 </th>
                <th>-A <input type="checkbox" name="permis[]" value="-A"></th>
                <th>
                    -B <input type="checkbox" name="permis[]" value="-B">
                    B+E <input type="checkbox" name="permis[]" value="B+E">
                </th>
                <th>
                    -C   <input type="checkbox" name="permis[]" value="-C">
                    C1   <input type="checkbox" name="permis[]" value="C1">
                    c+E  <input type="checkbox" name="permis[]" value="C+E">
                    C1+E <input type="checkbox" name="permis[]" value="C1+E">
                </th>
            </tr>
            </tbody>
        </table>
    </fieldset>
    <fieldset class="container">
        <legend>Disponibilités</legend>
        <table class="table table-bordered" >
            <thead>
            <tr>
                <th></th>
                <th>Lundi</th>
                <th>Mardi</th>
                <th>Mecredi</th>
                <th>Jeudi</th>
                <th>Vendredi</th>
                <th>Samedi</th>
                <th>Dimanche</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th>Midi</th>
                <th><input type="checkbox" name="lundiMidi" ></th>
                <th><input type="checkbox" name="mardiMidi"></th>
                <th><input type="checkbox" name="mercrediMidi"></th>
                <th><input type="checkbox" name="jeudiMidi"></th>
                <th><input type="checkbox" name="vendrediMidi"></th>
                <th><input type="checkbox" name="samediMidi"></th>
                <th><input type="checkbox" name="dimancheMidi"></th>
            </tr>
            <tr>
                <th>Soir</th>
                <th><input type="checkbox" name="lundiSoir"></th>
                <th><input type="checkbox" name="mardiSoir"></th>
                <th><input type="checkbox" name="mercrediSoir"></th>
                <th><input type="checkbox" name="jeudiSoir"></th>
                <th><input type="checkbox" name="vendrediSoir"></th>
                <th><input type="checkbox" name="samediSoir"></th>
                <th><input type="checkbox" name="dimancheSoir"></th>

            </tr>
            </tbody>
        </table>
    </fieldset>
    <br><br>
    <button type="button" class="btn btn-success pull-right" onclick="creerContrat(this)">suivant</button>
    </div>
    <!--
    contrat
    -->
    <div id="contrat" style="display: none">
        <fieldset class="container">
            <legend>Contrat <div class="pull-right"><small>champs obligatoires : </small> <span style="color: #FF8C00;" class="glyphicon glyphicon-asterisk "></span></div></legend>

            <div class="form-group-6">
                <label for="" class="col-sm-4 col-md-3 control-label">Type de contrat : <span style="color: #FF8C00;" class="glyphicon glyphicon-asterisk small "></span></label>
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
                    <input type="text" name="remunerationBrut" class="form-control"  pattern="[0-9 -,.]*" title="seulement des chiffres ou .,-"/><span class="input-group-addon"> €</span>
                </div>
            <div class="form-group-6">
                <label for="" class="col-sm-4 col-md-3 control-label">Date de début : <span style="color: #FF8C00;" class="glyphicon glyphicon-asterisk small "></span></label>
                    <div class="col-sm-2 col-md-1">
                        <input type="text" class="form-control" required name="jourDebut" id="jourDebut" placeholder="jour" maxlength="2" pattern="[0-9]{2}" value="<?php echo date('d');?>" title="deux chiffres ex : 09, 12, ect"/>
                    </div>
                    <div class="col-sm-2 col-md-1">
                        <input type="text" class="form-control" required name="moisDebut" id="moisDebut" placeholder="mois" maxlength="2"  pattern="[0-9]{2}" value="<?php echo date('m');?>" title="deux chiffres ex : 09, 12, ect"/>
                    </div>
                    <div class="col-sm-2 col-md-1">
                        <input type="text" class="form-control" required name="anneeDebut" id="anneeDebut" placeholder="année" maxlength="4" pattern="[0-9]{4}" value="<?php echo date('Y');?>" title="seulement des chiffres"/>
                    </div>
            </div>
            <div class="form-group-6" id="dateFin" style="display:none;">
                <label for="" class="col-sm-4 col-md-3 control-label">Date de fin : <span style="color: #FF8C00;" class="glyphicon glyphicon-asterisk small "></span></label>
                <div class="col-sm-2 col-md-1">
                    <input type="text" class="form-control" name="jourFin" id="jourFin" placeholder="jour" maxlength="2" pattern="[0-9]{2}" title="deux chiffres ex : 09, 12, ect"/>
                </div>
                <div class="col-sm-2 col-md-1">
                    <input type="text" class="form-control" name="moisFin" id="moisFin" placeholder="mois" maxlength="2"  pattern="[0-9]{2}" title="deux chiffres ex : 09, 12, ect"/>
                </div>
                <div class="col-sm-2 col-md-1">
                    <input type="text" class="form-control" name="anneeFin" id="anneeFin" placeholder="année" maxlength="4" pattern="[0-9]{4}" title="seulement des chiffres"/>
                </div>
            </div>
        </fieldset>
        <fieldset class="container">
            <legend>Fonction</legend>
            <div class="form-group-6">
                <label for="" class="col-sm-4 col-md-3 control-label">Compétence : <span style="color: #FF8C00;" class="glyphicon glyphicon-asterisk small "></span></label>
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
        <button type="button" class="btn btn-success pull-right" onclick="valider(this)">suivant</button>
        <button type="submit" class="btn btn-success pull-right"  id="bouttonvalider" style="display: none">valider</button>

    </div>
    <button type="button" class="btn btn-warning " id="retour">annuler</button>

</form>
<?php else: ?>
    <form id="personnel.creer" action= "personnel.creer" method="POST" onsubmit="return form_action('personnel.creer')" class="form-horizontal">
        <fieldset class="container">
            <div class="form-group-6">
                <legend>Données personnelles<div class="pull-right"><small>champs obligatoires : </small> <span style="color: #FF8C00;" class="glyphicon glyphicon-asterisk "></span></div></legend>
                <label for="nom" class="col-sm-4 col-md-3 control-label">Nom :  <span style="color: #FF8C00;" class="glyphicon glyphicon-asterisk small "></span></label>
                <div class="col-sm-2 col-md-3">
                    <input type="text" id="nom" name="nomPers" class="form-control" required placeholder="votre nom que des lettres" maxlength="15" pattern="[a-zA-ZÀ-ÿ]{1,15}" title="seulement des lettres"/>
                </div>
            </div>

            <div class="form-group-6">
                <label for="" class="col-sm-4 col-md-3 control-label">Prénom :  <span style="color: #FF8C00;" class="glyphicon glyphicon-asterisk small "></span></label>
                <div class="col-sm-2 col-md-3">
                    <input type="text" name="prenom" class="form-control" required placeholder="votre prenom que des lettres" maxlength="15" pattern="[a-zA-ZÀ-ÿ]{1,15}" title="seulement des lettres"/>
                </div>
            </div>
            <div class="form-group-6">
                <label for="" class="col-sm-4 col-md-3 control-label">Date de naissance : </label>
                <div class="col-sm-2 col-md-1">
                    <input type="text" class="form-control" name="jour" id="jour" placeholder="jour" maxlength="2" pattern="[0-9]{2}" title="seulement des chiffres"/>
                </div>
                <div class="col-sm-2 col-md-1">
                    <input type="text" class="form-control" name="mois" id="mois" placeholder="mois" maxlength="2"  pattern="[0-9]{2}" title="seulement des chiffres"/>
                </div>
                <div class="col-sm-2 col-md-1">
                    <input type="text" class="form-control" name="année" id="annee" placeholder="année" maxlength="4" pattern="[0-9]{4}" title="seulement des chiffres"/>
                </div>
            </div>

            <div class="form-group-6">
                <label for="" class="col-sm-4 col-md-3 control-label">Gsm :  <span style="color: #FF8C00;" class="glyphicon glyphicon-asterisk small "></span></label>
                <div class="col-sm-2 col-md-3">
                    <input type="text" name="gsm" id="GSM" class="form-control" required placeholder="exemple : 04xx/xx xx xx" pattern="^0[4][0-9]{2}([-. /]?[0-9]{2}){3}$" title="04xx/xx xx xx"/>
                </div>
            </div>
            <div class="form-group-6">
                <label for="" class="col-sm-4 col-md-3 control-label">Téléphone :  <span style="color: #FF8C00;" class="glyphicon glyphicon-asterisk small "></span></label>
                <div class="col-sm-2 col-md-3">
                    <input type="text" name="telephone" id="telephone" class="form-control" required placeholder="exemple : 0x/xxx xx xx" pattern="^0[0-9]?[-. /0-9]*$" title="0x/xxx xx xx"/>
                </div>
            </div>
            <div class="form-group-6">
                <label for="" class="col-sm-4 col-md-3 control-label">Nationalité : </label>
                <div class="col-sm-2 col-md-3">
                    <input list="restaurant" type="text" name="nationalite" class="form-control" placeholder="Recherche" onkeyup="afficher(this)"maxlength="15" pattern="[a-zA-ZÀ-ÿ]{1,15}" title="seulement des lettres">
                    <datalist id="restaurant" oninput="recherch(this)">
                        <?php foreach ($_SESSION['nationalite'] as  $donnees): ?>
                            <option><?php echo $donnees->getNationalite();?></option>
                        <?php endforeach; ?>
                    </datalist>
                </div>
            </div>
            <div class="form-group-6">
                <label for="" class="col-sm-4 col-md-3 control-label">Etat civil : </label>
                <div class="col-sm-2 col-md-3">
                    <select class="form-control" id="select" name="etatCivil" required placeholder="">
                        <option>Célibataire</option>
                        <option>Marié</option>
                        <option>dDivorcé</option>
                        <option>Veuf</option>
                    </select>
                </div>
            </div>

            <div class="form-group-6">
                <label for="" class="col-sm-4 col-md-3 control-label">Email :  <span style="color: #FF8C00;" class="glyphicon glyphicon-asterisk small "></span></label>
                <div class="col-sm-2 col-md-3">
                    <input type="email" name="email" id="email" class="form-control" required placeholder=""/>
                </div>
            </div>
            <div class="form-group-6">
                <label for="" class="col-sm-4 col-md-3 control-label">Sexe : </label>
                <div class="col-sm-2 col-md-3">
                    <select class="form-control" id="select" name="sexe">
                        <option>Homme</option>
                        <option>Femme</option>
                    </select>
                </div>
            </div>
            <div class="form-group-6">
                <label for="" class="col-sm-4 col-md-3 control-label">Compte bancaire :  <span style="color: #FF8C00;" class="glyphicon glyphicon-asterisk small "></span></label>
                <div class="col-sm-2 col-md-3">
                    <input type="text" name="compteBancaire" id="compteBancaire" class="form-control" required placeholder="exemple : xxxx xxxx xxxx xxxx x" pattern="([0-9]{4}[-. /]?){4}[0-9]" title="xxxx xxxx xxxx xxxx x"/>
                </div>
            </div>
            <div class="form-group-6">
                <label for="" class="col-sm-4 col-md-3 control-label">Permis de travail : </label>
                <div class="col-sm-2 col-md-3">
                    <select class="form-control" id="select" name="permisDeTravail">
                        <option>oui</option>
                        <option>non</option>
                    </select>
                </div>
            </div>
        </fieldset>
        <fieldset class="container" >
            <legend>Adresse du domicile</legend>
            <div class="form-group-6">
                <label for="" class="col-sm-4 col-md-3 control-label">Rue :  <span style="color: #FF8C00;" class="glyphicon glyphicon-asterisk small "></span></label>
                <div class="col-sm-2 col-md-3">
                    <input type="text" name="rue" class="form-control" required placeholder="" maxlength="30" pattern="([a-zA-ZÀ-ÿ .-]?){1,30}" title="seulement des lettres ou ./-"/>
                </div>
            </div>
            <div class="form-group-6">
                <label for="" class="col-sm-4 col-md-3 control-label">Numéro :  <span style="color: #FF8C00;" class="glyphicon glyphicon-asterisk small "></span></label>
                <div class="col-sm-2 col-md-3">
                    <input type="text" name="numero" class="form-control" required placeholder="" maxlength="3" pattern="[0-9]{1,3}" title="seulement des chiffres"/>
                </div>
            </div>
            <div class="form-group-6">
                <label for="" class="col-sm-4 col-md-3 control-label">Code postal :  <span style="color: #FF8C00;" class="glyphicon glyphicon-asterisk small "></span></label>
                <div class="col-sm-2 col-md-3">
                    <input type="text" name="CodePostal" class="form-control" required placeholder=""  maxlength="4" pattern="[0-9]{1,4}" title="seulement des chiffres"/>
                </div>
            </div>
            <div class="form-group-6">
                <label for="" class="col-sm-4 col-md-3 control-label">Localité :  <span style="color: #FF8C00;" class="glyphicon glyphicon-asterisk small "></span></label>
                <div class="col-sm-2 col-md-3">
                    <input type="text" name="localite" class="form-control" required placeholder="" maxlength="30" pattern="([a-zA-ZÀ-ÿ -]?){1,30}" title="seulement des lettres ou ./-"/>
                </div>
            </div>
        </fieldset>
        <fieldset class="container">
            <legend>Adresse résidentielle</legend>
            <div class="form-group-6">
                <label for="" class="col-sm-4 col-md-3 control-label">Rue : </label>
                <div class="col-sm-2 col-md-3">
                    <input type="text" name="Residentiel[]" class="form-control" maxlength="30" pattern="([a-zA-ZÀ-ÿ]?){ ,30}" title="seulement des lettres ou ./-"/>
                </div>
            </div>
            <div class="form-group-6">
                <label for="" class="col-sm-4 col-md-3 control-label">Numéro : </label>
                <div class="col-sm-2 col-md-3">
                    <input type="text" name="Residentiel[]" class="form-control" maxlength="3" pattern="[0-9]{ ,3}"  title="seulement des chiffres"/>
                </div>
            </div>
            <div class="form-group-6">
                <label for="" class="col-sm-4 col-md-3 control-label">Code Postal : </label>
                <div class="col-sm-2 col-md-3">
                    <input type="text" name="Residentiel[]" class="form-control" maxlength="4" pattern="[0-9]{ ,4}"  title="seulement des chiffres"/>
                </div>
            </div>
            <div class="form-group-6">
                <label for="" class="col-sm-4 col-md-3 control-label">Localité : </label>
                <div class="col-sm-2 col-md-3">
                    <input type="text" name="Residentiel[]" class="form-control" maxlength="30" pattern="([a-zA-ZÀ-ÿ -]?){ ,30}" title="seulement des lettres ou ./-"/>
                </div>
            </div>
        </fieldset>
        <fieldset class="container">
            <legend>Permis</legend>
            <table class="table table-bordered" >
                <thead>
                <tr>

                    <th>Vélomoteur</th>
                    <th>Motocyclette</th>
                    <th>Voiture</th>
                    <th>Camion</th>
                </tr>
                </thead>
                <tbody>
                <tr>

                    <th><input type="checkbox" name="permis[]" value="-A3" >-A3 </th>
                    <th>-A <input type="checkbox" name="permis[]" value="-A"></th>
                    <th>
                        -B <input type="checkbox" name="permis[]" value="-B">
                        B+E <input type="checkbox" name="permis[]" value="B+E">
                    </th>
                    <th>
                        -C   <input type="checkbox" name="permis[]" value="-C">
                        C1   <input type="checkbox" name="permis[]" value="C1">
                        c+E  <input type="checkbox" name="permis[]" value="C+E">
                        C1+E <input type="checkbox" name="permis[]" value="C1+E">
                    </th>
                </tr>
                </tbody>
            </table>
        </fieldset>
        <fieldset class="container">
            <legend>Disponibilitées</legend>
            <table class="table table-bordered" >
                <thead>
                <tr>
                    <th></th>
                    <th>Lundi</th>
                    <th>Mardi</th>
                    <th>Mecredi</th>
                    <th>Jeudi</th>
                    <th>Vendredi</th>
                    <th>Samedi</th>
                    <th>Dimanche</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th>Midi</th>
                    <th><input type="checkbox" name="lundiMidi" ></th>
                    <th><input type="checkbox" name="mardiMidi"></th>
                    <th><input type="checkbox" name="mercrediMidi"></th>
                    <th><input type="checkbox" name="jeudiMidi"></th>
                    <th><input type="checkbox" name="vendrediMidi"></th>
                    <th><input type="checkbox" name="samediMidi"></th>
                    <th><input type="checkbox" name="dimancheMidi"></th>
                </tr>
                <tr>
                    <th>Soir</th>
                    <th><input type="checkbox" name="lundiSoir"></th>
                    <th><input type="checkbox" name="mardiSoir"></th>
                    <th><input type="checkbox" name="mercrediSoir"></th>
                    <th><input type="checkbox" name="jeudiSoir"></th>
                    <th><input type="checkbox" name="vendrediSoir"></th>
                    <th><input type="checkbox" name="samediSoir"></th>
                    <th><input type="checkbox" name="dimancheSoir"></th>

                </tr>
                </tbody>
            </table>
        </fieldset>
        <br><br>
        <button type="submit" class="btn btn-success pull-right" >ajouter</button>
        <button type="button" class="btn btn-warning " id="retourAdmin">annuler</button>
    </form>
<?php endif; ?>
<script src="vue/js/action-form.js"></script>





