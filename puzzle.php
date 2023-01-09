<?php
include_once('header.php');
$nbr_pieces = 3;
$finis = $nbr_pieces === 5
?>
  <body>
    <main>
      <div class="puzzle-container">
        <?php for($i = 1; $i < $nbr_pieces + 1 ; $i++): ?>
          <img src="assets/puzzle/puzzle_<?= $i ?>.png" alt="">
        <?php endfor ?>
      </div>
      <button <?= $finis ? "class='unlocked'" : '' ?>><p>Ma récompense</p><img src="assets/lock.svg" alt="Cadenas"></button>
    </main>
    <?= $finis ? "<script src='js/puzzle.js'></script>" : '' ?>
  <body>
</html>

<!-- <?php include_once('./components/footer.php') ?> -->