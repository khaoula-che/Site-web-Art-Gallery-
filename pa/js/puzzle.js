choiceImg = Math.floor(Math.random()*4);

switch (choiceImg){
    case 1:
        choice1 = "../image2/";
    break;
    case 2:
        choice1 = "../image3/";
    break;
    case 3:
        choice1 = "../image4/";
    break;
  ;
}

var rows = 3;
var columns = 3;

var currTile;
var otherTile; 

var turns = 0;
let imgOrder = [1, 2, 3, 4, 5, 6, 7, 8, 9];
let imgOrderTermine = [1, 2, 3, 4, 5, 6, 7, 8, 9];

function shuffleArray(array) {
  for (let i = array.length - 1; i > 0; i--) {
    const j = Math.floor(Math.random() * (i + 1));
    [array[i], array[j]] = [array[j], array[i]];
  }
  return array;
}

imgOrder = shuffleArray(imgOrder);

window.onload = function() {
    for (let r=0; r < rows; r++) {
        for (let c=0; c < columns; c++) {
            let tile = document.createElement("img");
            tile.id = r.toString() + "-" + c.toString();
            tile.src = choice1 + imgOrder.shift() + ".jpg";

            tile.addEventListener("dragstart", dragStart);  
            tile.addEventListener("dragover", dragOver);    
            tile.addEventListener("dragenter", dragEnter);  
            tile.addEventListener("dragleave", dragLeave);  
            tile.addEventListener("drop", dragDrop);       
            tile.addEventListener("dragend", dragEnd);      

            document.getElementById("board").append(tile);

        }
    }
}

function dragStart() {
    currTile = this; 
}

function dragOver(e) {
    e.preventDefault();
}

function dragEnter(e) {
    e.preventDefault();
}

function dragLeave() {

}

function dragDrop() {
    otherTile = this; 
}

function checkPuzzle() {
  for (let r = 0; r < rows; r++) {
    for (let c = 0; c < columns; c++) {
      let tile = document.getElementById(r.toString() + "-" + c.toString());
      let expectedSrc = imgOrderTermine[r * columns + c] + ".jpg";
      if (tile.src.indexOf(expectedSrc) === -1) {
        return false;
      }
    }
  }
  return true;
}

function dragEnd() {
    let currImg = currTile.src;
    let otherImg = otherTile.src;

    currTile.src = otherImg;
    otherTile.src = currImg;

    if (checkPuzzle()) {
        document.location.href="mail-vérification.php";
    }
}



