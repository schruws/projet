<?php $indice = 0; ?>
<form id="horaire.creerVacance" action= "<?= $_SESSION['action']; ?>" method="POST" onsubmit="return form_action('horaire.creerVacance')" class="form-horizontal">
    <div id="contrat">

    <legend>Horaire des bessoins en personnels</legend>
    <p>Sélectionné un jour de la semaine :  </p>
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
                <th class="col-sm-2"><?= $donnees ; ?></th>
                <?php foreach ($_POST['competence'] as  $competence): ?>
                    <th class="col-sm-2"><?= $competence->getNomComp() ?></th>
                <?php endforeach; ?>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th>Midi</th>
                <th><div><input class=" form-control" type="number" min="0" max="100" step="1" <?php echo $_SESSION["disabled"]?>  value="<?= $_POST['midi'][$indice] ; ?>" name="<?= $donnees ; ?>Midi[]"  ></div></th>
                <th><div><input class=" form-control" type="number" min="0" max="100" step="1" <?php echo $_SESSION["disabled"]?> value="<?= $_POST['midi'][$indice+1] ; ?>" name="<?= $donnees ; ?>Midi[]"></div></th>
                <th><div><input class=" form-control" type="number" min="0" max="100" step="1" <?php echo $_SESSION["disabled"]?> value="<?= $_POST['midi'][$indice+2] ; ?>" name="<?= $donnees ; ?>Midi[]"></div></th>
                <th><div><input class=" form-control" type="number" min="0" max="100" step="1" <?php echo $_SESSION["disabled"]?> value="<?= $_POST['midi'][$indice+3] ; ?>" name="<?= $donnees ; ?>Midi[]"></div></th>
            </tr>
            <tr>
                <th>Soir</th>
                <th><input class=" form-control" type="number" min="0" max="100" step="1" <?php echo $_SESSION["disabled"]?> value="<?= $_POST['soir'][$indice] ; ?>" name="<?= $donnees ; ?>Soir[]" ></div></th>
    <th><input class=" form-control" type="number" min="0" max="100" step="1" <?php echo $_SESSION["disabled"]?> value="<?= $_POST['soir'][$indice+1] ; ?>" name="<?= $donnees ; ?>Soir[]"></div></th>
<th><input class=" form-control" type="number" min="0" max="100" step="1" <?php echo $_SESSION["disabled"]?> value="<?= $_POST['soir'][$indice+2] ; ?>" name="<?= $donnees ; ?>Soir[]"></div></th>
<th><input class=" form-control" type="number" min="0" max="100" step="1" <?php echo $_SESSION["disabled"]?> value="<?= $_POST['soir'][$indice+3] ; ?>" name="<?= $donnees ; ?>Soir[]"></div></th>


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
            <th><div><input class=" form-control" type="number" min="0" max="100" step="1" <?php echo $_SESSION["disabled"]?> value="<?= $_POST['midi'][$indice] ; ?>" name="<?= $donnees ; ?>Midi[]"  ></div></th>
            <th><div><input class=" form-control" type="number" min="0" max="100" step="1" <?php echo $_SESSION["disabled"]?> value="<?= $_POST['midi'][$indice+1] ; ?>" name="<?= $donnees ; ?>Midi[]"></div></th>
            <th><div><input class=" form-control" type="number" min="0" max="100" step="1" <?php echo $_SESSION["disabled"]?> value="<?= $_POST['midi'][$indice+2] ; ?>" name="<?= $donnees ; ?>Midi[]"></div></th>
            <th><div><input class=" form-control" type="number" min="0" max="100" step="1" <?php echo $_SESSION["disabled"]?> value="<?= $_POST['midi'][$indice+3] ; ?>" name="<?= $donnees ; ?>Midi[]"></div></th>
        </tr>
        <tr>
            <th>Soir</th>
            <th><input class=" form-control" type="number" min="0" max="100" step="1" <?php echo $_SESSION["disabled"]?> value="<?= $_POST['soir'][$indice] ; ?>" name="<?= $donnees ; ?>Soir[]" ></div></th>
            <th><input class=" form-control" type="number" min="0" max="100" step="1" <?php echo $_SESSION["disabled"]?> value="<?= $_POST['soir'][$indice+1] ; ?>" name="<?= $donnees ; ?>Soir[]"></div></th>
            <th><input class=" form-control" type="number" min="0" max="100" step="1" <?php echo $_SESSION["disabled"]?> value="<?= $_POST['soir'][$indice+2] ; ?>" name="<?= $donnees ; ?>Soir[]"></div></th>
            <th><input class=" form-control" type="number" min="0" max="100" step="1" <?php echo $_SESSION["disabled"]?> value="<?= $_POST['soir'][$indice+3] ; ?>" name="<?= $donnees ; ?>Soir[]"></div></th>


        </tr>
        </tbody>
    </table>
<?php endif; ?>
<?php $indice = 4 + $indice; ?>
<?php endforeach; ?>
<button type="button" class="btn btn-warning" id="retour">annuler</button>
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
