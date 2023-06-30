const btnHam = document.querySelector(".ham");
const hpNav = document.querySelector(".hp-nav");
const mask = document.querySelector(".mask");

btnHam.addEventListener("click", function() {
  btnHam.classList.toggle("active");
  hpNav.classList.toggle("active");
  mask.classList.toggle("active");
});

mask.addEventListener("click", function() {
  btnHam.classList.remove("active");
  hpNav.classList.remove("active");
  mask.classList.remove("active");
});

// ページをリロードしてもスクロール位置を保持
$(window).scroll(function() {
  sessionStorage.scrollTop = $(this).scrollTop();
});
$(document).ready(function() {
  if (sessionStorage.scrollTop != "undefined") {
    $(window).scrollTop(sessionStorage.scrollTop);
  }
});

// ユーザー情報スクロールメニュー
// const btnUserInfo = document.querySelector("#menu-item-user");
// const userInfoList = document.querySelector(".user-info-list");
// btnUserInfo.addEventListener("mouseover", () => {
//   userInfoList.classList.add("active");
// });
// btnUserInfo.addEventListener("mouseout", () => {
//   userInfoList.classList.remove("active");
// });

$(function(){
  $("#menu-item-user").mouseover(function(){
    $(this).children(".user-info-list").stop().slideDown();
  });
  $("#menu-item-user").mouseout(function(){
    $(".user-info-list").stop().slideUp();
  });
  $("#menu-item-user-sp").click(function(){
    $(this).children(".user-info-list").stop().slideDown();
  });
  $("#menu-item-user-sp").click(function(){
    $(".user-info-list").stop().slideUp();
  });
});