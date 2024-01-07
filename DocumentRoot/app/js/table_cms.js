document.addEventListener("DOMContentLoaded", function() {
    var table;

    $.ajax({
        url: "http://localhost/controladores/controladorMostrarCms.php",
        method: 'GET',
            dataType: 'json',
            success: function(datos) {
            table = $('#tableCms').DataTable({
            data: datos,
            columns: [
                    
                    { data: "policy" },
                    { data: "policyValue" },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return '<button class="btn btn-warning btn-editar">Editar</button>';
                        }
                    }
                ],
                keys: true
            });

            // Manejar clic en el botón para editar en línea
            $('#tableCms tbody').on('click', '.btn-editar', function() {
                var tr = $(this).closest('tr');
                var row = table.row(tr);

                if (row.child.isShown()) {
                    // Si la fila ya está en modo de edición, cancela la edición
                    row.child.hide();
                    tr.removeClass('shown');
                } else {
                    // De lo contrario, inicia la edición
                    row.child(format(row.data())).show();
                    tr.addClass('shown');
                }
            });
        }
    });

    // Función para formatear la fila de edición
    function format(data) {
        // Puedes personalizar este formulario según tus necesidades
        var formulario = '<form class="form-edicion" method = "post" action = "#">';
        formulario += '<input type="hidden" name = "idCms" id="idCms" value="' + data.idCms + '">';    
        formulario += '<label for="traduccion">Valor:</label>\t';
        formulario += '<input type="text" name = "policyValue" id="policyValue" value="' + data.policyValue + '">';
        formulario += '<br>';
        formulario += '<button type="submit" class="btn btn-success btn-guardar">Guardar</button>';
        formulario += '</form>';

        return formulario;
    }

});