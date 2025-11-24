// Invertimos los arrays para mostrar de 2018 a 2025
const labels = window.labelsCotizacion.slice().reverse();
const datosCotizacion = window.valoresCotizacion.slice().reverse();
const datosUSD = window.valoresUSD.slice().reverse();

// Gráfico Cotización en pesos
const ctxCot = document.getElementById('graficoCotizacion').getContext('2d');
new Chart(ctxCot, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Cotización USD (pesos)',
            data: datosCotizacion,
            backgroundColor: 'rgba(15, 105, 165, 0.7)',
            borderColor: 'rgba(15, 105, 165, 0.7)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            title: { display: true, text: 'Cotización USD (pesos)' },
            legend: { display: false }
        },
        scales: {
            y: { beginAtZero: true }
        }
    }
});

// Gráfico Cantidad USD
const ctxUSD = document.getElementById('graficoUSD').getContext('2d');
new Chart(ctxUSD, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Cantidad USD',
            data: datosUSD,
            backgroundColor: 'rgba(2, 131, 66, 0.71)',
            borderColor: 'rgba(2, 131, 66, 0.71)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            title: { display: true, text: 'Cantidad USD por Mes' },
            legend: { display: false }
        },
        scales: {
            y: { beginAtZero: true }
        }
    }
});
