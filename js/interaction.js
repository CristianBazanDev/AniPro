// User menu 

const userIcon = document.querySelector('.profile-icon')
const userMenu = document.querySelector('header .user-options')

userIcon.addEventListener('click', () => {
    userMenu.classList.toggle('active')
})


document.body.addEventListener('click', (e) => {
    if (!userMenu.contains(e.target) && !userIcon.contains(e.target)) {
        userMenu.classList.remove('active');
    }
});