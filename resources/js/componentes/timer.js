// Funcion temporizador pregunta
export function iniciarContador() {
    document.addEventListener('DOMContentLoaded', (event) => {
        let contadorElement = document.getElementById('contador');
        let tiempoExpiradoElement = document.getElementById('tiempo_expirado');
        let tiempoRestante = parseInt(contadorElement.innerText);
    
        function actualizarContador() {
            if (tiempoRestante > 0) {
                tiempoRestante--;
                contadorElement.innerText = tiempoRestante;
            } else {
                tiempoExpiradoElement.value = '1';
            }
        }
    
        setInterval(actualizarContador, 1000);
    });
    
}
