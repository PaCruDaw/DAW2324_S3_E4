$(document).ready(function () {
    $.getJSON('../controladores/controladorProductos.php', function (data){
        console.log(data)
        $('#productsTable').DataTable({
        "data": data,
                "columns": [
                    { "data": 'idProduct', "title": 'Id Producto' },
                    { "data": 'idVariant', "title": 'Id Variante' }, 
                    { "data": 'variantName', "title": 'Producto' },
                    { "data": 'size', "title": 'Tamaño' },
                    { "data": 'format_width', "title": 'formato_anchura' },
                    { "data": 'format_height', "title": 'formato_altura' },
                    { "data": 'currency', "title": 'Moneda' },
                    {
                        "data": 'showProduct', 
                        "title": 'showProduct',
                        "render": function (data, type, row) {
                            return '<input type="checkbox" class="showProductCheckbox" data-id="' + row.idVariant + '" ' + (data == 1 ? 'checked' : '') + '>';
                        }
                    },
                    { data: 'marginPercentage', title: 'Porcentaje Beneficio' }
                ]
            });
            });

            // $('#productsTable tbody').on('change', '.showProductCheckbox', function () {
            //     var idVariant = $(this).data('id');
            //     var showProduct = this.checked ? 1 : 0;

            //     $.ajax({
            //         url: '../controladores/controladorProductos.php',
            //         method: 'POST',
            //         data: { idVariant: idVariant, showProduct: showProduct },
            //         dataType: 'json',
            //         success: function (response) {
            //             if (response.success) {
            //                 console.log('Estado actualizado exitosamente');
            //             } else {
            //                 console.error('Error al actualizar el estado');
            //             }
            //         },
            //         error: function (error) {
            //             console.error('Error en la solicitud AJAX: ', error);
            //         }
            //     });
            // });
        });