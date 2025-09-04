<?php
session_start();

require_once "../config/conexion.php";

$alert = '';

// Manejar el inicio de sesión
if (isset($_POST['action']) && $_POST['action'] == 'login') {
    $usuario = mysqli_real_escape_string($conexion, $_POST['usuario']);
    $clave = $_POST['clave'];

    // Verificar si el usuario existe en la base de datos
    $stmt = $conexion->prepare("SELECT id, nombre, usuario, clave, rol FROM usuarios WHERE usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Usuario existe, verificar contraseña
        $dato = $result->fetch_assoc();
        if (password_verify($clave, $dato['clave'])) {
            // Contraseña válida, iniciar sesión
            $_SESSION['active'] = true;
            $_SESSION['id'] = $dato['id'];
            $_SESSION['nombre'] = $dato['nombre'];
            $_SESSION['user'] = $dato['usuario'];
            
        // Comprobaciones de depuración
        if (!isset($_SESSION['nombre']) || $_SESSION['nombre'] == null) {
            error_log("Error: Nombre de usuario no configurado correctamente en la sesión.");
        }


            // Redirigir según el rol
            if ($dato['rol'] == 'admin') {
                header('Location: productos.php');
            } else {
                header('Location: ../index.php');
            }
            exit;
        } else {
            // Contraseña incorrecta
            $alert = '<div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
                        Contraseña incorrecta
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
        }
    } else {
        // Usuario no existe
        $alert = '<div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
                    Usuario no encontrado
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
    }
}

// Manejar el registro
if (isset($_POST['action']) && $_POST['action'] == 'register') {
    $usuario = mysqli_real_escape_string($conexion, $_POST['usuario']);
    $clave = password_hash($_POST['clave'], PASSWORD_BCRYPT);

    // Verificar si el usuario ya existe
    $stmt = $conexion->prepare("SELECT id FROM usuarios WHERE usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0){ 
        // Usuario ya existe
        $alert = '<div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
                    El usuario ya está registrado
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
    } else {
        // Registrar nuevo usuario
        $stmt = $conexion->prepare("INSERT INTO usuarios (usuario, clave, rol) VALUES (?, ?, 'cliente')");
        $stmt->bind_param("ss", $usuario, $clave);
        if ($stmt->execute()) {
            $alert = '<div class="alert alert-success text-center alert-dismissible fade show" role="alert">
                        Usuario registrado exitosamente
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
        } else {
            $alert = '<div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
                        Error al registrar usuario
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login / Registro</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/sb-admin-2.min.css">
    <link rel="shortcut icon" href="../assets/img/Logo_ferreteria.png" />
</head>

<body class="bg-gradient-primary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row align-items-center">
                            <div class="col-lg-6">
                                <img class="p-5 w-100" src="../assets/img/Logo_ferreteria.png" alt="">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Bienvenido!</h1>
                                        <?php echo (isset($alert)) ? $alert : ''; ?>
                                    </div>
                                    <form class="user" method="POST" action="" autocomplete="off">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="usuario" name="usuario" placeholder="Usuario...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="clave" name="clave" placeholder="Password">
                                        </div>
                                        <button type="submit" name="action" value="login" class="btn btn-primary btn-user btn-block">
                                            Ingresar
                                        </button>
                                        <button type="submit" name="action" value="register" class="btn btn-secondary btn-user btn-block">
                                            Registrar
                                        </button>
                                        <hr>
                                    </form>
                                    <div class="text-center">
                                        <a class="small" href="../index.php">Volver al inicio</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery.easing.min.js"></script>
    <script src="assets/js/sb-admin-2.min.js"></script>
</body>

</html>
