<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/styles.css">
    <link rel="stylesheet" href="./assets/css/cards.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>El Rincon del Electricista</title>
</head>
<body class="body-experto">
    <section class="contenedor-experto" id="experto">
        <a href="./index.php#inicio"><button>Volver al Home</button></a>
          <br>
        <h2 class="subtitulo">Conocimientos basicos para calcular:</h2>
        <section class="experts card-container">
            <div class="cont-expert">
                <div class="card">
                    <div class="card-inner">
                        <div class="card-front">
                            <h1>Primera Ley de Ohm</h1>
                        </div>
                        <div class="card-back">
                            <h3>"La intensidad de corriente en un circuito es directamente proporcional a la tensión
                                aplicada a ella e inversamente proporcional a la resistencia del propio circuito".</h3>
                            <img src="./assets/img/ley_del_ohm.png" alt="Ley de Ohm">
                        </div>
                    </div>
                </div>
            </div>
            <div class="cont-expert">
                <div class="card">
                    <div class="card-inner">
                        <div class="card-front">
                            <h1>Ecuacion de Potencia</h1>
                        </div>
                        <div class="card-back">
                            <h3>"La potencia consumida por una carga o elemento del circuito es directamente
                                proporcional al producto entre el voltaje del circuito y la corriente que circula a
                                través de él"</h3>
                            <img src="./assets/img/triangulo_de_potencias.png" alt="Triangulo de Potencia">
                        </div>
                    </div>
                </div>
            </div>
            <div class="cont-expert">
                <div class="card">
                    <div class="card-inner">
                        <div class="card-front">
                            <h1>Energía Eléctrica</h1>
                        </div>
                        <div class="card-back">
                            <h3>La potencia eléctrica también se puede definir como la tasa de transferencia de energía. Si un joule de trabajo es absorbido o entregado a una velocidad constante de un segundo, la potencia correspondiente será equivalente a un watts, por lo que la potencia se puede definir como «1 Joule/seg = 1 watt»</h3>
                            <img src="./assets/img/formula_triangulo_energia.png" alt="Triangulo De Energia">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <br>
        <br>
        <br>
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

</body>

</html>