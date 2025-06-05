<?php
$archivo = "css/js/data/profesiones.json";
$profesiones = file_exists($archivo) ? json_decode(file_get_contents($archivo), true) : [];

$id = $_GET['id'];
$indice = array_search($id, array_column($profesiones, 'id'));

if ($indice === false) {
    echo "Profesión no encontrada.";
    exit;
}

if (isset($_POST['guardar'])) {
    $profesiones[$indice]['nombre'] = $_POST['nombre'];
    $profesiones[$indice]['categoria'] = $_POST['categoria'];
    $profesiones[$indice]['salario'] = $_POST['salario'];

    file_put_contents($archivo, json_encode($profesiones, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    echo "<script>alert('🌟 Profesion actualizada con éxito'); window.location.href='lista_profesiones.php';</script>";
    exit;
}

$profesion = $profesiones[$indice];
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Profesión</title>
  <style>
    body {
      background-color: #fff0f5;
      font-family: 'Comic Sans MS', cursive;
      color: #d63384;
      padding: 20px;
    }
    .formulario {
      background: #ffffff;
      border: 3px solid #ffb6c1;
      border-radius: 20px;
      width: 400px;
      margin: 40px auto;
      padding: 30px;
      box-shadow: 0 0 20px #ff69b4;
    }
    h2 {
      text-align: center;
      color: #ff1493;
    }
    label {
      display: block;
      margin-bottom: 8px;
      font-weight: bold;
    }
    input, select {
      width: 100%;
      padding: 10px;
      margin-bottom: 16px;
      border: 2px solid #ffb6c1;
      border-radius: 10px;
      font-size: 14px;
    }
    input[type="submit"] {
      background-color: #ff69b4;
      color: white;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.3s;
    }
    input[type="submit"]:hover {
      background-color: #d63384;
    }
  </style>
</head>
<body>
  <div class="formulario">
    <h2>✏️ Editar Profesión</h2>
    <form method="POST">
      <label>Nombre de la Profesión:</label>
      <input type="text" name="nombre" value="<?= htmlspecialchars($profesion['nombre']) ?>" required>

      <label>Categoría:</label>
      <select name="categoria">
        <option <?= $profesion['categoria'] == 'Ciencia' ? 'selected' : '' ?>>Ciencia</option>
        <option <?= $profesion['categoria'] == 'Arte' ? 'selected' : '' ?>>Arte</option>
        <option <?= $profesion['categoria'] == 'Deporte' ? 'selected' : '' ?>>Deporte</option>
        <option <?= $profesion['categoria'] == 'Entretenimiento' ? 'selected' : '' ?>>Entretenimiento</option>
        <option <?= $profesion['categoria'] == 'Tecnología' ? 'selected' : '' ?>>Tecnología</option>
        <option <?= $profesion['categoria'] == 'Oficio' ? 'selected' : '' ?>>Oficio</option>
        <option <?= $profesion['categoria'] == 'Educación' ? 'selected' : '' ?>>Educación</option>
        <option <?= $profesion['categoria'] == 'Moda' ? 'selected' : '' ?>>Moda</option>
        <option <?= $profesion['categoria'] == 'Salud' ? 'selected' : '' ?>>Salud</option>
        <option <?= $profesion['categoria'] == 'Gastronomía' ? 'selected' : '' ?>>Gastronomía</option>

      </select>

      <label>Salario Mensual (USD):</label>
      <input type="number" name="salario" value="<?= $profesion['salario'] ?>" required>

      <input type="submit" name="guardar" value="Guardar Cambios">
    </form>
  </div>
</body>
</html>
