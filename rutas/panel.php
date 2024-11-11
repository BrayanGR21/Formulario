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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <link href="js/confirm/css/jquery-confirm.css" rel="stylesheet">
    <link href="js/datatables/css/datatables.min.css" rel="stylesheet">

    <!--<script src="js/jquery/js/jquery.min.js"></script>-->
    <script src="js/validatejs/js/jquery.validate.js"></script>
    <script src="js/validatejs/js/localization/messages_es.js"></script>
    <script src="js/validatejs/js/additional-methods.js"></script>

    <script src="js/datatables/js/jquery.dataTables.min.js"></script>

    <script src="js/confirm/js/jquery-confirm.js"></script>


</head>
<body>
<div class="container mt-5">
    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand">Trasporte</a>
            <form class="d-flex" role="search">

                <a class="btn btn-outline-success" href="index.php">Formulario</a>
            </form>
        </div>
    </nav>
    <h2>Ficha de Datos Personales para Uso del Transporte</h2>
    <div class="row">
        <div class="col-md-3">
            <label for="">Colinas</label>
            <select name="colonia" class="form-control">
                <option value="">seleccione una opcion</option>
            </select>
        </div>
        <div class="col-md-12 text-right">
            <button type="button" id="btn-search" class="btn btn-primary">Buscar</button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table id="tb-estudiantes" class="table table-strited table-border">
                <thead>
                    <tr>
                        <th>Estudiante</th>
                        <th>Tutor</th>
                        <th>Ruta</th>
                        <th>Domicilio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>



</body>
</html>
<script>
    $(document).off(".evt");
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
    var dt_estudiantes;
    dt_estudiantes  = $("#tb-estudiantes").DataTable({
        pageLength:100,
        language:{
            //url:"vendor/datatables/js/Spanish.json"
            url:"js/datatables/js/Spanish.json"

        },
        "processing": true,
        "serverSide": true,
        "ajax": {
            url: "php/api.php",
            type: 'POST',
            data: function (d) {
                d.accion = "dt-estudiantes";
                // FILTROS
                d.colonia = $("[name=colonia]").val();
            }
        },
        "columns": [
            { "data": "n_estudiante" },
            { "data": "tutor" },
            { "data": "ruta" },
            { "data": "domicilio" },
            { "data": "acciones" }
        ]
    });
    $("#btn-search").click(function () {
        dt_estudiantes.ajax.reload();
    });
    $(document).on("click.evt",".acc-editar", function () {
        var _id = $(this).closest("tr").data("id");
       $.ajax({
           url: 'php/api.php',
           type: 'POST',
           dataType: 'json',
           data: {
               accion: 'vista-editar',
               id : _id
           },
           success: function(response){
               _alert(response.msg);
           },
           error: function(x,y,z){
               alert("Falla en conexión con servidor");
           }
       });
    });
</script>