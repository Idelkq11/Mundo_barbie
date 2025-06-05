
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>🌸 Mundo Barbie - Inicio</title>
  <link rel="stylesheet" href="css/estilo.css">
  <style>
    body {
      font-family: 'Comic Sans MS', cursive;
      background: linear-gradient(to right, #ffb6c1, #ffc0cb);
      text-align: center;
      padding: 40px;
    }

    h1 {
      color: #ff1493;
      font-size: 48px;
      margin-top: 20px;
    }

    .menu {
      margin-top: 40px;
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 30px;
    }


    .menu a {
      text-decoration: none;
      background-color: #fff0f5;
      color: #ff1493;
      border: 2px solid #ff69b4;
      padding: 15px 30px;
      border-radius: 20px;
      font-weight: bold;
      transition: 0.3s;
    }

    

    .menu a:hover {
      background-color: #ff69b4;
      color: white;
    }

    .logo-barbie {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      object-fit: cover;
      box-shadow: 0 0 15px #ff69b4;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>

  <img src="https://i.pinimg.com/736x/26/64/a7/2664a71afdcedda333ef64fac726e768.jpg" alt="Logo Barbie" class="logo-barbie">
  <h1>✨ Bienvenidos al Mundo Barbie ✨</h1>

  <div class="menu">
    <a href="lista_personajes.php">📋 Personajes</a>
    <a href="lista_profesiones.php">💼 Profesiones</a>
    <a href="Estadistica.php">📊 Ver Estadísticas</a>
  </div>

</body>
</html>

