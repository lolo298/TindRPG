<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="shortcut icon" href="./assets/Logo.png" type="image/x-icon">
    <link rel="stylesheet" href="./css/battle.css">
    <title>Battle</title>
</head>

<body>
    <div class="title">
        <img src="./assets/Logo.png" alt="TindRPG" id="logo">
        <h1>TindRPG</h1>
    </div>
    <div id="battle">
        <div id="Player" class="wrapper">
            <div id="PlayerSprite">
                <img src="./assets/profs/front/Pierre.png" alt="Pierre Bueno" class="sprite">
            </div>
            <div class="mobInfo">
                <img src="./assets/battle/profs/Pierre.png" alt="Player life" class="battleSprite">
                <div class="LifeBackPlayer lifeBack"></div>
                <div id="PlayerLife" class="lifeBar"></div>
            </div>
        </div>
        <div id="Enemy" class="wrapper">
            <div class="mobInfo">
                <img src="./assets/battle/dark/Baptiste.png" alt="Player life" class="battleSprite">
                <div class="LifeBackDark lifeBack"></div>
                <div id="EnemyLife" class="lifeBar"></div>
            </div>
            <div id="EnemySprite">
                <img src="./assets/profs/dark/Baptiste.png" alt="Dark Baptiste" class="sprite">
            </div>
        </div>
    </div>
    <!--
    <input type="number" name="num" id="num" max="2" min="0">
    <button onclick="endTurn('player')">debug life player</button>
    <button onclick="endTurn('enemy')">debug life enemy</button> -->

    <div class="formWrapper">
        <div class="questionWrapper">
            <p class="question">Pouvez vous répondre à cette superbe question ?</p>
        </div>
        <form action="" id="Reponses">
            <input type="radio" name="reponse" id="reponse1" class="reponse" value="1">
            <label for="reponse1" class="reponseCheck" id="reponseCheck1">Oui</label>
            <input type="radio" name="reponse" id="reponse2" class="reponse" value="2">
            <label for="reponse2" class="reponseCheck" id="reponseCheck2">Non</label>
            <input type="radio" name="reponse" id="reponse3" class="reponse" value="3">
            <label for="reponse3" class="reponseCheck" id="reponseCheck3">Peut être</label>
        </form>
    </div>
    <button id="valider">Valider</button>
    <script src="./js/battle.js"></script>
</body>

</html>