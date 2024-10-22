document.querySelector('.btn-white-outline').addEventListener('click', function(event) {
    event.preventDefault(); 
    const targetId = this.getAttribute('href'); 
    const targetElement = document.querySelector(targetId); 
    targetElement.scrollIntoView({
        behavior: 'smooth' 
    });
});

