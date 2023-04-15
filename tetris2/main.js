const FIELD_COL = 10;
const FIELD_ROW = 20;
const BLOCK_SIZE = 30;
const CANVAS_WIDTH = BLOCK_SIZE * FIELD_COL;
const CANVAS_HEIGHT = BLOCK_SIZE * FIELD_ROW;
const TETROMINO_SIZE = 4; // tetrominoのサイズ
const BACKGROUND_COLOR = "#333";
const NEXT_CANVAS_WIDTH = BLOCK_SIZE * TETROMINO_SIZE;
const NEXT_CANVAS_HEIGHT = BLOCK_SIZE * TETROMINO_SIZE;
const LEVEL = document.querySelector("#level");
const SCORE = document.querySelector("#score");
const LINE = document.querySelector("#line");
const pauseBtn = document.querySelector("#pause-btn");
const restartBtn = document.querySelector("#restart-btn");
const hintBtn = document.querySelector("#hint-btn");
const pauseBtnTxt = document.querySelector("#pause-btn-txt");
const upBtn = document.querySelector("#keyboard-btn-up");
const leftBtn = document.querySelector("#keyboard-btn-left");
const downBtn = document.querySelector("#keyboard-btn-down");
const rightBtn = document.querySelector("#keyboard-btn-right");
const spaceBtn = document.querySelector("#keyboard-btn-space");

let canvas = document.querySelector("#canvas");
let ctx = canvas.getContext("2d"); // canvas要素は、getContext()メソッドで描画する
let nextCanvas = document.querySelector("#next-canvas");
let nextCtx = nextCanvas.getContext("2d");
canvas.width = CANVAS_WIDTH;
canvas.height = CANVAS_HEIGHT;
canvas.style.border = "2px solid #000";
nextCanvas.width = NEXT_CANVAS_WIDTH;
nextCanvas.height = NEXT_CANVAS_HEIGHT;
nextCanvas.style.border = "1px solid #ccc";

let dropSpeed = 1000;
const levelUp = 10;
const START_X = FIELD_COL/2 - TETROMINO_SIZE/2;
const START_Y = 0;
let line = 0;
let score = 0;
let level = 1;
let isHint = false;
let isGameOver = false;

// tetrominoの本体
let tetrominos = [             // 三次元配列
  [],
  [
    [0, 0, 0, 0],
    [1, 1, 1, 1],
    [0, 0, 0, 0],
    [0, 0, 0, 0],
  ],
  [
    [0, 1, 0, 0],
    [0, 1, 0, 0],
    [0, 1, 1, 0],
    [0, 0, 0, 0],
  ],
  [
    [0, 0, 1, 0],
    [0, 0, 1, 0],
    [0, 1, 1, 0],
    [0, 0, 0, 0],
  ],
  [
    [0, 0, 0, 0],
    [0, 1, 0, 0],
    [1, 1, 1, 0],
    [0, 0, 0, 0],
  ],
  [
    [0, 0, 0, 0],
    [0, 1, 1, 0],
    [0, 1, 1, 0],
    [0, 0, 0, 0],
  ],
  [
    [0, 0, 0, 0],
    [1, 1, 0, 0],
    [0, 1, 1, 0],
    [0, 0, 0, 0],
  ],
  [
    [0, 0, 0, 0],
    [0, 1, 1, 0],
    [1, 1, 0, 0],
    [0, 0, 0, 0],
  ]
]
let random = Math.floor(Math.random() * (tetrominos.length - 1)) + 1;
let nextRandom = Math.floor(Math.random() * (tetrominos.length - 1)) + 1;
let tetromino = tetrominos[random]; // 二次元配列

// tetrominoの色
const tetrominoColors = [
  BACKGROUND_COLOR,
  "#6CF",
  "#F92",
  "#66F",
  "#C5C",
  "#FD2",
  "#F44",
  "#5B5",
  "#999"
];

// tetrominoの座標
let currentX = START_X;
let currentY = START_Y;

// fieldの中身
let field = []; // 二次元配列を定義することができないので、まず一次元配列として宣言

// ゲーム開始
init();
draw();
displayNext();
timerID = setInterval(drop, dropSpeed);

// 自動落下
function drop() {
  if(isGameOver)return;
  if(checkMove(0,1)) {
    currentY++;
  } else {
    fix();
    checkLine();
    random = nextRandom;
    nextRandom = Math.floor(Math.random() * (tetrominos.length - 1)) + 1;
    tetromino = tetrominos[random];
    currentX = START_X;
    currentY = START_Y; // 新しいtetrominoを生成
    if(!checkMove(0,0)){
      isGameOver = true;
    }
  }
  displayNext();
  draw();
}

// tetrominoを固定
function fix() {
  for(let y=0; y<TETROMINO_SIZE; y++){
    for(let x=0; x<TETROMINO_SIZE; x++){
      if(tetromino[y][x]){
        field[currentY + y][currentX + x] = random;
      }
    }
  }
}

// 揃ったラインを消す
function checkLine() {
  let linesCount = 0;
  for(let y=0; y<FIELD_ROW; y++){
    let isLine = true;
    for(let x=0; x<FIELD_COL; x++){
      if(field[y][x] === 0){
        isLine = false;
        break;
      }
    }
    if(isLine) { // ラインが揃ったら
      linesCount++;
      for(let ny=y; ny>0; ny--){ // 揃ったラインから一番上まで
        for(let nx=0; nx<FIELD_COL; nx++){
          field[ny][nx] = field[ny-1][nx]; // 上から一列落ちる
        }
      }
    }
  }
  if(linesCount) {
    line += linesCount;
    score += linesCount * linesCount * 100;
    LINE.innerHTML = line;
    SCORE.innerHTML = score;
  }
  let nextLevel = Math.floor(line / levelUp) + 1;
  if(nextLevel > level){
    dropSpeed -= 100;
    level++;
    LEVEL.innerHTML = level;
    clearInterval(timerID);
    timerID = null;
    timerID = setInterval(drop, dropSpeed);
  }
}

// 次のtetrominoを表示
function displayNext() {
  nextCtx.clearRect(0,0,CANVAS_WIDTH,CANVAS_HEIGHT);
  // for(let y=0; y<TETROMINO_SIZE; y++) {
  //   for(let x=0; x<TETROMINO_SIZE; x++) {
  //       drawNextBlock(x,y,field[y][x]); // 空白のfieldも色を付ける
  //   }
  // }
  for(let y=0; y<TETROMINO_SIZE; y++) {
    for(let x=0; x<TETROMINO_SIZE; x++) {
      let nextTetromino = tetrominos[nextRandom];
      if(nextTetromino[y][x]) {
        drawNextBlock(x,y,nextRandom);
      }
    }
  }
}

// field初期化
function init() {
  for(let y=0; y<FIELD_ROW; y++){
    field[y] = [];
    for(let x=0; x<FIELD_COL; x++){
      field[y][x] = 0;
    }
  }
  ctx.clearRect(0,0,CANVAS_WIDTH,CANVAS_HEIGHT); // canvasをクリアしてから次の位置で描画
  LEVEL.innerHTML = 1;
  LINE.innerHTML = 0;
  SCORE.innerHTML = 0;
}

// 一つの block を描画
function drawBlock(x,y,color) {
  let px = x * BLOCK_SIZE;
  let py = y * BLOCK_SIZE;
  ctx.fillStyle = tetrominoColors[color]; // 塗りつぶしの色を指定
  ctx.fillRect(px,py,BLOCK_SIZE,BLOCK_SIZE); // 塗りつぶしの起点(x,y)と範囲(width,height)
  ctx.strokeStyle = BACKGROUND_COLOR; // 枠の色を指定
  ctx.lineWidth = 2;
  ctx.strokeRect(px,py,BLOCK_SIZE,BLOCK_SIZE); // 枠の起点と範囲
}

// 一つの block を描画(次のtetromino用)
function drawNextBlock(x,y,color) {
  let px = x * BLOCK_SIZE;
  let py = y * BLOCK_SIZE;
  nextCtx.fillStyle = tetrominoColors[color];
  nextCtx.fillRect(px,py,BLOCK_SIZE,BLOCK_SIZE);
  nextCtx.lineWidth = 2;
  nextCtx.strokeStyle = "#fff";
  nextCtx.strokeRect(px,py,BLOCK_SIZE,BLOCK_SIZE);
}
// 一つの block を描画(ヒントのtetromino用)
function drawHintBlock(x,y,color) {
  let px = x * BLOCK_SIZE;
  let py = y * BLOCK_SIZE;
  ctx.fillStyle = tetrominoColors[color];
  ctx.fillRect(px,py,BLOCK_SIZE,BLOCK_SIZE);
  ctx.lineWidth = 2;
  ctx.strokeStyle = "#444";
  ctx.strokeRect(px,py,BLOCK_SIZE,BLOCK_SIZE);
}

// fieldの描画、tetrominoの描画、hintの描画、gameoverの描画
function draw() {
  ctx.clearRect(0,0,CANVAS_WIDTH,CANVAS_HEIGHT); // canvasをクリアしてから次の位置で描画
  for(let y=0; y<FIELD_ROW; y++) {
    for(let x=0; x<FIELD_COL; x++) {
      // if(field[y][x]) {
        drawBlock(x,y,field[y][x]); // 空白のfieldも色を付ける
      // }
    }
  }
  for(let y=0; y<TETROMINO_SIZE; y++) {
    for(let x=0; x<TETROMINO_SIZE; x++) {
      if(tetromino[y][x]) {
        drawBlock(currentX + x, currentY + y,random);
      }
    }
  }
  let plus = 0;
  if(isHint) {
    while(checkMove(0, plus+1))plus++;
    for(let y=0; y<TETROMINO_SIZE; y++) {
      for(let x=0; x<TETROMINO_SIZE; x++) {
        if(tetromino[y][x]) {
          drawHintBlock(currentX + x, currentY + y + plus, 0);
          drawBlock(currentX + x, currentY + y, random);
        }
      }
    }
  }
  if(isGameOver){
    let text = "GAME OVER";
    ctx.font = "60px 'Oswald'";
    let w = ctx.measureText(text).width;
    let x = CANVAS_WIDTH/2 - w/2;
    let y = CANVAS_HEIGHT/2 + 20;
    // ctx.lineWidth = 4;
    // ctx.strokeText(text,x,y);
    ctx.fillStyle = "rgba(0,0,0,0.5";
    ctx.fillRect(0,0,CANVAS_WIDTH,CANVAS_HEIGHT);
    ctx.fillStyle = "#fff";
    ctx.fillText(text,x,y);
  }
}

// blockの衝突判定
function checkMove(mx,my,rotateTetromino = tetromino) { // デフォルト引数として定義
  for(let y=0; y<TETROMINO_SIZE; y++) {
    for(let x=0; x<TETROMINO_SIZE; x++) {
      if(rotateTetromino[y][x]) {
        let nx = currentX + mx + x;
        let ny = currentY + my + y;
        if(
          ny < 0 || nx < 0 || ny >= FIELD_ROW || nx >= FIELD_COL || // field外になったらダメ
          field[ny][nx] // 新しい位置のfieldに何かがあったらダメ
          ) {
            return false;
          }
      }
    }
  }
  return true;
}

// tetrominoを回転
function rotate() {
  let rotateTetromino = [];
  for(let y=0; y<TETROMINO_SIZE; y++) {
    rotateTetromino[y] = [];
    for(let x=0; x<TETROMINO_SIZE; x++) {
      rotateTetromino[y][x] = tetromino[TETROMINO_SIZE-1-x][y];
    }
  }
  return rotateTetromino;
}

// キーボード操作
document.onkeydown = function(e) {
  if(isGameOver)return;
  switch(e.keyCode) { // 条件分岐
    case 37: // 左
    if(timerID){
      if(checkMove(-1,0))currentX--;
      break;
    }
    case 38: // 上
    if(timerID){
      let rotateTetromino = rotate();
      if(checkMove(0,0,rotateTetromino))tetromino = rotateTetromino;
      break;
    }
    case 39: // 右
    if(timerID){
      if(checkMove(1,0))currentX++;
      break;
    }
    case 40: // 下
    if(timerID){
      if(checkMove(0,1))currentY++;
      break;
    }
    case 32: // スペース
    if(timerID){
      while(checkMove(0,1))currentY++; // 一気に一番下まで移動
      break;
    }
  }
  draw();
}

// ボタン操作
// ヒントボタン
hintBtn.addEventListener("click", () => {
  if(isHint) isHint = false;
  else isHint = true;
  draw();
});

// 新ゲームボタン
restartBtn.addEventListener("click", () => {
  clearInterval(timerID);
  isGameOver = false;
  init();
  random = Math.floor(Math.random() * (tetrominos.length - 1)) + 1;
  nextRandom = Math.floor(Math.random() * (tetrominos.length - 1)) + 1;
  tetromino = tetrominos[random]; // 二次元配列
  currentX = START_X;
  currentY = START_Y;
  draw();
  displayNext();
  timerID = setInterval(drop, dropSpeed);
});

// 一時停止・再開ボタン
pauseBtn.addEventListener("click", () => {
  if(timerID) {
    clearInterval(timerID);
    timerID = null;
    document.images["pause-btn"].src = "img/play.png"
    pauseBtnTxt.innerHTML = "Play";
  } else {
    draw();
    timerID = setInterval(drop, dropSpeed);
    document.images["pause-btn"].src = "img/pause.png"
    pauseBtnTxt.innerHTML = "Pause";
  }
});

// キーボードボタン
upBtn.addEventListener("click", () => {
  if(timerID){
    let rotateTetromino = rotate();
    if(checkMove(0,0,rotateTetromino))tetromino = rotateTetromino;
    draw();
  }
});
leftBtn.addEventListener("click", () => {
  if(timerID){
    if(checkMove(-1,0))currentX--;
    draw();
  }
});
downBtn.addEventListener("click", () => {
  if(timerID){
    if(checkMove(0,1))currentY++;
    draw();
  }
});
rightBtn.addEventListener("click", () => {
  if(timerID){
    if(checkMove(1,0))currentX++;
    draw();
  }
});
spaceBtn.addEventListener("click", () => {
  if(timerID){
    while(checkMove(0,1))currentY++;
    draw();
  }
});