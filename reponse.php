<?php
include_once('header.php');
$reponse = true;
$nbr_pieces = $_SESSION['mmiquest']['']
?>

<body>
  <?php component('components/logo.php') ?>
  <main>
    <?php if($reponse): ?>
      <h1>Bonne réponse !</h1>
      <p>Bravo, vous avez dévérouillé une pièce du puzzle !</p>
      <?php component('components/puzzle.php') ?>
    <?php else: ?>
      <h1>Mauvaise réponse !</h1>
      <p>Demande des renseignements aux élèves / professeurs et retente ta chance !</p>
    <?php endif ?>
  </main>
</body>
</html>