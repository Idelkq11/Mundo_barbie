<?php
$archivo_roles = "css/js/data/roles.json";
$roles = file_exists($archivo_roles) ? json_decode(file_get_contents($archivo_roles), true) : [];

if (isset($_POST['guardar'])) {
    $personajes = [];
    $archivo = "css/js/data/personajes.json";

    if (file_exists($archivo)) {
        $personajes = json_decode(file_get_contents($archivo), true);
    }

    $foto_nombre = uniqid() . "_" . $_FILES['foto']['name'];
    $foto_ruta = "img/" . $foto_nombre;
    move_uploaded_file($_FILES['foto']['tmp_name'], $foto_ruta);

    $nuevo_personaje = [
        "id" => $_POST["id"],
        "nombre" => $_POST["nombre"],
        "apellido" => $_POST["apellido"],
        "fecha_nacimiento" => $_POST["fecha_nacimiento"],
        "foto" => $foto_ruta,
        "rol" => $_POST["rol"],
        "experiencia" => $_POST["experiencia"]
    ];

    $personajes[] = $nuevo_personaje;
    file_put_contents($archivo, json_encode($personajes, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    echo "<script>alert('🎀 Personaje registrado exitosamente'); window.location.href='Lista_personajes.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registrar Personaje | Mundo Barbie</title>
  <link rel="stylesheet" href="css/estilo.css">
  <style>
    body {
      background-color: #ffe6f0;
      font-family: 'Comic Sans MS', cursive;
      color: #d63384;
      padding: 20px;
    }
    h1 {
      text-align: center;
      color: #ff1493;
    }
    form {
      background-color: #fff0f5;
      padding: 20px;
      border-radius: 20px;
      width: 500px;
      margin: auto;
      box-shadow: 0 0 10px #ff69b4;
    }
    label {
      font-weight: bold;
      display: block;
      margin-bottom: 5px;
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
    a.volver {
      display: block;
      text-align: center;
      margin-top: 20px;
      text-decoration: none;
      color: #d63384;
      font-weight: bold;
    }
  </style>
</head>
<body>

  <h1>💖 Registrar Personaje en el Mundo Barbie 💖</h1>

  <form action="registrar_personaje.php" method="POST" enctype="multipart/form-data">
    <label>Identificación:</label>
    <input type="text" name="id" required>

    <label>Nombre:</label>
    <input type="text" name="nombre" required>

    <label>Apellido:</label>
    <input type="text" name="apellido" required>

    <label>Fecha de Nacimiento:</label>
    <input type="date" name="fecha_nacimiento" required>

    <label>Foto del personaje:</label>
    <input type="file" name="foto" accept="image/*" required>

    <label>Profesión o Rol en el Mundo Barbie:</label>
    <select name="rol" required>
      <option value="">Selecciona un Rol</option>
      <?php foreach ($roles as $rol): ?>
        <option value="<?= htmlspecialchars($rol['nombre']) ?>">
          <?= htmlspecialchars($rol['nombre']) ?>
        </option>
      <?php endforeach; ?>
    </select>

    <label>Nivel de Experiencia:</label>
    <select name="experiencia" required>
      <option value="Principiante">Principiante</option>
      <option value="Intermedio">Intermedio</option>
      <option value="Avanzado">Avanzado</option>
    </select>

    <input type="submit" name="guardar" value="Registrar Personaje">
  </form>

  <a href="lista_personajes.php" class="volver">⬅️ Volver a la lista de personajes</a>

</body>
</html>
