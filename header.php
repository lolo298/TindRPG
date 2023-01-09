<?php
    $file_name = basename($_SERVER["SCRIPT_FILENAME"], '.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href=".css/global.css">
    <link rel="stylesheet" href=".css/components.css">
    <?php
        $own_style_path = "style/" . $file_name . ".css";
        if(file_exists($own_style_path)) echo "<link rel='stylesheet' href='$own_style_path'>";
    ?>
    <title>TindRPG</title>
</head>
<?php

include_once('api/api.php');

?>