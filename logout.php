<?php
session_start();
session_destroy();
header('Location: index.php'); // Redirige a la página de inicio u otra página deseada
exit;
?>
