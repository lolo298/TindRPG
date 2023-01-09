<?php 
include_once('header.php')


?>
<body style="
justify-content: initial;
">
<div class="td_toplogo">
        <img class="td_applogo" src="./assets/Logo.png" alt="TindRPG">
        <h2 class="td_logotitle">TindRPG</h2>
    </div>
    
    <img src="<?php echo(get_prof_by_id($_GET['pid'])['img'])?>" alt="<?php echo(get_prof_by_id($_GET['pid'])['nom'])?>">
</body>
</html>
