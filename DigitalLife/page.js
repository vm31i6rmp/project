// ハンバーグメニュー
const navMenu = document.querySelector(".header-nav");
const hamBtn = document.querySelector("#ham-btn");
const circleContainer = document.querySelector(".circle-btn-container");
hamBtn.addEventListener("click", () => {
  hamBtn.classList.toggle("open");
  navMenu.classList.toggle("open");
  // circleContainer.classList.toggle("open");
});
navMenu.addEventListener("click", () => {
  hamBtn.classList.remove("open");
  navMenu.classList.remove("open");
  // circleContainer.classList.remove("open");
})

// 一番上に戻る
// const BackToTopBtn = document.querySelector(".circle-btn-top");
// BackToTopBtn.addEventListener("click", (e) => {
//   e.preventDefault();
//   window.scrollTo({
//     top: 0,
//     behavior: "smooth",
//   });
// });

const header = document.querySelector(".header");
window.addEventListener("scroll", () => {
  if(window.pageYOffset > 80) {
    header.classList.add("fixed");
  } else {
    header.classList.remove("fixed");
  }
});


// スムーズにスクロール
var indexLink = document.querySelectorAll('a[href^="#"]');
  for (let i=0; i<indexLink.length; i++){
    indexLink[i].addEventListener('click', (e) => {
      e.preventDefault();
      let href = indexLink[i].getAttribute('href');
      let targetElement = document.getElementById(href.replace('#', ''));
      const nowOffset = window.pageYOffset;
      const targetOffset = targetElement.getBoundingClientRect().top;
      const gap = 100;
      const offset = nowOffset + targetOffset - gap;
      window.scrollTo({
        top: offset,
        behavior: 'smooth',
      });
    });
  }
