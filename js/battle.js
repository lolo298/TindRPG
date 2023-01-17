spinner(true);
playerLife = 2;
enemyLife = 2;
goodAnswers = [];
let Load = [];
questionNum = 0;
questionQte = 0;
let completeRooms = {};
let userRef = db.collection("Users").doc(sessionStorage.getItem("id"));
setup();
async function setup() {

  await userRef.get().then((doc) => {
    data = doc.data();
    completeRooms = data.salles;
    if (completeRooms[roomId]) {
      document.querySelector("#modalFin").querySelector("h2").innerHTML =
        "Vous avez déja compléter cette salle !";
      document.querySelector("#modalFin").querySelector("p").innerHTML =
        "Vous pouvez retourner à la carte pour en choisir une autre !";
      document.querySelector(".puzzle-container").style.display = "none";
      document.querySelector("#modalFinWrapper").querySelector("#retry").style.display = "none";
      document.querySelector("#modalFinWrapper").style.display = "flex";
    }
  });

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
    Load.push(setQuestion("first"));
    return true;
  });

  Promise.all(Load).then(() => {
    spinner(false);
    Load = [];
  });
}

/**
 *Permet de reduire les points de vie de l'ennemi ou de notre personnage
 *@param {boolean} state true = ennemi false = joueur
 *@async
 */
async function setLife(state) {
  // let delayVal = 50;
  let delayVal = 5;
  if (state) {
    enemyLifeBar = document.getElementById("EnemyLife");
    if (questionQte == 2) {
      enemyLife--;
      if (enemyLife == 1) {
        for (let i = 93; i >= 45; i--) {
          enemyLifeBar.style.maxWidth = i + "px";
          lifeBarColor(i, enemyLifeBar);
          await delay(delayVal);
        }
      } else if (enemyLife == 0) {
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
        for (let i = 93; i >= 45; i--) {
          playerLifeBar.style.maxWidth = i + "px";
          lifeBarColor(i, playerLifeBar);
          await delay(delayVal);
        }
      } else if (playerLife == 0) {
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

/**
 *Verifie quelle couleur doit etre appliquée a la barre de vie
 *@param {number} val nombre de point de vie
 *@param {HTMLElement} target element html de la barre de vie
 */
function lifeBarColor(val, target) {
  if (val >= 46) {
    target.style.backgroundColor = "#74e3a0";
  } else if (val >= 15) {
    target.style.backgroundColor = "#f3dd5d";
  } else if (val <= 14) {
    target.style.backgroundColor = "#da3327";
  }
}

/**
 *Permet de mettre en pause le code
 *@param {number} ms temps en milliseconde
 */
function delay(ms) {
  return new Promise((resolve) => setTimeout(resolve, ms));
}

/**
 * Permet de charger les questions de la salle depuis la base de données
 * @async
 */
async function setQuestion() {
  document.querySelector("#valider").disabled = true;
  document.querySelector("#valider").classList.add("disabled");
  questionRef = db.collection("Salles").where("salle", "==", parseInt(roomId));
  questionRef.get().then((querySnapshot) => {
    querySnapshot.forEach((doc) => {
      data = doc.data();
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
            reponses[i - 1] = data["question" + i].reponses;
            goodAnswers[i - 1] = data["question" + i].reponse;
          }
        }
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
        document
          .getElementById("valider")
          .setAttribute("onclick", "this.disabled=true;checkAnswer(" + questionNum + ");");
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
        document
          .getElementById("valider")
          .setAttribute("onclick", "this.disabled=true;checkAnswer(1);");
        return;
      }
    });
  });
}

/**
 * Créer les éléments HTML pour les réponses
 * @param {string} answer réponse
 * @param {number} id id de la réponse
 */
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
  label.setAttribute("onclick", 'document.querySelector("#valider").disabled = false;document.querySelector("#valider").classList.remove("disabled");');
  return [input, label];
}

/**
 * Vérifie si la réponse est la bonne
 * @param {number} idAnswer id de la question
 */
function checkAnswer(idAnswer) {
  let checkedAnswer = document.querySelector('input[name="reponse"]:checked');
  let labelAnswer = document.getElementById("reponseCheck" + checkedAnswer.id[7]);
  let answer = checkedAnswer.value;
  questionRef.get().then((querySnapshot) => {
    querySnapshot.forEach(async (doc) => {
      data = doc.data();
      goodAnswer = goodAnswers[idAnswer - 1];
      if (goodAnswer == answer) {
        labelAnswer.classList.add("goodAnswer");
        let allCheckbox = document.querySelectorAll(".reponse");
        allCheckbox.forEach((checkbox) => {
          checkbox.setAttribute("disabled", "disabled");
        });
        await setLife(true);
        if (roomId == 19 && questionNum < questionQte) {
          setQuestion();
        } else {
          if (enemyLife == 0) {
            endBattle(true);
          } else {
            endBattle(false);
          }
        }
      } else {
        let allCheckbox = document.querySelectorAll(".reponse");
        labelAnswer.classList.add("badAnswer");
        allCheckbox.forEach((checkbox) => {
          checkbox.setAttribute("disabled", "disabled");
        });
        await setLife(false);
        if (roomId == 19 && questionNum < questionQte) {
          setQuestion();
        } else {
          endBattle(false);
        }
      }
    });
  });
}

/**
 * Termine le combat et fais apparaitre le menu de fin
 * @param {boolean} state true si le joueur a gagné, false sinon
 */
function endBattle(state) {
  if (state) {
    document.getElementById("Enemy").classList.add("kill");
    modalFin.querySelector("h2").innerHTML = "Bravo, Vous avez battu dark " + enemyName + " !";
    modalFin.querySelector("p").innerHTML = "Vous avez débloqué une pièce de puzzle !";
    modalFin.querySelector("#retry").style.display = "none";
    completeRooms[roomId] = true;
    userRef.update({
      salles: completeRooms
    });
    nbPieces = 1;
    for (val of Object.values(completeRooms)) {
      if (val) {
        nbPieces++;
      }
    }
    document.getElementById("battleEnd").href = "./carte.php?pieces=" + nbPieces + '&roomId=' + roomId;
  } else {
    if (playerLife == 0) {
      document.getElementById("Player").classList.add("kill");
    }
    document.querySelector(".puzzle-container").style.display = "none";
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
