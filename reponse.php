<?php
include_once('header.php');
$reponse = $_GET["rep"];
$salle = $_GET["roomId"];
$nbr_pieces = $_SESSION['mmiquest']['nbr_pieces'];
if ($_SESSION['mmiquest']['rooms'][$salle]) {
}
if ($reponse) {
  $nbr_pieces++;
  $_SESSION['mmiquest']['nbr_pieces'] = $nbr_pieces;
  $_SESSION['mmiquest']['rooms'][$salle] = true;
}

?>

<body>
  <style>
    main {
      <?php if ($reponse) { ?>height: 100%;
      <?php } else { ?>height: 40%;
      <?php } ?>
    }
  </style>
  <?php component('components/logo.php') ?>
  <main>
    <?php if ($reponse) : ?>
      <h1>Bonne réponse !</h1>
      <p>Bravo, vous avez dévérouillé une pièce du puzzle !</p>
      <?php component('components/puzzle.php', ['nbr_pieces' => $nbr_pieces]) ?>
      <a class="btn" href="carte.php">Retour à la carte</a>
    <?php else : ?>
      <h1>Mauvaise réponse !</h1>
      <p>Demande des renseignements aux élèves / professeurs et retente ta chance !</p>
      <a class="btn" onclick="window.location.reload()">Retenter</a>
      <a class="btn blanc" href="carte.php">Retour à la carte</a>
    <?php endif ?>
  </main>
  <?php if ($reponse) : ?>
    <script>
      let userRef = db.collection('users').doc(sessionStorage.getItem("id"));
      var completeRooms = {};
      var roomId = <?= $salle ?>;
      userRef.get().then((doc) => {
        data = doc.data();
        completeRooms = data.salles;
      });

      function win() {
        nbPieces = 0
        for (val of Object.values(completeRooms)) {
          console.log(val)
          if (val) {
            nbPieces++;
          }
        }
      }
    </script>
  <?php endif ?>
</body>

</html>