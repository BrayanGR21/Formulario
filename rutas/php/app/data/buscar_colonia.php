<?php
include '../data/db.php';
header('Content-Type: application/json');

$conexion = new db();
$cnn = $conexion->conectar();

$colonias = array();
if ($cnn) {
    $sql = "SELECT DISTINCT CONCAT(cat_abreviatura, ' ', nombre) AS n_colonia FROM cat_colonias2 ORDER BY n_colonia ASC";
    try {
        $stmt = $cnn->prepare($sql);
        $stmt->execute();

        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($resultado as $row) {
            $colonias[] = $row['n_colonia'];
        }

        echo json_encode($colonias);
    } catch (PDOException $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Error al conectar a la base de datos']);
}
?>