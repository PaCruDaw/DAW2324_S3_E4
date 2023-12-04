$(document).ready(function() {
    $.ajax({
        url: "http://localhost/controladores/controladortraducciones.php",
        success: function(data) {
            var table = $('#table_translate').DataTable({
                data: data,
                "columns": [
                    { "data": "TraduccionIdiomaID" },
                    { "data": "Traduccion" },
                    { "data": "TextoOriginal" },
                    { "data": "Idioma" },
                    {
                        data: null,
                        className: 'dt-center editor-delete',
                        defaultContent: '<button>Eliminar</button>',
                        orderable: false 
                    }
                ]
            })
            table.on('click', 'button', function (e) {
                var fila = table.row($(this).closest('tr'));
                if (confirm("¿Estás seguro de que deseas eliminar esta fila?")) {
                    fila.remove().draw();
                    var allData = table.rows().data().toArray();
                    localStorage.setItem("paisosData", JSON.stringify(allData));
                }
            });  
        }
    });
});
