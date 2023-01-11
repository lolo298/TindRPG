spinner(true);
playerLife = 2;
enemyLife = 2;
goodAnswers = [];
let Load = [];
questionNum = 0;
questionQte = 0;

setup();
async function setup() {
  console.log("setup");
  starterRef = db.collection("Profs").doc(fbId);

  await starterRef.get().then((doc) => {
    data = doc.data();
    document.getElementById("modalFin").querySelector("img").src =
      "./assets/profs/front/" + data.Nom + ".png";
    Load.push(
      new Promise((resolve, reject) => {
        document.getElementById("modalFin").querySelector("img").onload = resolve;
        document.getElementById("modalFin").querySelector("img").onerror = reject;
      })
    );
    document.getElementById("modalFin").querySelector("img").alt = data.Nom;
    let player = document.getElementById("Player");
    player.querySelector("#PlayerSprite").querySelector("img").src =
      "./assets/profs/back/" + data.Nom + ".png";
    Load.push(
      new Promise((resolve, reject) => {
        player.querySelector("#PlayerSprite").querySelector("img").onload = resolve;
        player.querySelector("#PlayerSprite").querySelector("img").onerror = reject;
      })
    );
    player.querySelector("#PlayerSprite").querySelector("img").alt = data.Nom;
    player.querySelector(".mobInfo").querySelector("img").src =
      "./assets/battle/profs/" + data.Nom + ".png";
    Load.push(
      new Promise((resolve, reject) => {
        player.querySelector(".mobInfo").querySelector("img").onload = resolve;
        player.querySelector(".mobInfo").querySelector("img").onerror = reject;
      })
    );
    return true;
  });
  enemyRef = db.collection("Profs").where("salle", "==", parseInt(roomId));
  await enemyRef.get().then((querySnapshot) => {
    var keys = Object.keys(querySnapshot.docs);
    var randomKey = keys[Math.floor(Math.random() * keys.length)];
    doc = querySnapshot.docs[randomKey];
    data = doc.data();
    enemyName = data.Nom;
    let Enemy = document.getElementById("Enemy");
    Enemy.querySelector("#EnemySprite").querySelector("img").src =
      "./assets/profs/dark/" + data.Nom + ".png";
    Load.push(
      new Promise((resolve, reject) => {
        Enemy.querySelector("#EnemySprite").querySelector("img").onload = resolve;
        Enemy.querySelector("#EnemySprite").querySelector("img").onerror = reject;
      })
    );
    Enemy.querySelector("#EnemySprite").querySelector("img").alt = data.Nom;
    Enemy.querySelector(".mobInfo").querySelector("img").src =
      "./assets/battle/dark/" + data.Nom + ".png";
    Load.push(
      new Promise((resolve, reject) => {
        Enemy.querySelector(".mobInfo").querySelector("img").onload = resolve;
        Enemy.querySelector(".mobInfo").querySelector("img").onerror = reject;
      })
    );
    Load.push(setQuestionV2("first"));
    return true;
  });

  Promise.all(Load).then(() => {
    spinner(false);
    Load = [];
  });
}

async function setLife(state) {
  // let delayVal = 50;
  let delayVal = 5;
  if (state) {
    enemyLifeBar = document.getElementById("EnemyLife");
    if (questionQte == 2) {
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
    } else if (questionQte == 1) {
      enemyLife = 0;
      for (let i = 93; i >= 0; i--) {
        enemyLifeBar.style.maxWidth = i + "px";
        lifeBarColor(i, enemyLifeBar);
        await delay(delayVal);
      }
    }
  } else {
    playerLifeBar = document.getElementById("PlayerLife");
    if (questionQte == 2) {
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
    } else if (questionQte == 1) {
      playerLife = 0;
      for (let i = 93; i >= 0; i--) {
        playerLifeBar.style.maxWidth = i + "px";
        lifeBarColor(i, playerLifeBar);
        await delay(delayVal);
      }
    }
  }
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

async function setQuestion(state) {
  questionRef = db.collection("Questions").where("ennemi", "==", enemyName);
  questionRef.get().then((querySnapshot) => {
    querySnapshot.forEach((doc) => {
      data = doc.data();
      let questions = data.questions;
      console.log(questions);
      questionNum++;
      let questionHTML = document.querySelector(".question");
      let answerHTML = document.getElementById("Reponses");
      switch (state) {
        case "first":
          Object.entries(questions).forEach((question) => {
            questionQte++;
          });
          enemyLife = playerLife = questionQte;

          Object.entries(questions).forEach((question) => {
            goodAnswers[question[0][8] - 1] = question[1].reponse;
          });
          questionHTML.innerHTML = questions.question1.question;
          questions.question1.reponses.forEach((reponse, key) => {
            let answers = createAnswer(reponse, key + 1);

            answers.forEach((element) => {
              answerHTML.appendChild(element);
            });
          });
          document.querySelector("#valider").disabled = false;
          console.log(enemyLife);
          break;
        case "next":
          if (questionQte < questionNum || playerLife == 0 || enemyLife == 0) {
            console.log("fini");
            console.log("PL:", playerLife);
            console.log("EL:", enemyLife);
            modalFin = document.querySelector("#modalFin");
            if (enemyLife == 0 && playerLife != 0) {
              document.getElementById("Enemy").classList.add("kill");
              modalFin.querySelector("h2").innerHTML =
                "Bravo, Vous avez battu dark " + enemyName + " !";
              modalFin.querySelector("p").innerHTML = "Vous avez débloqué une pièce de puzzle !";
              modalFin.querySelector("#retry").style.display = "none";
            } else {
              if (playerLife == 0) {
                document.getElementById("Player").classList.add("kill");
              }
              document.querySelector("#modalFin").querySelector("h2").innerHTML =
                "Dommage, vous n'avez pas réussi a battre dark " + enemyName + " !";
              document.querySelector("#modalFin").querySelector("p").innerHTML =
                "Demande des renseignements aux élèves / professeurs et retente ta chance !";
            }
            setTimeout(() => {
              document.querySelector("#modalFinWrapper").style.display = "flex";
            }, 1000);
            return;
          }

          answerHTML.innerHTML = "";
          questionHTML.innerHTML = questions["question" + questionNum].question;
          questions["question" + questionNum].reponses.forEach((reponse, key) => {
            let answers = createAnswer(reponse, key + 1);

            answers.forEach((element) => {
              answerHTML.appendChild(element);
            });
          });
          document.querySelector("#valider").disabled = false;
          break;
      }
      document
        .getElementById("valider")
        .setAttribute("onclick", "this.disabled=true;checkAnswer(" + questionNum + ");");
      return;
    });
  });
}

async function setQuestionV2() {
  console.log("setQuestionV2");
  questionRef = db.collection("Salles").where("salle", "==", parseInt(roomId));
  questionRef.get().then((querySnapshot) => {
    querySnapshot.forEach((doc) => {
      console.log(querySnapshot);
      data = doc.data();
      console.log(data);
      questionNum++;
      let questionHTML = document.querySelector(".question");
      let answerHTML = document.getElementById("Reponses");
      if (roomId == 19) {
        var reponses = [];
        var questions = [];
        questionQte = 2;
        if (questions.length == 0 && reponses.length == 0) {
          for (let i = 1; i <= 2; i++) {
            questions[i - 1] = data["question" + i].question;
            console.log(questions);
            reponses[i - 1] = data["question" + i].reponses;
            goodAnswers[i - 1] = data["question" + i].reponse;
          }
        }
        console.log("questions:", questions);
        currentQuestion = questions[questionNum - 1];
        currentReponses = reponses[questionNum - 1];
        questionHTML.innerHTML = currentQuestion;
        answerHTML.innerHTML = "";
        currentReponses.forEach((reponse, key) => {
          let answers = createAnswer(reponse, key + 1);
          answers.forEach((element) => {
            answerHTML.appendChild(element);
          });
        });
        document.querySelector("#valider").disabled = false;
        console.log(enemyLife);
        document
          .getElementById("valider")
          .setAttribute("onclick", "this.disabled=true;checkAnswerV2(" + questionNum + ");");
        return;
      } else {
        let question = data.question;
        let reponses = data.reponses;
        goodAnswers[0] = data.reponse;

        questionQte = 1;
        questionHTML.innerHTML = question;
        reponses.forEach((reponse, key) => {
          let answers = createAnswer(reponse, key + 1);

          answers.forEach((element) => {
            answerHTML.appendChild(element);
          });
        });
        document.querySelector("#valider").disabled = false;
        console.log(enemyLife);
        document
          .getElementById("valider")
          .setAttribute("onclick", "this.disabled=true;checkAnswerV2(1);");
        return;
      }
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
        setQuestionV2("next");
      } else {
        console.log("mauvaise reponse");
        let allCheckbox = document.querySelectorAll(".reponse");
        labelAnswer.classList.add("badAnswer");
        allCheckbox.forEach((checkbox) => {
          checkbox.setAttribute("disabled", "disabled");
        });
        await setLife(false);
        setQuestionV2("next");
      }
    });
  });
}
function checkAnswerV2(idAnswer) {
  let checkedAnswer = document.querySelector('input[name="reponse"]:checked');
  let labelAnswer = document.getElementById("reponseCheck" + checkedAnswer.id[7]);
  let answer = checkedAnswer.value;
  questionRef.get().then((querySnapshot) => {
    querySnapshot.forEach(async (doc) => {
      data = doc.data();
      goodAnswer = goodAnswers[idAnswer - 1];
      console.log("answer:", answer);
      console.log("good:", goodAnswer);
      if (goodAnswer == answer) {
        console.log("bonne reponse");
        labelAnswer.classList.add("goodAnswer");
        let allCheckbox = document.querySelectorAll(".reponse");
        allCheckbox.forEach((checkbox) => {
          checkbox.setAttribute("disabled", "disabled");
        });
        await setLife(true);
        if (roomId == 19 && questionNum < questionQte) {
          setQuestionV2();
        } else {
          endBattle(true);
        }
      } else {
        console.log("mauvaise reponse");
        let allCheckbox = document.querySelectorAll(".reponse");
        labelAnswer.classList.add("badAnswer");
        allCheckbox.forEach((checkbox) => {
          checkbox.setAttribute("disabled", "disabled");
        });
        await setLife(false);
        if (roomId == 19 && questionNum < questionQte) {
          setQuestionV2();
        } else {
          endBattle(false);
        }
      }
    });
  });
}

function endBattle(state) {
  if (enemyLife == 0 && playerLife != 0) {
    document.getElementById("Enemy").classList.add("kill");
    modalFin.querySelector("h2").innerHTML = "Bravo, Vous avez battu dark " + enemyName + " !";
    modalFin.querySelector("p").innerHTML = "Vous avez débloqué une pièce de puzzle !";
    modalFin.querySelector("#retry").style.display = "none";
  } else {
    if (playerLife == 0) {
      document.getElementById("Player").classList.add("kill");
    }
    document.querySelector("#modalFin").querySelector("h2").innerHTML =
      "Dommage, vous n'avez pas réussi a battre dark " + enemyName + " !";
    document.querySelector("#modalFin").querySelector("p").innerHTML =
      "Demande des renseignements aux élèves / professeurs et retente ta chance !";
  }
  setTimeout(() => {
    document.querySelector("#modalFinWrapper").style.display = "flex";
  }, 1000);
  return;
}
