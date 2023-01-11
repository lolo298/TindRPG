<?php 
include_once('header.php');

?>
<body style="
justify-content: initial;
">
    <div class="td_tutorial">
        <p>Trouvez votre professeur totem en répondant aux questions suivantes !</p>
        <button id="td_tutorial_act" class="btn">Suivant</button>
    </div>
            <?php component("components/logo.php") ?>
        <div class="td_blur td_card_container">
        <?php
        $questions = list_all_questions();
        foreach($questions as $key=>$value) {?>
        <div class="td_card">
                <div class="td_questions_container" style="background-image:linear-gradient(180.05deg, rgba(47, 47, 47, 0.02) 36.75%, rgba(49, 49, 49, 0.5) 57.49%, rgba(0, 0, 0, 0.7) 100%),url('<?php echo($questions[$key]["img"]);?>')">
                    <div class="question"><?php echo($questions[$key]["quest"]);?></div>
                </div>
                <div class="td_action_buttons">
                    <div class="td_button td_back_button">
                        <img class="td_button_img td_back_img" src="./assets/icons/redcross.png" alt="Cancel">
                    </div>
                    <div class="td_button td_like_button">
                        <img class="td_button_img td_like_img" src="./assets/icons/heart.png" alt="Like">
                    </div>
                </div>
            </div>
        <?php }?>
    </div>
</body>
</html>
<script>
    const answ_to_prof = {
        0: "0", 
        1: "2",
        2: "0",
        3: "2",
        4: "4",
        5: "4",
        6: "6",
        7: "0",
        8: "7",
        9: "3",
        10: "5",
        11: "6",
        12: "3",
        13: "2",
        14: "0",
        15: "1",
    };
    let lsitcards = document.querySelectorAll('.td_card')
    let likebut = document.querySelectorAll('.td_like_button');
    let cancbut = document.querySelectorAll('.td_back_button');
    const rot = 20
    const tx = 150
    const ty = 20
    let result = ""

    document.querySelector("#td_tutorial_act").addEventListener('click',function(){
        document.querySelector(".td_tutorial").style.display = 'none'
        document.querySelectorAll(".td_blur").forEach(element => {
            element.classList.remove("td_blur")
    })
    })

    function add_result(data){
        result += data
        if(result.length == 4){
            location.href = "tinder_result.php?pid="+answ_to_prof[parseInt(result, 2)];
        }
    }
    
    likebut.forEach(element =>{
        element.addEventListener('click', function(){
            element.parentNode.parentNode.style.transform = "translate("+tx+"%, "+ty+"%) rotate("+rot+"deg)";
            add_result("1")
        })
    })
    cancbut.forEach(element =>{
        element.addEventListener('click', function(){
            element.parentNode.parentNode.style.transform = "translate(-"+tx+"%, "+ty+"%) rotate(-"+rot+"deg)";
            add_result("0")
        })
    })
</script>
