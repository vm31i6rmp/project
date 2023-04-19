// ハンバーグメニュー
const navMenu = document.querySelector(".header-nav");
const hamBtn = document.querySelector("#ham-btn");
// const cover = document.querySelector("#cover");
hamBtn.addEventListener("click", () => {
  hamBtn.classList.toggle("open");
  navMenu.classList.toggle("open");
  // cover.classList.toggle("open");
});
navMenu.addEventListener("click", () => {
  hamBtn.classList.remove("open");
  navMenu.classList.remove("open");
  // cover.classList.remove("open");
})
// cover.addEventListener("click", () => {
//   hamBtn.classList.remove("open");
//   navMenu.classList.remove("open");
//   cover.classList.remove("open");
// })

// スムーズにスクロール
let indexLink = document.querySelectorAll("a[href^='#']");
document.addEventListener("load", () => {
  for(i=0; i<indexLink; i++) {
    if(indexLink[i].hash) {
      const nowOffset = window.pageYOffset;
      const targetElement = document.querySelector(indexLink[i].hash);
      const targetOffset = targetElement.getBoundingClientRect().top;
      const offset = nowOffset + targetOffset;
      indexLink[i].addEventListener("click", (e) => {
        e.preventDefault();
        window.scrollTo({
          top: offset,
          behavior: "smooth",
        });
      });
    }
  }
});

// スクロールすると固定メニューが出る
// const header = document.querySelector(".header");
// const fv = document.querySelector(".fv");
// const targetHeight = fv.getBoundingClientRect().bottom;
// window.addEventListener("scroll",function(){
//   if(window.innerWidth > 768){
//     if(window.pageYOffset > targetHeight){
//       header.classList.add("fixed");
//     }
//     else{
//       header.classList.remove("fixed");
//     }
//   }
// });