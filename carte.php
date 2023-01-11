<?php
  require_once('header.php');
  $salles = $_SESSION['mmiquest']['salles'];
  $id = $_SESSION['mmiquest']['prof_id'];
  $avatar = get_prof_by_id($id);
  if(isset($_GET['pieces'])){
    $_SESSION['mmiquest']['nbr_pieces'] = intval($_GET['pieces']);
  }
?>
  <body>
    <?php component('components/logo.php') ?>
  </body>
  <main>
    <div class="carte">
      <img class="carte-img" src="assets/carte.png" alt="">
      <?php foreach($salles as $key => $salle): ?>
        <?php
          $currentIndex = array_search($key, array_keys($salles));
          $isCurrent = $salle  && ($currentIndex === count($salles) - 1 || !$salles[array_keys($salles)[$currentIndex + 1]]);
        ?>
        <div class="salle-overlay _<?= $key . (!$salle ? ' locked' : '') . ($isCurrent ? ' current' : '') ?>">
          <?php if($isCurrent): ?>
            <div>
              <img class="avatar" src="<?= $avatar["img"] ?>" alt="<?= $avatar["nom"] ?>">
            </div>
          <?php endif ?>
        </div>
      <?php endforeach ?>
      <div class="passage _020-016"></div>
      <div class="passage _016-029-1"></div>
      <div class="passage _016-029-2"></div>
    </div>
  </main>
</html>