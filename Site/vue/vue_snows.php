<?php
/**
 * Created by PhpStorm.
 * User: Pascal.BENZONANA
 * Date: 12.05.2017
 * Time: 09:36
 */
ob_start();
$titre = 'Rent A Snow - Nos snows';

?>

<article>
  <header>
    <h2>Nos snows</h2>
    <table class="table textcolor">
      <tr>
      <?php
        // Affichage des entêtes du tableau (-1 pour enlever le champ statut)

        for ($i=0; $i<$resultats->columnCount()-1; $i++)
        {
          $entete = $resultats->getColumnMeta($i);
          echo "<th>" . $entete['name'] . "</th>";
        }
      ?>
      <?php if ((isset($_SESSION['login']))&&(@$_SESSION['typeUser'])=="Vendeur") : ?>
        <th><a href="index.php?action=vue_add_snow"><img src="contenu/images/add.png"</a></th>
      <?php endif; ?>
      </tr>
      <?php foreach ($resultats as $resultat) :?>
        <!-- Affichage des résultats de la BD -->
        <tr>
          <td><?=$resultat['idsurf'];?></td>
          <td><?=$resultat['marque'];?></td>
          <td><?=$resultat['boots'];?></td>
          <td><?=$resultat['type'];?></td>
          <td><?=$resultat['disponibilite'];?></td>
          <?php if ((isset($_SESSION['login']))&&(@$_SESSION['typeUser'])=="Vendeur") : ?>
          <td><a href="index.php?action=vue_del_snow&ID=<?=$resultat['idsurf'];?>"><img src="contenu/images/delete.jpg"></a> -
            <a href="index.php?action=vue_upd_snow&ID=<?=$resultat['idsurf'];?>"><img src="contenu/images/modif.png"></a>
          </td>
          <?php endif; ?>
          <?php if ((isset($_SESSION['login']))&&(@$_SESSION['typeUser'])=="Client") : ?>
            <td><a href="index.php?action=vue_del_snow&ID=<?=$resultat['idsurf'];?>"><img src="contenu/images/icone-panier.jpg"></a>
            </td>
          <?php endif; ?>

        </tr>
      <?php endforeach;?>

    </table>
  </header>
</article>
<hr/>

<?php
  $contenu=ob_get_clean();
  require "gabarit.php";
