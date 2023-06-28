const btnHam = document.querySelector(".ham");
const hpNav = document.querySelector(".hp-nav");
const mask = document.querySelector(".mask");

btnHam.addEventListener("click", function(){
  btnHam.classList.toggle("active");
  hpNav.classList.toggle("active");
  mask.classList.toggle("active");
});

mask.addEventListener("click", function(){
  btnHam.classList.remove("active");
  hpNav.classList.remove("active");
  mask.classList.remove("active");
});