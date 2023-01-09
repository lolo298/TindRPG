<?php 
include_once('header.php');

?>
<body style="
justify-content: initial;
">
    <div class="td_toplogo">
        <img class="td_applogo" src="./assets/Logo.png" alt="TindRPG">
        <h2 class="td_logotitle">TindRPG</h2>
    </div>
    <div class="td_card_container">
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
    
    function add_result(data){
        result += data
        console.log(result)
        if(result.length == 4){
            location.href = "tinder_result.php?pid="+answ_to_prof[parseInt(result, 2)];
            console.log()
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







        <!-- <div class="td_card">
            <div class="td_questions_container">
                <div class="question">Serais-tu attiré par le marketing?</div>
            </div>
            <div class="td_action_buttons">
                <div class="td_button td_back_button">
                    <img class="td_button_img td_back_img" src="./assets/icons/redcross.png" alt="Cancel">
                </div>
                <div class="td_button td_like_button">
                    <img class="td_button_img td_like_img" src="./assets/icons/heart.png" alt="Like">
                </div>
            </div>
        </div> -->