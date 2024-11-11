<?php
//session_name("siav1");
//session_start();
ini_set('display_errors',1);
/*if (!isset($_SESSION["usuario"])) {
    header("Location: ../../login.php");
    exit;
}*/

include("app/core.php");
if (isset($_POST["accion"])) {
    $accion = $_POST["accion"];
} elseif (isset($_GET["accion"])) {
    $accion = $_GET["accion"];
} else {
    header("Content-Type: application/json");
    echo json_encode(["error" => "acceso denegado."]);
    exit;
}

$core = new core();
//$permisos = $_SESSION['usuario']['permisos'];
//var_dump($permisos);
//echo $accion;
$data=[];
$titulo = '';
$contenido ='';
$tipo ='alert';
$botones = [
    'ok' => [
        'text' => 'Cerrar',
        'btnClass'=> 'btn-default'
    ]
];
$tamano = '';
$visible ='true';
$color = 'blue';
$icono = 'icon-check';
$column_class = "col-md-6 col-md-offset-3";
$init = '';
$container_fluid =false;
$kescape = false;



switch ($accion) {

    case 'guardar-transporte':
            $titulo = 'Estatus de registro';
            //VALIDAR 
            $REG = $core::educacion()->getByCurp($_POST['curp']);
            if(!empty($REG)){
                $contenido = 'Su CURP ya fue capturada previamente en nuestro sistema.';
                goto salto;
            }

            if(empty($_POST['nombres'])){
                $contenido = 'Antes de guardar, ingresa un nombre valido';
                goto salto;
            }
            if(empty($_POST['apellido_paterno'])){
                $contenido = 'Antes de guardarr, ingresa un apellido paterno valido';
                goto salto;
            }
            if(empty($_POST['apellido_materno'])){
                $contenido = 'Antes de guardar, ingresa un appellido materno valido';
                goto salto;
            }
            if(empty($_POST['calle'])){
                $contenido = 'Antes de guardar, ingresa una calle valida';
                goto salto;
            }
            if(empty($_POST['entre_calles'])){
                $contenido = 'Antes de guardar, verifica las entre calles sean validas';
                goto salto;
            }
            if(empty($_POST['colonia'])){
                $contenido = 'Antes de guardar, verifica que la colonia es valida';
                goto salto;
            }
            if(empty($_POST['municipio'])){
                $contenido = 'Antes de guardar, verifica que el municipio es valido';
                goto salto;
            }
            if(empty($_POST['estado'])){
                $contenido = 'Antes de guardar, verifica que el estado sea valido';
                goto salto;
            }
            if(empty($_POST['codigo_postal'])){
                $contenido = 'Antes de guardar, verifica que el codigo postal sea valido';
                goto salto;
            }
            if(empty($_POST['telefono'])){
                $contenido = 'Antes de guardar, verifica que el telefono sea valido';
                goto salto;
            }
            if(empty($_POST['fecha_nacimiento'])){
                $contenido = 'Antes de guardar, verifica que la fecha de nacimiento sea valida';
                goto salto;
            }
            if(empty($_POST['sexo'])){
                $contenido = 'Antes de guardar, verifica que el sexo sea valido';
                goto salto;
            }
            if(empty($_POST['lugar_nacimiento'])){
                $contenido = 'Antes de guardar, verifica que el lugar de nacimiento sea valido';
                goto salto;
            }
            if(empty($_POST['nacionalidad'])){
                $contenido = 'Antes de guardar, verifique que la nacionalidad sea valida';
                goto salto;
            }
            if(empty($_POST['curp'])){
                $contenido = 'Antes de guardar, verifique que la curp sea valida';
                goto salto;
            }
            if(empty($_POST['peso'])){
                $contenido = 'Antes de guardar, verifique que el peso sea valido';
                goto salto;
            }
            if(empty($_POST['estatura'])){
                $contenido = 'Antes de guardar, verifique que la estatura sea valida';
                goto salto;
            }
            if(empty($_POST['tipo_sangre'])){
                $contenido = 'Antes de guardar, verifique que el tipo de sangre sea valido';
                goto salto;
            }
            if(empty($_POST['enfermedad_cronica'])){
                $contenido = 'Antes de guardar, verifique que el campo: enfermedad cronica, sea valido';
                goto salto;
            }
            if(empty($_POST['servicio_medico'])){
                $contenido = 'Antes de guardar, verifique que los servicios medicos sean validos';
                goto salto;
            }
            if(empty($_POST['correo_alumno'])){
                $contenido = 'Antes de guardar, verifique que el correo del alumno sea valido';
                goto salto;
            }
            if(empty($_POST['apellido_paterno_tutor'])){
                $contenido = 'Antes de guardar, verifique que el apellido paterno del tutro sea valido';
                goto salto;
            }
            if(empty($_POST['apellido_materno_tutor'])){
                $contenido = 'Antes de guardar, verifique que el apellido materno del tutor sea valido';
                goto salto;
            }
            if(empty($_POST['nombre_tutor'])){
                $contenido = 'Antes de guardar, verifique que el nombre del tutor sea valido';
                goto salto;
            }
            if(empty($_POST['calle_tutor'])){
                $contenido = 'Antes de guardar, verifique que la calle del tutor sea valida';
                goto salto;
            }
            if(empty($_POST['entre_calles_tutor'])){
                $contenido = 'Antes de guardar, verifica que las entre calles del tutor sean validas';
                goto salto;
            }
            if(empty($_POST['colonia_tutor'])){
                $contenido = 'Antes de guardar, verifica que la colonia del tutor sea valida';
                goto salto;
            }
            if(empty($_POST['municipio_tutor'])){
                $contenido = 'Antes de guardar, verifica que el municipio del tutor sea valido';
                goto salto;
            }
            if(empty($_POST['codigo_postal_tutor'])){
                $contenido = 'Antes de guardar, verifica que el codigo postal del tutor sea valido';
                goto salto;
            }
            if(empty($_POST['estado_civil_tutor'])){
                $contenido = 'Antes de guardar, verifica que el estado civl del tutor sea valido';
                goto salto;
            }
            if(empty($_POST['fecha_nacimiento_tutor'])){
                $contenido = 'Antes de guardar, verifica que la fecha de nacimiento del tutor sea valida';
                goto salto;
            }
            if(empty($_POST['telefono_tutor1'])){
                $contenido = 'Antes de guardar, verifica que el telefono del tutor sea valido';
                goto salto;
            }
            if(empty($_POST['ocupacion_tutor'])){
                $contenido = 'Antes de guardar, verifica que la ocupacion del tutor sea valida';
                goto salto;
            }
            if(empty($_POST['curp_tutor'])){
                $contenido = 'Antes de guardar, verifica que la ocupacion del tutor sea valida';
                goto salto;
            }
            if(empty($_POST['email_tutor'])){
                $contenido = 'Antes de guardar, verifica que el correo del tutor sea valido';
                goto salto;
            }
            if(empty($_POST['ruta'])){
                $contenido = 'Antes de guardar, verifica que la ruta sea valida';
                goto salto;
            }


            $res = $core::educacion()->guardar();
            if($res){
                $contenido = 'Su registro se a guardado exitosamente. Gracias';
                $botones = ['ok' => [
                        'text' => 'Aceptar',
                        'btnClass' => 'btn-blue',
                        'strAction' => '(function(){
                            window.location.reload();
                           
                        })'
                    ]
                ];
            }else{
                $contenido = 'Se genero un error al tratar de guardar su registro, comuniquese con su administrador.';
            }
        break;

    case 'dt-estudiantes':
        $WHERE = '';
        if (!empty($_POST['colonia'])) {
            $WHERE .= " AND colonia = '{$_POST['colonia']}'";
        }

        $columns = array(
            array(
                'db' => 'id',
                'dt' => 'DT_RowData',
                'formatter' => function ($d, $row) {
                    return array('id' => $d);
                }
            ),
            array('db' => 'id', 'dt' => 'DT_RowId'),
            array('db' => 'n_estudiante', 'dt' => 'n_estudiante'),
            array('db' => 'n_tutor', 'dt' => 'tutor'),
            array('db' => 'ruta', 'dt' => 'ruta'),
            array('db' => 'domicilio', 'dt' => 'domicilio'),
            array('db' => 'accion', 'dt' => 'acciones'),
        );
        $primaryKey = 'id';
        $table = /**@lang MySQL*/"(SELECT 
            id,
           CONCAT(nombres,' ',apellido_paterno,' ',apellido_materno) n_estudiante,
           CONCAT(nombres_tutor,' ',apellido_paterno_tutor,' ',apellido_materno_tutor) n_tutor,
           ruta,
           CONCAT('domicilio') domicilio,
    
          '<div class=\"dropdown\">
              <button class=\"btn btn-secondary dropdown-toggle\" type=\"button\" id=\"dropdownMenuButton1\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\">
                Acciones
              </button>
              <ul class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton1\">
                <li><a class=\"dropdown-item acc-editar\" href=\"#\">Editar</a></li>
                <li><a class=\"dropdown-item acc-borrar\" href=\"#\">Borrar/a></li> 
              </ul>
            </div>' accion
          FROM  registros_transporte tb  
          WHERE 1=1 $WHERE) t1";
        $arr = $core::SSP()->simple($_POST, $table, $primaryKey, $columns);
        //$arr['tabla'] = $table;
        echo json_encode($arr);
        exit;
        break;

    case 'vista-borrar':
        $titulo = 'Vista borrar';
        $contenido = $_POST['id'];
        break;

    case 'vista-editar':
        $titulo = 'Vista editar';
        $contenido = $_POST['id'];
        break;

    case 'buscar_colonias':
        $res = $core::educacion()->buscarColonia($_GET['term']);
        $data = $res; //array_column($res,'n_colonia');
        break;

        //case 'editar_registro':
            //break;
    
}

salto:
echo json_encode(
    array(
        'data' => $data,
        'msg' => [
            'titulo' => $titulo,
            'contenido' => $contenido,
            'tipo' => $tipo,
            'botones' => $botones,
            'tamano' => $tamano,
            'visible' => $visible,
            'color' => $color,
            'icono'=>$icono,
            'init' =>$init,
            'column_class' => $column_class,
            'container_fluid' => $container_fluid,
            'kescape' => $kescape
        ]
    )
);
exit;