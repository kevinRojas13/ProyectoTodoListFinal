<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Usuario</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-image: url("assets/images/bg2.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            text-align: center;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #46A2FD;
        }

        .formulario {
            margin-top: 20px;
        }

        .form-control {
            margin-bottom: 15px;
        }

        .form-control label {
            display: block;
            font-weight: 500;
            margin-bottom: 5px;
        }

        .form-control input[type="text"],
        .form-control input[type="password"] {
            width: 100%;
            padding: 10px;
            border: none;
            background: #F2F2F2;
            font-size: 16px;
            outline: none;
            border-radius: 5px;
        }

        .boton {
            padding: 10px 40px;
            margin-top: 10px;
            border: none;
            font-size: 14px;
            background: #46A2FD;
            font-weight: 600;
            cursor: pointer;
            color: white;
            outline: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .boton:hover {
            background-color: #2196F3;
        }

        .usuarios {
            margin-top: 20px;
            background: #F2F2F2;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .usuarios h2 {
            color: #46A2FD;
        }

        .back-button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            border: none;
            background: #46A2FD;
            font-weight: 600;
            cursor: pointer;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .back-button:hover {
            background-color: #2196F3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Actualizar Usuario</h1>
        <form action="" method="GET" class="formulario">
            <div class="form-control">
                <label for="id">Nombre de Usuario:</label>
                <input type="text" name="id" id="id" required>
            </div>
            <div class="form-control">
                <input type="submit" value="Buscar" class="boton">
            </div>
        </form>

        <?php
        require_once "assets/php/conexion_be.php";

        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $query = "SELECT * FROM usuarios WHERE Usuario = '$id'";
            $result = mysqli_query($conexion, $query);

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $nombre = isset($row['Nombre_completo']) ? $row['Nombre_completo'] : '';
                $correo = isset($row['Correo']) ? $row['Correo'] : '';
                $usuario = isset($row['Usuario']) ? $row['Usuario'] : '';
                $contrasena = isset($row['Contrasena']) ? $row['Contrasena'] : '';
                ?>
                <div class="usuarios">
                    <h2>Datos del Usuario</h2>
                    <form action="cambiarcontrasena.php" method="POST" class="formulario">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <div class="form-control">
                            <label for="nombre">Nombre Completo:</label>
                            <input type="text" name="nombre" id="nombre" value="<?php echo $nombre; ?>" required>
                        </div>
                        <div class="form-control">
                            <label for="correo">Correo:</label>
                            <input type="text" name="correo" id="correo" value="<?php echo $correo; ?>" required>
                        </div>
                        <div class="form-control">
                            <label for="usuario">Nombre de Usuario:</label>
                            <input type="text" name="usuario" id="usuario" value="<?php echo $usuario; ?>" required>
                        </div>
                        <div class="form-control">
                            <label for="contrasena">Contraseña:</label>
                            <input type="password" name="contrasena" id="contrasena" value="<?php echo $contrasena; ?>" required>
                        </div>
                        <div class="form-control">
                            <input type="submit" value="Actualizar" class="boton">
                        </div>
                    </form>
                </div>
                <?php
            } else {
                echo "<p class='mensaje'>No se encontró el usuario con el nombre de usuario especificado.</p>";
            }
        }

        // Verificar si se envió el formulario de actualización
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST["id"];
            $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : '';
            $correo = isset($_POST["correo"]) ? $_POST["correo"] : '';
            $usuario = isset($_POST["usuario"]) ? $_POST["usuario"] : '';
            $contrasena = isset($_POST["contrasena"]) ? $_POST["contrasena"] : '';

            $query = "UPDATE usuarios SET Nombre_completo = '$nombre', Correo = '$correo', Usuario = '$usuario', Contrasena = '$contrasena' WHERE Usuario = '$id'";
            $result = mysqli_query($conexion, $query);
            if ($result) {
                echo "<p class='mensaje'>Usuario actualizado exitosamente.</p>";
            } else {
                echo "<p class='mensaje'>Error al actualizar el usuario.</p>";
            }
        }
        ?>

        <a href="bienvenida.php" class="back-button">Regresar</a>
    </div>
</body>
</html>