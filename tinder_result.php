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
    <div class="td_dialog">
        <img class="td_avatar" src="<?php echo(get_prof_by_id($_GET['pid'])['img'])?>" alt="<?php echo(get_prof_by_id($_GET['pid'])['nom'])?>">
        <div class="td_avatar_dialog">
            <p class="td_text_dialog">Salut, moi c'est <?php echo(get_prof_by_id($_GET['pid'])['nom'])?></p>
            <!-- <img src="assets/questions/bulle.png" alt=""> -->
        </div>
    </div>
    <div class="td_avatar_act_button">
        <button>Suivant</button>
    </div>
</body>
</html>
<script>
    
</script>