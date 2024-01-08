document.addEventListener('DOMContentLoaded', function () {
    const apiKey = 'my_api_key';  // Reemplaza 'TuAPIKey' con tu propia API Key

    // Configura la URL de la API
    const apiUrl = 'http://localhost:8000/clients_month';

    // Configura la cabecera de la solicitud con la API Key
    const headers = new Headers({
        'X-API-Key': apiKey,
        'Content-Type': 'application/json'
    });

    // Configura los detalles de la solicitud
    const requestOptions = {
        method: 'GET',
        headers: headers,
    };

    fetch(apiUrl, requestOptions)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`Error al obtener datos desde la API: ${response.status} - ${response.statusText}`);
                    }
                    return response.json();
                })
                .then(data => {
                    // Supongamos que la respuesta de la API contiene un array de objetos con la propiedad 'membershipDate'
                    const membershipDates = data.map(item => new Date(item.membershipDate));

                    // Agrupa las fechas por año
                    const groupedByYear = membershipDates.reduce((acc, date) => {
                        const year = date.getFullYear();
                        acc[year] = (acc[year] || 0) + 1;
                        return acc;
                    }, {});

                    // Configura tus datos para Chart.js
                    const labels = Object.keys(groupedByYear);
                    const valores = Object.values(groupedByYear);

                    // Obtén el contexto del lienzo
                    const ctx = document.getElementById('myChart').getContext('2d');

                    // Crea el gráfico utilizando Chart.js
                    const myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Miembros por año',
                                data: valores,
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    stepSize: 1  // Establece el paso en el eje y a 1
                                }
                            }
                        }
                    });
                })
                .catch(error => console.error('Error al obtener datos desde la API:', error));
    });