<?php 
include_once('header.php');

?>
<body>
    <?php component("components/logo.php") ?>
    <div class="in_buttons_container">
        <button value="prof" class="in_but btn"><p>Professeur</p><span>►</span></button>
        <button value="salles" class="in_but btn"><p>Salles</p><span>►</span></button>
        <button value="butdj" class="in_but btn"><p>But du Jeu</p><span>►</span></button>
    </div>

    <div class="prof overlay">
        <div class="overlay_header">
            <button value="prof" class="ret_but btn blanc"><span>◄</span><p>Retour</p></button>
            <p class="overlay_title">Informations Professeur</p>
        </div>
        <div class="prof_card_container">
            <?php
             $profs = list_all_prof();
             foreach($profs as $key=>$value) {
            ?>
            <div class='prof_card'>
                <p style="display: none;"><?php echo($key);?></p>
                <img class="prof_card_avatar" src='<?php echo($value["img"]);?>' alt="test" >
                <div class="prof_card_name"><?php echo($value["nom"]);?></div>
                <div class="prof_card_desc"><?php echo($value["resp"]);?></div>
            </div>
            <div id="td_<?php echo($key);?>" class="prof_card_overlay">
                <div class="porf_overlay_top">
                    <button value="td_<?php echo($key);?>" class="close_po btn blanc">
                        <img class="in_button_img" src="./assets/icons/redcross.png" alt="Cancel">
                    </button>
                </div>
                <img class="avatar_to_photo" src="./assets/profs/photos/pierre.png" alt="Cancel">
                <div class="prof_card_name"><?php echo($value["nom"]);?></div>
                <div class="prof_card_desc"><?php echo($value["resp"]);?></div>
                <div class="overlay_coord_container">
                    <button class="btn"><p>Coordonnées</p></button>
                    <div class="coord_infos">
                        <p class="where">Vous trouverez Pierre dans la salle 29 ...etc</p>
                        <p class="mail"> <span>✉</span> pierre.bueno@univ-rennes1.fr</p>
                    </div>
                </div>
            </div>
            <?php }?>   
        </div>
    </div>
    
    <div class="salles overlay">
        <div class="overlay_header">
            <button value="salles" class="ret_but btn blanc"><span>◄</span><p>Retour</p></button>
            <p class="overlay_title">Informations Salles</p>
        </div>
    </div>
    
    <div class="butdj overlay">
        <div class="overlay_header">
            <button value="butdj" class="ret_but btn blanc"><span>◄</span><p>Retour</p></button>
            <p class="overlay_title">Informations But du Jeu</p>
        </div>
    </div>
</body>
</html>
<script>
    function show(classe_to_show){
        let element = document.querySelector("."+classe_to_show)
        element.style.transform = 'translateY(-100%)'
        element.classList.add('show')
    }
    function hide(classe_to_show){
        let element = document.querySelector("."+classe_to_show)
        element.style.transform = 'translateY(100%)'
        element.classList.remove('show')
    }
    document.querySelectorAll(".in_but").forEach(element => {
        element.addEventListener('mouseenter',function(){
            element.classList.add('blanc')
        })
        element.addEventListener('mouseleave',function(){
            element.classList.remove('blanc')
        })
        element.addEventListener('click',function(){
            show(element.value)
        })
    })
    document.querySelectorAll(".ret_but").forEach(element => {
        element.addEventListener('click',function(){
            hide(element.value)
        })
    })
    function show_prof(prof){
        document.querySelector("#td_" + prof.childNodes[1].innerHTML).style.transform = 'translateY(15%)'
    }
    function hide_prof(id){
        console.log(id)
        document.querySelector("#"+id).style.transform = 'translateY(200%)'
    }
    document.querySelectorAll(".prof_card").forEach(element => 
    element.addEventListener('click', function(){
        show_prof(element)
    })
    )
    document.querySelectorAll(".close_po").forEach(element => {
        element.addEventListener('click',function(){
            hide_prof(element.value)
        })
    })
</script>