var dates = [];
var ventes = [];

fetch("http://localhost:8000/dbventes", {
  method: "GET",
  headers: {
    "X-API-Key": "my_api_key"
  }
})
.then(response => {
    if (!response.ok) {
      throw new Error("Error en la solicitud");
    }
    return response.json();
  })
.then(data => {
    // Llenar las variables con los datos obtenidos
    for (var i = 0; i < data.length; i++) {
      dates.push(data[i].fecha);
      ventes.push(data[i].total_precio);
    }

    // Ahora, puedes utilizar las variables dates y ventes para crear el gráfico
const ctx = document.getElementById('chart1');

new Chart(ctx, {
    type: 'bar',
    data: {
    labels: dates,
    datasets: [{
        label: 'Ventes',
        data: ventes, // Usamos las ventas obtenidas
        borderWidth: 1
    }]
    },
    options: {
    scales: {
        y: {
        beginAtZero: true
        }
    }
    }
});
})
.catch(error => {
console.error("Error en la creación de la gráfica:", error);
});
