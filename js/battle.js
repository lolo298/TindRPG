playerLife = 2;
enemyLife = 2;
function endTurn(type) {
  if (type == "player") {
    setLife(document.querySelector("#num").value, document.getElementById("PlayerLife"), "player");
  } else if (type == "enemy") {
    setLife(document.querySelector("#num").value, document.getElementById("EnemyLife"), "enemy");
  }
}

async function setLife(state, lifeBar, type) {
  let delayVal = 50;
  switch (state) {
    case "2":
      if (type == "player") {
        if (playerLife == 1) {
          for (let i = 45; i <= 93; i++) {
            lifeBar.style.maxWidth = i + "px";
            lifeBarColor(i, lifeBar);
            await delay(delayVal);
          }
        } else if (playerLife == 0) {
          for (let i = 0; i <= 93; i++) {
            lifeBar.style.maxWidth = i + "px";
            lifeBarColor(i, lifeBar);
            await delay(delayVal);
          }
        }
        playerLife = 2;
      } else if (type == "enemy") {
        if (enemyLife == 1) {
          for (let i = 45; i <= 93; i++) {
            lifeBar.style.maxWidth = i + "px";
            lifeBarColor(i, lifeBar);
            await delay(delayVal);
          }
        } else if (enemyLife == 0) {
          for (let i = 0; i <= 93; i++) {
            lifeBar.style.maxWidth = i + "px";
            lifeBarColor(i, lifeBar);
            await delay(delayVal);
          }
        }
        enemyLife = 2;
      }
      break;
    case "1":
      if (type == "player") {
        if (playerLife == 2) {
          for (let i = 93; i >= 45; i--) {
            lifeBar.style.maxWidth = i + "px";
            lifeBarColor(i, lifeBar);
            await delay(delayVal);
          }
        } else if (playerLife == 0) {
          for (let i = 0; i <= 45; i++) {
            lifeBar.style.maxWidth = i + "px";
            lifeBarColor(i, lifeBar);
            await delay(delayVal);
          }
        }
        playerLife = 1;
      } else if (type == "enemy") {
        if (enemyLife == 2) {
          for (let i = 93; i >= 45; i--) {
            lifeBar.style.maxWidth = i + "px";
            lifeBarColor(i, lifeBar);
            await delay(delayVal);
          }
        } else if (enemyLife == 0) {
          for (let i = 0; i <= 45; i++) {
            lifeBar.style.maxWidth = i + "px";
            lifeBarColor(i, lifeBar);
            await delay(delayVal);
          }
        }
        enemyLife = 1;
      }
      break;
    case "0":
      if (type == "player") {
        if (playerLife == 2) {
          for (let i = 93; i >= 0; i--) {
            lifeBar.style.maxWidth = i + "px";
            lifeBarColor(i, lifeBar);
            await delay(delayVal);
          }
        } else if (playerLife == 1) {
          for (let i = 45; i >= 0; i--) {
            lifeBar.style.maxWidth = i + "px";
            lifeBarColor(i, lifeBar);
            await delay(delayVal);
          }
        }
        playerLife = 0;
      } else if (type == "enemy") {
        if (enemyLife == 2) {
          for (let i = 93; i >= 0; i--) {
            lifeBar.style.maxWidth = i + "px";
            lifeBarColor(i, lifeBar);
            await delay(delayVal);
          }
        } else if (enemyLife == 1) {
          for (let i = 45; i >= 0; i--) {
            lifeBar.style.maxWidth = i + "px";
            lifeBarColor(i, lifeBar);
            await delay(delayVal);
          }
        }
        enemyLife = 0;
      }
      break;
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
