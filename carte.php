<?php
  require_once('header.php');
  $salles = $_SESSION['mmiquest']['salles'];
  $nbr_pieces = $_SESSION['mmiquest']['nbr_pieces'];
  $id = $_SESSION['mmiquest']['prof_id'];
  $avatar = get_prof_by_id($id);
  $currentRoom;
?>
  <body>
    <?php component('components/logo.php') ?>
    <main>
      <div>
        <a class="btn blanc" href="infos.php"><img src="assets/info_icon.svg" alt=""><p>Informations</p></a>
        <div class="carte">
          <img class="carte-img" src="assets/carte.png" alt="">
          <?php foreach($salles as $key => $salle): ?>
            <?php
              $currentIndex = array_search($key, array_keys($salles));
              $isCurrent = $salle  && ($currentIndex === count($salles) - 1 || !$salles[array_keys($salles)[$currentIndex + 1]]);
              if($isCurrent) $currentRoom = $key
            ?>
            <div class="salle-overlay _<?= $key . (!$salle ? ' locked' : '') . ($isCurrent ? ' current' : '') ?>" <?= $isCurrent ? "data-room='$key'" : '' ?>>
              <?php if($isCurrent): ?>
                <div>
                  <img class="avatar" src="<?= $avatar["img"] ?>" alt="<?= $avatar["nom"] ?>">
                </div>
              <?php endif ?>
              <?php if(!$salle): ?>
                <img class="cadenas" src="assets/lock_red.svg" alt="<?= $avatar["nom"] ?>">
              <?php endif ?>
            </div>
          <?php endforeach ?>
          <div class="passage _020-016"></div>
          <div class="passage _016-029-1"></div>
          <div class="passage _016-029-2"></div>
        </div>
      </div>
      <div class="puzzle">
        <img src="assets/puzzle_icon.svg" alt="">
        <p><?= $nbr_pieces ?><span>/</span>5</p>
      </div>
    </main>
    <div class="popup">
      <div class="popup-window">
        <p>Voulez-vous commencer le combat de la salle <?= $currentRoom ?> ?</p>
        <div>
          <a href="battle.php?roomId=<?= $currentRoom ?>" class="btn">Oui</a>
          <button class="btn blanc close-popup">Non</button>
        </div>
      </div>
    </div>
    <script src="js/carte.js"></script>
  </body>
</html>