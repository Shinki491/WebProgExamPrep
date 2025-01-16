const elements = ["anemo", "geo", "electro", "dendro", "hydro", "pyro", "cryo"];
let currEls = [];

const correct = [
  ["anemo", "anemo", "pyro", "pyro"],
  ["geo", "electro", "electro", "geo"],
  ["dendro", "hydro", "dendro", "hydro"],
  ["cryo", "cryo", "cryo", "cryo"]
];

const controls = document.querySelector("#controls");

// console.log(controls);

controls.addEventListener("input", (e) => {
  document.querySelector(("#" + e.target.id + "-output")).innerText = e.target.value;
});

const table = document.querySelector("table");
// console.log(table);

const genTable = function (rows, cols) {
  for (let i = 0; i < rows; i++){
    let elRow = [];
    let row = document.createElement("tr");
    for (let j = 0; j < cols; j++){
      let col = document.createElement("td");
      row.appendChild(col);
      elRow.push(0);
    }
    table.appendChild(row);
    currEls.push(elRow);
  }
};

controls.addEventListener("click", (e)=>{
  const rows = document.querySelector("#rows-output").innerText;
  const cols = document.querySelector("#cols-output").innerText;
  if (e.target.matches("button")){
    genTable(rows, cols);
    controls.style.display = "none" 
    if (rows == 4 && cols == 4){
      fbf = true;
    }
  }
});

table.addEventListener("click", (e) => {
  if (e.target.matches("td")){
    let cell = e.target;
    let rowID = cell.parentElement.rowIndex;
    let colID = cell.cellIndex; 
    let thisCurrEl = currEls[rowID][colID];
    console.log("Row:" + (rowID+1) + ", Col:" + (colID+1));
    if (cell.style.background == ""){
      cell.style.background = `url(${elements[thisCurrEl]}.webp)`;
      cell.style.backgroundSize = "contain";

    } else if (!cell.classList.contains("correct")) {
      thisCurrEl = thisCurrEl == 6 ? 0 : ++thisCurrEl;
      cell.style.background = `url(${elements[thisCurrEl]}.webp)`;
      cell.style.backgroundSize = "contain";
      currEls[rowID][colID] = thisCurrEl;
    }

    if (fbf){
      if (elements[thisCurrEl] == correct[rowID][colID]){
        cell.classList.add("correct");
      }
    }
  }
});

let fbf = false;

