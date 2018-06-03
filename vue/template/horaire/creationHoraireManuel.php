<form id="horaire.CreationHoraireManuel" action= "horaire.CreationHoraireManuel" method="POST" onsubmit="return form_action('horaire.CreationHoraireManuel')" class="form-horizontal">
<div id="contrat">
<p>Sélectionné un jour de la semaine :
</p>
<table class="table table" >
    <thead>
    <tr>
        <th class="col-sm-1" id="tous" onclick="jour(this)">Tous</th>
        <?php for ($indice = $_POST['quelleJour'] ; $indice <= count($_POST['jour']) -1; $indice++) : ?>
            <th class="col-sm-1" id="<?php echo  $_POST['jour'][$indice];?>" onclick="jour(this)"><?php echo  $_POST['jour'][$indice];?></th>
        <?php endfor; ?>
    </tr>
    </thead>
</table>

<div id="voir>">
    <?php for ($indice = $_POST['quelleJour'] ; $indice <= count($_POST['jour']) -1; $indice++) : ?>
    <?php if ($_POST['jour'][$indice] === "lundi"): ?>
    <table class="table table-bordered" id="<?= $_POST['jour'][$indice] ?>" >
    <thead>
    <tr>
        <th class="col-sm-2"><?= $_POST['jour'][$indice] ; ?></th>
        <?php foreach ($_POST['competence'] as  $competence): ?>
            <th class="col-sm-2"><?= $competence->getNomComp() ?></th>
        <?php endforeach; ?>
    </tr>
    </thead>
    <tbody id="contenue">
    <tr>

        <td>Midi</td>
        <?php foreach ($_POST['competence'] as  $valeur): ?>
        <td id="<?=$_POST['jour'][$indice]."Midi".$valeur->getNomComp()?>">
            <input type="hidden" id="<?=$_POST['jour'][$indice]."Midi".$valeur->getNomComp()?>" value="<?= $_POST[$_POST['jour'][$indice]."Midi"]['nombre'.$valeur->getNomComp()] ?>">
            <?php if (isset($_POST[$_POST['jour'][$indice]."Midi"][$valeur->getNomComp()]) ) : ?>
        <?php foreach ($_POST[$_POST['jour'][$indice]."Midi"][$valeur->getNomComp()] as  $personnes): ?>
            <?= "Nom : ".$personnes['nomPers']." Prénom :".$personnes['prenom'] ?> <input type="checkbox" value="<?= $personnes['idPersonne'] ?>" name="midi[<?= $_POST['jour'][$indice] ; ?>][<?=$valeur->getNomComp()?>][]"> <br>
        <?php endforeach; ?>
        </td>
        <?php endif; ?>
        <?php endforeach; ?>
    </tr>
    <tr>

        <td>Soir</td>
        <?php foreach ($_POST['competence'] as  $valeur): ?>
        <td id="<?=$_POST['jour'][$indice]."Soir".$valeur->getNomComp()?>">
            <input type="hidden" id="<?= $_POST['jour'][$indice]."Soir".$valeur->getNomComp()?>" value="<?= $_POST[$_POST['jour'][$indice]."Soir"]['nombre'.$valeur->getNomComp()] ?>">
            <?php if (isset($_POST[$_POST['jour'][$indice]."Soir"][$valeur->getNomComp()]) ) : ?>
                <?php foreach ($_POST[$_POST['jour'][$indice]."Soir"][$valeur->getNomComp()] as  $personnes): ?>
                    <?= "Nom : ".$personnes['nomPers']." Prénom :".$personnes['prenom'] ?> <input type="checkbox" value="<?= $personnes['idPersonne'] ?>" name="Soir[<?= $_POST['jour'][$indice] ; ?>][<?=$valeur->getNomComp()?>][]"> <br>
                <?php endforeach; ?>
                </td>
            <?php endif; ?>
        <?php endforeach; ?>

    </tr>
    </tbody>
</table>
<?php else:?>
            <table class="table table-bordered" id="<?= $_POST['jour'][$indice] ; ?>" style="display: none" >
                <thead>
                <tr>
                    <th class="col-sm-2"><?= $_POST['jour'][$indice] ; ?></th>
                    <?php foreach ($_POST['competence'] as  $competence): ?>
                        <th class="col-sm-2"><?= $competence->getNomComp() ?></th>
                    <?php endforeach; ?>
                </tr>
                </thead>
                <tbody id="contenue">
                <tr>

                    <td>Midi</td>
                    <?php foreach ($_POST['competence'] as  $valeur): ?>
                        <td id="<?=$_POST['jour'][$indice]."Midi".$valeur->getNomComp()?>">
                        <input type="hidden" id="<?=$_POST['jour'][$indice]."Midi".$valeur->getNomComp()?>" value="<?= $_POST[$_POST['jour'][$indice]."Midi"]['nombre'.$valeur->getNomComp()] ?>">
                        <?php if (isset($_POST[$_POST['jour'][$indice]."Midi"][$valeur->getNomComp()]) ) : ?>
                            <?php foreach ($_POST[$_POST['jour'][$indice]."Midi"][$valeur->getNomComp()] as  $personnes): ?>
                                <?= "Nom : ".$personnes['nomPers']." Prénom :".$personnes['prenom'] ?> <input type="checkbox" value="<?= $personnes['idPersonne'] ?>" name="midi[<?= $_POST['jour'][$indice] ; ?>][<?=$valeur->getNomComp()?>][]"> <br>
                            <?php endforeach; ?>
                            </td>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tr>
                <tr>

                    <td>Soir</td>
                    <?php foreach ($_POST['competence'] as  $valeur): ?>
                        <td id="<?=$_POST['jour'][$indice]."Soir".$valeur->getNomComp()?>">
                        <input type="hidden" id="<?= $_POST['jour'][$indice]."Soir".$valeur->getNomComp()?>" value="<?= $_POST[$_POST['jour'][$indice]."Soir"]['nombre'.$valeur->getNomComp()] ?>">
                        <?php if (isset($_POST[$_POST['jour'][$indice]."Soir"][$valeur->getNomComp()]) ) : ?>
                            <?php foreach ($_POST[$_POST['jour'][$indice]."Soir"][$valeur->getNomComp()] as  $personnes): ?>
                                <?= "Nom : ".$personnes['nomPers']." Prénom :".$personnes['prenom'] ?> <input type="checkbox" value="<?= $personnes['idPersonne'] ?>" name="Soir[<?= $_POST['jour'][$indice] ; ?>][<?=$valeur->getNomComp()?>][]"> <br>
                            <?php endforeach; ?>
                            </td>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tr>
                </tbody>
            </table>
<?php endif; ?>
<?php endfor; ?>
</div>
</div>
    <button type="button" class="btn btn-warning" id="retour">annuler</button>
    <button type="submit" class="btn btn-success pull-right" >creer</button>
</form>