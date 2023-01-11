<?php
require_once('header.php');
$_SESSION['mmiquest']['prof_id'] = $_GET['pid'];
$nom = explode(" ", get_prof_by_id($_SESSION['mmiquest']['prof_id'])['nom']);
$spe = get_prof_by_id($_SESSION['mmiquest']['prof_id'])['spe'];
?>

<script>
    
 db.collection("Users").doc(sessionStorage.getItem("id")).update({
    "avatar": '<?= $nom[0] ?>',
    "matiere": '<?= $spe ?>',
 }).then(()=>{
    document.location.href = "./carte.php";
 })
</script>