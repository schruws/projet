<?php  $a = 0; ?>
<div class="navbar-form navbar-left inline-form">
<?php if($_SESSION['user']->getNomPers() === "admin"): ?>
    <a class="btn btn-primary" href="?page=personnel.ajouterPersonnel">ajouter un  responsable</a>
    <?php else: ?>
    <?php if(!isset($_SESSION['afficheTous'])): ?>
        <form id="personnel.afficher" action= "personnel.afficher" method="POST" onsubmit="return form_action('personnel.afficher')" class="form-horizontal">
            <input type="hidden" name="idRestaurant" value=<?= $_SESSION['restaurantContrat']->getIdRestaurant() ?>>
            <input type="submit"  class="btn btn-success pull-right" value="ajouter un membre du personnel">
        </form>
    <?php endif; ?>
<?php endif; ?>

</div>

<input type="hidden" value="0" id="compteur">
<?php if(!isset($_SESSION['afficheTous'])): ?>



    <div class="navbar-form navbar-right inline-form">
        <label for="restaurant">rechercher une personne :</label>
        <input list="restaurant" type="text" id="choix" placeholder="Recherche par nom" onkeyup="rechercheNom(this)">
        <datalist id="restaurant" oninput="afficher(this)">
            <?php foreach ($_SESSION['personnel'] as  $donnees): ?>
                <?php if(!$donnees->getDateSupr()): ?>
                    <option><?php echo $donnees->getNomPers();?></option>
                <?php endif; ?>
            <?php endforeach; ?>
        </datalist>
    </div>

    <div id="voir">
<table class="table table-hover">
    <thead>
    <tr>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Tél/Gsm</th>
        <?php if($_SESSION['user']->getNomPers() === "admin"): ?>
        <th>Responsable</th>
        <?php else : ?>
            <th>Avis</th>
        <?php endif; ?>
        <th>Personne</th>
        <?php if($_SESSION['user']->getNomPers() !== "admin"): ?>
        <th>Contrat</th>
        <th>Congé</th>
        <?php endif; ?>
    </tr>
    </thead>
    <tbody id="contenue">
    <?php foreach($_SESSION['personnel'] as $donnees): ?>
    <?php if($donnees->getDateSupr() === null): ?>
        <?php $a++; ?>
        <?php if($a < 10) : ?>
        <tr id="<?= $donnees->getNomPers()?>">
            <td><?= $donnees->getNomPers()?></td>
            <td><?= $donnees->getPrenom()?></td>
            <td><?= $donnees->getGsm()?></td>
            <?php if($_SESSION['user']->getNomPers() === "admin"): ?>
            <td><?= $donnees->getResponsable()?></td>
                <?php else: ?>
            <?php if(isset($_POST[$donnees->getIdPersonne()])) : ?>
                <td>
                <?php foreach ($_POST[$donnees->getIdPersonne()] as $valeur) : ?>
                    <?php if($valeur['note'] !== null) :?>
                            <?= "Fonction : ".$valeur['type']." Notes : ".$valeur['note'] ?><br>
                        <?php else: ?>
                             <?= "Fonction : ".$valeur['type']." Notes : pas encore été attribué"?><br>
                        <?php endif; ?>
                <?php endforeach; ?>
                </td>
            <?php endif ; ?>
            <?php endif ; ?>
            <td>
                <form id="personnel.consulter<?=$donnees->getIdPersonne()?>" action="personnel.consulter" method="POST" style="display: inline;" onsubmit="return form_action('personnel.consulter<?=$donnees->getIdPersonne()?>')">
                    <input type="hidden" name="idPersonnel" value=<?= $donnees->getIdPersonne() ?>>
                    <input type="submit"  class="btn btn-info btn-sm" value="consulter">
                </form>
                <form id="personnel.modifier<?=$donnees->getIdPersonne()?>" action= "personnel.modifier" method="POST" style="display: inline;" onsubmit="return form_action('personnel.modifier<?=$donnees->getIdPersonne()?>')">
                    <input type="hidden" name="idPersonnel" value=<?= $donnees->getIdPersonne() ?>>
                    <input type="submit"  class="btn btn-warning btn-sm" value="modifier">
                </form>
                <form id="personnel.suprimer<?=$donnees->getIdPersonne()?>" action= "personnel.suprimer" method="POST" style="display: inline;" onsubmit="return form_action('personnel.suprimer<?=$donnees->getIdPersonne()?>')">
                    <input type="hidden" name="idPersonnel" value=<?= $donnees->getIdPersonne() ?>>
                    <input type="submit" class="btn btn-danger btn-sm" value="supprimer">
                </form>
            </td>
            <?php if($_SESSION['user']->getNomPers() !== "admin"): ?>
            <td>
                    <form id="contrat.afficher<?=$donnees->getIdPersonne()?>" action= "contrat.afficher" method="POST" style="display: inline;" onsubmit="return form_action('contrat.afficher<?=$donnees->getIdPersonne()?>')">
                        <input type="hidden" name="idPersonnel" value=<?= $donnees->getIdPersonne() ?>>
                        <input type="submit"  class="btn btn-success btn-sm" value="consulter">
                    </form>
            </td>
            <td>
                <form id="conger.afficher<?=$donnees->getIdPersonne()?>" action= "conger.afficher" method="POST" style="display: inline;" onsubmit="return form_action('conger.afficher<?=$donnees->getIdPersonne()?>')">
                    <input type="hidden" name="idPersonnel" value=<?= $donnees->getIdPersonne() ?>>
                    <input type="submit"  class="btn btn-success btn-sm" value="consulter">
                </form>
            </td>
            <?php endif; ?>
            <?php else : ?>
            <tr id="<?= $donnees->getNomPers()?>">
                <td><?= $donnees->getNomPers()?></td>
                <td><?= $donnees->getPrenom()?></td>
                <td><?= $donnees->getGsm()?></td>
                <td><?= $donnees->getResponsable()?></td>
            <td>
                <form id="personnel.consulter<?=$donnees->getIdPersonne()?>" action="personnel.consulter" method="POST" style="display: inline;" onsubmit="return form_action('personnel.consulter<?=$donnees->getIdPersonne()?>')">
                    <input type="hidden" name="idPersonnel" value=<?= $donnees->getIdPersonne() ?>>
                    <input type="submit"  class="btn btn-info btn-sm" value="consulter">
                </form>
                <form id="personnel.modifier<?=$donnees->getIdPersonne()?>" action= "personnel.modifier" method="POST" style="display: inline;" onsubmit="return form_action('personnel.modifier<?=$donnees->getIdPersonne()?>')">
                    <input type="hidden" name="idPersonnel" value=<?= $donnees->getIdPersonne() ?>>
                    <input type="submit"  class="btn btn-warning btn-sm" value="modifier">
                </form>
                <form id="personnel.suprimer<?=$donnees->getIdPersonne()?>" action= "personnel.suprimer" method="POST" style="display: inline;" onsubmit="return form_action('personnel.suprimer<?=$donnees->getIdPersonne()?>')">
                    <input type="hidden" name="idPersonnel" value=<?= $donnees->getIdPersonne() ?>>
                    <input type="submit" class="btn btn-danger btn-sm" value="supprimer">
                </form>
            </td>
            <?php if($_SESSION['user']->getNomPers() !== "admin"): ?>
                <td>
                    <form id="contrat.afficher<?=$donnees->getIdPersonne()?>" action= "contrat.afficher" method="POST" style="display: inline;" onsubmit="return form_action('contrat.afficher<?=$donnees->getIdPersonne()?>')">
                        <input type="hidden" name="idPersonnel" value=<?= $donnees->getIdPersonne() ?>>
                        <input type="submit"  class="btn btn-success btn-sm" value="consulter">
                    </form>
                </td>
                <td>
                    <form id="conger.afficher<?=$donnees->getIdPersonne()?>" action= "conger.afficher" method="POST" style="display: inline;" onsubmit="return form_action('conger.afficher<?=$donnees->getIdPersonne()?>')">
                        <input type="hidden" name="idPersonnel" value=<?= $donnees->getIdPersonne() ?>>
                        <input type="submit"  class="btn btn-success btn-sm" value="consulter">
                    </form>
                </td>
            <?php endif; ?>
        <?php endif; ?>
    </tr>
    <?php else: ?>
    <tr id="archive.<?= $donnees->getNomPers()?>" style="display: none;">
        <td><?= $donnees->getNomPers()?></td>
        <td><?= $donnees->getPrenom()?></td>
        <td><?= $donnees->getGsm()?></td>
        <?php if($_SESSION['user']->getNomPers() === "admin"): ?>
            <td><?= $donnees->getResponsable()?></td>
        <?php else: ?>
            <?php if(isset($_POST[$donnees->getIdPersonne()])) : ?>
                <td>
                    <?php foreach ($_POST[$donnees->getIdPersonne()] as $valeur) : ?>
                        <?php if($valeur['note'] !== null) :?>
                            <?= "Fonction : ".$valeur['type']." Notes : ".$valeur['note'] ?><br>
                        <?php else: ?>
                            <?= "Fonction : ".$valeur['type']." Notes : pas encore été attribuée"?><br>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </td>
            <?php endif ; ?>
        <?php endif ; ?>
        <td>
            <form id="personnel.consulter<?=$donnees->getIdPersonne()?>" action="personnel.consulter" method="POST" style="display: inline;" onsubmit="return form_action('personnel.consulter<?=$donnees->getIdPersonne()?>')">
                <input type="hidden" name="idPersonnel" value=<?= $donnees->getIdPersonne() ?>>
                <input type="submit"  class="btn btn-info btn-sm" value="consulter">
            </form>
            <form id="personnel.retablir<?=$donnees->getIdPersonne()?>" action= "personnel.retablir" method="POST" style="display: inline;" onsubmit="return form_action('personnel.retablir<?=$donnees->getIdPersonne()?>')">
                <input type="hidden" name="idPersonnel" value=<?= $donnees->getIdPersonne() ?>>
                <input type="submit" class="btn btn-danger btn-sm" value="retablir">
            </form>
        </td>
        <td>
            <?php if($_SESSION['user']->getNomPers() !== "admin"): ?>
                <form id="contrat.afficher<?=$donnees->getIdPersonne()?>" action= "contrat.afficher" method="POST" style="display: inline;" onsubmit="return form_action('contrat.afficher<?=$donnees->getIdPersonne()?>')">
                    <input type="hidden" name="idPersonnel" value=<?= $donnees->getIdPersonne() ?>>
                    <input type="submit"  class="btn btn-success btn-sm" value="consulter">
                </form>
            <?php endif; ?>
        </td>
    <?php endif ; ?>
    <?php endforeach; ?>
    </tbody>
</table>
</div>

    <div class="navbar-form navbar-right" id="check">
        <?php if($_SESSION['user']->getNomPers() === "admin"): ?>
            <label>voir les données des responsables archivés : </label>
        <?php else : ?>
            <label>voir les données des employés  archivés : </label>
        <?php endif;?>
        <input  type="checkbox" id="voir" onchange="afficher(this)">
    </div>
    <?php $a = 0 ?>
<?php else: ?>



            <div class="navbar-form navbar-right inline-form">
                <label for="restaurant">rechercher un restaurant :</label>
                <input list="restaurant" type="text" id="choix" placeholder="Recherche" onkeyup="recherch(this)">
                <datalist id="restaurant" oninput="afficher(this)">
                    <?php foreach ($_SESSION['restaurant'] as  $donnees): ?>
                        <?php if(!$donnees->getDateSupr()): ?>
                            <option><?php echo $donnees->getNomRestau();?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </datalist>
            </div>


<?php foreach($_SESSION['restaurant'] as  $donneeRestaurant): ?>

        <?php if(!$donneeRestaurant->getDateSupr()): ?>
    <div id="<?= $donneeRestaurant->getNomRestau();?>" >
        <table class="table table-hover" id="<?= $donneeRestaurant->getNomRestau() ;?>">
            <caption>Restaurant : <?= $donneeRestaurant->getNomRestau();?>
                <form id="personnel.afficher<?= $donneeRestaurant->getIdRestaurant() ?>" action= "personnel.afficher" method="POST" onsubmit="return form_action('personnel.afficher<?= $donneeRestaurant->getIdRestaurant() ?>')" class="form-horizontal">
                    <input type="hidden" name="idRestaurant" value=<?= $donneeRestaurant->getIdRestaurant() ?>>
                    <input type="submit"  class="btn btn-success pull-right" value="ajouter  personnel">
                </form>
            </caption>
            <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Tél/Gsm</th>
                <th></th>
            </tr>
            </thead>
            <tbody id="contenue">
    <?php foreach($_SESSION[$donneeRestaurant->getNomRestau()." ".$donneeRestaurant->getIdRestaurant()] as $donnees): ?>
        <?php if($donnees->getDateSupr() === null): ?>
        <?php $a++; ?>
        <?php if($a < 10) : ?>
            <tr id="caroussel">
            <td><?= $donnees->getNomPers()?></td>
            <td><?= $donnees->getPrenom()?></td>
            <td><?= $donnees->getGsm()?></td>
            <td>
                <form id="personnel.consulter<?=$donnees->getIdPersonne()?>" action="personnel.consulter" method="POST" style="display: inline;" onsubmit="return form_action('personnel.consulter<?=$donnees->getIdPersonne()?>')">
                    <input type="hidden" name="idPersonnel" value=<?= $donnees->getIdPersonne() ?>>
                    <input type="submit"  class="btn btn-info btn-sm" value="consulter">
                </form>
                <?php if($_SESSION['user']->getNomPers() !== "admin"): ?>
                    <form id="contrat.menu<?=$donnees->getIdPersonne()?>" action= "contrat.afficher" method="POST" style="display: inline;" onsubmit="return form_action('contrat.menu<?=$donnees->getIdPersonne()?>')">
                        <input type="hidden" name="idPersonnel" value=<?= $donnees->getIdPersonne() ?>>
                        <input type="submit"  class="btn btn-success btn-sm" value="contrat">
                    </form>
                <?php endif; ?>
                <form id="personnel.modifier<?=$donnees->getIdPersonne()?>" action= "personnel.modifier" method="POST" style="display: inline;" onsubmit="return form_action('personnel.modifier<?=$donnees->getIdPersonne()?>')">
                    <input type="hidden" name="idPersonnel" value=<?= $donnees->getIdPersonne() ?>>
                    <input type="submit"  class="btn btn-warning btn-sm" value="modifier">
                </form>
                <form id="personnel.suprimer<?=$donnees->getIdPersonne()?>" action= "personnel.suprimer" method="POST" style="display: inline;" onsubmit="return form_action('personnel.suprimer<?=$donnees->getIdPersonne()?>')">
                    <input type="hidden" name="idPersonnel" value=<?= $donnees->getIdPersonne() ?>>
                    <input type="submit" class="btn btn-danger btn-sm" value="suprimer">
                </form>
            </td>
        <?php else : ?>
            <tr id="caroussel" style='display:none'>
            <td><?= $donnees->getNomPers()?></td>
            <td><?= $donnees->getPrenom()?></td>
            <td><?= $donnees->getGsm()?></td>
            <td>
                <form id="personnel.consulter<?=$donnees->getIdPersonne()?>" action="personnel.consulter" method="POST" style="display: inline;" onsubmit="return form_action('personnel.consulter<?=$donnees->getIdPersonne()?>')">
                    <input type="hidden" name="idPersonnel" value=<?= $donnees->getIdPersonne() ?>>
                    <input type="submit"  class="btn btn-info btn-sm" value="consulter">
                </form>
                <form id="contrat.menu<?=$donnees->getIdPersonne()?>" action= "contrat.afficher" method="POST" style="display: inline;" onsubmit="return form_action('contrat.menu<?=$donnees->getIdPersonne()?>')">
                    <input type="hidden" name="idPersonnel" value=<?= $donnees->getIdPersonne() ?>>
                    <input type="submit"  class="btn btn-success btn-sm" value="contrat">
                </form>
                <form id="personnel.modifier<?=$donnees->getIdPersonne()?>" action= "personnel.modifier" method="POST" style="display: inline;" onsubmit="return form_action('personnel.modifier<?=$donnees->getIdPersonne()?>')">
                    <input type="hidden" name="idPersonnel" value=<?= $donnees->getIdPersonne() ?>>
                    <input type="submit"  class="btn btn-warning btn-sm" value="modifier">
                </form>
                <form id="personnel.suprimer<?=$donnees->getIdPersonne()?>" action= "personnel.suprimer" method="POST" style="display: inline;" onsubmit="return form_action('personnel.suprimer<?=$donnees->getIdPersonne()?>')">
                    <input type="hidden" name="idPersonnel" value=<?= $donnees->getIdPersonne() ?>>
                    <input type="submit" class="btn btn-danger btn-sm" value="suprimer">
                </form>
            </td>
        <?php endif; ?>
        </tr>
        <?php else: ?>
    <tr id="archive.<?= $donnees->getNomPers()?>" style="display: none;">
                <td><?= $donnees->getNomPers()?></td>
                <td><?= $donnees->getPrenom()?></td>
                <td><?= $donnees->getGsm()?></td>
                <td>
                    <form id="personnel.consulter<?=$donnees->getIdPersonne()?>" action="personnel.consulter" method="POST" style="display: inline;" onsubmit="return form_action('personnel.consulter<?=$donnees->getIdPersonne()?>')">
                        <input type="hidden" name="idPersonnel" value=<?= $donnees->getIdPersonne() ?>>
                        <input type="submit"  class="btn btn-info" value="consulter">
                    </form>
                    <?php if($_SESSION['user']->getNomPers() !== "admin"): ?>
                        <form id="contrat.menu<?=$donnees->getIdPersonne()?>" action= "contrat.afficher" method="POST" style="display: inline;" onsubmit="return form_action('contrat.menu<?=$donnees->getIdPersonne()?>')">
                            <input type="hidden" name="idPersonnel" value=<?= $donnees->getIdPersonne() ?>>
                            <input type="submit"  class="btn btn-success" value="contrat">
                        </form>
                    <?php endif; ?>
                    <form id="personnel.modifier<?=$donnees->getIdPersonne()?>" action= "personnel.modifier" method="POST" style="display: inline;" onsubmit="return form_action('personnel.modifier<?=$donnees->getIdPersonne()?>')">
                        <input type="hidden" name="idPersonnel" value=<?= $donnees->getIdPersonne() ?>>
                        <input type="submit"  class="btn btn-warning" value="modifier">
                    </form>
                    <form id="personnel.suprimer<?=$donnees->getIdPersonne()?>" action= "personnel.suprimer" method="POST" style="display: inline;" onsubmit="return form_action('personnel.suprimer<?=$donnees->getIdPersonne()?>')">
                        <input type="hidden" name="idPersonnel" value=<?= $donnees->getIdPersonne() ?>>
                        <input type="submit" class="btn btn-danger" value="retablir">
                    </form>
                </td>
    </tr>
        <?php endif ; ?>
    <?php endforeach; ?>
        </tbody>
        </table>
        <div class="<?= $donneeRestaurant->getNomRestau();?>" >
            <?php if(count($_SESSION[$donneeRestaurant->getNomRestau()." ".$donneeRestaurant->getIdRestaurant()]) !== 0) : ?>
                <div class="navbar-form navbar-right">
                    <label>voir les données du  personnel archivé : </label>
                    <input  type="checkbox" id="<?= $donneeRestaurant->getNomRestau();?>" onchange="afficher(this)">
                </div>
            <?php endif; ?>
            <?php $a = 0 ?>

        <?php endif; ?>
        </div>
    </div>

<?php endforeach; ?>
    <?php unset($_SESSION['afficheTous']); ?>
<?php endif; ?>


<br><br>
<script src="vue/js/action-form.js"></script>