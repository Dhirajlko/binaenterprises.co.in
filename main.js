// Generate floating shapes
const shapesContainer = document.getElementById('shapes');
for(let i = 0; i < 14; i++) {
    let shape = document.createElement('div');
    shape.classList.add('shape');
    let size = Math.random() * 180 + 40;
    shape.style.width = size + 'px';
    shape.style.height = size + 'px';
    shape.style.top = Math.random() * 100 + '%';
    shape.style.left = Math.random() * 100 + '%';
    shape.style.animationDelay = Math.random() * 12 + 's';
    shape.style.animationDuration = Math.random() * 20 + 12 + 's';
    shapesContainer.appendChild(shape);
}

// 3D Tilt Effect for Cards
const tiltElements = document.querySelectorAll('.tilt-card, .floating-card');
tiltElements.forEach(el => {
    el.addEventListener('mousemove', (e) => {
        const rect = el.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        const centerX = rect.width / 2;
        const centerY = rect.height / 2;
        const rotateX = (y - centerY) / 20;
        const rotateY = (centerX - x) / 20;
        el.style.transform = `perspective(800px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale(1.02)`;
    });
    el.addEventListener('mouseleave', () => {
        el.style.transform = 'perspective(800px) rotateX(0deg) rotateY(0deg) scale(1)';
    });
});

// Hero Card Mouse Move Effect
const heroCard = document.getElementById('hero3dCard');
if(heroCard) {
    document.addEventListener('mousemove', (e) => {
        let x = (window.innerWidth / 2 - e.clientX) / 50;
        let y = (window.innerHeight / 2 - e.clientY) / 50;
        heroCard.style.transform = `perspective(800px) rotateY(${x}deg) rotateX(${y}deg) translateZ(10px)`;
    });
}