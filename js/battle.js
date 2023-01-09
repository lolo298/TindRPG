playerLife = 2;
enemyLife = 2;
goodAnswers = [];
questionNum = 0;
questionRef = db.collection("Questions").where("ennemi", "==", enemyName);
id = getCookie("id");
starterRef = db.collection("Profs").doc(id);
starterRef.get().then((doc) => {
  console.log(doc);
  data = doc.data();
  document.getElementById("modalFin").querySelector('img').src = "./assets/profs/front/" + data.Nom + ".png";
  document.getElementById("modalFin").querySelector('img').alt = data.Nom;
  let player = document.getElementById("Player");
  player.querySelector("#PlayerSprite").querySelector("img").src = "./assets/profs/back/" + data.Nom + ".png";
  player.querySelector("#PlayerSprite").querySelector("img").alt = data.Nom;
  player.querySelector(".mobInfo").querySelector('img').src = "./assets/battle/profs/" + data.Nom + ".png"
  setQuestion("first");
});

async function setLife(state) {
  delayVal = 30;
  enemyLifeBar = document.getElementById("EnemyLife");
  if (state) {
    console.log("enemy");
    enemyLife--;
    if (enemyLife == 1) {
      console.log("mid");
      for (let i = 93; i >= 45; i--) {
        enemyLifeBar.style.maxWidth = i + "px";
        lifeBarColor(i, enemyLifeBar);
        await delay(delayVal);
      }
    } else if (enemyLife == 0) {
      console.log("KO");
      for (let i = 45; i >= 0; i--) {
        enemyLifeBar.style.maxWidth = i + "px";
        lifeBarColor(i, enemyLifeBar);
        await delay(delayVal);
      }
    }
  } else {
    console.log("player");
    playerLifeBar = document.getElementById("PlayerLife");
    playerLife--;
    if (playerLife == 1) {
      console.log("mid");
      for (let i = 93; i >= 45; i--) {
        playerLifeBar.style.maxWidth = i + "px";
        lifeBarColor(i, playerLifeBar);
        await delay(delayVal);
      }
    } else if (playerLife == 0) {
      console.log("KO");
      for (let i = 45; i >= 0; i--) {
        playerLifeBar.style.maxWidth = i + "px";
        lifeBarColor(i, playerLifeBar);
        await delay(delayVal);
      }
    }
  }
  return false;
}
function lifeBarColor(val, target) {
  if (val >= 46) {
    target.style.backgroundColor = "#74e3a0";
  } else if (val >= 15) {
    target.style.backgroundColor = "#f3dd5d";
  } else if (val <= 14) {
    target.style.backgroundColor = "#da3327";
  }
}

function delay(ms) {
  return new Promise((resolve) => setTimeout(resolve, ms));
}

function setQuestion(state) {
  questionRef.get().then((querySnapshot) => {
    querySnapshot.forEach((doc) => {
      data = doc.data();
      let questions = data.questions;
      questionNum++;

      Object.entries(questions).forEach((question) => {
        goodAnswers[question[0][8] - 1] = question[1].reponse;
      });
      let questionHTML = document.querySelector(".question");
      let answerHTML = document.getElementById("Reponses");
      switch (state) {
        case "first":
          questionHTML.innerHTML = questions.question1.question;
          questions.question1.reponses.forEach((reponse, key) => {
            let answers = createAnswer(reponse, key + 1);

            answers.forEach((element) => {
              answerHTML.appendChild(element);
            });
          });
          document.querySelector('#valider').disabled = false;
          break;
        case "next":
          if( Object.keys(questions).length < questionNum || playerLife == 0 || enemyLife == 0){
            console.log("fini");
            if(enemyLife == 0 && playerLife != 0){
              document.getElementById("Enemy").classList.add('kill');
              document.querySelector("#modalFin").querySelector('h2').innerHTML = "Bravo, Vous avez battu dark "+ enemyName +" !";
              document.querySelector("#modalFin").querySelector('p').innerHTML = "Vous avez débloqué une pièce de puzzle !";
            }else{
                if(playerLife==0){document.getElementById("Player").classList.add('kill');}
                document.querySelector("#modalFin").querySelector('h2').innerHTML = "Dommage, vous n'avez pas réussi a battre dark "+ enemyName +" !";
                document.querySelector("#modalFin").querySelector('p').innerHTML = "Retentez votre chance";
              }
              setTimeout(() => {
                document.querySelector("#modalFinWrapper").style.display = "flex";
              }, 1000);
              return;
          }

          answerHTML.innerHTML = "";
          questionHTML.innerHTML = questions["question"+questionNum].question;
          questions["question"+questionNum].reponses.forEach((reponse, key) => {
            let answers = createAnswer(reponse, key + 1);

            answers.forEach((element) => {
              answerHTML.appendChild(element);
            });
          });
          document.querySelector('#valider').disabled = false;
          break;
      }
      document
        .getElementById("valider")
        .setAttribute("onclick", "this.disabled=true;checkAnswer(" + questionNum + ");");
    });
  });
}

function createAnswer(answer, id) {
  let input = document.createElement("input");
  input.type = "radio";
  input.name = "reponse";
  input.id = "reponse" + id;
  input.className = "reponse";
  input.value = answer;
  let label = document.createElement("label");
  label.setAttribute("for", "reponse" + id);
  label.className = "reponseCheck";
  label.id = "reponseCheck" + id;
  label.innerHTML = answer;

  return [input, label];
}

function checkAnswer(num) {
  let checkedAnswer = document.querySelector('input[name="reponse"]:checked');
  let labelAnswer = document.getElementById("reponseCheck" + checkedAnswer.id[7]);
  let answer = checkedAnswer.value;
  questionRef.get().then((querySnapshot) => {
    querySnapshot.forEach(async (doc) => {
      data = doc.data();
      console.log("answer:", answer);
      console.log("good:", goodAnswers[num - 1]);
      if (goodAnswers[num - 1] == answer) {
        console.log("bonne reponse");
        labelAnswer.classList.add("goodAnswer");
        let allCheckbox = document.querySelectorAll(".reponse");
        allCheckbox.forEach((checkbox) => {
          checkbox.setAttribute("disabled", "disabled");
        });
        await setLife(true);
        setQuestion("next");
      } else {
        console.log("mauvaise reponse");
        let allCheckbox = document.querySelectorAll(".reponse");
        labelAnswer.classList.add("badAnswer");
        allCheckbox.forEach((checkbox) => {
          checkbox.setAttribute("disabled", "disabled");
        });
        await setLife(false);
        setQuestion("next");
      }
    });
  });
}

function getCookie(name) {
  const value = `; ${document.cookie}`;
  const parts = value.split(`; ${name}=`);
  if (parts.length === 2) return parts.pop().split(';').shift().replaceAll(' ','');
}