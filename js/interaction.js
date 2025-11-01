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


// Modal steps 
const steps = document.querySelectorAll('.home .modal .container .steps .status .step')
const separator = document.querySelector('.home .modal .container .steps .status .separator')

let activeStep = 0; 
steps[activeStep].classList.add('active')

steps.forEach((step, index) => {
    step.addEventListener('click', () => {
        activeStep = index
        steps.forEach(step => step.classList.remove('active'))
        step.classList.add('active')

        let percentageComplete; 
        let percentage; 

        console.log(steps.length)

        percentage = 100 / steps.length
        if (activeStep != 0) {
            percentageComplete = Math.floor(percentage * (activeStep + 1))
            separator.style.background = `linear-gradient(to right, var(--accent) ${percentageComplete - 10}%, var(--light) 50%)`
            console.log(separator.style.background)
            console.log(percentageComplete)
        }
       





    })
})

