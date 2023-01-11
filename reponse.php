<?php
include_once('header.php');
$reponse = $_GET["rep"];
$nbr_pieces = $_SESSION['mmiquest']['nbr_pieces'];
?>

<body>
  <?php component('components/logo.php') ?>
  <main>
    <?php if($reponse): ?>
      <h1>Bonne réponse !</h1>
      <p>Bravo, vous avez dévérouillé une pièce du puzzle !</p>
      <?php component('components/puzzle.php', ['nbr_pieces' => $nbr_pieces]) ?>
      <a class="btn" href="carte.php">Retour à la carte</a>
    <?php else: ?>
      <h1>Mauvaise réponse !</h1>
      <p>Demande des renseignements aux élèves / professeurs et retente ta chance !</p>
      <a class="btn" href="carte.php">Retenter</a>
      <a class="btn blanc" href="carte.php">Retour à la carte</a>
    <?php endif ?>
  </main>
</body>
</html>