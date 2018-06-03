<div class="navbar-form navbar-right inline-form">
    <label for="restaurant">rechercher un restaurant :</label>
    <input list="restaurant" type="text" id="choix" placeholder="Recherche" onkeyup="rechercheNom(this)">
    <datalist id="restaurant" oninput="afficher(this)">
        <?php foreach ($_SESSION['restaurant'] as  $donnees): ?>
            <?php if(!$donnees->getDateSupr()): ?>
                <option><?php echo $donnees->getNomRestau();?></option>
            <?php endif; ?>
        <?php endforeach; ?>
    </datalist>
</div>
<br>
<legend>Ancien restaurant</legend>
<table class="table table-hover" id="tableau">
    <thead>
    <tr>
        <th>Nom du restaurant</th>
        <th>Adresse</th>
        <th>Téléphone</th>
        <th>Nombre d'employés</th>
        <th>Restaurant</th>
    </tr>
    </thead>
    <tbody id="contenue">
            <tr id="<?= $_SESSION['restaurantContrat']->getNomRestau()?>">

                <td><?= $_SESSION['restaurantContrat']->getNomRestau()?></td>
                <td><?= $_SESSION[$_SESSION['restaurantContrat']->getIdRestaurant().'lieu']->getRue(). " n ". $_SESSION[$_SESSION['restaurantContrat']->getIdRestaurant().'lieu']->getNumero()?><br><?= $_SESSION[$donnees->getIdRestaurant().'lieu']->getCodePostal(). " ". $_SESSION[$donnees->getIdRestaurant().'lieu']->getLocalite()?> </td>
                <td><?= $_SESSION['restaurantContrat']->getTelephone()?></td>
                <td><?= $_SESSION[$_SESSION['restaurantContrat']->getNomRestau()." ".$_SESSION['restaurantContrat']->getIdRestaurant()]?></td>
                <td>
                    <form id="restaurant.consulter<?=$donnees->getIdRestaurant()?>" action= "restaurant.consulter" method="POST" style="display: inline;" onsubmit="return form_action('restaurant.consulter<?=$donnees->getIdRestaurant()?>')">
                        <input type="hidden" name="idRestaurant" value=<?= $donnees->getIdRestaurant() ?>>
                        <input type="submit"  class="btn btn-info btn-sm" value="consulter">
                    </form>
            </tr>
    </tbody>
</table>
<legend>nouveaux restaurants</legend>
<table class="table table-hover" id="tableau">
    <thead>
    <tr>
        <th>Nom du restaurant</th>
        <th>Adresse</th>
        <th>Téléphone</th>
        <th>Nombre d'employés</th>
        <th>Restaurant</th>
        <th>lier</th>
    </tr>
    </thead>
    <tbody id="contenue">
    <?php foreach($_SESSION['restaurant'] as  $donnees): ?>
    <?php if(($donnees->getDateSupr() === null) and ($_SESSION['restaurantContrat']->getIdRestaurant() !== $donnees->getIdRestaurant())): ?>
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
        </td>
        <td>
            <form id="contrat.lierRestaurant<?=$donnees->getIdRestaurant()?>" action= "contrat.lierRestaurant" method="POST" style="display: inline;" onsubmit="return form_action('contrat.lierRestaurant<?=$donnees->getIdRestaurant()?>')">
                <input type="hidden" name="idRestaurant" value=<?= $donnees->getIdRestaurant() ?>>
                <input type="submit" class="btn btn-warning btn-sm" value="restaurant">
            </form>
        </td>

    </tr>
    <?php endif;?>
    <?php endforeach; ?>
    </tbody>
</table>