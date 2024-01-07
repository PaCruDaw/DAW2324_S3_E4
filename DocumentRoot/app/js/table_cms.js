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
                    { data: "idCms" },
                    { data: "idPolicy" },
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
            $('#table_cms tbody').on('click', '.btn-editar', function() {
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
        var formulario = '<form class="form-edicion" method = "post" action = "../controladores/controladortraducciones.php">';
        formulario += '<input type="hidden" name = "traduccion_id" id="traduccion_id" value="' + data.idTranslation + '">';    
        formulario += '<label for="traduccion">Traducción:</label>\t';
        formulario += '<input type="text" name = "nueva_traduccion" id="nueva_traduccion" value="' + data.translation + '">';
        formulario += '<br>';
        formulario += '<button type="submit" class="btn btn-success btn-guardar">Guardar</button>';
        formulario += '</form>';

        return formulario;
    }

});