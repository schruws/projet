<a href="?page=conger.ajouterConger" class="btn btn-primary">nouvelle demande de congé</a>

<legend>Les congés déjà demandés</legend>
<div id="voir">
    <table class="table table-hover" id="tableau">
        <thead>
        <tr>
            <th>date de début</th>
            <th>date de fin</th>
            <th></th>
        </tr>
        </thead>
        <?php if(isset($_SESSION['congerPersonne'])) : ?>
        <tbody id="contenue">
        <?php foreach($_SESSION['congerPersonne'] as  $donnees): ?>

            <?php if(strtotime($donnees->getDateFin()) > strtotime(date("Y/m/j"))): ?>
                <tr id="">

                    <td><?= $donnees->getDateDebut(); ?></td>
                    <td><?= $donnees->getDateFin() ?></td>
                    <td>
                        <form id="conger.consulter<?=$donnees->getIdConger()?>" action="conger.consulter" method="POST" style="display: inline;" onsubmit="return form_action('conger.consulter<?=$donnees->getIdConger()?>')">
                            <input type="hidden" name="idConger" value=<?= $donnees->getIdConger() ?>>
                            <input type="submit"  class="btn btn-info btn-sm" value="consulter">
                        </form>
                        <form id="conger.modifier<?=$donnees->getIdConger()?>" action= "conger.modifier" method="POST" style="display: inline;" onsubmit="return form_action('conger.modifier<?=$donnees->getIdConger()?>')">
                            <input type="hidden" name="idConger" value=<?= $donnees->getIdConger() ?>>
                            <input type="submit"  class="btn btn-warning btn-sm" value="modifier">
                        </form>
                        <form id="conger.suprimer<?=$donnees->getIdConger()?>" action= "conger.suprimer" method="POST" style="display: inline;" onsubmit="return form_action('conger.suprimer<?=$donnees->getIdConger()?>')">
                            <input type="hidden" name="idConger" value=<?= $donnees->getIdConger() ?>>
                            <input type="submit"  class="btn btn-danger btn-sm" value="supprimer">
                        </form>
                    </td>
                </tr>
            <?php else: ?>
                <tr id="archive.''" style="display: none">

                    <td><?= $donnees->getDateDebut(); ?></td>
                    <td><?= $donnees->getDateFin() ?></td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
        </tbody>
        <?php endif; ?>
    </table>
</div>
<div class="navbar-form navbar-right" id="check">
    <label>voir les anciennes demandes de congé : </label>
    <input  type="checkbox" id="voir" onchange="afficher(this)">
</div>
<script src="vue/js/action-form.js"></script>