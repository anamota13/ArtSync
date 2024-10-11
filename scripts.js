function toggleMenu() {
    const dropdown = document.getElementById("dropdown");
    const arrow = document.querySelector(".arrow-down");

    // Alterna a visibilidade do menu suspenso
    dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";

    // Alterna a seta para cima ou para baixo
    arrow.classList.toggle("up");
}

// Fecha o menu se o usuário clicar fora dele
window.onclick = function(event) {
    if (!event.target.matches('.user-name')) {
        const dropdown = document.getElementById("dropdown");
        if (dropdown && dropdown.style.display === "block") {
            dropdown.style.display = "none";
        }
    }
}
