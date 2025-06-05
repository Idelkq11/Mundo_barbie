<?php
$archivo = "css/js/data/personajes.json";
$id = $_GET['id'] ?? null;

if (!$id) {
    echo "❌ ID no proporcionado.";
    exit;
}

$personajes = file_exists($archivo) ? json_decode(file_get_contents($archivo), true) : [];


$personajes = array_filter($personajes, function ($p) use ($id) {
    return $p['id'] !== $id;
});


$personajes = array_values($personajes);


file_put_contents($archivo, json_encode($personajes, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));


header("Location: Lista_personajes.php");
exit;
?>
