<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css"
      integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="shortcut icon" href="./assets/Logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="./css/battle.css" />
    <title>Battle</title>
  </head>

  <body>
    <script src="https://www.gstatic.com/firebasejs/8.9.0/firebase-app.js"></script>
    <!-- Add Firebase products that you want to use -->
    <script src="https://www.gstatic.com/firebasejs/8.9.0/firebase-firestore.js"></script>
    <script>
      // Your web app's Firebase configuration
      const firebaseConfig = {
        apiKey: "AIzaSyCp61ziHL96zyEGG9EskUi92tDKLJ1AqAE",
        authDomain: "sae301-eb77d.firebaseapp.com",
        projectId: "sae301-eb77d",
        storageBucket: "sae301-eb77d.appspot.com",
        messagingSenderId: "976249625593",
        appId: "1:976249625593:web:8c215411d295c91cb2bb28",
        measurementId: "G-32MSSS8DKX",
      };

      // Initialize Firebase
      firebase.initializeApp(firebaseConfig);
      var db = firebase.firestore();
    </script>
    <script>
      enemyName = "Baptiste";
    </script>

    <div id="modalFinWrapper">
      <div id="modalFin">
        <img src="./assets/profs/front/Pierre.png" alt="Pierre Bueno" />
        <h2></h2>
        <p></p>
        <a class="btnFin" href="./carte.php">Retour a la carte</a>
      </div>
    </div>
    <header>
      <a id="retour" href="./carte.php">
        <img src="./assets/retour.png" alt="retour" />
      </a>
      <div class="title">
        <img src="./assets/Logo.png" alt="TindRPG" id="logo" />
        <h1>TindRPG</h1>
      </div>
    </header>
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
          <img src="./assets/battle/dark/Baptiste.png" alt="Player life" class="battleSprite" />
          <div class="LifeBackDark lifeBack"></div>
          <div id="EnemyLife" class="lifeBar"></div>
        </div>
        <div id="EnemySprite">
          <img src="./assets/profs/dark/Baptiste.png" alt="Dark Baptiste" class="sprite" />
        </div>
      </div>
    </div>

    <div class="formWrapper">
      <div class="questionWrapper">
        <p class="question">Pouvez vous répondre à cette superbe question ?</p>
      </div>
      <form action="" id="Reponses"></form>
    </div>
    <button id="valider" onclick="this.disable=true;checkAnswer();">Valider</button>
    <script src="./js/battle.js"></script>
  </body>
</html>
