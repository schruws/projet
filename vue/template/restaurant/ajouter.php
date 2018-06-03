<div>
    <ul class="progressBar">
        <li class="active" >données du restaurant</li>
        <li id="2">contrat</li>
        <li id="3">confirmé</li>
    </ul>
</div>
<form id="restaurant.creer" action= "restaurant.creer" method="POST" onsubmit="return form_action('restaurant.creer')" class="form-horizontal">
    <div id="personne">
        <fieldset class="container">
        <legend>Données du restaurant <div class="pull-right"><small>champs obligatoires : </small> <span style="color: #FF8C00;" class="glyphicon glyphicon-asterisk "></span></div></legend>
            <div class="form-group-6">
                <label for="nom" class="col-sm-4 col-md-3 control-label">Nom : <span style="color: #FF8C00;" class="glyphicon glyphicon-asterisk small "></span></label>
                <div class="col-sm-2 col-md-3">
                    <input type="text" id="nom" name="nomRestau" class="form-control" required placeholder="" maxlength=30 pattern="[a-zA-ZÀ-ÿ -.0-9]{1,30}"/>
                </div>
            </div>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Téléphone :</label>
            <div class="col-sm-2 col-md-3">
                <input type="text" name="telephone" class="form-control"  placeholder="exemple : 0x/xxx xx xx" title="0x ou/ou. xxxx ou/ou. xx ou/ou. xx" pattern="^0[0-9]?[-. /]?[0-9]{3}([-. /]?[0-9]{2}){2}$"/>
            </div>
        </div>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Fax : </label>
            <div class="col-sm-2 col-md-3">
                <input type="text" name="fax" class="form-control"  placeholder="exemple : 0x/xxx xx xx" title="0x ou/ou. xxxx ou/ou. xx ou/ou. xx" pattern="^0[0-9]?[-. /]?[0-9]{3}([-. /]?[0-9]{2}){2}$"/>
            </div>
        </div>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Email : <span style="color: #FF8C00;" class="glyphicon glyphicon-asterisk small "></span></label>
            <div class="col-sm-2 col-md-3">
                <input type="email" name="email" class="form-control" required placeholder=""/>
            </div>
        </div>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Site web : </label>
            <div class="col-sm-2 col-md-3">
                <input type="text" name="site" class="form-control"  placeholder="exemple : www.exemple.com" title="www.exemple.com/be/..." pattern="#(w{3}\.)?)(?<!www)(\w+-?)*\.([a-z]{2,4}))#"/>
            </div>
        </div>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Lien Facebook : </label>
            <div class="col-sm-2 col-md-3 ">
                <input type="text" name="adresseFacebook" class="form-control"  placeholder="www.facebook.com/votre nom" title="www.facebook.com/username" pattern="^www.facebook.com/[a-zA-ZÀ-ÿ -.]*"/>
            </div>
        </div>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Numéro de TVA : </label>
            <div class="col-sm-2 col-md-3">
                <input type="text" name="numeroTVA" class="form-control"  placeholder="exemple : 123456789" title="0 + 9 ou 10 caractères numériques" pattern="[0-9]{9,10}"/>
            </div>
        </div>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Numéro de commerce : </label>
            <div class="col-sm-2 col-md-3">
                <input type="text" name="numRegistCommerce" class="form-control" placeholder="que des chiffres" title="que des chiffres" pattern="[0-9]*"/>
            </div>
        </div>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Compte bancaire : </label>
            <div class="col-sm-2 col-md-3">
                <input type="text" name="compteBancaire" class="form-control" placeholder="exemple : xxxx xxxx xxxx xxxx x" pattern="([0-9]{4}[-. /]?){4}[0-9]"/>
            </div>
        </div>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Type de cuisine : </label>
            <div class="col-sm-2 col-md-3">
                <input list="restaurant" type="text" name="typeDeCuisine" class="form-control" placeholder="Recherche" title="que des lettres" multiple pattern="[a-zA-ZÀ-ÿ -]*">
                <datalist id="restaurant">
                    <?php foreach ($_POST['typeCuisinne'] as  $donnees): ?>
                        <option><?php echo $donnees->getTypeDeCuisinne();?></option>
                    <?php endforeach; ?>
                </datalist>
            </div>
        </div>
    </fieldset>
    <fieldset >
        <legend>Adresse</legend>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Rue : <span style="color: #FF8C00;" class="glyphicon glyphicon-asterisk small "></span></label>
            <div class="col-sm-2 col-md-3">
                <input type="text" name="rue" class="form-control" required placeholder="" maxlength="30" pattern="([a-zA-ZÀ-ÿ .-]?){1,30}"/>
            </div>
        </div>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Numéro : <span style="color: #FF8C00;" class="glyphicon glyphicon-asterisk small "></span></label>
            <div class="col-sm-2 col-md-3">
                <input type="text" name="numero" class="form-control" required placeholder=""  maxlength="3" pattern="[0-9]{1,3}"/>
            </div>
        </div>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Code postal : <span style="color: #FF8C00;" class="glyphicon glyphicon-asterisk small "></span></label>
            <div class="col-sm-2 col-md-3">
                <input type="text" name="codePostal" class="form-control" required placeholder=""  maxlength="4" pattern="[0-9]{1,4}" title=""/>
            </div>
        </div>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Localité : <span style="color: #FF8C00;" class="glyphicon glyphicon-asterisk small "></span></label>
            <div class="col-sm-2 col-md-3">
                <input type="text" name="localite" class="form-control" required placeholder="" maxlength="30" pattern="([a-zA-ZÀ-ÿ .-]?){1,30}"/>
            </div>
        </div>
    </fieldset>
    <fieldset>
        <legend>Informations</legend>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Parking : </label>
            <div class="col-sm-2 col-md-3">
                <input type="text" name="parking" class="form-control" placeholder="que des chiffres" pattern="[0-9]*" maxlength="4"/>
            </div>
        </div>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Terrasse : </label>
            <div class="col-sm-2 col-md-3">
                <input type="text" name="terasse" class="form-control" 1/>
            </div>
        </div>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Nombre de couverts : </label>
            <div class="col-sm-2 col-md-3">
                <input type="text" name="nombreCouvert" placeholder="que des chiffrs" class="form-control"/>
            </div>
        </div>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Dînner club : </label>
            <div class="col-sm-2 col-md-3">
                <input type="checkbox" name="dinersClub" class="form-control"/>
            </div>
        </div>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Menu pour enfant : </label>
            <div class="col-sm-2 col-md-3">
                <input type="checkbox" name="menuEnfant" class="form-control"/>
            </div>
        </div>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Wifi : </label>
            <div class="col-sm-2 col-md-3">
                <input type="checkbox" name="wifi" class="form-control"/>
            </div>
        </div>
    </fieldset>
    <fieldset>
        <legend>Moyens de paiement</legend>
        <table class="table table-bordered" >
            <thead>
            <tr>

                <th class="col-sm-2">Visa</th>
                <th class="col-sm-2">Master Card</th>
                <th class="col-sm-2">Bancontact</th>
                <th class="col-sm-2">Amrecican Express</th>
                <th class="col-sm-2">Sodexo</th>
            </tr>
            </thead>
            <tbody>
            <tr>

                <th><input type="checkbox" name="paiementVisa"  ></th>
                <th><input type="checkbox" name="paiementMasterCard" ></th>
                <th><input type="checkbox" name="paiementBancontact" ></th>
                <th><input type="checkbox" name="paiementAmericanExpress" ></th>
                <th><input type="checkbox" name="paiementSodexo" ></th>
            </tr>
            </tbody>
        </table>
    </fieldset>
        <button type="button" class="btn btn-success pull-right" onclick="creerContrat(this)">suivant</button>
    </div>
    <div id="contrat" style="display: none">
        <legend>Horaires des besoins en personnel</legend>
        <p>Sélectionner un jour de la semaine : </p>
        <table class="table table" >
            <thead>
            <tr>
                <th class="col-sm-1" id="tous" onclick="jour(this)">Tous</th>
                <?php foreach ($_POST['jour'] as  $donnees): ?>
                    <th class="col-sm-1" id="<?php echo $donnees;?>" onclick="jour(this)"><?php echo $donnees;?></th>
                <?php endforeach; ?>
            </tr>
            </thead>
        </table>
        <div id="voir>">
        <?php foreach ($_POST['jour'] as  $donnees): ?>
        <?php if ($donnees === "lundi"): ?>
        <table class="table table-bordered" id="<?= $donnees ; ?>" >
            <thead>
            <tr>
                <th class="col-sm-2"><?= $donnees ; ?></th>
                <?php foreach ($_POST['competence'] as  $competence): ?>
                    <th class="col-sm-2"><?= $competence->getNomComp() ?></th>
                <?php endforeach; ?>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th>Midi</th>
                <th><div><input class=" form-control" type="number" min="0" max="100" step="1" value="0" name="<?= $donnees ; ?>Midi[]" ></div></th>
                <th><div><input class=" form-control" type="number" min="0" max="100" step="1" value="0" name="<?= $donnees ; ?>Midi[]"></div></th>
                <th><div><input class=" form-control" type="number" min="0" max="100" step="1" value="0" name="<?= $donnees ; ?>Midi[]"></div></th>
                <th><div><input class=" form-control" type="number" min="0" max="100" step="1" value="0" name="<?= $donnees ; ?>Midi[]"></div></th>
            </tr>
            <tr>
                <th>Soir</th>
                <th><div><input class=" form-control" type="number" min="0" max="100" step="1" value="0" name="<?= $donnees ; ?>Soir[]" ></div></th>
                <th><div><input class=" form-control" type="number" min="0" max="100" step="1" value="0" name="<?= $donnees ; ?>Soir[]"></div></th>
                <th><div><input class=" form-control" type="number" min="0" max="100" step="1" value="0" name="<?= $donnees ; ?>Soir[]"></div></th>
                <th><div><input class=" form-control" type="number" min="0" max="100" step="1" value="0" name="<?= $donnees ; ?>Soir[]"></div></th>


            </tr>
            </tbody>
        </table>
    <?php else: ?>
    <table class="table table-bordered" id="<?= $donnees ; ?>" style="display: none" >
        <thead>
        <tr>
            <th class="col-sm-2"><?= $donnees ; ?></th>
            <?php foreach ($_POST['competence'] as  $competence): ?>
            <th class="col-sm-2"><?= $competence->getNomComp() ?></th>
           <?php endforeach; ?>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th>Midi</th>
            <th><div><input class=" form-control" type="number" min="0" max="100" step="1" value="0" name="<?= $donnees ; ?>Midi[]" ></div></th>
            <th><div><input class=" form-control" type="number" min="0" max="100" step="1" value="0" name="<?= $donnees ; ?>Midi[]"></div></th>
            <th><div><input class=" form-control" type="number" min="0" max="100" step="1" value="0" name="<?= $donnees ; ?>Midi[]"></div></th>
            <th><div><input class=" form-control" type="number" min="0" max="100" step="1" value="0" name="<?= $donnees ; ?>Midi[]"></div></th>
        </tr>
        <tr>
            <th>Soir</th>
            <th><div><input class=" form-control" type="number" min="0" max="100" step="1" value="0" name="<?= $donnees ; ?>Soir[]" ></div></th>
            <th><div><input class=" form-control" type="number" min="0" max="100" step="1" value="0" name="<?= $donnees ; ?>Soir[]"></div></th>
            <th><div><input class=" form-control" type="number" min="0" max="100" step="1" value="0" name="<?= $donnees ; ?>Soir[]"></div></th>
            <th><div><input class=" form-control" type="number" min="0" max="100" step="1" value="0" name="<?= $donnees ; ?>Soir[]"></div></th>


        </tr>
        </tbody>
    </table>
    <?php endif; ?>
    <?php endforeach; ?>
    </div>
    <button type="button" class="btn btn-success pull-right" onclick="valider(this)">suivant</button>
    <button type="submit" class="btn btn-success pull-right"  id="bouttonvalider" style="display: none">valider</button>
    </div>
    <button type="button" class="btn btn-warning " id="retour">annuler</button>
</form>
<script src="vue/js/action-form.js"></script>






