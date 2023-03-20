// ハンバーグメニュー
const hamBtn = document.querySelector(".btn-ham");
const navMenu = document.querySelector(".header-inner nav");
hamBtn.addEventListener("click",function(){
  hamBtn.classList.toggle("close");
  navMenu.classList.toggle("close");
});

// スクロールすると固定メニューが出る
const header = document.querySelector(".header");
const fv = document.querySelector(".fv");
const targetHeight = fv.getBoundingClientRect().bottom;
window.addEventListener("scroll",function(){
  if(window.innerWidth > 768){
    if(window.pageYOffset > targetHeight){
      header.classList.add("fixed");
    }
    else{
      header.classList.remove("fixed");
    }
  }
});

// スライダー(slickを使用するには、jQueryが必須)
$('.slider').slick({
  autoplay: true,
  autoplaySpeed: 2000,
  fade: true,
  speed: 1000,  // fadeのスピード
  cssEase: 'linear'
});
