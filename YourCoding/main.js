// ハンバーグメニュー
const hamBtn = document.querySelector(".ham");
const cover = document.querySelector(".cover");
const navMenu = document.querySelector(".header-nav");
hamBtn.addEventListener("click",function(){
  hamBtn.classList.toggle("open");
  cover.classList.toggle("open");
  navMenu.classList.toggle("open");
});
cover.addEventListener("click",function(){
  hamBtn.classList.remove("open");
  cover.classList.remove("open");
  navMenu.classList.remove("open");
});
navMenu.addEventListener("click",function(){
  hamBtn.classList.remove("open");
  cover.classList.remove("open");
  navMenu.classList.remove("open");
});

// スムーズにスクロールする
let indexLink = document.querySelectorAll('a[href^="#"]');
window.addEventListener("load", () => {
  for(i=0; i<indexLink.length; i++){
    if(indexLink[i].hash){
      const nowOffset = window.pageYOffset;
      const targetElement = document.querySelector(indexLink[i].hash);
      const targetOffset = targetElement.getBoundingClientRect().top;
      const offset = nowOffset + targetOffset - 90;
      indexLink[i].addEventListener("click",(e) => {
        e.preventDefault();
        window.scrollTo({
          top: offset,
          behavior: "smooth",
        });
      });
    }
  }
});

// 質問をクリックすると該当する回答が現る
$(document).ready(function(){
  $('.faq dt').click(function(){
    // $(this).next().slideToggle();
    $(this).next().toggleClass('open');
  });
  $('.faq dd').click(function(){
    $(this).removeClass('open');
  });
});