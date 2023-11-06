let currentSlide = 0;
const slides = document.querySelectorAll('.carousel-slide');

function mostrarSiguiente() {
    slides[currentSlide].style.display = 'none';
    currentSlide = (currentSlide + 1) % slides.length;
    slides[currentSlide].style.display = 'block';
}

function mostrarAnterior() {
    slides[currentSlide].style.display = 'none';
    currentSlide = (currentSlide - 1 + slides.length) % slides.length;
    slides[currentSlide].style.display = 'block';
}

// Mostrar la primera imagen al cargar la página
slides[currentSlide].style.display = 'block';

// Configurar un temporizador para avanzar automáticamente
setInterval(mostrarSiguiente, 3000);

// Mostrar los botones de flecha cuando se pasa el ratón sobre el carrusel
const carousel = document.querySelector('.carousel');
carousel.addEventListener('mouseover', () => {
    document.querySelectorAll('.carousel-button').forEach((button) => {
        button.style.display = 'block';
    });
});

// Ocultar los botones de flecha cuando se retira el ratón del carrusel
carousel.addEventListener('mouseout', () => {
    document.querySelectorAll('.carousel-button').forEach((button) => {
        button.style.display = 'none';
    });
});