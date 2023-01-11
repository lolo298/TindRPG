<?php
  require_once('header.php');
  $salles = $_SESSION['mmiquest']['salles'];
  $id = $_SESSION['mmiquest']['prof_id'];
  $avatar = get_prof_by_id($id);
?>
  <body>
    <?php component('components/logo.php') ?>
  </body>
  <main>
    <div class="carte">
      <img src="assets/carte.png" alt="">
      <?php foreach($salles as $key => $salle): ?>
        <?php
          $currentIndex = array_search($key, array_keys($salles));
          $isCurrent = $salle && $currentIndex < count($salles) && !$salles[array_keys($salles)[$currentIndex]];
        ?>
        <div class="salle-overlay _<?= $key . (!$salle ? ' locked' : '') . ($isCurrent ? ' current' : '') ?>">
          <?php if($isCurrent): ?>
            <img src="<?= $avatar["img"] ?>" alt="<?= $avatar["nom"] ?>">
          <?php endif ?>
        </div>
      <?php endforeach ?>
      <div class="passage _020-016"></div>
      <div class="passage _016-029-1"></div>
      <div class="passage _016-029-2"></div>
    </div>
  </main>
</html>