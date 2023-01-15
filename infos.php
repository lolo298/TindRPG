<?php 
include_once('header.php');

?>
<body>
    <?php component("components/logo.php") ?>
    <a href="carte.php" class="quit btn blanc"><span>◄</span><p>Retour à la carte</p></a>
    <div class="in_buttons_container">
        <button value="prof" class="in_but btn"><p>Professeur</p><span>►</span></button>
        <button value="salles" class="in_but btn"><p>Salles</p><span>►</span></button>
        <button value="butdj" class="in_but btn"><p>But du Jeu</p><span>►</span></button>
    </div>

    <div class="prof overlay">
        <div class="overlay_header">
            <button value="prof" class="ret_but btn blanc"><span>x</span><p>Fermer</p></button>
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
                <img class="avatar_to_photo" src="<?php echo($value["pht"]);?>" alt="Cancel">
                <div class="prof_card_name"><?php echo($value["nom"]);?></div>
                <div class="prof_card_desc"><?php echo($value["resp"]);?></div>
                <div class="overlay_coord_container">
                    <button class="btn"><p>Coordonnées</p></button>
                    <div class="coord_infos">
                        <p class="where">Vous pouvez trouver <?php echo($value["nom"]);?> en salle <?php echo($value["pla"]);?></p>
                        <p class="mail"> <span>✉</span><?php echo($value["mail"]);?></p>
                    </div>
                </div>
            </div>
            <?php }?>   
        </div>
    </div>
    
    <div class="salles overlay">
        <div class="overlay_header">
            <button value="salles" class="ret_but btn blanc"><span>x</span><p>Fermer</p></button>
            <p class="overlay_title">Informations Salles</p>
        </div>
        <div class="info_liste">
            <?php
             $rooms = list_all_room();
             foreach($rooms as $key=>$value) {
            ?>
                <div class="accord">
                    <button class="btn accord_title"><?php echo($value["nom"]);?>
                        <span class="arrow">▷</span>
                    </button>
                    <div class="accord_content" style="display: none;">
                        <p class="accord_content_text">
                            <span class="title"><?php echo($value["spe"]);?></span><br><br>
                            <?php echo($value["desc"]);?>
                        </p>
                    </div>
                </div>
            <?php }?>   
        </div>
    </div>
    
    <div class="butdj overlay">
        <div class="overlay_header">
            <button value="butdj" class="ret_but btn blanc"><span>x</span><p>Fermer</p></button>
            <p class="overlay_title">Informations But du Jeu</p>
        </div>
        <div class="info_liste">
            <?php
             $rules = list_all_rules();
             foreach($rules as $key=>$value) {
                ?>
                <div class="accord">
                    <button class="btn accord_title"><?php echo($value["nom"]);?>
                        <span class="arrow">▷</span>
                    </button>
                    <div class="accord_content" style="display: none;">
                        <p class="accord_content_text">
                            <span class="title"><?php echo($value["spe"]);?></span><br><br>
                            <?php echo($value["desc"]);?>
                        </p>
                    </div>
                </div>
            <?php }?>    
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

    function close_accor(){
        listaccor.forEach(sup => sup.parentNode.querySelector(".accord_content").style.display = 'none')
        listaccor.forEach(arr => arr.querySelector(".arrow").style.transform = 'rotate(0)')

    }
    let listaccor = document.querySelectorAll(".accord_title")
    listaccor.forEach(element => element.addEventListener('click', function(){
        let content = element.parentNode.querySelector(".accord_content")
        if(content.style.display == '' || content.style.display == 'none'){
            close_accor()
            content.style.display = 'block'
            element.parentNode.querySelector(".arrow").style.transform = 'rotate(90deg)'
        }
        else{
            content.style.display = 'none'
            element.parentNode.querySelector(".arrow").style.transform = 'rotate(0)'

        }
    }))
</script>