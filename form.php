<?php include_once('header.php') ?>

    <body>
        <?php component("components/logo.php") ?>

        <form name="login" action="" method="post" class="login-form">

            <div class="form__group field">
                <input class="form__field" name="pseudo" placeholder="Pseudonyme" required/>
                <label for="pseudo" class="form__label"> Pseudonyme </label>
            </div>

            <div class="form__group field">
                <input class="form__field" name="mail" placeholder="Mail (optionnel)"/>
                <label for="mail" class="form__label"> Mail (optionnel) </label>
            </div>

            <input type="submit" class="btn formSubmit" value="C'est parti !"></input>

        </form>
    </body>
    <script>

        function getData(form) {

            var formData = new FormData(form);

            var formValues = Object.fromEntries(formData);
            return formValues

        }

        document.querySelector(".login-form").addEventListener("submit", function (e) {
            e.preventDefault();
            formValues = getData(e.target);
            addDoc();
        });

        function addDoc() {
            // Add a new document with a generated id.
            db.collection("Users").add({
                name: formValues.name,
                mail: formValues.mail
            })
            .then((docRef) => {
                console.log("Document written with ID: ", docRef.id);
                //Créer un cookie pour stocker l'id
            })
            .catch((error) => {
                console.error("Error adding document: ", error);
            });
        }

    </script>
</html>
