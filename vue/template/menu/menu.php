
<?php if(!isset($_SESSION['lierContrat'])): ?>
<a href="?page=restaurant.ajouterRestaurant" class="btn btn-primary">ajouter un restaurant </a>
    <?php if(isset($_SESSION['restaurant'])): ?>
<a href="?page=personnel.affichePersonnelDeTousRestaurant" class="btn btn-primary">afficher tous les membres du  personel</a>
    <?php endif; ?>
<?php endif;?>

<div class="navbar-form navbar-right inline-form">
    <label for="restaurant">rechercher un restaurant :</label>
    <input list="restaurant" type="text" id="choix" placeholder="Recherche par nom" onkeyup="rechercheNom(this)">
    <datalist id="restaurant" oninput="afficher(this)">
        <?php foreach ($_SESSION['restaurant'] as  $donnees): ?>
            <?php if(!$donnees->getDateSupr()): ?>
                <option><?php echo $donnees->getNomRestau();?></option>
            <?php endif; ?>
        <?php endforeach; ?>
    </datalist>
</div>
<div id="voir">
<table class="table table-hover" id="tableau">
    <thead>
    <tr>
        <th>Nom du restaurant</th>
        <th>Adresse</th>
        <th>Téléphone</th>
        <th>Nombre d'employés</th>
        <th>Restaurant</th>
        <th>Personel</th>
        <th>Horaires</th>
    </tr>
    </thead>
    <tbody id="contenue">
    <?php if(isset($_SESSION['restaurant'])): ?>
    <?php foreach($_SESSION['restaurant'] as  $donnees): ?>
        <?php if($donnees->getDateSupr() === null): ?>
        <tr id="<?= $donnees->getNomRestau()?>">

            <td><?= $donnees->getNomRestau()?></td>
            <td><?= $_SESSION[$donnees->getIdRestaurant().'lieu']->getRue(). " n ". $_SESSION[$donnees->getIdRestaurant().'lieu']->getNumero()?><br><?= $_SESSION[$donnees->getIdRestaurant().'lieu']->getCodePostal(). " ". $_SESSION[$donnees->getIdRestaurant().'lieu']->getLocalite()?> </td>
            <td><?= $donnees->getTelephone()?></td>
            <td><?= $_SESSION[$donnees->getNomRestau()." ".$donnees->getIdRestaurant()]?></td>
            <td>
                <form id="restaurant.consulter<?=$donnees->getIdRestaurant()?>" action= "restaurant.consulter" method="POST" style="display: inline;" onsubmit="return form_action('restaurant.consulter<?=$donnees->getIdRestaurant()?>')">
                    <input type="hidden" name="idRestaurant" value=<?= $donnees->getIdRestaurant() ?>>
                    <input type="submit"  class="btn btn-info btn-sm" value="consulter">
                </form>
                <form id="restaurant.modifier<?=$donnees->getIdRestaurant()?>" action= "restaurant.modifier" method="POST" style="display: inline;" onsubmit="return form_action('restaurant.modifier<?=$donnees->getIdRestaurant()?>')">
                    <input type="hidden" name="idRestaurant" value=<?= $donnees->getIdRestaurant() ?>>
                    <input type="submit"  class="btn btn-warning btn-sm" value="modifier">
                </form>
                <form id="restaurant.suprimer<?=$donnees->getIdRestaurant()?>" action= "restaurant.suprimer" method="POST" style="display: inline;" onsubmit="return form_action('restaurant.suprimer<?=$donnees->getIdRestaurant()?>')">
                    <input type="hidden" name="idRestaurant" value=<?= $donnees->getIdRestaurant() ?>>
                    <input type="submit" class="btn btn-danger btn-sm" value="supprimer">
                </form>
            </td>
            <td>
                <form id="personnel.restaurant<?=$donnees->getIdRestaurant()?>" action= "personnel.restaurant" method="POST" style="display: inline;" onsubmit="return form_action('personnel.restaurant<?=$donnees->getIdRestaurant()?>')">
                    <input type="hidden" name="idRestaurant" value=<?= $donnees->getIdRestaurant() ?>>
                    <input type="submit" class="btn btn-success btn-sm" value="consulter">
                </form>
            </td>
            <td>
                <form id="horaire.restaurant<?=$donnees->getIdRestaurant()?>" action= "horaire.restaurant" method="POST" style="display: inline;" onsubmit="return form_action('horaire.restaurant<?=$donnees->getIdRestaurant()?>')">
                <input type="hidden" name="idRestaurant" value=<?= $donnees->getIdRestaurant() ?>>
                <input type="submit" class="btn btn-success btn-sm" value="consulter">
                </form>
            </td>

        </tr>
        <?php else: ?>
            <tr id="archive.<?= $donnees->getNomRestau()?>" style="display: none">

                <td><?= $donnees->getNomRestau()?></td>
                <td><?= $_SESSION[$donnees->getIdRestaurant().'lieu']->getRue(). " n ". $_SESSION[$donnees->getIdRestaurant().'lieu']->getNumero()?><br><?= $_SESSION[$donnees->getIdRestaurant().'lieu']->getCodePostal(). " ". $_SESSION[$donnees->getIdRestaurant().'lieu']->getLocalite()?> </td>
                <td><?= $donnees->getTelephone()?></td>
                <td><?= $_SESSION[$donnees->getNomRestau()]?></td>
                <td>
                    <form id="restaurant.consulter<?=$donnees->getIdRestaurant()?>" action= "restaurant.consulter" method="POST" style="display: inline;" onsubmit="return form_action('restaurant.consulter<?=$donnees->getIdRestaurant()?>')">
                        <input type="hidden" name="idRestaurant" value=<?= $donnees->getIdRestaurant() ?>>
                        <input type="submit"  class="btn btn-info btn-sm" value="consulter">
                    </form>
                    <form id="restaurant.retablir<?=$donnees->getIdRestaurant()?>" action= "restaurant.retablir" method="POST" style="display: inline;" onsubmit="return form_action('restaurant.retablir<?=$donnees->getIdRestaurant()?>')">
                        <input type="hidden" name="idRestaurant" value=<?= $donnees->getIdRestaurant() ?>>
                        <input type="submit" class="btn btn-danger btn-sm" value="rétablir">
                    </form>

                </td>
                <td>
                    <form id="personnel.restaurant<?=$donnees->getIdRestaurant()?>" action= "personnel.restaurant" method="POST" style="display: inline;" onsubmit="return form_action('personnel.restaurant<?=$donnees->getIdRestaurant()?>')">
                        <input type="hidden" name="idRestaurant" value=<?= $donnees->getIdRestaurant() ?>>
                        <input type="submit" class="btn btn-success btn-sm" value="consulter">
                    </form>
                </td>

            </tr>
    <?php endif; ?>
    <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>
</div>

<?php if(isset($_SESSION['lierContrat']) && ($_SESSION['lierContrat'] !== null)): ?>
    <button type="button" class="btn btn-warning " id="retour">annuler</button>
<?php endif;?>
<div class="navbar-form navbar-right" id="check">
<label>voir les restaurants inactifs : </label>
<input  type="checkbox" id="voir" onchange="afficher(this)">
</div>
<script src="vue/js/action-form.js"></script>


