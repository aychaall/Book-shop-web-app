let navbar = document.querySelector('.header .main-header .navbar');
let accountBox = document.querySelector('.header .user-box');


document.querySelector('#menu-btn').onclick = () => {
    navbar.classList.toggle('show-menu');
    accountBox.classList.remove('show-account');
}

document.querySelector('#user-btn').onclick = () => {
    accountBox.classList.toggle('show-account');
    navbar.classList.remove('show-menu');
}

window.onscroll = () => {
    navbar.classList.remove('show-menu');
    accountBox.classList.remove('show-account');

    if (window.scrollY > 60) {
        document.querySelector('.header .main-header').classList.add('sticky');
    } else {
        document.querySelector('.header .main-header').classList.remove('sticky');
    }
}