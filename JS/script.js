
// Menu Burger


const logoBurger = document.getElementById('logoBurger');
const menuBurger = document.querySelector('.burger');


logoBurger.addEventListener('click', function(event) { 
    menuBurger.classList.toggle('active');
    logoBurger.classList.toggle('active');  

    let rotationAngle = logoBurger.classList.contains('active') ? 360 : 0; 
    logoBurger.style.transition = "transform 0.8s"; 
    logoBurger.style.transform = `rotate(${rotationAngle}deg)`; 

    event.stopPropagation();
});

document.addEventListener('click', function(event) { 
    if (!menuBurger.contains(event.target) && !logoBurger.contains(event.target)) {
        menuBurger.classList.remove('active');
        logoBurger.classList.remove('active'); 

        logoBurger.style.transition = "transform 0.8s"; 
        logoBurger.style.transform = "rotate(0deg)"; 
    }
});


