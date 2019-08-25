var collboard = document.getElementsByClassName('callboard');
var text = document.getElementsByClassName('callboard__text');
var header = document.getElementsByClassName('callboard__header');


for(let i=0; i<collboard.length; i++) {
    collboard[i].addEventListener('mouseenter', (e) => {
          e.target.style.overflow = "auto";
          text[i].style.opacity = 1;
          header[i].style.top = '1rem';
    }, true)
}
