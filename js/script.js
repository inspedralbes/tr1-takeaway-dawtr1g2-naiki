
const content = document.querySelector('.content');

content.addEventListener('mouseover', () => {
    content.style.transform = 'scale(1.1)';
});

content.addEventListener('mouseout', () => {
    content.style.transform = 'scale(1)';
});
