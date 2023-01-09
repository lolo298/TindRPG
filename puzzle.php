<?php
// include_once('./components/header.php');
$nbr_pieces = 3;
$finis = $nbr_pieces === 5
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" referrerpolicy="no-referrer">
      <link rel="stylesheet" href="css/global.css">
      <link rel="stylesheet" href="css/puzzle.css">
      <title>TindRPG</title>
  </head>
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