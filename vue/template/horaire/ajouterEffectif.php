<form id="horaire.creerEffectif" action= "horaire.creerEffectif" method="POST" onsubmit="return form_action('horaire.creerEffectif')" class="form-horizontal">
<div id="contrat">
    <legend>Horaires des besoins en personnel</legend>
    <p>Sélectionnez un jour de la semaine : </p>
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
                <th><input class=" form-control" type="number" min="0" max="100" step="1" value="0" name="<?= $donnees ; ?>Soir[]" ></div></th>
    <th><input class=" form-control" type="number" min="0" max="100" step="1" value="0" name="<?= $donnees ; ?>Soir[]"></div></th>
<th><input class=" form-control" type="number" min="0" max="100" step="1" value="0" name="<?= $donnees ; ?>Soir[]"></div></th>
<th><input class=" form-control" type="number" min="0" max="100" step="1" value="0" name="<?= $donnees ; ?>Soir[]"></div></th>


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
            <th><div><input class=" form-control"type="number" min="0" max="100" step="1" value="0" name="<?= $donnees ; ?>Midi[]"></div></th>
            <th><div><input class=" form-control" type="number" min="0" max="100" step="1" value="0" name="<?= $donnees ; ?>Midi[]"></div></th>
            <th><div><input class=" form-control" type="number" min="0" max="100" step="1" value="0" name="<?= $donnees ; ?>Midi[]"></div></th>
        </tr>
        <tr>
            <th>Soir</th>
            <th><input class=" form-control" type="number" min="0" max="100" step="1" value="0" name="<?= $donnees ; ?>Soir[]" ></div></th>
            <th><input class=" form-control" type="number" min="0" max="100" step="1" value="0" name="<?= $donnees ; ?>Soir[]"></div></th>
            <th><input class=" form-control" type="number" min="0" max="100" step="1" value="0" name="<?= $donnees ; ?>Soir[]"></div></th>
            <th><input class=" form-control" type="number" min="0" max="100" step="1" value="0" name="<?= $donnees ; ?>Soir[]"></div></th>


        </tr>
        </tbody>
    </table>
<?php endif; ?>
<?php endforeach; ?>
<button type="button" class="btn btn-warning" id="retour">annuler</button>
<button type="submit" class="btn btn-success pull-right" >ajouter</button>
</div>
</form>
<script src="vue/js/action-form.js"></script>