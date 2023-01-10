<?php
    session_start();
    if(!isset($_SESSION['mmiquest'])){
        $_SESSION['mmiquest'] = [
            'nbr_pieces' => 0,
            'prof_id' => 0
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
    <title>TindRPG</title>
</head>