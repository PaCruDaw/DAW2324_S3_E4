
document.addEventListener("DOMContentLoaded", function() {
var table;
$.ajax({
            url: 'http://localhost/controladores/controladorMostrarUsuaris.php',
            method: 'GET',
            dataType: 'json',
            success: function(datos) {
            table = $('#tableUsuaris').DataTable({
            data: datos,
            columns: [
                
                { data: "idClient" },
                { data: "name" },
                { data: "surnames" },
                { data: "username" },
                { data: "password" },
                { data: "mail" },
                { data: "phone" },
                { data: "address" },
                { data: "postcode" },
                { data: "idCountry" },
                { data: "membershipDate" },
                { data: "clientStatus" },
                
                {
                  data: null,
                  render: function(data, type, row) {
                      return '<button class="btn btn-warning btn-editar">Editar</button>';
                  }
                }
                    ],
                keys: true
            });
            },
            error: function(error) {
                console.error('Error en la petición:', error);
            }
        });
        $('#tableUsuaris tbody').on('click', '.btn-editar', function () {
          var tr = $(this).closest('tr');
          var rowData = table.row(tr).data();
          var modalContent = `
          <form method="post" action="#" style="margin-top:3%;">
            
            <div class="mb-3">
                <input type="hidden" id="idClientU" name="idClientU" value="${rowData.idClient}">
                <input type="hidden" id="action" name="action" value="update">
                <label for="nameU" class="form-label">Nombre:</label>
                <input type="text" class="form-control" id="nameU" name="nameU" value="${rowData.name}">
                <div class="error-message" id="error-nameU"></div>
            </div>

            <div class="mb-3">
                <label for="surnameU" class="form-label">Apellido/s:</label>
                <input type="text" class="form-control" id="surnameU" name="surnameU" value="${rowData.surnames}">
                <div class="error-message" id="error-surnameU"></div>
            </div>

            <div class="mb-3">
                <label for="usernameU" class="form-label">Nombre de usuario:</label>
                <input type="text" class="form-control" id="usernameU" name="usernameU" value="${rowData.username}">
                <div class="error-message" id="error-usernameU"></div>
            </div>

            <div class="mb-3">
                <label for="passwordU" class="form-label">Contraseña:</label>
                <input type="password" class="form-control" id="passwordU" name="passwordU" value="${rowData.password}">
                <!-- Mensaje de error para la contraseña -->
                <div class="error-message" id="error-passwordU"></div>
            </div>
            
            <div class="mb-3">
                <label for="emailU" class="form-label">Email:</label>
                <input type="email" class="form-control" id="emailU" name="emailU" value="${rowData.mail}">
                <!-- Mensaje de error para el correo electrónico -->
                <div class="error-message" id="error-emailU"></div>
            </div>

            <div class="mb-3">
                <label for="phoneU" class="form-label">Teléfono:</label>
                <input type="text" class="form-control" id="phoneU" name="phoneU" value="${rowData.phone}">
                <!-- Mensaje de error para el nombre de usuario -->
                <div class="error-message" id="error-phoneU"></div>
            </div>

            <div class="mb-3">
                <label for="addressU" class="form-label">Dirección:</label>
                <input type="text" class="form-control" id="addressU" name="addressU" value="${rowData.address}">
                <!-- Mensaje de error para el nombre de usuario -->
                <div class="error-message" id="error-addressU"></div>
            </div>

            <div class="mb-3">
                <label for="postcodeU" class="form-label">Codigo postal:</label>
                <input type="text" class="form-control" id="postcodeU" name="postcodeU" value="${rowData.postcode}">
                <!-- Mensaje de error para el nombre de usuario -->
                <div class="error-message" id="error-postcodeU"></div>
            </div>

            <div class="mb-3">
                <label for="idCountryU" class="form-label">Pais:</label>
                <select class="form-select" id="idCountryU" name="idCountryU" value="${rowData.idCountry}">
                    <option value="1">País 1</option>
                    // <option value="2">País 2</option>
                    // <option value="3">País 3</option>
                </select>
                <div class="error-message" id="error-idCountryU"></div>
            </div>

            <div class="mb-3">
                <label for="clientStatusU" class="form-label">Estatus:</label>
                <select class="form-select" id="clientStatusU" name="clientStatusU" value="${rowData.clientStatus}">
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                    <option value="Banned">Banned</option>
                    <option value="Deleted">Deleted</option>

                </select>
                <div class="error-message" id="error-clientStatusU"></div>
            </div>

            <button type="submit" class="btn btn-primary" name="accion" value="actualizar">Guardar Usuario</button>
        </form>
        `
    $('#userInfo').empty();
    $('#userInfo').html(modalContent);
          
    var infoModal = new bootstrap.Modal(document.getElementById('infoModal'));
    infoModal.show();
    });
});