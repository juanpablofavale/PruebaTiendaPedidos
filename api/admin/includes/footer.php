
<!-- Footer -->
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
<script src="../assets/js/jquery-3.6.0.min.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/jquery.easing.min.js"></script>
<script src="../assets/js/sb-admin-2.min.js"></script>
<script src="../assets/js/all.min.js"></script>
<script src="../assets/js/scripts.js"></script>
</body>
</html>