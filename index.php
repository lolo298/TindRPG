<?php include_once('header.php') ?>
<body>
    <div class="home-header">
        <h1 id="startTitle">Bienvenue dans</h1>
        <?php component("components/logo.php") ?>
    </div>
    
    <p id="textStart"> Vous êtes soudainement plongé dans un monde alternatif où les alter ego maléfiques des professeurs ont pris le pouvoir </p>
    <button class="btn" onclick="contenu()"> Suivant </button>
    <script>
        function contenu(){
            document.getElementById('textStart').innerHTML = "Utilisez vos connaissances et vos compétences pour combattre ces versions maléfiques et sauver l’IUT ";
            document.querySelector('.btn').setAttribute('onclick', 'next()');
        }
        function next(){
            document.location.href = "./form.php";
        }
    </script>
</body>

</html>