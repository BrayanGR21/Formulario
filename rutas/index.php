<!-- Formulario de registro -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Transporte Escolar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <link href="js/confirm/css/jquery-confirm.css" rel="stylesheet">

    <!--<script src="js/jquery/js/jquery.min.js"></script>-->
    <script src="js/validatejs/js/jquery.validate.js"></script>
    <script src="js/validatejs/js/localization/messages_es.js"></script>
    <script src="js/validatejs/js/additional-methods.js"></script>
    
    <script src="js/confirm/js/jquery-confirm.js"></script>

    <script>
      $(function () {
        $.ajax({
          url: 'php/app/data/buscar_colonia.php',
          dataType: 'json',
          success: function (data) {
            $("#colonia").autocomplete({
              minLength: 3,
              source: data,
              dropdown: {
                maxItems: 20
              }
            });
          }
        });
      });
    </script>

    <script>
      $(function () {
        $.ajax({
          url: 'php/app/data/buscar_colonia.php',
          dataType: 'json',
          success: function (data) {
            $("#colonia_tutor").autocomplete({
              minLength: 3,
              source: data,
              dropdown: {
                maxItems: 20
              }
            });
          }
        });
      });
    </script>

</head>
<body>
    <div class="container mt-5">
        <h2>Ficha de Datos Personales para Uso del Transporte</h2>
        <form id="frm-registro" action="php/api.php" method="POST">
            <!-- Datos del Estudiante -->
            <h3>Datos del Estudiante</h3>
            <div class="row">
                <div class="mb-3 col-md-4">
                    <label for="apellido_paterno" class="form-label">Apellido Paterno:</label>
                    <input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno" required>
                </div>
                <div class="mb-3 col-md-4">
                    <label for="apellido_materno" class="form-label">Apellido Materno:</label>
                    <input type="text" class="form-control" id="apellido_materno" name="apellido_materno" required>
                </div>
                <div class="mb-3 col-md-4">
                    <label for="nombres" class="form-label">Nombre(s):</label>
                    <input type="text" class="form-control" id="nombres" name="nombres" required>
                </div>
            </div>

            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="calle" class="form-label">Calle y No.:</label>
                    <input type="text" class="form-control" id="calle" name="calle" required>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="entre_calles" class="form-label">Entre Calles:</label>
                    <input type="text" class="form-control" id="entre_calles" name="entre_calles" required>
                </div>
            </div>
            
            <div class="row">
                <div class="mb-3 col-md-4">
                    <label for="colonia" class="form-label">Colonia:</label>
                    <input type="text" class="form-control" id="colonia" name="colonia" required>
                </div>
                <div class="mb-3 col-md-4">
                    <label for="municipio" class="form-label">Municipio:</label>
                    <input type="text" class="form-control" id="municipio" name="municipio" required>
                </div>
                <div class="mb-3 col-md-4">
                    <label for="estado" class="form-label">Estado:</label>
                    <input type="text" class="form-control" id="estado" name="estado" required>
                </div>
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="esAltamira" onchange="llenarCamposAltamira()">
                <label class="form-check-label" for="esAltamira">
                    ¿Es una colonia de Altamira?
                </label>
            </div>
            
            <!-- Si es que es de Altamira -->
            <script>
            function llenarCamposAltamira() {
                const esAltamira = document.getElementById("esAltamira").checked;
                const municipioInput = document.getElementById("municipio");
                const estadoInput = document.getElementById("estado");

                if (esAltamira) {
                    municipioInput.value = "Altamira";
                    estadoInput.value = "Tamaulipas";
                    municipioInput.readOnly = true;
                    estadoInput.readOnly = true;
                } else {
                    municipioInput.value = "";
                    estadoInput.value = "";
                    municipioInput.readOnly = false;
                    estadoInput.readOnly = false;
                }
            }
            </script>


            <div class="row">
                <div class="mb-3 col-md-4">
                    <label for="codigo_postal" class="form-label">Código Postal:</label>
                    <input type="text" class="form-control" id="codigo_postal" name="codigo_postal" required>
                </div>
                <div class="mb-3 col-md-4">
                    <label for="telefono" class="form-label">Teléfono o Celular:</label>
                    <input type="text" class="form-control" id="telefono" name="telefono" required>
                </div>
                <div class="mb-3 col-md-4">
                    <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento:</label>
                    <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
                </div>
            </div>

            <div class="row">
                <div class="mb-3 col-md-2">
                    <label for="sexo" class="form-label">Sexo:</label>
                    <select class="form-control" id="sexo" name="sexo" required>
                        <option value="M">Masculino</option>
                        <option value="F">Femenino</option>
                    </select>
                </div>
                <div class="mb-3 col-md-3">
                    <label for="lugar_nacimiento" class="form-label">Lugar de Nacimiento:</label>
                    <input type="text" class="form-control" id="lugar_nacimiento" name="lugar_nacimiento" required>
                </div>
                <div class="mb-3 col-md-3">
                    <label for="curp" class="form-label">CURP:</label>
                    <input type="text" class="form-control" id="curp" name="curp" required>
                </div>
                <div class="mb-3 col-md-3">
                    <label for="nacionalidad" class="form-label">Nacionalidad:</label>
                    <input type="text" class="form-control" id="nacionalidad" name="nacionalidad" required>
                </div>
            </div>

            <div class="row">
                <div class="mb-3 col-md-4">
                    <label for="peso" class="form-label">Peso:</label>
                    <input type="number" class="form-control" id="peso" name="peso">
                </div>
                <div class="mb-3 col-md-4">
                    <label for="estatura" class="form-label">Estatura:</label>
                    <input type="number" class="form-control" id="estatura" name="estatura">
                </div>
                <div class="mb-3 col-md-2">
                    <label for="tipo_sangre" class="form-label">Tipo de sangre:</label>
                    <select class="form-control" id="tipo_sangre" name="tipo_sangre" required>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="mb-3 col-md-3">
                    <label for="enfermedad_cronica" class="form-label">Enfermedad Crónica:</label>
                    <input type="text" class="form-control" id="enfermedad_cronica" name="enfermedad_cronica">
                </div>
                <div class="mb-3 col-md-3">
                    <label for="servicio_medico" class="form-label">Tiene Servicio Médico (¿Cuál?):</label>
                    <input type="text" class="form-control" id="servicio_medico" name="servicio_medico">
                </div>
                <div class="mb-3 col-md-3">
                    <label for="alergia" class="form-label">Alergias:</label>
                    <input type="text" class="form-control" id="alergia" name="alergia">
                </div>
                <div class="mb-3 col-md-3">
                    <label for="correo_alumno" class="form-label">Correo electrónico del alumno:</label>
                    <input type="text" class="form-control" id="correo_alumno" name="correo_alumno">
                </div>
            </div>

            <!-- Datos del Padre o Tutor -->
            <h3>Datos del Padre o Tutor</h3>
            <div class="row">
                <div class="mb-3 col-md-4">
                    <label for="apellido_paterno_tutor" class="form-label">Apellido Paterno:</label>
                    <input type="text" class="form-control" id="apellido_paterno_tutor" name="apellido_paterno_tutor" required>
                </div>
                <div class="mb-3 col-md-4">
                    <label for="apellido_materno_tutor" class="form-label">Apellido Materno:</label>
                    <input type="text" class="form-control" id="apellido_materno_tutor" name="apellido_materno_tutor" required>
                </div>
                <div class="mb-3 col-md-4">
                    <label for="nombre_tutor" class="form-label">Nombre(s):</label>
                    <input type="text" class="form-control" id="nombre_tutor" name="nombre_tutor" required>
                </div>
            </div>
<!-- checkbox si viven juntos -->
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="vivenJuntos" onchange="llenarCamposTutor()">
               <label class="form-check-label" for="vivenJuntos">
                    ¿Viven juntos el tutor y el estudiante?
                </label>
            </div>
<!-- Si es de altamira pero del tutor -->
            <div class="row">
                <div class="mb-3 col-md-3">
                    <label for="calle_tutor" class="form-label">Calle y No.:</label>
                    <input type="text" class="form-control" id="calle_tutor" name="calle_tutor" required>
                </div>
                <div class="mb-3 col-md-3">
                    <label for="entre_calles_tutor" class="form-label">Entre Calles:</label>
                    <input type="text" class="form-control" id="entre_calles_tutor" name="entre_calles_tutor" required>
                </div>
                <div class="mb-3 col-md-3">
                    <label for="colonia_tutor" class="form-label">Colonia:</label>
                    <input type="text" class="form-control" id="colonia_tutor" name="colonia_tutor" required>
                </div>
                <div class="mb-3 col-md-3">
                    <label for="municipio_tutor" class="form-label">Municipio:</label>
                    <input type="text" class="form-control" id="municipio_tutor" name="municipio_tutor" required>
                </div>
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="esAltamiraTutor" onchange="llenarMunicipioAltamiraTutor()">
                <label class="form-check-label" for="esAltamiraTutor">
                    ¿Es una colonia de Altamira?
                </label>
            </div>

            <script>
            function llenarMunicipioAltamiraTutor() {
                const esAltamira = document.getElementById("esAltamiraTutor").checked;
                const municipioInput = document.getElementById("municipio_tutor");

                if (esAltamira) {
                    municipioInput.value = "Altamira";
                    municipioInput.readOnly = true;
                } else {
                    municipioInput.value = "";
                    municipioInput.readOnly = false;
                }
            }
            </script>

            <script>
            function llenarCamposTutor() {
                const vivenJuntos = document.getElementById("vivenJuntos").checked;

                if (vivenJuntos) {
                    //los campos estudiante
                    document.getElementById("calle_tutor").value = document.getElementById("calle").value;
                    document.getElementById("entre_calles_tutor").value = document.getElementById("entre_calles").value;
                    document.getElementById("colonia_tutor").value = document.getElementById("colonia").value;
                    document.getElementById("municipio_tutor").value = document.getElementById("municipio").value;
                } else {
                    //se borran los campos del tutor si no viven juntos
                    document.getElementById("calle_tutor").value = "";
                    document.getElementById("entre_calles_tutor").value = "";
                    document.getElementById("colonia_tutor").value = "";
                    document.getElementById("municipio_tutor").value = "";
                }
            }
            </script>


            <div class="row">
                <div class="mb-3 col-md-4">
                    <label for="codigo_postal_tutor" class="form-label">Código Postal:</label>
                    <input type="text" class="form-control" id="codigo_postal_tutor" name="codigo_postal_tutor" required>
                </div>
                <div class="mb-3 col-md-4">
                    <label for="estado_civil_tutor" class="form-label">Estado civil:</label>
                    <select class="form-control" id="estado_civil_tutor" name="estado_civil_tutor" required>
                        <option value="Soltero">Soltero</option>
                        <option value="Casado">Casado</option>
                        <option value="Divorciado">Divorciado</option>
                        <option value="Viudo">Viudo</option>
                        <option value="Separado">Separado</option>
                        <option value="Union libre">Union libre</option>
                        <option value="Concubinato">Concubinato</option>
                    </select>
                </div>
                <div class="mb-3 col-md-4">
                    <label for="telefono_tutor1" class="form-label">Teléfono o Celular 1:</label>
                    <input type="text" class="form-control" id="telefono_tutor1" name="telefono_tutor1" required>
                </div>
            </div>

            <div class="row">
                <div class="mb-3 col-md-4">
                    <label for="fecha_nacimiento_tutor" class="form-label">Fecha de nacimiento.:</label>
                    <input type="date" class="form-control" id="fecha_nacimiento_tutor" name="fecha_nacimiento_tutor" required>
                </div>
                <div class="mb-3 col-md-4">
                    <label for="telefono_tutor2" class="form-label">Teléfono o Celular 2:</label>
                    <input type="text" class="form-control" id="telefono_tutor2" name="telefono_tutor2" required>
                </div>
                <div class="mb-3 col-md-4">
                    <label for="ocupacion_tutor" class="form-label">Ocupación:</label>
                    <input type="text" class="form-control" id="ocupacion_tutor" name="ocupacion_tutor" required>
                </div>
            </div>

            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="curp_tutor" class="form-label">Curp:</label>
                    <input type="text" class="form-control" id="curp_tutor" name="curp_tutor" required>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="email_tutor" class="form-label">E-mail:</label>
                    <input type="text" class="form-control" id="email_tutor" name="email_tutor" required>
                </div>
                <div class="mb-3 col-md-8">
                    <label for="ruta" class="form-label">Ruta:</label>
                    <input type="text" class="form-control" id="ruta" name="ruta" required>
                </div>
            </div>
            <input type="hidden" name="accion" value="guardar-transporte">
            <!-- Guardar el formulario -->
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form> <!-- Cierre del formulario -->
    </div>



</body>
</html>
<script>
   function _alert(msg = {}) {
    const $alert = $.alert({
        escapeKey: msg.kescape || false,
        backgroundDismiss: msg.kescape || false,
        title: msg.titulo || "Alerta",
        content: msg.contenido || "Contenido no especificado",
        columnClass: msg.column_class || "medium",
        theme: "bootstrap",
        draggable: true,
        animation: "top",
        closeAnimation: "top",
        type: msg.color || "blue",
        icon: msg.icono || "fas fa-info-circle",
        onDestroy: function() {},
        buttons: msg.botones || { ok: { text: "Aceptar", action: function() {} } },
        onContentReady: function() {
            if (msg.init) {
                eval(msg.init);
            }
        },
        containerFluid: msg.container_fluid || false,
        closeIcon: msg.icono_cerrar || false
    });
}
        var frm_valid = $("#frm-registro").validate({
                debug: true,
                rules: {
                    "apellido_paterno": {
                        required: true,
                        minlength: 1,
                        maxlength: 50

                    },
                    "curp": {
                        required: true,
                        curp: true
                    },
                    "apellido_materno": {
                        required: true,
                        minlength: 1,
                        maxlength: 50
                    },
                    "nombres": {
                        required: true,
                        minlength: 1,
                        maxlength: 50
                    },
                    "calle": {
                        required: true,
                        minlength: 1,
                        maxlength: 50
                    },
                    "entre_calles": {
                        required: true,
                        minlength: 1,
                        maxlength: 50
                    },
                    "colonia": {
                        required: true,
                        minlength: 1,
                        maxlength: 50
                    },
                    "municipio": {
                        required: true,
                        minlength: 1,
                        maxlength: 50
                    },
                    "estado": {
                        required: true,
                        minlength: 1,
                        maxlength: 50
                    },
                    "codigo_postal": {
                        required: true,
                        digits: true,
                        minlength: 1,
                        maxlength: 50
                    },
                    "telefono": {
                        required: true,
                        digits: true,
                        minlength: 1,
                        maxlength: 15
                    },
                    "fecha_nacimiento": {
                        required: true,
                        date: true,
                    },
                    "sexo": {
                        required: true,
                        minlength: 1,
                        maxlength: 10
                    },
                    "lugar_nacimiento": {
                        required: true,
                        minlength: 1,
                        maxlength: 50
                    },
                    "nacionalidad": {
                        required: true,
                        minlength: 1,
                        maxlength: 50
                    },
                    "peso": {
                        required: true,
                        minlength: 1,
                        maxlength: 50
                    },
                    "estatura": {
                        required: true,
                        minlength: 1,
                        maxlength: 50
                    },
                    "tipo_sangre": {
                        required: true,
                        minlength: 1,
                        maxlength: 50
                    },
                    "enfermedad_cronica": {
                        required: true,
                        minlength: 1,
                        maxlength: 50
                    },
                    "servicio_medico": {
                        required: true,
                        minlength: 1,
                        maxlength: 50
                    },
                    "correo_alumno": {
                        required: true,
                        minlength: 1,
                        maxlength: 50
                    },
                    "apellido_paterno_tutor": {
                        required: true,
                        minlength: 1,
                        maxlength: 50
                    },
                    "apellido_materno_tutor": {
                        required: true,
                        minlength: 1,
                        maxlength: 50
                    },
                    "nombres_tutor": {
                        required: true,
                        minlength: 1,
                        maxlength: 50
                    },
                    "calle_tutor": {
                        required: true,
                        minlength: 1,
                        maxlength: 50
                    },
                    "entre_calles_tutor": {
                        required: true,
                        minlength: 1,
                        maxlength: 50
                    },
                    "colonia_tutor": {
                        required: true,
                        minlength: 1,
                        maxlength: 50
                    },
                    "municipio_tutor": {
                        required: true,
                        minlength: 1,
                        maxlength: 50
                    },
                    "codigo_postal_tutor": {
                        required: true,
                        digits: true,
                        minlength: 1,
                        maxlength: 50
                    },
                    "estado_civil_tutor": {
                        required: true,
                        minlength: 1,
                        maxlength: 50
                    },
                    "fecha_nacimiento_tutor": {
                        required: true,
                        date: true,
                    },
                    "telefono_tutor1": {
                        required: true,
                        digits: true,
                        minlength: 1,
                        maxlength: 15
                    },
                    "telefono_tutor2": {
                        required: true,
                        digits: true,
                        minlength: 1,
                        maxlength: 15
                    },
                    "ocupación_tutor": {
                        required: true,
                        minlength: 1,
                        maxlength: 50
                    },
                    "curp_tutor": {
                        required: true,
                        curp: true
                    },
                    "email_tutor": {
                        required: true,
                        minlength: 1,
                        maxlength: 50

                    },
                    "ruta": {
                        required: true,
                        minlength: 1,
                        maxlength: 50
                    }
                                      
                },
                submitHandler: function (form) {
                //debugger;
                    var _formData = new FormData(form);
                    $.ajax({
                        url: "php/api.php",
                        data :_formData,
                        dataType: "json",
                        processData: false,
                        contentType: false,
                        type: "POST",
                        beforeSend:function(){
                            // modal : loading
                        },
                        error:function(e1,e2,e3){
                            alert(e1);alert(e2);alert(e3);
                            //_alert($msg_error,null);
                        },
                        success : function(response){
                            
                            _alert(response.msg);
                        }
                    });
                 return false;
             }
           });
</script>