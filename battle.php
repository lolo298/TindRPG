<?php include_once('header.php') ?>
<?php
$id = $_SESSION['mmiquest']['prof_id'];
$fbId = get_prof_by_id($id)['fbId'];
$nbr_pieces = $_SESSION['mmiquest']['nbr_pieces'];

?>

<body>
  <script>
    enemyName = 'Benoist';
    fbId = '<?= $fbId ?>';
    roomId = '<?= $_GET['roomId'] ?>';
  </script>
  <?php component('components/logo.php') ?>
  <main>

    <div id="modalFinWrapper">
      <div id="modalFin">
        <img id="avatar" src="" alt="" />
        <h2></h2>
        <p></p>
        <div id="puzzle">
          <?php component('components/puzzle.php', ['nbr_pieces' => $nbr_pieces == 5 ? $nbr_pieces : $nbr_pieces + 1]) ?>
        </div>
        <div id="retry" class="btnEmpty btn" onclick="location.reload()">
          <p style="position:relative;cursor:pointer;">Retenter</p>
        </div>
        <a id="battleEnd" class="btnFin btn" href="./carte.php">Retour a la carte</a>
      </div>
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
          <img src="" alt="Player life" class="battleSprite" />
          <div class="LifeBackDark lifeBack"></div>
          <div id="EnemyLife" class="lifeBar"></div>
        </div>
        <div id="EnemySprite">
          <img src="" alt="" class="sprite" />
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
      <button id="valider" class="btn disabled" onclick="this.disable=true;checkAnswer();" disabled>Valider</button>
    </div>
  </main>
  <script src="./js/global.js"></script>
  <script src="./js/battle.js"></script>
</body>

</html>