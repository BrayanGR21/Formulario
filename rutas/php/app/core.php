<?php
 
class core
{
    static $mdb;
    public function __construct() {
        require_once 'data/db.php';
        self::$mdb = (new db())->conectar();

    }
    public static function educacion(){
        require_once 'models/educacion.php'; // Verificar si la conexión está establecida
        if (!self::$mdb) {
            throw new Exception("Conexión a la base de datos no establecida.");
        }
    
        // Incluir la clase educacion
       
        
        // Crear la instancia de la clase Educacion y pasar la conexión a la base de datos
        return new Educacion(self::$mdb);
    }
    
   

    //public static function Bcrypt(){
      //  require_once  'vendor/Bcrypt/Bcrypt.php';
        //return new Bcrypt();
    //}
    public static function SSP(){
        require_once 'vendor/datatables/ssp.class.php';
        return new SSP(self::$mdb);
    }

   // public static function FPDF($orientation='P', $unit='mm', $size='A4'){
       // require_once 'vendor/FPDF/fpdf.php';
       // return new FPDF($orientation, $unit, $size);
   // }
    

   // public static function PHPExcel(){
        //require_once("vendor/PHPEXCEL/PHPExcel.php");
       // return new PHPExcel();
   // }

    

    public function getInsertLastId(){
        return self::$mdb->lastInsertId();
    }

    public static function _bind_type_value($value, $type)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        return $type;
    }

    public static function _formatDate($date,$format){
        return date("$format",strtotime(str_replace('/','-',$date)));
    }

    public static function _formatBytes($bytes, $precision = 2) {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        // Uncomment one of the following alternatives
        // $bytes /= pow(1024, $pow);
        // $bytes /= (1 << (10 * $pow));

        return round($bytes, $precision) . ' ' . $units[$pow];
    }

    public static function iniciales($str)
    {
        $arr = explode(" ", $str);
        $cad = "";
        foreach ($arr as $val) {
            $cad .= substr($val, 0, 1) . ".";
        }
        return $cad;
    }

    public static function  _getStringComboBox($data,$selected_id=null,$column_name = null){
        $_str ='';
        foreach ($data as $d){
            if($d['id']==$selected_id){
                $_str.='<option value="'.$d['id'].'"'
                    .(isset($d['puesto']) ? "data-puesto='{$d['puesto']}'" : '')
                    .(isset($d['inventario']) ? "data-inventario='{$d['inventario']}'" : '')
                    .(isset($d['idxinv']) ? "data-idxinv='{$d['idxinv']}'" : '')
                    .(isset($d['capitulo']) ? "data-capitulo='{$d['capitulo']}'" : '')
                    .(isset($d['concepto']) ? "data-concepto='{$d['concepto']}'" : '')
                    .(isset($d['partida_generica']) ? "data-partida_generica='{$d['partida_generica']}'" : '')
                    .' selected>'.($column_name != null ? $d[$column_name] : $d['nombre']).'</option>';
            }else{
                $_str.='<option value="'.$d['id'].'" '
                    .(isset($d['puesto']) ? "data-puesto='{$d['puesto']}'" : '')
                    .(isset($d['inventario']) ? "data-inventario='{$d['inventario']}'" : '')
                    .(isset($d['idxinv']) ? "data-idxinv='{$d['idxinv']}'" : '')
                    .(isset($d['capitulo']) ? "data-capitulo='{$d['capitulo']}'" : '')
                    .(isset($d['concepto']) ? "data-concepto='{$d['concepto']}'" : '')
                    .(isset($d['partida_generica']) ? "data-partida_generica='{$d['partida_generica']}'" : '')
                    .'>'.($column_name != null ? $d[$column_name] : $d['nombre']).'</option>';
            }
        }
        return $_str;
    }

    public static function  _getStringCheckbox($data,$selected_id=null,$column_name = null,$input_name){
        $_str ='';
        //echo $column_name;
//
        if($selected_id == null) {
            $selected_id = [''];
        }else if(empty($selected_id)) {
            $selected_id = [''];
        }else{
            if (strpos($selected_id,',') !== false) {
                $selected_id = explode(',', $selected_id);
            } else {
                $selected_id = [$selected_id];
            }
        }
        foreach ($data as $d){
            if(in_array($d['id'],$selected_id)){
//                if($column_name == 'nombre'){
//                    // var_dump(strpos( $selected_id,',') );
//                    echo 'id';
//                    var_dump($d['id']);
//                    echo '<hr>';
//
//                    var_dump($selected_id);
//                    //
//                }
                $_str.='<label class="checkbox-inline"><input type="checkbox" name="'.$input_name.'" value="'.$d['id'].'" checked>'.($column_name != null ? $d[$column_name] : $d['nombre']).'</label>';
            }else{
                $_str.='<label class="checkbox-inline"><input type="checkbox" name="'.$input_name.'" value="'.$d['id'].'">'.($column_name != null ? $d[$column_name] : $d['nombre']).'</label>';
            }
        }
        return $_str;
        exit;
    }

    static  function  _getStringTable($data){
        //self::dd($data);exit;
        $_str ='';
        foreach ($data as  $columns){
           
                $_str .= "<tr id='{$columns['id']}'>";
                foreach ($columns as $key =>$row){
                     if($key != 'id'){
                        $_str .= '<td>'.$row.'</td>';
                    }
                }
                $_str .= '</tr>';
           
        }
        if(empty($data)){
            $_str = '<tr><td colspan="10" class="text-center">Sin información</td></tr>';
        }
        return $_str;
    }

    static function dd($var,$flag=false){
        echo '<pre>';
        print_r($var);
        if($flag)
            exit;
    }

    
    static function _getVersionPdf($filename){
        $fp = @fopen($filename, 'rb');

        if (!$fp) {
            return 0;
        }

        /* Reset file pointer to the start */
        fseek($fp, 0);

        /* Read 1024 bytes from the start of the PDF */
        preg_match('/%PDF-(\d\.\d)/', fread($fp,1024), $match);

        fclose($fp);

        if (isset($match[1])){
            return $match[1];
        }

        return null;
    }

    

    public  static function _generatePassword(){
        $l = "abcdefghijkmnopqrstuvwxyz9";
        $u = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $d ='012345678';
        $password = substr( str_shuffle( $l ), 0, 1)
            .substr( str_shuffle( $d ), 0, 5 )
            .substr( str_shuffle( $u ), 0, 1)
            .substr( str_shuffle( $l ), 0, 1);
        return $password;
    }
    public static function validateDate($date, $format = 'Y-m-d'){
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }
    public static function _formatPhone($phone_no) {
        return preg_replace(
            "/.*(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{4})/",
            '$1 $2 $3',
            $phone_no
        );
    }
   

    public static function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }



}