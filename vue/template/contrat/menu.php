<a href="?page=contrat.ajouterContrat" class="btn btn-primary">nouveau contrat</a>


    <div class="navbar-form navbar-right inline-form">
        <label for="restaurant">Rechercher un type de contrat :</label>
        <input list="restaurant" type="text" id="choix" placeholder="Recherche" onkeyup="rechercheNom(this)">
        <datalist id="restaurant" oninput="afficher(this)">
            <?php foreach ($_SESSION['contrat'] as  $donnees): ?>
                <?php if(strtotime($donnees->getDateFinContrat()) > strtotime(date("Y/m/j"))): ?>
                    <option><?php echo $donnees->getTypecontrat();?></option>
                <?php endif; ?>
            <?php endforeach; ?>
        </datalist>
    </div>

<div id="voir">
    <table class="table table-hover" id="tableau">
        <thead>
        <tr>
            <th>Type de contrat</th>
            <th>Date de début</th>
            <th>Date de fin</th>
            <th>Fonction</th>
            <th>Contrat</th>
            <th>Lier</th>
        </tr>
        </thead>
        <tbody id="contenue">
            <?php foreach($_SESSION['contrat'] as  $donnees): ?>

                <?php if(($donnees->getDateFinContrat() !== null) and (strtotime($donnees->getDateFinContrat()) > strtotime(date("Y/m/j")))): ?>
                    <tr id="<?= $donnees->getTypecontrat(); ?>">

                        <td><?= $donnees->getTypecontrat(); ?></td>
                        <td><?= $donnees->getDateDebutContrat() ?></td>
                        <td>
                            <?php if($donnees->getTypecontrat() !== "CDI") : ?>
                            <?= $donnees->getDateFinContrat() ?>
                            <?php else: ?>
                                durée indéfinie
                            <?php endif; ?>
                        </td>
                        <td><?= $_SESSION['tableauFonction'][$donnees->getIdContrat()]->getType(); ?></td>
                        <td>
                            <form id="contrat.consulter<?=$donnees->getIdContrat()?>" action="contrat.consulter" method="POST" style="display: inline;" onsubmit="return form_action('contrat.consulter<?=$donnees->getIdContrat()?>')">
                                <input type="hidden" name="idContrat" value=<?= $donnees->getIdContrat() ?>>
                                <input type="submit"  class="btn btn-info btn-sm" value="consulter">
                            </form>
                            <form id="contrat.modifier<?=$donnees->getIdContrat()?>" action= "contrat.modifier" method="POST" style="display: inline;" onsubmit="return form_action('contrat.modifier<?=$donnees->getIdContrat()?>')">
                                <input type="hidden" name="idContrat" value=<?= $donnees->getIdContrat() ?>>
                                <input type="submit"  class="btn btn-warning btn-sm" value="modifier">
                            </form>
                            <form id="contrat.suprimer<?=$donnees->getIdContrat()?>" action= "contrat.suprimer" method="POST" style="display: inline;" onsubmit="return form_action('contrat.suprimer<?=$donnees->getIdContrat()?>')">
                                <input type="hidden" name="idContrat" value=<?= $donnees->getIdContrat() ?>>
                                <input type="submit"  class="btn btn-danger btn-sm" value="supprimer">
                            </form>
                        </td>
                        <td>
                            <form id="contrat.lier<?=$donnees->getIdContrat()?>" action= "contrat.lier" method="POST" style="display: inline;" onsubmit="return form_action('contrat.lier<?=$donnees->getIdContrat()?>')">
                                <input type="hidden" name="idContrat" value=<?= $donnees->getIdContrat() ?>>
                                <input type="submit"  class="btn btn-danger btn-sm" value="restaurant">
                            </form>
                        </td>

                    </tr>
                <?php else: ?>
                    <tr id="archive.'<?= $donnees->getTypecontrat(); ?>'" style="display: none">

                        <td><?= $donnees->getTypecontrat(); ?></td>
                        <td><?= $donnees->getDateDebutContrat() ?></td>
                        <td> <?php if($donnees->getTypecontrat() !== "CDI") : ?>
                                <?= $donnees->getDateFinContrat() ?>
                            <?php else: ?>
                                durée indéfinie
                            <?php endif; ?></td>
                        <td><?= $_SESSION['tableauFonction'][$donnees->getIdContrat()]->getType(); ?></td>
                        <td>
                            <form id="contrat.consulter<?=$donnees->getIdContrat()?>" action="contrat.consulter" method="POST" style="display: inline;" onsubmit="return form_action('contrat.consulter<?=$donnees->getIdContrat()?>')">
                                <input type="hidden" name="idContrat" value=<?= $donnees->getIdContrat() ?>>
                                <input type="submit"  class="btn btn-info btn-sm" value="consulter">
                            </form>
                            <form id="contrat.modifier<?=$donnees->getIdContrat()?>" action= "contrat.modifier" method="POST" style="display: inline;" onsubmit="return form_action('contrat.modifier<?=$donnees->getIdContrat()?>')">
                                <input type="hidden" name="idContrat" value=<?= $donnees->getIdContrat() ?>>
                                <input type="submit"  class="btn btn-warning btn-sm" value="modifier">
                            </form>
                            <form id="contrat.retablir<?=$donnees->getIdContrat()?>" action= "contrat.retablir" method="POST" style="display: inline;" onsubmit="return form_action('contrat.retablir<?=$donnees->getIdContrat()?>')">
                                <input type="hidden" name="idContrat" value=<?= $donnees->getIdContrat() ?>>
                                <input type="submit"  class="btn btn-danger btn-sm" value="retablir">
                            </form>
                        </td>

                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div class="navbar-form navbar-right" id="check">
    <label>voir les anciens contrats : </label>
    <input  type="checkbox" id="voir" onchange="afficher(this)">
</div>
<script src="vue/js/action-form.js"></script>