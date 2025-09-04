<?php
session_start();
require_once "config/conexion.php";

$alert = '';

if (isset($_POST['action']) && $_POST['action'] == 'login') {
    $usuario = mysqli_real_escape_string($conexion, $_POST['usuario']);
    $clave = $_POST['clave'];

    $stmt = $conexion->prepare("SELECT id, nombre, usuario, clave, rol FROM usuarios WHERE usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $dato = $result->fetch_assoc();
        if (password_verify($clave, $dato['clave'])) {
            $_SESSION['active'] = true;
            $_SESSION['id'] = $dato['id'];
            $_SESSION['nombre'] = $dato['nombre'];
            $_SESSION['user'] = $dato['usuario'];
            $_SESSION['rol'] = $dato['rol'];

            if ($dato['rol'] == 'admin') {
                header('Location: productos.php');
            } else {
                header('Location: ../index.php');
            }
            exit;
        } else {
            $alert = 'Contraseña incorrecta';
        }
    } else {
        $alert = 'Usuario no encontrado';
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="El Rincon Del Electricista">
    <meta name="keywords" content="Electro Lanz, Electricista, Electricidad, Calculos electricos, Ley de Ohm, Calculo Potencia Electrica, Conocimientos en Electricidad, Calculo de Mano de Obra Electricidad">
    <meta name="author" content="Franco Libertini">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="imgage/png" href="./assets/img/Logo_ferreteria.png">
    <link rel="stylesheet" href="./assets/css/estilos.css">
    <link rel="stylesheet" href="./assets/css/styles.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet">
    <title>Electro Lanz</title>
</head>
<body class="principal">
        <header class="header" id="inicio">
        <img src="./assets/img/bx-menu-alt-right.svg" alt="" class="hamburguer">
    <nav class="menu-navegacion">
        <a href="#inicio">Inicio</a>
        <a href="#servicio">Nuestro Servicio</a>
        <a href="#portafolio">Galeria de Imagenes</a>
        <a href="#experto">Conocimientos Basicos</a>
        <a href="#tienda">Tienda</a>
        <a href="#contacto">Contacto</a>
        <a href="./calculo.php">Calculo de Mano de Obra</a>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <?php if (isset($_SESSION['active']) && $_SESSION['active']): ?>
        <?php $nombre = isset($_SESSION['user']) ? htmlspecialchars($_SESSION['user']) : 'Usuario'; ?>
        <p>Bienvenido, <?php echo $nombre; ?>!</p>
                <a href="logout.php" class="btn btn-danger">Cerrar Sesión</a>
            <?php else: ?>
                <a href="./admin/login.php" class="login">Log In</a>
            <?php endif; ?>
        <span></span>
    </nav>
    <div class="contenedor head">
        <img class="logo_ferre" src="./assets/img/Logo_ferreteria.png" alt="">
    </div>    
    </header>
    <main>
        <a class="logof" href="#contacto"><img class="logofl" src="./assets/img/Logo_ferreteria.png" alt="Logo Personal"></a>
        <section class="contenedor" id="servicio">
            <h2 class="subtitulo">Nuestro servicio</h2>
            <div class="contenedor-servicio">
                <img src="./assets/img/Frente_ferre.jpg" alt="checklist">
                <div class="checklist-servicio">
                    <div class="service">
                        <h3 class="n-service"><span class="number">1</span>Materiales Electricos</h3>
                        <p>Ofrecemos una amplia gama de materiales eléctricos de alta calidad para satisfacer todas tus necesidades. Desde cables y conductores hasta dispositivos de iluminación y equipos de seguridad, contamos con productos de las mejores marcas para garantizar la máxima eficiencia y durabilidad.
                        </p>
                    </div>
                    <br>
                    <div class="service">
                        <h3 class="n-service"><span class="number">2</span>Articulos de Ferreteria</h3>
                        <p>Encuentra todo lo que necesitas para tus proyectos de construcción, reparación y mantenimiento. Disponemos de una extensa variedad de herramientas, accesorios y materiales de ferretería que cumplen con los más altos estándares de calidad, asegurando que cada trabajo se realice con precisión y seguridad.</p>
                    </div>
                    <br>
                    <div class="service">
                        <h3 class="n-service"><span class="number">3</span>Articulos de Camping</h3>
                        <p>Prepárate para tus aventuras al aire libre con nuestros productos de camping. Ofrecemos tiendas de campaña, sacos de dormir, linternas y todo lo esencial para disfrutar de la naturaleza con comodidad y seguridad. Nuestro equipo de camping está diseñado para resistir las condiciones más exigentes, garantizando una experiencia inolvidable.</p>
                    </div>
                    <br>
                </div>
            </div>
        </section>
        <section class="gallery" id="portafolio">
            <div class="contenedor">
                <h2 class="subtitulo">Local Comercial</h2>
                <div class="contenedor-galeria">
                    <img src="./assets/img/1.jpeg" alt="" class="img-galeria">
                    <img src="./assets/img/2.jpeg" alt="" class="img-galeria">
                    <img src="./assets/img/3.jpeg" alt="" class="img-galeria">
                    <img src="./assets/img/4.jpeg" alt="" class="img-galeria">
                    <img src="./assets/img/5.jpeg" alt="" class="img-galeria">
                    <img src="./assets/img/6.jpeg" alt="" class="img-galeria">
                </div>
            </div>
        </section>
      <section class="imagen-light">
            <img src="./assets/img/bx-x.svg" alt="" class="close">
            <img src="./assets/img/desbloquear.jpg" alt="" class="agregar-imagen">
        </section> 
        <section class="contenedor-experto" id="experto">
            <br>
            <br>
            <h2 class="subtitulo">Conocimientos basicos sobre calculos electricos.</h2>
            <h2 class="subtitulo">&darr;     &darr;     &darr;     &darr;    &darr;</h2>
            <a href="./leydeohm.php"><img class="ley" src="./assets/img/Ley de Ohm.jpg" alt="Ley de Ohm"></a>
        </section>
        <!-- Tienda-->
        <section id="tienda">
    <div class="tienda py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder"><img src="./assets/img/Logo_ferreteria.png" alt=""></h1>
                <p class="lead fw-normal text-white-50 mb-0">Seccion de la Tienda Online</p>
            </div>
        </div>
    </div>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
            <div class="container-fluid">
                <a class="navbar-brand" href="#tienda">Filtro de Busqueda</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                        <!-- Navigation-->
        <a href="./carrito.php" class="btn-flotante" id="btnCarrito">Carrito <span class="badge bg-success" id="carrito">0</span></a>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <a href="#tienda" class="nav-link text-info" category="all">Todo</a>
                        <?php
                        $query = mysqli_query($conexion, "SELECT * FROM categorias");
                        while ($data = mysqli_fetch_assoc($query)) { ?>
                            <a href="#tienda" class="nav-link" category="<?php echo $data['categoria']; ?>"><?php echo $data['categoria']; ?></a>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <section class="py-5">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php
                $query = mysqli_query($conexion, "SELECT p.*, c.id AS id_cat, c.categoria FROM productos p INNER JOIN categorias c ON c.id = p.id_categoria");
                $result = mysqli_num_rows($query);
                if ($result > 0) {
                    while ($data = mysqli_fetch_assoc($query)) { ?>
                        <div class="col mb-5 productos" category="<?php echo $data['categoria']; ?>">
                            <div class="card h-100">
                                <!-- Sale badge-->
                                <div class="badge bg-danger text-white position-absolute" style="top: 0.5rem; right: 0.5rem"><?php echo ($data['precio_normal'] > $data['precio_rebajado']) ? 'Oferta' : ''; ?></div>
                                <!-- Product image-->
                                <img class="card-img-top" src="assets/img/<?php echo $data['imagen']; ?>" alt="..." />
                                <!-- Product details-->
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <!-- Product name-->
                                        <h5 class="fw-bolder"><?php echo $data['nombre'] ?></h5>
                                        <p><?php echo $data['descripcion']; ?></p>
                                        <!-- Product reviews-->
                                        <div class="d-flex justify-content-center small text-warning mb-2">
                                            <div class="bi-star-fill"></div>
                                            <div class="bi-star-fill"></div>
                                            <div class="bi-star-fill"></div>
                                            <div class="bi-star-fill"></div>
                                            <div class="bi-star-fill"></div>
                                        </div>
                                        <!-- Product price-->
                                        <span class="text-muted text-decoration-line-through"><?php echo $data['precio_normal'] ?></span>
                                        <?php echo $data['precio_rebajado'] ?>
                                    </div>
                                </div>
                                <!-- Product actions-->
                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                    <div class="text-center"><a class="btn btn-outline-dark mt-auto agregar" data-id="<?php echo $data['id']; ?>" href="#">Agregar</a></div>
                                </div>
                            </div>
                        </div>
                <?php  }
                } ?>
            </div>
        </div>
    </section>
        </section>
    </main>
    <br>
    <br>
    <br>
    <footer id="contacto">
        <div class="contenedor footer-content">
            <div class="contact-us">
                <p>Dirección: Av. Lainez 2890, Bahía Blanca</p>
                <p>Teléfono: 0291 402-4466</p>
                <p>
                    <?php
                        $horarios = [
                            'Lunes' => '8:30 a 12:30  -  16:00  a 20:00',
                            'Martes' => '8:30 a 12:30  -  16:00  a 20:00',
                            'Miércoles' => '8:30 a 12:30  -  16:00  a 20:00',
                            'Jueves' => '8:30 a 12:30  -  16:00  a 20:00',
                            'Viernes' => '8:30 a 12:30  -  16:00  a 20:00',
                            'Sábado' => '9:00  - 13:00 ',
                            'Domingo' => 'Cerrado'
                        ];  
                        $diasSemana = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
                        $diaActual = date('N');
                        $nombreDia = $diasSemana[$diaActual % 7];
                        $horarioHoy = $horarios[$nombreDia];
                        echo "Horario de hoy ($nombreDia): $horarioHoy";
                        ?>
                        </p>
            </div>
            <div class="social-media">
                <a href="https://web.facebook.com/electrolanz.ferreteria1" target="_blank" class="social-media-icon">
                    <i class='bx bxl-facebook'></i>
                </a>
                <a href="https://www.instagram.com/ferreteriaelectrolanz/" target="_blank" class="social-media-icon">
                    <i class='bx bxl-instagram'></i>
                </a>
                <a href="https://x.com/home" target="_blank" class="social-media-icon">
                    <i class='bx bxl-twitter' ></i>
                </a>
                <a href="https://wa.me/2915747629" target="_blank" class="social-media-icon">
                    <i class='bx bxl-whatsapp' ></i>
                </a>
            </div>
        </div>
        <div class="line">
        </div> 
    </footer>
    <script src="./assets/js/menu.js"></script>
    <script src="./assets/js/lightbox.js"></script>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="./assets/js/jquery-3.6.0.min.js"></script>
    <script src="./assets/js/scripts.js"></script>
</body>
</html>