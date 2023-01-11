<?php include_once('header.php') ?>
<?php
$enemyName = "Benoist";
$id = $_SESSION['mmiquest']['prof_id'];
$fbId = get_prof_by_id($id)['fbId'];
?>

<body>
  <script>
    enemyName = '<?= $enemyName ?>';
    fbId = '<?= $fbId ?>';
    roomId = '<?= $_GET['roomId'] ?>';
  </script>

  <div id="modalFinWrapper">
    <div id="modalFin">
      <img src="" alt="" />
      <h2></h2>
      <p></p>
      <img src="./assets/Logo.png" alt="Puzzle" style="display:none;">
      <div id="retry" class="btnEmpty btn" onclick="location.reload()">
        <p style="position:relative;cursor:pointer;">Retenter</p>
      </div>
      <a class="btnFin btn" href="./carte.php">Retour a la carte</a>
    </div>
  </div>
  <div id="Title" class="title">
    <img src="./assets/Logo.png" alt="MMIQuest" id="logo" />
    <h1>MMIQuest</h1>
  </div>
  <div id="battle">
    <div id="Player" class="wrapper">
      <div id="PlayerSprite">
        <img src="" alt="" class="sprite" />
      </div>
      <div class="mobInfo">
        <img src="" alt="Player life" class="battleSprite" />
        <div class="LifeBackPlayer lifeBack"></div>
        <div id="PlayerLife" class="lifeBar"></div>
      </div>
    </div>
    <div id="Enemy" class="wrapper">
      <div class="mobInfo">
        <img src="./assets/battle/dark/<?= $enemyName ?>.png" alt="Player life" class="battleSprite" />
        <div class="LifeBackDark lifeBack"></div>
        <div id="EnemyLife" class="lifeBar"></div>
      </div>
      <div id="EnemySprite">
        <img src="./assets/profs/dark/<?= $enemyName ?>.png" alt="Dark <?= $enemyName ?>" class="sprite" />
      </div>
    </div>
  </div>

  <div class="formWrapper">
    <div class="questionWrapper">
      <p class="question">Pouvez vous répondre à cette superbe question ?</p>
    </div>
    <form action="" id="Reponses"></form>
  </div>
  <div class="boutonSuite">
    <div id="retour" class="btn btnEmpty"><a href="./carte.php">Retour</a></div>
    <button id="valider" class="btn" onclick="this.disable=true;checkAnswer();">Valider</button>
  </div>
  <script src="./js/global.js"></script>
  <script src="./js/battle.js"></script>
</body>

</html>