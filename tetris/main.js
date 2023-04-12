document.addEventListener("DOMContentLoaded", () => {
  const grid = document.querySelector(".grid");
  let squares = Array.from(document.querySelectorAll(".grid div"));
  const scoreDisplay = document.querySelector("#score");
  const startBtn = document.querySelector("#start-btn");
  const width = 10;
  let nextRandom = 0;
  let score = 0;

  // The Tetrominoes
  const lTetromino = [
    [1, width+1, width*2+1, 2],
    [width, width+1, width+2, width*2+2],
    [1, width+1, width*2, width*2+1],
    [width, width*2, width*2+1, width*2+2]
  ];

  const zTetromino = [
    [width+1, width+2, width*2, width*2+1],
    [0, width, width+1, width*2+1],
    [width+1, width+2, width*2, width*2+1],
    [0, width, width+1, width*2+1]
  ];

  const tTetromino = [
    [1, width, width+1, width+2],
    [1, width+1, width+2, width*2+1],
    [width, width+1, width+2, width*2+1],
    [1, width, width+1, width*2+1]
  ];

  const oTetromino = [
    [0, 1, width, width+1],
    [0, 1, width, width+1],
    [0, 1, width, width+1],
    [0, 1, width, width+1],
  ];

  const iTetromino = [
    [1, width+1, width*2+1, width*3+1],
    [width, width+1, width+2, width+3],
    [1, width+1, width*2+1, width*3+1],
    [width, width+1, width+2, width+3]
  ];

  const theTetrominos = [lTetromino, zTetromino, tTetromino, oTetromino, iTetromino];

  let currentPosition = 4;
  let currentRotation = 0;

  // randomly select a Tetromino and its first rotation
  let random = Math.floor(Math.random() * theTetrominos.length);
  let current = theTetrominos[random][currentRotation];

  // draw the Tetromino
  function draw() {
    // indexで[0,1,10,11]などでtetrominoの位置を取得
    current.forEach(index => {
      // メインエリア(squares)でtetrominoを描画
      squares[currentPosition + index].classList.add("tetromino");
    })
  }

  // undraw the Tetromino
  function undraw() {
    current.forEach(index => {
      squares[currentPosition + index].classList.remove("tetromino");
    })
  }

  // assign function to keyCodes
  function control(e) {
    if(e.keyCode === 37){
      moveLeft();
    }
    else if(e.keyCode === 38){
      rotate();
    }
    else if(e.keyCode === 39){
      moveRight();
    }
    else if(e.keyCode === 40){
      moveDown();
    }
  }
  document.addEventListener("keyup",control);

  timerID = setInterval(moveDown,1000);
  function moveDown() {
    undraw();
    currentPosition += width;
    draw();
    freeze();
  }

  function freeze() {
    // some of the Tetrominoがメインエリアの最下部(.taken)に触ったら
    if(current.some(index => squares[currentPosition + index + width].classList.contains("taken"))) {
      current.forEach(index => squares[currentPosition + index].classList.add("taken"));
      // start a new tetromino falling
      random = nextRandom;
      nextRandom = Math.floor(Math.random() * theTetrominos.length);
      current = theTetrominos[random][currentRotation];
      currentPosition = 4;
      draw();
      displayShape();
      addScore();
      gameOver();
    }
  }

  // move the tetromino, unless is at the edge or there is a blockage
  function moveLeft() {
    undraw();
    const isAtLeftEdge = current.some(index => (currentPosition + index) % width ===0);
    if(!isAtLeftEdge) currentPosition -= 1;
    if(current.some(index => squares[currentPosition + index].classList.contains("taken"))){
      currentPosition += 1;
    }
    draw();
  }
  function moveRight() {
    undraw();
    const isAtRightEdge = current.some(index => (currentPosition + index) % width === width -1)
    if(!isAtRightEdge) currentPosition += 1;
    if(current.some(index => squares[currentPosition + index].classList.contains("taken"))){
      currentPosition -= 1;
    }
    draw();
  }
  // rotate the tetromino
  function rotate() {
    undraw();
    currentRotation ++;
    // if the current rotation gets to 4, make it go back to 0
    if(currentRotation === current.length) {
      currentRotation = 0;
    }
    current = theTetrominos[random][currentRotation];
    draw();
  }

  // show up next tetromino in mini-grid display
  const displaySquares = document.querySelectorAll(".mini-grid div");
  const displayWidth = 4;
  let displayIndex = 0;

  // the Tetrominos without rotations
  const upNextTrtrominos = [
      [1, displayWidth+1, displayWidth*2+1, 2], // lTetromino
      [displayWidth+1, displayWidth+2, displayWidth*2, displayWidth*2+1], // zTetromino
      [1, displayWidth, displayWidth+1, displayWidth+2], // tTetromino
      [0, 1, displayWidth, displayWidth+1], // oTetromino
      [1, displayWidth+1, displayWidth*2+1, displayWidth*3+1], // iTetromino
  ]

  // display the shape in the mini-grid display
  function displayShape() {
    // remove any trace of a tetromino from the entire grid(メインエリア)
    displaySquares.forEach(square => {
      square.classList.remove("tetromino");
    })
    upNextTrtrominos[nextRandom].forEach(index => {
      displaySquares[displayIndex + index].classList.add("tetromino");
    })
  }

  startBtn.addEventListener("click", () => {
    if(timerID) {
      clearInterval(timerID);
      timerID = null;
    }else{
      draw();
      timerID = setInterval(moveDown, 1000);
      nextRandom = Math.floor(Math.random() * theTetrominos.length);
      displayShape();
    }
  });

  function addScore() {
    for(let i=0; i<199; i+=width){
      const row = [i, i+1, i+2, i+3, i+4, i+5, i+6, i+7, i+8, i+9];
      if(row.every(index => squares[index].classList.contains("taken"))){
        score += 10;
        scoreDisplay.innerHTML = score;
        row.forEach(index => {
          squares[index].classList.remove("taken");
          squares[index].classList.remove("tetromino");
        })
        const squaresRemoved = squares.splice(i, width);
        squares = squaresRemoved.concat(squares);
        squares.forEach(cell => grid.appendChild(cell)); // cellを改めてgridの子要素として追加
      }
    }
  }

  function gameOver() {
    if(current.some(index => squares[currentPosition + index].classList.contains("taken"))) {
      scoreDisplay.innerHTML = "end";
      clearInterval(timerID);
    }
  }


});

