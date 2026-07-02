// Select DOM elements
const list = document.querySelector('.slider .list');
const items = document.querySelectorAll('.slider .list .item');
const dots = document.querySelectorAll('.slider .dots li');
const prev = document.getElementById('prev');
const next = document.getElementById('next');

// Initialize variables
let active = 0;
const lengthItems = items.length - 1;

// Next button event
next.onclick = function () {
    active = active + 1 > lengthItems ? 0 : active + 1;
    reloadSlider();
};

// Previous button event
prev.onclick = function () {
    active = active - 1 < 0 ? lengthItems : active - 1;
    reloadSlider();
};

// Auto-slide every 4 seconds
let refreshSlider = setInterval(() => next.click(), 4000);

// Reload slider function
function reloadSlider() {
    // Move the slider to the active item's position
    const checkLeft = items[active].offsetLeft;
    list.style.left = -checkLeft + 'px';

    // Update active dot
    const lastActiveDot = document.querySelector('.slider .dots li.active');
    lastActiveDot?.classList.remove('active');
    dots[active].classList.add('active');

    // Reset auto-slide interval
    clearInterval(refreshSlider);
    refreshSlider = setInterval(() => next.click(), 4000);
}

// Dot click events
dots.forEach((li, key) => {
    li.addEventListener('click', () => {
        active = key;
        reloadSlider();
    });
});