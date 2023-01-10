<?php
include_once('header.php');
$nbr_pieces = 3;
$finis = $nbr_pieces === 5
?>
  <body>
    <main>
      <div class="puzzle-container">
        <?php for($i = 0; $i < $nbr_pieces ; $i++): ?>
          <img src="assets/puzzle/puzzle_<?= $i + 1 ?>.png" alt="">
        <?php endfor ?>
      </div>
      <button class="btn<?= $finis ? ' unlocked' : '' ?>"><p>Ma récompense</p><img src="assets/lock.svg" alt="Cadenas"></button>
    </main>
    <?= $finis ? "<script src='js/puzzle.js'></script>" : '' ?>
  <body>
</html>

<!-- <?php include_once('./components/footer.php') ?> -->