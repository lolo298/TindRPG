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
            <div class='prof_card'>
                <p style="display: none;">0<p>
                <img class="prof_card_avatar" src='./assets/profs/front/Pierre.png' alt="test" >
                <div class="prof_card_name">Pierre Bueno</div>
                <div class="prof_card_desc">Responsable Design</div>
            </div>
            <div id="td_0" class="prof_card_overlay">
                <button value="td_0" class="close_po btn blanc">X</button>
                Pierre Bueno
            </div>
            
            
            <div class='prof_card'>
                <img src='./assets/profs/front/Pierre.png' class="prof_card_avatar">
                <div class="prof_card_name">Pierre Bueno</div>
                <div class="prof_card_desc">Responsable Design</div>
            </div>
            
            
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
        document.querySelector("#td_" + prof.childNodes[1].innerHTML).style.transform = 'translateY(50%)'
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