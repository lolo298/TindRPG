<?php
  require_once('header.php');
  if(isset($_GET['tuto'])){
    $_SESSION['mmiquest']['tuto_carte'] = true;
  }
  if(isset($_GET['pieces'])){
    $_SESSION['mmiquest']['nbr_pieces'] = $_GET['pieces'];
  }
  if(isset($_GET['roomId']) && $_GET['roomId'] !== "29"  && array_key_exists("0" . $_GET['roomId'], $_SESSION['mmiquest']['salles'])){
    $keys = array_keys($_SESSION['mmiquest']['salles']);
    $_SESSION['mmiquest']['salles'][$keys[array_search("0" . $_GET['roomId'],$keys)+1]] = true;
  }
  $salles = $_SESSION['mmiquest']['salles'];
  $nbr_pieces = $_SESSION['mmiquest']['nbr_pieces'];
  $id = $_SESSION['mmiquest']['prof_id'];
  $avatar = get_prof_by_id($id);
  $tuto = $_SESSION['mmiquest']['tuto_carte'];
  $currentRoom;
?>
  <body>
    <?php component('components/logo.php') ?>
    <main>
      <div>
        <a class="info-btn btn blanc" href="infos.php"><img src="assets/info_icon.svg" alt=""><p>Informations</p></a>
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
      <a href="puzzle.php" class="puzzle">
        <img src="assets/puzzle_icon.svg" alt="">
        <p><?= $nbr_pieces ?><span>/</span>5</p>
      </a>
    </main>
    <div class="popup<?= !$tuto ? ' visible' : '' ?>">
      <?php if($tuto): ?>
        <div class="popup-window">
        <p>Voulez-vous commencer le combat de la salle <span class="break"><?= $currentRoom ?> ?</span></p>
        <div>
          <a href="battle.php?roomId=<?= substr($currentRoom, 1); ?>" class="btn">Oui</a>
          <button class="btn blanc close-popup">Non</button>
        </div>
      </div>
      <?php else: ?>
        <div class="message">
        <img src="<?= $avatar["img"] ?>" alt="<?= $avatar["nom"] ?>">
          <div class="message-content">
            <p class="current-p">A présent, je vais te guider à travers ta quête de la JPO</p>
            <p>Vous débloquerez de nouvelles salles au fur et à mesure de votre visite.</p>
            <p>Tu as terminé une salle ? La suivante deviendra verte et accessible en cliquant dessus. Tu pourras alors accéder au challenge de cette salle.</p>
            <p data-mask=".info-btn">En appuyant sur le bouton "Informations" en haut à gauche de la carte, tu trouveras les professeurs présents, les matières enseignées et toutes les infos qui te seront utiles.</p>
           </div>
          <a href="carte.php?tuto=" class="btn next-message">Suivant</a>
        </div>
      <?php endif ?>
    </div>
    <script src="js/carte.js"></script>
  </body>
</html>