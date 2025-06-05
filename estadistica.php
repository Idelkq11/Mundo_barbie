<?php
$archivoPersonajes = "css/js/data/personajes.json";
$archivoProfesiones = "css/js/data/profesiones.json";

$personajes = file_exists($archivoPersonajes) ? json_decode(file_get_contents($archivoPersonajes), true) : [];
$profesiones = file_exists($archivoProfesiones) ? json_decode(file_get_contents($archivoProfesiones), true) : [];

$totalPersonajes = count($personajes);
$totalProfesiones = count($profesiones);

$edades = [];
foreach ($personajes as $p) {
    if (!empty($p['fecha_nacimiento'])) {
        $nacimiento = new DateTime($p['fecha_nacimiento']);
        $hoy = new DateTime();
        $edad = $hoy->diff($nacimiento)->y;
        $edades[] = $edad;
    }
}
$edadPromedio = count($edades) > 0 ? round(array_sum($edades) / count($edades)) : 0;

$experienciaFrecuente = 'Ninguna';
if (!empty($personajes)) {
    $experiencias = array_column($personajes, 'experiencia');
    $experiencias = array_filter($experiencias); 
    if ($experiencias) {
        $conteo = array_count_values($experiencias);
        arsort($conteo);
        $experienciaFrecuente = array_key_first($conteo);
    }
}

$salarioPorCategoria = [];
$conteoPorCategoria = [];

foreach ($profesiones as $p) {
    $categoria = $p['categoria'];
    $salario = (float)$p['salario'];
    $salarioPorCategoria[$categoria] = ($salarioPorCategoria[$categoria] ?? 0) + $salario;
    $conteoPorCategoria[$categoria] = ($conteoPorCategoria[$categoria] ?? 0) + 1;
}

$promedioPorCategoria = [];
foreach ($salarioPorCategoria as $categoria => $total) {
    $promedioPorCategoria[$categoria] = round($total / $conteoPorCategoria[$categoria], 2);
}

$salarios = array_column($profesiones, 'salario');
$profesionAlta = $profesionBaja = 'N/A';
if (!empty($salarios)) {
    $maxSalario = max($salarios);
    $minSalario = min($salarios);

    foreach ($profesiones as $p) {
        if ($p['salario'] == $maxSalario) $profesionAlta = $p['nombre'];
        if ($p['salario'] == $minSalario) $profesionBaja = $p['nombre'];
    }
    $salarioPromedio = round(array_sum($salarios) / count($salarios), 2);
} else {
    $salarioPromedio = 0;
}

$personajeTop = 'Ninguno';
$salarioTop = 0;
foreach ($personajes as $p) {
    $nombreRol = $p['rol'] ?? null;
    $prof = array_filter($profesiones, fn($pro) => $pro['nombre'] === $nombreRol);
    if (!empty($prof)) {
        $salario = (float)array_values($prof)[0]['salario'];
        if ($salario > $salarioTop) {
            $salarioTop = $salario;
            $personajeTop = $p['nombre'] . ' ' . $p['apellido'];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>📊 Estadísticas | Mundo Barbie</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    body {
      font-family: 'Comic Sans MS', cursive;
      background-color: #fff0f5;
      color: #d63384;
      padding: 20px;
    }
    h1 {
      text-align: center;
      color: #ff1493;
    }
    .panel {
      background: #ffffff;
      border-radius: 15px;
      box-shadow: 0 0 10px #ff69b4;
      padding: 20px;
      margin: 20px auto;
      max-width: 900px;
    }
    .stats {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
      gap: 15px;
      margin-bottom: 30px;
    }
    .stat-box {
      background: #ffe6f0;
      padding: 15px;
      border-radius: 12px;
      box-shadow: 0 0 6px #ff69b4;
    }
    canvas {
      max-width: 100%;
    }
    .boton-volver {
      display: inline-block;
      margin: 15px 10px;
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
    .botones-container {
      text-align: center;
      margin-top: 30px;
    }
  </style>
</head>
<body>
  <h1>📊 Panel de Estadísticas del Mundo Barbie</h1>

  <div class="panel">
    <div class="stats">
      <div class="stat-box">👩 Total de personajes: <strong><?= $totalPersonajes ?></strong></div>
      <div class="stat-box">💼 Total de profesiones: <strong><?= $totalProfesiones ?></strong></div>
      <div class="stat-box">🎂 Edad promedio: <strong><?= $edadPromedio ?> años</strong></div>
      <div class="stat-box">📚 Experiencia más común: <strong><?= $experienciaFrecuente ?></strong></div>
      <div class="stat-box">💰 Salario promedio: <strong>$<?= $salarioPromedio ?></strong></div>
      <div class="stat-box">🏆 Personaje con salario más alto: <strong><?= $personajeTop ?></strong></div>
      <div class="stat-box">⬆️ Profesión mejor pagada: <strong><?= $profesionAlta ?></strong></div>
      <div class="stat-box">⬇️ Profesión menos pagada: <strong><?= $profesionBaja ?></strong></div>
    </div>

    <h2 style="text-align:center;">📊 Salario promedio por categoría de profesión</h2>
    <canvas id="salaryChart"></canvas>
  </div>

  <div class="botones-container">
    <a href="Lista_personajes.php" class="boton-volver">⬅️ Volver a personajes</a>
    <a href="index.php" class="boton-volver">🏠 Volver al inicio</a>
  </div>

  <script>
    const ctx = document.getElementById("salaryChart").getContext("2d");

    const salaryChart = new Chart(ctx, {
      type: "bar",
      data: {
        labels: <?= json_encode(array_keys($promedioPorCategoria)) ?>,
        datasets: [{
          label: "Salario Promedio ($USD)",
          data: <?= json_encode(array_values($promedioPorCategoria)) ?>,
          backgroundColor: ["#ff69b4", "#ffcc00", "#00bfff", "#ff5733", "#8e44ad", "#00c9a7", "#ff8c00", "#e84393"]
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: { display: false },
          title: { display: false }
        },
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>
</body>
</html>
