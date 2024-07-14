// Función para incrementar y mostrar el contador de visitas
function incrementarVisitas(pagina) {
    // Clave única para el contador de visitas de cada página
    const VISITAS_KEY = `visitas_${pagina}`;
    
    // Obtener el número de visitas desde localStorage
    let visitas = localStorage.getItem(VISITAS_KEY);
    
    if (!visitas) {
        visitas = 0; // Si no hay visitas, inicializar en 0
    } else {
        visitas = parseInt(visitas); // Convertir el valor a un número entero
    }
    
    // Incrementar el contador de visitas y actualizar el DOM
    visitas++;
    localStorage.setItem(VISITAS_KEY, visitas);
    document.getElementById("visitas").textContent = visitas;
}

// Llamar a esta función en cada página con la clave específica
document.addEventListener("DOMContentLoaded", function () {
    // La clave específica debe ser pasada en la etiqueta <script> en cada página
});
