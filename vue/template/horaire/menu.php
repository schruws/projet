<?php $indice = 0; ?>
<?php if(!isset($_SESSION['utilisateur'])) : ?>
<?php if( $_POST['afficherCreationHoraire'] === true ): ?>
    <form id="horaire.creationHoraireAutomatique" action="horaire.creationHoraireAutomatique" method="POST" style="display: inline;" onsubmit="return form_action('horaire.creationHoraireAutomatique')">
        <input type="submit"  class="btn btn-primary" value="creation d'horaire automatique">
    </form>
    <a href="?page=horaire.CreationHoraireManuel" class="btn btn-primary">creation d'horaire manuel</a>
<?php endif; ?>
<?php if($_POST['affiche'] === false) : ?>
<a href="?page=horaire.ajouterVacance" class="btn btn-primary">ajouter un horaire de vacances</a>
<?php else : ?>

<legend>Horaire de vacance</legend>
<div>
    <table class="table table-hover" id="tableau">
        <thead>
        <tr>
            <th>Debut</th>
            <th>Fin</th>
            <th>Moment</th>
            <th>Ouvert/Ferme</th>
            <th></th>
        </tr>
        </thead>
        <tbody id="contenue">
        <tr>

            <td><?= $_SESSION['congerRestaurant']->getDebut() ?></td>
            <td><?= $_SESSION['congerRestaurant']->getFin() ?></td>
            <td><?= $_SESSION['congerRestaurant']->getMoment() ?></td>
            <td><?= $_POST["ouvertFerme"] ?></td>
            <td>
                <form id="horaire.consulterVacance<?=$_SESSION['congerRestaurant']->getIdHoraireVacance()?>" action="horaire.consulterVacance" method="POST" style="display: inline;" onsubmit="return form_action('horaire.consulterVacance<?=$_SESSION['congerRestaurant']->getIdHoraireVacance()?>')">
                    <input type="hidden" name="idHoraireVacance" value=<?= $_SESSION['congerRestaurant']->getIdHoraireVacance() ?>>
                    <input type="submit"  class="btn btn-info btn-sm" value="consulter">
                </form>
                <form id="horaire.modifierVacance<?=$_SESSION['congerRestaurant']->getIdHoraireVacance()?>" action= "horaire.modifierVacance" method="POST" style="display: inline;" onsubmit="return form_action('horaire.modifierVacance<?=$_SESSION['congerRestaurant']->getIdHoraireVacance()?>')">
                    <input type="hidden" name="idHoraireVacance" value=<?= $_SESSION['congerRestaurant']->getIdHoraireVacance() ?>>
                    <input type="submit"  class="btn btn-warning btn-sm" value="modifier">
                </form>
                <form id="horaire.suprimerVacance<?=$_SESSION['congerRestaurant']->getIdHoraireVacance()?>" action= "horaire.suprimerVacance" method="POST" style="display: inline;" onsubmit="return form_action('horaire.suprimerVacance<?=$_SESSION['congerRestaurant']->getIdHoraireVacance()?>')">
                    <input type="hidden" name="idHoraireVacance" value=<?= $_SESSION['congerRestaurant']->getIdHoraireVacance() ?>>
                    <input type="submit"  class="btn btn-danger btn-sm" value="supprimer">
                </form>
            </td>

        </tr>
        </tbody>
    </table>
</div>
<?php endif; ?>
<?php if(isset($_POST['ajouter'])) : ?>
    <a href="?page=horaire.ajouterEffectif" class="btn btn-primary">ajouter un horaire d'effectif</a>
<?php else: ?>
<div id="contrat">

<legend>Horaires des besoins en personnel</legend>
    <form id="horaire.suprimerEffectif" action= "horaire.suprimerEffectif" method="POST" style="display: inline;" onsubmit="return form_action('horaire.suprimerEffectif')">
        <input type="submit"  class="btn btn-danger btn-sm pull-right" value="supprimer">
    </form>
    <form id="horaire.modifierEffectif" action= "horaire.modifierEffectif" method="POST" style="display: inline;" onsubmit="return form_action('horaire.modifierEffectif')">
        <input type="submit"  class="btn btn-warning btn-sm pull-right" value="modifier">
    </form>

<p>Sélectionnez un jour de la semaine :
</p>
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
            <th><input class=" form-control" type="number" min="0" max="100" step="2" <?php echo $_SESSION["disabled"]?>  value="<?= $_POST['midi'][$indice] ; ?>" name="<?= $donnees ; ?>Midi[]" ></th>
            <th><input class=" form-control" type="number" min="0" max="100" step="2" <?php echo $_SESSION["disabled"]?> value="<?= $_POST['midi'][$indice+1] ; ?>" name="<?= $donnees ; ?>Midi[]"></th>
            <th><input class=" form-control" type="number" min="0" max="100" step="2" <?php echo $_SESSION["disabled"]?> value="<?= $_POST['midi'][$indice+2] ; ?>" name="<?= $donnees ; ?>Midi[]"></th>
            <th><input class=" form-control" type="number" min="0" max="100" step="2" <?php echo $_SESSION["disabled"]?> value="<?= $_POST['midi'][$indice+3] ; ?>" name="<?= $donnees ; ?>Midi[]"></th>
        </tr>
        <tr>
            <th>Soir</th>
            <th><input class=" form-control" type="number" min="0" max="100" step="2" <?php echo $_SESSION["disabled"]?> value="<?= $_POST['soir'][$indice] ; ?>" name="<?= $donnees ; ?>Soir[]" ></th>
    <th><input class=" form-control" type="number" min="0" max="100" step="2" <?php echo $_SESSION["disabled"]?> value="<?= $_POST['soir'][$indice+1] ; ?>" name="<?= $donnees ; ?>Soir[]"></th>
    <th><input class=" form-control" type="number" min="0" max="100" step="2" <?php echo $_SESSION["disabled"]?> value="<?= $_POST['soir'][$indice+2] ; ?>" name="<?= $donnees ; ?>Soir[]"></th>
    <th><input class=" form-control" type="number" min="0" max="100" step="2" <?php echo $_SESSION["disabled"]?> value="<?= $_POST['soir'][$indice+3] ; ?>" name="<?= $donnees ; ?>Soir[]"></th>


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
        <th><input class=" form-control" type="number" min="0" max="100" step="2" <?php echo $_SESSION["disabled"]?> value="<?= $_POST['midi'][$indice] ; ?>" name="<?= $donnees ; ?>Midi[]"  ></th>
        <th><div><input class=" form-control" type="number" min="0" max="100" step="2" <?php echo $_SESSION["disabled"]?> value="<?= $_POST['midi'][$indice+1] ; ?>" name="<?= $donnees ; ?>Midi[]"></th>
        <th><div><input class=" form-control" type="number" min="0" max="100" step="2" <?php echo $_SESSION["disabled"]?> value="<?= $_POST['midi'][$indice+2] ; ?>" name="<?= $donnees ; ?>Midi[]"></th>
        <th><div><input class=" form-control" type="number" min="0" max="100" step="2" <?php echo $_SESSION["disabled"]?> value="<?= $_POST['midi'][$indice+3] ; ?>" name="<?= $donnees ; ?>Midi[]"></th>
    </tr>
    <tr>
        <th>Soir</th>
        <th><input class=" form-control" type="number" min="0" max="100" step="2" <?php echo $_SESSION["disabled"]?> value="<?= $_POST['soir'][$indice] ; ?>" name="<?= $donnees ; ?>Soir[]" ></th>
        <th><input class=" form-control" type="number" min="0" max="100" step="2" <?php echo $_SESSION["disabled"]?> value="<?= $_POST['soir'][$indice+1] ; ?>" name="<?= $donnees ; ?>Soir[]"></th>
        <th><input class=" form-control" type="number" min="0" max="100" step="2" <?php echo $_SESSION["disabled"]?> value="<?= $_POST['soir'][$indice+2] ; ?>" name="<?= $donnees ; ?>Soir[]"></th>
        <th><input class=" form-control" type="number" min="0" max="100" step="2" <?php echo $_SESSION["disabled"]?> value="<?= $_POST['soir'][$indice+3] ; ?>" name="<?= $donnees ; ?>Soir[]"></th>


    </tr>
    </tbody>
</table>
<?php endif; ?>
<?php $indice = 4 + $indice; ?>
<?php endforeach; ?>
</div>
</div>
<?php endif; ?>
<?php endif; ?>







<?php if(isset($_SESSION['horaire'])) : ?>
<div id="horaire">


<legend>Horaires de la semaine </legend>
    <?php if(!isset($_SESSION['utilisateur'])) : ?>
    <a href="?page=horaire.suprimerHoraire" class="btn btn-danger pull-right btn-sm">supprimer</a>
    <a href="?page=horaire.modifierHoraire" class="btn btn-warning pull-right btn-sm">modifier</a>
    <form id="horaire.envoyerHoraire" action= "horaire.envoyerHoraire" method="POST" style="display: inline;" onsubmit="return form_action('horaire.envoyerHoraire')">
        <input type="submit"  class="btn btn-info btn-sm pull-right" value="envoyer">
    </form>
    <?php endif; ?>
    <p>Sélectionnez un jour de la semaine :
    </p>
    <table class="table table" >
        <thead>
        <tr>
            <th class="col-sm-1" id="tous" onclick="horaireRecherche(this)">Tous</th>
            <?php foreach ( $_SESSION['horaire'] as  $donnees): ?>
                <th class="col-sm-1" id="<?php echo $donnees;?>" onclick="horaireRecherche(this)"><?php echo $donnees;?></th>
            <?php endforeach; ?>
        </tr>
        </thead>
    </table>
<div id="voir">
    <?php for ($valeur = 0 ; $valeur <= count($_SESSION['horaire']) -1; $valeur++): ?>
    <?php if ($_SESSION['horaire'][$valeur] ===  $_SESSION['horaire'][0]): ?>
            <iframe id="<?= $_SESSION['horaire'][$valeur] ; ?>" src="<?= $_SESSION['chemin'][$valeur] ?>" width="900" height="600" align="middle"></iframe>
<?php else: ?>
            <iframe id="<?= $_SESSION['horaire'][$valeur] ; ?>" src="<?=$_SESSION['chemin'][$valeur]?>" style="visibility: hidden"  width="0" height="0"  align="middle"></iframe>
<?php endif; ?>
<?php $indice = 4 + $indice; ?>
<?php endfor; ?>
</div>
</div>
<?php endif; ?>
<script src="vue/js/action-form.js"></script>

