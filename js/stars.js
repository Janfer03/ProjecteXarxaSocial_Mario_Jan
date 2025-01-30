document.addEventListener("DOMContentLoaded", () => {
    const starContainer = document.getElementById("falling-stars");

    function createFallingStar() {
        const star = document.createElement("div");
        star.classList.add("star");

        // Posición inicial aleatoria
        const startX = Math.random() * window.innerWidth;
        star.style.left = `${startX}px`;

        // Velocidad y dirección aleatoria
        const duration = Math.random() * 2 + 1; // Entre 1 y 3 segundos
        star.style.animationDuration = `${duration}s`;

        // Añadir al contenedor
        starContainer.appendChild(star);

        // Eliminar la estrella después de la animación
        star.addEventListener("animationend", () => {
            star.remove();
        });
    }

    // Crear estrellas periódicamente
    setInterval(createFallingStar, 300); // Una estrella cada 300ms
});