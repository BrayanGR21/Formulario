<?php
class Educacion 
{
    private $db;
    private $date_now;

    function __construct($db){
        date_default_timezone_set('America/Tegucigalpa');
        $this->db = $db;
        $this->date_now = date("Y-m-d H:i:s");
    }

    function guardar(){

        $colonia = $_POST['colonia'] ?? null;
        $colonia_tutor = $_POST['colonia_tutor'] ?? null;
    
        if ($colonia) {
            $coloniaId = $this->buscarIdColonia($colonia);
            $colonia = $coloniaId;
            $colonia = $coloniaId !== null ? $coloniaId : -1;

        }
        if ($colonia_tutor) {
            $coloniaTutorId = $this->buscarIdColonia($colonia_tutor);
            $colonia_tutor = $coloniaTutorId;
            $colonia_tutor = $coloniaTutorId !== null ? $coloniaTutorId : -1;
        }
        
        $data = [
            //alumno
            ':apellido_paterno' => $_POST['apellido_paterno'] ?? null,
            ':apellido_materno' => $_POST['apellido_materno'] ?? null,
            ':nombres' => $_POST['nombres'] ?? null,
            ':calle' => $_POST['calle'] ?? null,
            ':entre_calles' => $_POST['entre_calles'] ?? null,
            ':colonia' => $colonia,
            ':municipio' => $_POST['municipio'] ?? null,
            ':estado' => $_POST['estado'] ?? null,
            ':codigo_postal' => $_POST['codigo_postal'] ?? null,
            ':telefono' => $_POST['telefono'] ?? null,
            ':fecha_nacimiento' => $_POST['fecha_nacimiento'] ?? null,
            ':sexo' => $_POST['sexo'] ?? null,
            ':lugar_nacimiento' => $_POST['lugar_nacimiento'] ?? null,
            ':nacionalidad' => $_POST['nacionalidad'] ?? null,
            ':curp' => $_POST['curp'] ?? null,
            ':peso' => $_POST['peso'] ?? null,
            ':estatura' => $_POST['estatura'] ?? null,
            ':tipo_sangre' => $_POST['tipo_sangre'] ?? null,
            ':enfermedad_cronica' => $_POST['enfermedad_cronica'] ?? null,
            ':servicio_medico' => $_POST['servicio_medico'] ?? null,
            ':alergia' => $_POST['alergia'] ?? null,
            ':correo_alumno' => $_POST['correo_alumno'] ?? null,

            //tutor
            ':apellido_paterno_tutor' => $_POST['apellido_paterno_tutor'] ?? null,
            ':apellido_materno_tutor' => $_POST['apellido_materno_tutor'] ?? null,
            ':nombre_tutor' => $_POST['nombre_tutor'] ?? null,
            ':calle_tutor' => $_POST['calle_tutor'] ?? null,
            ':entre_calles_tutor' => $_POST['entre_calles_tutor'] ?? null,
            ':colonia_tutor' => $colonia_tutor,
            ':municipio_tutor' => $_POST['municipio_tutor'] ?? null,
            ':codigo_postal_tutor' => $_POST['codigo_postal_tutor'] ?? null,
            ':estado_civil_tutor' => $_POST['estado_civil_tutor'] ?? null,
            ':fecha_nacimiento_tutor' => $_POST['fecha_nacimiento_tutor'] ?? null,
            ':telefono_tutor1' => $_POST['telefono_tutor1'] ?? null,
            ':telefono_tutor2' => $_POST['telefono_tutor2'] ?? null,
            ':ocupacion_tutor' => $_POST['ocupacion_tutor'] ?? null,
            ':curp_tutor' => $_POST['curp_tutor'] ?? null,
            ':email_tutor' => $_POST['email_tutor'] ?? null,

            //ruta
            ':ruta' => $_POST['ruta'] ?? null,
            ':created_at' => $this->date_now
        ];
        //PARA COMENTAR
        //$data['nacionalidad'] = '';

        $sql = "INSERT INTO registros_transporte 
        (apellido_paterno, apellido_materno, nombres, calle, entre_calles, colonia, municipio, estado, codigo_postal, telefono, fecha_nacimiento, sexo, lugar_nacimiento, 
        nacionalidad, curp, peso, estatura, tipo_sangre, enfermedad_cronica, servicio_medico, alergia, correo_alumno, apellido_paterno_tutor, apellido_materno_tutor, nombres_tutor, 
        calle_tutor, entre_calles_tutor, colonia_tutor, municipio_tutor, codigo_postal_tutor, estado_civil_tutor, fecha_nacimiento_tutor, telefono_tutor1, telefono_tutor2, 
        ocupacion_tutor, curp_tutor, email_tutor, ruta, created_at) 
        
        VALUES (:apellido_paterno, :apellido_materno, :nombres, :calle, :entre_calles, :colonia, :municipio, :estado, :codigo_postal, :telefono, :fecha_nacimiento, :sexo, 
        :lugar_nacimiento, :nacionalidad, :curp, :peso, :estatura, :tipo_sangre, :enfermedad_cronica, :servicio_medico, :alergia, :correo_alumno, :apellido_paterno_tutor, :apellido_materno_tutor, 
        :nombre_tutor, :calle_tutor, :entre_calles_tutor, :colonia_tutor, :municipio_tutor, :codigo_postal_tutor, :estado_civil_tutor, :fecha_nacimiento_tutor, :telefono_tutor1, 
        :telefono_tutor2, :ocupacion_tutor, :curp_tutor, :email_tutor, :ruta, :created_at)";

        $stmt = $this->db->prepare($sql);
        //var_dump($_POST);
        if ($stmt) {
            foreach ($data as $key => $value) {
                $stmt->bindValue($key, $value);
            }
        
            if ($stmt->execute()) {
                return true;
            } else {
                // Captura el error y lo imprime
                 error_log('Error en la consulta SQL: ' . print_r($stmt->errorInfo(), true));
                return false;
            }
        } else {
            // Si la preparación de la consulta falla
            return false;
        }
    }

    function getByCurp($curp){
        return $this->db->query("select * from registros_transporte where curp = '$curp';")->fetchAll(PDO::FETCH_ASSOC);
    }

    function buscarColonia($term)
    {

        $sql = "SELECT DISTINCT id_colonia, CONCAT(cat_abreviatura, ' ', nombre) AS n_colonia FROM cat_colonias2 
        WHERE  nombre   like '%$term%'                                                          
        ORDER BY n_colonia ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);


    }
    function buscarIdColonia($colonia) {
        $sql = "SELECT id_colonia FROM cat_colonias2 WHERE nom_col = :colonia";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':colonia', $colonia, PDO::PARAM_STR);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $resultado ? $resultado['id_colonia'] : -1;
    }
}