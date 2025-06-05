<?php
$archivo = "css/js/data/personajes.json";
$personajes = file_exists($archivo) ? json_decode(file_get_contents($archivo), true) : [];

$id = $_GET['id'] ?? null;
$indice = null;

foreach ($personajes as $i => $p) {
    if ($p['id'] === $id) {
        $indice = $i;
        break;
    }
}

if ($indice === null) {
    echo "❌ Personaje no encontrado.";
    exit;
}


$roles = json_decode(file_get_contents("css/js/data/roles.json"), true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $personajes[$indice]['nombre'] = $_POST['nombre'];
    $personajes[$indice]['apellido'] = $_POST['apellido'];
    $personajes[$indice]['fecha_nacimiento'] = $_POST['fecha_nacimiento'];
    $personajes[$indice]['rol'] = $_POST['rol'];
    $personajes[$indice]['experiencia'] = $_POST['experiencia'];

    file_put_contents($archivo, json_encode($personajes, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    header("Location: Lista_personajes.php");
    exit;
}

$personaje = $personajes[$indice];
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Personaje | Mundo Barbie</title>
  <link rel="stylesheet" href="css/estilo.css">
  <style>
    body {
      background-color: #fff0f5;
      font-family: 'Comic Sans MS', cursive;
      color: #d63384;
      padding: 20px;
    }
    h1 {
      text-align: center;
      color: #ff1493;
    }
    form {
      max-width: 600px;
      margin: auto;
      background-color: #ffffff;
      padding: 20px;
      border-radius: 20px;
      box-shadow: 0 0 10px #ff69b4;
    }
    label {
      font-weight: bold;
    }
    input, select {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 10px;
    }
    input[type="submit"] {
      background-color: #ff69b4;
      color: white;
      font-weight: bold;
      cursor: pointer;
    }
    input[type="submit"]:hover {
      background-color: #d63384;
    }
    .volver {
      display: block;
      text-align: center;
      margin-top: 15px;
      text-decoration: none;
      color: #d63384;
      font-weight: bold;
    }
  </style>
</head>
<body>

<h1>💖 Editar Personaje</h1>

<form method="POST">
  <label>Nombre:</label>
  <input type="text" name="nombre" value="<?= htmlspecialchars($personaje['nombre']) ?>" required>

  <label>Apellido:</label>
  <input type="text" name="apellido" value="<?= htmlspecialchars($personaje['apellido']) ?>" required>

  <label>Fecha de Nacimiento:</label>
  <input type="date" name="fecha_nacimiento" value="<?= htmlspecialchars($personaje['fecha_nacimiento']) ?>" required>

  <label>Rol:</label>
  <select name="rol" required>
    <?php foreach ($roles as $rol): ?>
      <option value="<?= $rol['nombre'] ?>" <?= $personaje['rol'] == $rol['nombre'] ? 'selected' : '' ?>>
        <?= $rol['nombre'] ?>
      </option>
    <?php endforeach; ?>
  </select>

  <label>Experiencia:</label>
  <select name="experiencia" required>
    <option value="Principiante" <?= $personaje['experiencia'] == 'Principiante' ? 'selected' : '' ?>>Principiante</option>
    <option value="Intermedio" <?= $personaje['experiencia'] == 'Intermedio' ? 'selected' : '' ?>>Intermedio</option>
    <option value="Avanzado" <?= $personaje['experiencia'] == 'Avanzado' ? 'selected' : '' ?>>Avanzado</option>
  </select>

  <input type="submit" value="Guardar Cambios">
</form>

<a href="lista_personajes.php" class="volver">⬅️ Volver a la lista</a>

</body>
</html>
