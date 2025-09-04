<?php
session_start();

// Redirigir al login si el usuario no está autenticado
if (empty($_SESSION['active'])) {
    header('Location: ./admin/login.php');
    exit;
}

// Obtener el nombre del usuario desde la sesión
$nombreUsuario = $_SESSION['nombre'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="./assets/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./assets/css/styles.css">
    <link rel="shortcut icon" href="./assets/img/Logo_ferreteria.png">
</head>

<body>
    <header class="tienda py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <a href="index.php#tienda"><img src="./assets/img/Logo_ferreteria.png" alt=""></a>
                <?php if (isset($_SESSION['active']) && $_SESSION['active']): ?>
        <?php $nombre = isset($_SESSION['user']) ? htmlspecialchars($_SESSION['user']) : 'Usuario'; ?>
        <p>Bienvenido al Carrito de Compras, <?php echo $nombre; ?>!</p>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <section class="py-5">
        <div class="container px-4 px-lg-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Producto</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Sub Total</th>
                                </tr>
                            </thead>
                            <tbody id="tblCarrito">

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-5 ms-auto">
                    <h4>Total a Pagar: <span id="total_pagar">0.00</span></h4>
                    <div class="d-grid gap-2">
                        <button class="btn btn-warning" type="button" id="btnVaciar">Vaciar Carrito</button>
                        <?php if (!isset($_SESSION['active'])) : ?>
                            <a href="./admin/login.php" class="btn btn-primary">Iniciar Sesión</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-12">
                    <form id="formCompra">
                        <button type="submit" class="btn btn-primary">Enviar Compra</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

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
                <a href="https://twitter.com/Libertini3209" target="_blank" class="social-media-icon">
                    <i class='bx bxl-twitter'></i>
                </a>
                <a href="https://wa.me/2915747629" target="_blank" class="social-media-icon">
                    <i class='bx bxl-whatsapp'></i>
                </a>
            </div>
        </div>
        <div class="line"></div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/js/jquery-3.6.0.min.js"></script>
    <script src="./assets/js/scripts.js"></script>
    <script>
        mostrarCarrito();

        function mostrarCarrito() {
            if (localStorage.getItem("productos") != null) {
                let array = JSON.parse(localStorage.getItem('productos'));
                if (array.length > 0) {
                    $.ajax({
                        url: './ajax.php',
                        type: 'POST',
                        data: {
                            action: 'buscar',
                            data: array
                        },
                        success: function (response) {
                            console.log(response);
                            const res = JSON.parse(response);
                            let html = '';
                            res.datos.forEach(element => {
                                html += `<tr>
                                    <td>${element.id}</td>
                                    <td>${element.nombre}</td>
                                    <td>${element.precio}</td>
                                    <td>1</td>
                                    <td>${element.precio}</td>
                                </tr>`;
                            });
                            $('#tblCarrito').html(html);
                            $('#total_pagar').text(res.total);
                        },
                        error: function (error) {
                            console.log(error);
                        }
                    });
                }
            }
        }

        $('#formCompra').submit(function (e) {
            e.preventDefault();
            let productos = JSON.parse(localStorage.getItem('productos'));

            if (productos && productos.length > 0) {
                $.ajax({
                    url: './ajax.php',
                    type: 'POST',
                    data: {
                        action: 'enviar_compra',
                        productos: JSON.stringify(productos) // Convertir a string JSON
                    },
                    success: function (response) {
                        let res = JSON.parse(response);
                        if (res.status === 'success') {
                            alert('Compra enviada correctamente');
                            localStorage.removeItem('productos');
                            $('#tblCarrito').html('');
                            $('#total_pagar').text('0.00');
                        } else {
                            alert(res.message);
                        }
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            } else {
                alert('El carrito está vacío');
            }
        });

        $('#btnVaciar').click(function () {
            localStorage.removeItem('productos');
            $('#tblCarrito').html('');
            $('#total_pagar').text('0.00');
        });
    </script>
</body>

</html>
