function toggleMenu() {
    const dropdown = document.getElementById("dropdown");
    const arrow = document.querySelector(".arrow-down");

  
    dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";

    
    arrow.classList.toggle("up");
}


window.onclick = function(event) {
    if (!event.target.matches('.user-name')) {
        const dropdown = document.getElementById("dropdown");
        if (dropdown && dropdown.style.display === "block") {
            dropdown.style.display = "none";
        }
    }
}
