<?php
$archivo = "css/js/data/profesiones.json";
$profesiones = file_exists($archivo) ? json_decode(file_get_contents($archivo), true) : [];

$id = $_GET['id'];

$nueva_lista = array_filter($profesiones, function($p) use ($id) {
    return $p['id'] !== $id;
});

file_put_contents($archivo, json_encode(array_values($nueva_lista), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
echo "<script>alert('Profesión eliminada'); window.location.href='lista_profesion.php';</script>";
?>
