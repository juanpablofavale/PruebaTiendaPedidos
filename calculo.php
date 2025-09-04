<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./assets/css/styles.css">
    <title>El Rincon del Electricista</title>
</head>
<body>
    <section class="calculo">
    <a id="inicio" href="./index.php#header"><button> Volver al Home</button></a>
    <h1>Bienvenido al Programa de Presupuesto de Mano de Obra de Eléctricidad</h1>
    <p>Este programa te ayudará a calcular un presupuesto aproximado.</p>
    <p>------------------------------------------------------------</p>
    <label for="valorUnitario">Ingrese el valor unitario de Boca de Electricidad:</label>
    <input type="number" id="valorUnitario">
    <div id="opciones">
        <p>Seleccione una opción:</p>
        <br>
        <br>
        <input type="radio" name="opcion" value="1" id="opcion1">
        <label for="opcion1">Calcular presupuesto por cantidad total de Bocas</label>
        <input type="radio" name="opcion" value="2" id="opcion2">
        <label for="opcion2">Calcular presupuesto de Bocas por circuitos</label>
    </div>
    <div id="resultado">
    </div>
    <div >
    <a class="calcular" id="calcular">Calcular</a>
    <a class="limpiar" id="limpiar">Limpiar</a>
    <br>
    <br>
    <p id="mensaje" class="mensaje"></p>
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
    <script src="./assets/js/script-calculo.js"></script>
</body>
</html>
