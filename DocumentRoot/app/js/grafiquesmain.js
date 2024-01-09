var datesusuarisorders = [];
var registresusuarisorders = [];
var datesusuarisregister = [];
var registresusuarisregister = [];
var table1;
var table2;

fetch("http://localhost:8000/orders_month", {
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
        datesusuarisorders.push(data[i].Mes);
        registresusuarisorders.push(data[i].TotalOrders);
    }

    // Ahora, puedes utilizar las variables dates y ventes para crear el gráfico
const chartCercle = document.getElementById('chart1');

new Chart(chartCercle, {
    type: 'bar',
    data: {
    labels: datesusuarisorders,
    datasets: [{
        label: 'Registres per mes',
        data: registresusuarisorders, // Usamos las ventas obtenidas
        borderWidth: 1,
        backgroundColor: '#9BD0F5'
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

fetch("http://localhost:8000/resgiter_month", {
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
        datesusuarisregister.push(data[i].Mes);
        registresusuarisregister.push(data[i].TotalClientes);
    }

    // Ahora, puedes utilizar las variables dates y ventes para crear el gráfico
const chartBarres = document.getElementById('chart4');

new Chart(chartBarres, {
    type: 'pie',
    data: {
    labels: datesusuarisregister,
    datasets: [{
        label: 'Registres per mes',
        data: registresusuarisregister, // Usamos las ventas obtenidas
        borderWidth: 1,
        backgroundColor: '#9BD0F5'
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

$.ajax({
    url: "http://localhost/controladores/controladorMostrarCms.php",
    method: 'GET',
        dataType: 'json',
        success: function(datos) {
        table = $('#tablemain1').DataTable({
        data: datos,
        columns: [
                
                { data: "policy" },
                { data: "policyValue" }
            ],
            keys: true
        });

    }
});

$.ajax({
    url: "http://localhost/controladores/controladorMostrarCms.php",
    method: 'GET',
        dataType: 'json',
        success: function(datos) {
        table = $('#tablemain2').DataTable({
        data: datos,
        columns: [
                
                { data: "policy" },
                { data: "policyValue" }
            ],
            keys: true
        });

    }
});

})
.catch(error => {
console.error("Error en la creación de la gráfica:", error);
});

// const chartLineal = document.getElementById('chart3');
// new Chart(chartLineal, {
//     type: 'bar',
//     data: {
//     labels: dates,
//     datasets: [{
//         label: 'Ventes',
//         data: ventes, // Usamos las ventas obtenidas
//         borderWidth: 1,
//         backgroundColor: '#9BD0F5'
//     },
//     {
//         label: 'Ventes',
//         data: ventes, // Usamos las ventas obtenidas
//         borderWidth: 1,
//         backgroundColor: '#9BD0F5'
//     },
//     {
//         label: 'Ventes',
//         data: ventes, // Usamos las ventas obtenidas
//         borderWidth: 1,
//         backgroundColor: '#9BD0F5'
//     }]
//     },
//     options: {
//     scales: {
//         y: {
//         beginAtZero: true
//         }
//     }
//     }
// });

// const chartFormatge = document.getElementById('chart4');
// new Chart(chartFormatge, {
//     type: 'pie',
//     data: {
//     labels: dates,
//     datasets: [{
//         label: 'Ventes',
//         data: ventes, // Usamos las ventas obtenidas
//         borderWidth: 1,
//         backgroundColor: '#9BD0F5'
//     },
//     {
//         label: 'Ventes',
//         data: ventes, // Usamos las ventas obtenidas
//         borderWidth: 1,
//         backgroundColor: '#9BD0F5'
//     },
//     {
//         label: 'Ventes',
//         data: ventes, // Usamos las ventas obtenidas
//         borderWidth: 1,
//         backgroundColor: '#9BD0F5'
//     }]
//     },
//     options: {
//     scales: {
//         y: {
//         beginAtZero: true
//         }
//     }
//     }
// });




