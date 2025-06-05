<?php
$archivo = "css/js/data/profesiones.json";
$profesiones = file_exists($archivo) ? json_decode(file_get_contents($archivo), true) : [];

if (isset($_POST['guardar'])) {
    $nueva_profesion = [
        "id" => uniqid(),
        "nombre" => $_POST["nombre"],
        "categoria" => $_POST["categoria"],
        "salario" => $_POST["salario"]
    ];

    $profesiones[] = $nueva_profesion;
    file_put_contents($archivo, json_encode($profesiones, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    echo "<script>alert('💼 Profesión registrada con éxito'); window.location.href='lista_profesiones.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registrar Profesión</title>
  <style>
    body {
      background-color: #fef0f5;
      font-family: 'Comic Sans MS', cursive;
      padding: 20px;
      color: #d63384;
    }
    form {
      background: #fff;
      padding: 20px;
      border-radius: 15px;
      width: 400px;
      margin: auto;
      box-shadow: 0 0 10px #ff69b4;
    }
    label {
      font-weight: bold;
    }
    input, select {
      width: 100%;
      padding: 10px;
      margin-bottom: 12px;
      border-radius: 10px;
      border: 1px solid #ccc;
    }
    input[type="submit"] {
      background: #ff69b4;
      color: white;
      font-weight: bold;
      cursor: pointer;
    }
    input[type="submit"]:hover {
      background: #d63384;
    }
  </style>
</head>
<body>
  <h2 style="text-align:center;">💼 Registrar Profesión</h2>
  <form method="POST">
    <label>Nombre de la Profesión:</label>
    <input type="text" name="nombre" required>

    <label>Categoría:</label>
    <select name="categoria" required>
      <option value="Ciencia">Ciencia</option>
      <option value="Arte">Arte</option>
      <option value="Deporte">Deporte</option>
      <option value="Entretenimiento">Entretenimiento</option>
      <option value="Tecnología">Tecnología</option>
      <option value="Oficio">Oficio</option>
      <option value="Educación">Educación</option>
      <option value="Moda">Moda</option>
      <option value="Salud">Salud</option>
      <option value="Gastronomía">Gastronomía</option>
    </select>

    <label>Salario Mensual (USD):</label>
    <input type="number" name="salario" required min="0">

    <input type="submit" name="guardar" value="Registrar Profesión">
  </form>
</body>
</html>

