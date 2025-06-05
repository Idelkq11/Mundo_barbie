<?php
$archivo = "css/js/data/personajes.json";
$personajes = file_exists($archivo) ? json_decode(file_get_contents($archivo), true) : [];
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Lista de Personajes | Mundo Barbie</title>
  <link rel="stylesheet" href="css/estilo.css">
  <style>
    body {
      background-color: #fff0f5;
      font-family: 'Comic Sans MS', cursive;
      padding: 20px;
      color: #d63384;
    }
    h1 {
      text-align: center;
      color: #ff1493;
    }
    .boton-agregar {
      display: block;
      width: 250px;
      margin: 20px auto;
      text-align: center;
      background-color: #ff69b4;
      color: white;
      padding: 12px;
      border-radius: 10px;
      font-weight: bold;
      text-decoration: none;
      box-shadow: 0 0 8px #d63384;
    }
    .boton-agregar:hover {
      background-color: #d63384;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      background-color: #ffffff;
      margin-top: 20px;
    }
    th, td {
      border: 1px solid #ffb6c1;
      padding: 12px;
      text-align: center;
    }
    th {
      background-color: #ffccdd;
      color: #d63384;
    }
    img {
      width: 80px;
      height: 80px;
      object-fit: cover;
      border-radius: 10px;
    }
    .btn-accion {
      margin: 0 5px;
      padding: 6px 12px;
      border: none;
      border-radius: 8px;
      color: white;
      cursor: pointer;
      font-weight: bold;
      font-family: 'Comic Sans MS', cursive;
      box-shadow: 0 0 6px #d63384;
      transition: background-color 0.3s ease;
    }
    .btn-editar {
      background-color: #ff69b4;
    }
    .btn-editar:hover {
      background-color: #d63384;
    }
    .btn-eliminar {
      background-color: #ff4d6d;
    }
    .btn-eliminar:hover {
      background-color: #b3324a;
    }

    .boton-volver {
      display: inline-block;
      margin: 40px auto 0;
      text-align: center;
      background-color: #ffe4ec;
      color: #d63384;
      padding: 10px 20px;
      border-radius: 15px;
      font-weight: bold;
      text-decoration: none;
      font-size: 18px;
      box-shadow: 0 0 6px #ff69b4;
    }

    .boton-volver:hover {
      background-color: #ffb6c1;
    }
  </style>
</head>
<body>

  <h1>🌟 Lista de Personajes del Mundo Barbie 🌟</h1>

  <a href="registrar_personaje.php" class="boton-agregar">➕ Agregar nuevo personaje</a>

  <?php if (count($personajes) > 0): ?>
  <table>
    <thead>
      <tr>
        <th>Foto</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Identificación</th>
        <th>Fecha de Nacimiento</th>
        <th>Rol</th>
        <th>Experiencia</th>
        <th>Acciones</th> 
      </tr>
    </thead>
    <tbody>
    <?php foreach ($personajes as $p): ?>
    <tr>
      <td><img src="<?= htmlspecialchars($p['foto']) ?>" alt="Foto"></td>
      <td><?= htmlspecialchars($p['nombre']) ?></td>
      <td><?= htmlspecialchars($p['apellido']) ?></td>
      <td><?= htmlspecialchars($p['id']) ?></td>
      <td><?= htmlspecialchars($p['fecha_nacimiento']) ?></td>
      <td><?= htmlspecialchars(isset($p['rol']) ? $p['rol'] : 'Sin rol asignado') ?></td>
      <td><?= htmlspecialchars($p['experiencia']) ?></td>
      <td>
        <a href="editar_personaje.php?id=<?= urlencode($p['id']) ?>" class="btn-accion btn-editar">✏️ </a>
        <a href="eliminar_personaje.php?id=<?= urlencode($p['id']) ?>" class="btn-accion btn-eliminar" onclick="return confirm('¿Estás seguro que quieres eliminar este personaje?');">🗑️ </a>
      </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
  <?php else: ?>
    <p style="text-align: center;">🎀 No hay personajes registrados aún.</p>
  <?php endif; ?>

  <div style="text-align: center;">
    <a href="index.php" class="boton-volver">⬅️ Volver al inicio</a>
  </div>

</body>
</html>
