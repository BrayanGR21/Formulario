<?php
include '../data/db.php';
header('Content-Type: application/json');

// Instanciar la clase db y conectar a la base de datos
$conexion = new db();
$cnn = $conexion->conectar();

$colonias = array();
if ($cnn) {
    // Preparar y ejecutar la consulta
    $sql = "SELECT DISTINCT CONCAT(cat_abreviatura, ' ', nombre) AS n_colonia FROM cat_colonias2 ORDER BY n_colonia ASC";
    try {
        $stmt = $cnn->prepare($sql);
        $stmt->execute();

        // Recoger los resultados
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Almacenar los nombres de las colonias en el arreglo
        foreach ($resultado as $row) {
            $colonias[] = $row['n_colonia'];
        }

        // Devolver el JSON
        echo json_encode($colonias);
    } catch (PDOException $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Error al conectar a la base de datos']);
}
?>