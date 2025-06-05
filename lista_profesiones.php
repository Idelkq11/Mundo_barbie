<?php
$archivo = "css/js/data/profesiones.json";
$profesiones = file_exists($archivo) ? json_decode(file_get_contents($archivo), true) : [];
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Lista de Profesiones</title>
  <style>
    body {
      background-color: #fff0f5;
      font-family: 'Comic Sans MS', cursive;
      padding: 20px;
      color: #d63384;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      background: #fff;
    }
    th, td {
      border: 1px solid #ffb6c1;
      padding: 12px;
      text-align: center;
    }
    th {
      background: #ffccdd;
    }
    .boton {
      background: #ff69b4;
      color: white;
      padding: 10px;
      border-radius: 10px;
      text-decoration: none;
      font-weight: bold;
      box-shadow: 0 0 5px #d63384;
      margin: 5px;
      display: inline-block;
    }
    .boton:hover {
      background: #d63384;
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
  <h1>📋 Lista de Profesiones</h1>
  <a href="registrar_profesion.php" class="boton">➕ Agregar Profesión</a>

  <?php if (count($profesiones) > 0): ?>
  <table>
    <thead>
      <tr>
        <th>Nombre</th>
        <th>Categoría</th>
        <th>Salario (USD)</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($profesiones as $p): ?>
      <tr>
        <td><?= htmlspecialchars($p['nombre']) ?></td>
        <td><?= htmlspecialchars($p['categoria']) ?></td>
        <td>$<?= number_format($p['salario'], 2) ?></td>
        <td>
          <a href="editar_profesion.php?id=<?= $p['id'] ?>" class="boton">✏️ </a>
          <a href="eliminar_profesion.php?id=<?= $p['id'] ?>" class="boton" onclick="return confirm('¿Eliminar esta profesión?')">🗑️ </a>
        </td>
      </tr>
      <?php endforeach; ?> 
    </tbody>
  </table>
  <?php else: ?>
    <p>No hay profesiones registradas.</p>
  <?php endif; ?> 

  <div style="text-align: center;">
    <a href="index.php" class="boton-volver">⬅️ Volver al inicio</a>
  </div>
</body>
</html>
