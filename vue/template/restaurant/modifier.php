<form id="restaurant.modification" action= "<?= $_SESSION['action']; ?>" method="POST" onsubmit="return form_action('restaurant.modification')" class="form-horizontal">
    <fieldset>
        <legend>Données du restaurant  <div class="pull-right"><small>champs obligatoires : </small> <span style="color: #FF8C00;" class="glyphicon glyphicon-asterisk "></span></div></legend>
        <div class="form-group-6">
            <label for="nom" class="col-sm-4 col-md-3 control-label">Nom : <span style="color: #FF8C00;" class="glyphicon glyphicon-asterisk small "></span></label>
            <div class="col-sm-4 col-md-3">
                <input type="text" id="nom" name="nomRestau" class="form-control"  <?php echo $_SESSION["disabled"]?> value="<?php echo  $_SESSION["consulter"]->getNomRestau(); ?>" required placeholder="" maxlength=30 pattern="[a-zA-ZÀ-ÿ -.0-9]{1,30}"/>
            </div>
        </div>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Téléphone : </label>
            <div class="col-sm-4 col-md-3">
                <input type="text" name="telephone" class="form-control"  <?php echo $_SESSION["disabled"]?> value="<?php echo  $_SESSION["consulter"]->getTelephone(); ?>"  placeholder="exemple : 0x/xxx xx xx" title="0x ou/ou. xxxx ou/ou. xx ou/ou. xx" pattern="^0[0-9]?[-. /]?[0-9]{3}([-. /]?[0-9]{2}){2}$"/>
            </div>
        </div>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Fax : </label>
            <div class="col-sm-4 col-md-3">
                <input type="text" name="fax" class="form-control"  <?php echo $_SESSION["disabled"]?> value="<?php echo $_SESSION["consulter"]->getFax(); ?>" placeholder="exemple : 0x/xxx xx xx" title="0x ou/ou. xxxx ou/ou. xx ou/ou. xx" pattern="^0[0-9]?[-. /]?[0-9]{3}([-. /]?[0-9]{2}){2}$"/>
            </div>
        </div>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Email : <span style="color: #FF8C00;" class="glyphicon glyphicon-asterisk small "></span></label>
            <div class="col-sm-4 col-md-3">
                <input type="email" name="email" class="form-control"  <?php echo $_SESSION["disabled"]?> value="<?php echo  $_SESSION["consulter"]->getEmail(); ?>" required placeholder=""/>
            </div>
        </div>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Site web : </label>
            <div class="col-sm-4 col-md-3">
                <input type="text" name="site" class="form-control"  <?php echo $_SESSION["disabled"]?> value="<?php echo $_SESSION["consulter"]->getSite(); ?>"  placeholder="exemple : www.exemple.com" title="www.exemple.com/be/..." pattern="#(w{3}\.)?)(?<!www)(\w+-?)*\.([a-z]{2,4}))#"/>
            </div>
        </div>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Lien Facebook : </label>
            <div class="col-sm-4 col-md-3">
                <input type="text" name="adresseFacebook" class="form-control"  <?php echo $_SESSION["disabled"]?>  value="<?php echo $_SESSION["consulter"]->getAdresseFacebook(); ?>"  placeholder="www.facebook.com/votre nom" title="www.facebook.com/username" pattern="^www.facebook.com/[a-zA-ZÀ-ÿ -.]*"/>
            </div>
        </div>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Numéro de TVA : </label>
            <div class="col-sm-4 col-md-3">
                <input type="text" name="numeroTVA" class="form-control"  <?php echo $_SESSION["disabled"]?> value="<?php echo $_SESSION["consulter"]->getNumeroTVA(); ?>"  placeholder="exemple : 123456789" title="0 + 9 ou 10 caractères numériques" pattern="[0-9]{9,10}"/>
            </div>
        </div>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Numéro de commerce: </label>
            <div class="col-sm-4 col-md-3">
                <input type="text" name="numRegistCommerce" class="form-control"  <?php echo $_SESSION["disabled"]?> value="<?php echo $_SESSION["consulter"]->getNumRegistCommerce(); ?>" placeholder="que des chiffres" title="que des chiffres" pattern="[0-9]*" />
            </div>
        </div>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Compte bancaire : </label>
            <div class="col-sm-4 col-md-3">
                <input type="text" name="compteBancaire" class="form-control"  <?php echo $_SESSION["disabled"]?> value="<?php echo $_SESSION["consulter"]->getCompteBancaire(); ?>"  placeholder="exemple : xxxx xxxx xxxx xxxx x" pattern="([0-9]{4}[-. /]?){4}[0-9]"/>
            </div>
        </div>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Type de cuisinne : </label>
            <div class="col-sm-2 col-md-3">
                <input list="restaurant" type="text" name="typeDeCuisine" class="form-control"  multiple value="<?php echo $_SESSION['typeDeCuisine'] ?>" <?php echo $_SESSION["disabled"]?> placeholder="Recherche" title="que des lettres" multiple pattern="[a-zA-ZÀ-ÿ -]*" >
                <datalist id="restaurant">
                    <?php foreach ($_POST['typeCuisinne'] as  $donnees): ?>
                        <option><?php echo $donnees->getTypeDeCuisinne();?></option>
                    <?php endforeach; ?>
                </datalist>
            </div>
        </div>
    </fieldset>
    <fieldset >
        <legend>Adresse </legend>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Rue : <span style="color: #FF8C00;" class="glyphicon glyphicon-asterisk small "></span></label>
            <div class="col-sm-4 col-md-3">
                <input type="text" name="rue" class="form-control"required placeholder="" maxlength="30" pattern="([a-zA-ZÀ-ÿ .-]?){1,30}"  <?php echo $_SESSION["disabled"]?> value="<?php echo $_SESSION["lieu"]->getRue() ?>"/>
            </div>
        </div>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Numero : <span style="color: #FF8C00;" class="glyphicon glyphicon-asterisk small "></span></label>
            <div class="col-sm-4 col-md-3">
                <input type="text" name="numero" class="form-control" required placeholder=""  maxlength="3" pattern="[0-9]{1,3}"  <?php echo $_SESSION["disabled"]?> value="<?php echo $_SESSION["lieu"]->getNumero() ?>"/>
            </div>
        </div>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Code postal : <span style="color: #FF8C00;" class="glyphicon glyphicon-asterisk small "></span></label>
            <div class="col-sm-4 col-md-3">
                <input type="text" name="CodePostal" class="form-control" required placeholder=""  maxlength="4" pattern="[0-9]{1,4}" title=""  <?php echo $_SESSION["disabled"]?> value="<?php echo $_SESSION["lieu"]->getCodePostal() ?>"/>
            </div>
        </div>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Ville : <span style="color: #FF8C00;" class="glyphicon glyphicon-asterisk small "></span></label>
            <div class="col-sm-4 col-md-3">
                <input type="text" name="localite" class="form-control" required placeholder="" maxlength="30" pattern="([a-zA-ZÀ-ÿ .-]?){1,30}"  <?php echo $_SESSION["disabled"]?> value="<?php echo $_SESSION["lieu"]->getLocalite() ?>"/>
            </div>
        </div>
    </fieldset>
    <fieldset>
        <legend>Informations</legend>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Parking : </label>
            <div class="col-sm-4 col-md-3">
                <input type="text" name="parking" class="form-control"  <?php echo $_SESSION["disabled"]?> value="<?php echo $_SESSION["consulter"]->getParking() ?>" placeholder="que des chiffres" pattern="[0-9]*" maxlength="4"/>
            </div>
        </div>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Terasse : </label>
            <div class="col-sm-4 col-md-3">
                <input type="text" name="terasse" class="form-control"  <?php echo $_SESSION["disabled"]?> value="<?php echo $_SESSION["consulter"]->getTerasse() ?>" placeholder="que des chiffres" pattern="[0-9]*" maxlength="4"/>
            </div>
        </div>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Nombre de couvert : </label>
            <div class="col-sm-4 col-md-3">
                <input type="text" name="nombreCouvert" class="form-control"  <?php echo $_SESSION["disabled"]?> value="<?php echo $_SESSION["consulter"]->getNombreCouvert() ?>"/>
            </div>
        </div>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Dinner club : </label>
            <div class="col-sm-4 col-md-3">
                <input type="checkbox" name="dinersClub"  <?php echo $_SESSION["disabled"]?> class="form-control" <?php if($_SESSION["consulter"]->getDinersClub()) echo 'checked'; ?> />
            </div>
        </div>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Menu pour enfant : </label>
            <div class="col-sm-4 col-md-3">
                <input type="checkbox" name="menuEnfant"  <?php echo $_SESSION["disabled"]?> class="form-control" <?php if($_SESSION["consulter"]->getMenuEnfant())  echo 'checked'; ?>/>
            </div>
        </div>
        <div class="form-group-6">
            <label for="" class="col-sm-4 col-md-3 control-label">Wifi : </label>
            <div class="col-sm-4 col-md-3">
                <input type="checkbox" name="wifi" <?php echo $_SESSION["disabled"]?> class="form-control" <?php if($_SESSION["consulter"]->getWifi() ) echo 'checked'; ?>/>
            </div>
        </div>
    </fieldset>
    <fieldset>
        <legend>Moyen de paiement</legend>
        <table class="table table-bordered" >
            <thead>
            <tr>

                <th class="col-md-2">Visa</th>
                <th class="col-md-2">Master Card</th>
                <th class="col-md-2">Bancontact</th>
                <th class="col-md-2">Amrecican Express</th>
                <th class="col-md-2">Sodexo</th>
            </tr>
            </thead>
            <tbody>
            <tr>

                <th><input type="checkbox" <?php echo $_SESSION["disabled"]?> name="paimentVisa" <?php if($_SESSION["consulter"]->getPaimentVisa() ) echo 'checked'; ?>  ></th>
                <th><input type="checkbox" <?php echo $_SESSION["disabled"]?> name="paiementMasterCard" <?php if($_SESSION["consulter"]->getPaiementMasterCard() ) echo 'checked'; ?> ></th>
                <th><input type="checkbox" <?php echo $_SESSION["disabled"]?> name="paiementBancontact" <?php if($_SESSION["consulter"]->getPaiementBancontact() ) echo 'checked'; ?> ></th>
                <th><input type="checkbox" <?php echo $_SESSION["disabled"]?> name="paiementAmericanExpress" <?php if($_SESSION["consulter"]->getPaiementAmericanExpress() ) echo 'checked'; ?> ></th>
                <th><input type="checkbox" <?php echo $_SESSION["disabled"]?> name="paiementSodexo" <?php if($_SESSION["consulter"]->getPaiementSodexo() ) echo 'checked'; ?> ></th>
            </tr>
            </tbody>
        </table>
    </fieldset>
    <button type="button" class="btn btn-warning " id="retour">annuler</button>
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