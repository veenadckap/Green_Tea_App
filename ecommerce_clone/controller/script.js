const header = document.querySelector('header');
function fixedNavbar() {
    header.classList.toggle('scroll',window.pageYOffset > 0)
}
fixedNavbar();
window.addEventListener('scroll', fixedNavbar)

let menu = document.querySelector('#menu-btn');
let userBtn = document.querySelector('#user-btn');

menu.addEventListener('click', function () {
  let nav =document.querySelector('.navbar')
    nav.classList.toggle('active')
})
userBtn.addEventListener('click', function () {
   let userBox = document.querySelector('.user-box');
   userBox.classList.toggle('active')
})
//-------------------home page slider----------------------------------------
"use strict";

// Ensure DOM is fully loaded
document.addEventListener('DOMContentLoaded', function () {
    const leftArrow = document.querySelector('.left-arrow .bxs-left-arrow'),
        rightArrow = document.querySelector('.right-arrow .bxs-right-arrow'),
        slider = document.querySelector('.slider');

    // Logging to verify elements are selected
    console.log(leftArrow, rightArrow, slider);

    // Function to scroll right
    function scrollRight() {
        console.log('Scrolling right');
        if (slider.scrollWidth - slider.clientWidth === slider.scrollLeft) {
            slider.scrollTo({
                left: 0,
                behavior: "smooth"
            });
        } else {
            slider.scrollBy({
                left: window.innerWidth,
                behavior: "smooth"
            });
        }
    }

    // Function to scroll left
    function scrollLeft() {
        console.log('Scrolling left');
        slider.scrollBy({
            left: -window.innerWidth,
            behavior: "smooth"
        });
    }

    // Set interval for auto-scrolling
    let timerId = setInterval(scrollRight, 7000);

    // Function to reset the timer
    function resetTimer() {
        clearInterval(timerId);
        timerId = setInterval(scrollRight, 7000);
    }

    // Event listener for right arrow click
    slider.addEventListener('click', function (ev) {
        if (ev.target.closest('.right-arrow')) {
            scrollRight();
            resetTimer();
        }
    });

    // Event listener for left arrow click
    slider.addEventListener('click', function (ev) {
        if (ev.target.closest('.left-arrow')) {
            scrollLeft();
            resetTimer();
        }
    });
});
//----------------------testimonial slide----------------------------------------------------
document.addEventListener('DOMContentLoaded', (event) => {
    let slides = document.querySelectorAll('.testimonial-item');
    let index = 0;

    function nextSlide() {
        slides[index].classList.remove('active');
        index = (index + 1) % slides.length;
        slides[index].classList.add('active');
    }

    function prevSlide() {
        slides[index].classList.remove('active');
        index = (index - 1 + slides.length) % slides.length;
        slides[index].classList.add('active');
    }


    window.nextSlide = nextSlide;
    window.prevSlide = prevSlide;
});
