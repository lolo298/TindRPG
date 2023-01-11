<?php
    session_start();
    if(!isset($_SESSION['mmiquest']) || isset($_GET["reset"])){
        $_SESSION['mmiquest'] = [
            'nbr_pieces' => 3,
            'prof_id' => 0,
            'salles' => [
                '019' => true,
                '020' => true,
                '016' => false,
                '029' => false,
            ]
        ];
    };
    include_once('functions.php');
    include_once('api/api.php');
    $file_name = basename($_SERVER["SCRIPT_FILENAME"], '.php');
    $own_style_path = "css/" . $file_name . ".css";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/Logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/components.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <!-- FONT -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300&display=swap" rel="stylesheet"> 

    <?php
        $own_style_path = "css/" . $file_name . ".css";
        if(file_exists($own_style_path)) echo "<link rel='stylesheet' href='$own_style_path'>";
    ?>
    <title>MMIQuest</title>

    <!-- Connection Base -->
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
            measurementId: "G-32MSSS8DKX"
        };

        // Initialize Firebase
        firebase.initializeApp(firebaseConfig);
        var db = firebase.firestore();
    </script>
    <!-- Fin Connection Base -->

</head>
<a style="position: absolute; top: 0; left: 0;" href="<?= $file_name ?>.php?reset=">reset session</a>