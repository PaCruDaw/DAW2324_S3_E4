$(document).ready(function() {
    var table;

    $.ajax({
        url: "http://localhost/controladores/controladortraducciones.php",
        success: function(data) {
            table = $('#table_translate').DataTable({
                data: data,
                columns: [
                    { data: "TraduccionIdiomaID" },
                    { data: "Traduccion" },
                    { data: "TextoOriginal" },
                    { data: "Idioma" },
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
            $('#table_translate tbody').on('click', '.btn-editar', function() {
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
        formulario += '<input type="hidden" name = "traduccion_id" id="traduccion_id" value="' + data.TraduccionIdiomaID + '">';    
        formulario += '<label for="traduccion">Traducción:</label>\t';
        formulario += '<input type="text" name = "nueva_traduccion" id="nueva_traduccion" value="' + data.Traduccion + '">';
        formulario += '<br>';
        formulario += '<button type="submit" class="btn btn-success btn-guardar">Guardar</button>';
        formulario += '</form>';

        return formulario;
    }

    $('#idioma').on('change', function() {
        // Obtiene el valor seleccionado en el desplegable
        var valorSeleccionado = $(this).val();
    
        // Aplica el filtro global
        table.search(valorSeleccionado).draw();
    });
});

