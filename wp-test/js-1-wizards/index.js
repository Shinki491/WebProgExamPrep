const task1 = document.querySelector("#task1");
const task2 = document.querySelector("#task2");
const task3 = document.querySelector("#task3");
const task4 = document.querySelector("#task4");
const task5 = document.querySelector("#task5");

console.log(wizards);

let youngWizAmount = 0;

wizards.forEach((wizard) => {
    if (wizard.age < 100){
        youngWizAmount ++;
    }
});

task1.innerHTML = youngWizAmount;

let wizAmount = 0;
let wizAgeSum = 0;

wizards.forEach((wizard) => {
    wizAgeSum += wizard.age;
    wizAmount++;
});

task2.innerHTML = wizAgeSum/ wizAmount;

let oldWizName = wizards[0].name;
let oldWizAge = wizards[0].age;

wizards.forEach((wizard) => {
    if (wizard.age > oldWizAge){
        oldWizName = wizard.name;
        oldWizAge = wizard.age;
    }
});

task3.innerHTML = oldWizName;

let highExp = wizards[0].xp;    
let oldExp;

wizards.forEach((wizard) => {
    if (wizard.name == oldWizName){
        oldExp = wizard.xp;
    }
    if ( wizard.xp > highExp){
        highExp = wizard.xp;
    }
});

let oldhigh = highExp == oldExp;

task4.innerHTML = oldhigh;

let word = "Fire";
let fireStr = "";
let first = true;

wizards.forEach((wizard) => {
    wizard.spells.forEach((spell) => {
        if (spell.match(word) != null){
            if (first){
                fireStr = fireStr + spell;
                first = false;
            } else {
                fireStr = fireStr + ", " + spell;
            }
        }
    });
});

// let fireStr = wizards
//     .flatMap(wizard => wizard.spells) // Combine all spells into one array
//     .filter(spell => spell.includes(word)) // Keep only spells with "Fire"
//     .join(", "); // Join them into a single string with commas


task5.innerHTML = fireStr;