<?php
include_once('header.php');
$nbr_pieces = 3;
?>
  <body>
  <?php component("components/logo.php") ?>

    <main>
      <?php component('components/puzzle.php', ['nbr_pieces' => $nbr_pieces]) ?>
      <button class="btn<?= $nbr_pieces === 5 ? ' unlocked' : '' ?>"><p>Ma récompense</p><img src="assets/lock.svg" alt="Cadenas"></button>
    </main>
    <?= $nbr_pieces === 5 ? "<script src='js/puzzle.js'></script>" : '' ?>
  <body>
</html>

<!-- <?php include_once('./components/footer.php') ?> -->