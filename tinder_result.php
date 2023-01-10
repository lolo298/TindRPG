<?php 
include_once('header.php')
?>

<body style="
justify-content: initial;
">
<p class="td_text" style="display: none;">Je vois que tu aime <?php echo(get_prof_by_id($_GET['pid'])['spe'])?></p>
<p class="pid" style="display: none;"><?php echo($_GET['pid'])?></p>

<div class="td_toplogo">
        <img class="td_applogo" src="./assets/Logo.png" alt="TindRPG">
        <h2 class="td_logotitle">TindRPG</h2>
    </div>
    <div class="td_dialog">
        <img class="td_avatar" src="<?php echo(get_prof_by_id($_GET['pid'])['img'])?>" alt="<?php echo(get_prof_by_id($_GET['pid'])['nom'])?>">
        <div class="bubble">
            <div class="bubble-text">
                <p class="td_text_dialog">Salut, moi c'est <?php echo(get_prof_by_id($_GET['pid'])['nom'])?></p>
            </div>
        </div>
    </div>
    <div class="td_avatar_act_button">
        <button id="next" class="btn">Suivant</button>
        <div class="close_td"><a href="tinder.php">Changer d'avatar</a></div>
    </div>
</body>
</html>

<script>
    let dg_count = 1
    document.querySelector('#next').addEventListener('click',function(){
        next_dialog();
    })
    function next_dialog(){
        if(dg_count == 1){
            document.querySelector(".td_text_dialog").innerHTML = document.querySelector(".td_text").innerHTML
        }
        else if(dg_count==2){
            document.querySelector(".td_text_dialog").innerHTML = "Veut-tu faire l'aventure avec moi?"
            document.querySelector("#next").innerHTML = "C'est parti !"
            document.querySelector(".close_td").style.display = 'flex'
        }
        else if(dg_count==3){
            console.log('slt')
            location.href = "save_prof.php?pid="+document.querySelector('#pid').innerHTML;
        }
        dg_count++
    }
</script>


        <!-- <img class="td_avatar" src="<?php echo(get_prof_by_id($_GET['pid'])['img'])?>" alt="<?php echo(get_prof_by_id($_GET['pid'])['nom'])?>">
        <div class="td_avatar_dialog">
            <p class="td_text_dialog">Salut, moi c'est <?php echo(get_prof_by_id($_GET['pid'])['nom'])?></p>
             <img src="assets/questions/bulle.png" alt=""> 
        </div> -->