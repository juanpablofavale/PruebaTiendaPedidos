<?php
session_start();
require_once "config/conexion.php";

if (isset($_POST['action']) && $_POST['action'] == 'buscar') {
    $array['datos'] = array();
    $total = 0;

    foreach ($_POST['data'] as $producto) {
        $id = $producto['id'];
        $query = mysqli_query($conexion, "SELECT * FROM productos WHERE id = $id");
        
        if ($query && mysqli_num_rows($query) > 0) {
            $result = mysqli_fetch_assoc($query);
            $data['id'] = $result['id'];
            $data['nombre'] = $result['nombre'];
            $data['precio'] = $result['precio_rebajado'];
            $total += $result['precio_rebajado'];
            $array['datos'][] = $data;
        } else {
            die(json_encode(['error' => 'Error al obtener productos desde la base de datos.']));
        }
    }

    $array['total'] = $total;
    echo json_encode($array);
    exit;
}



// Función para enviar correo electrónico

if (isset($_POST['enviarCorreo'])) {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $mensaje = $_POST['mensaje'];

    $para = "libertini.f.a@gmail.com";
    $asunto = "Lista de Compra de $nombre";
    $contenido = "Nombre: $nombre \nCorreo: $correo \nMensaje: $mensaje";

    if (mail($para, $asunto, $contenido)) {
        echo json_encode(['status' => 'success', 'message' => 'Correo enviado correctamente.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error al enviar el correo. Por favor, inténtalo de nuevo.']);
    }
}

// Verificar la autenticación antes de manejar el carrito de compras

if (isset($_POST['action']) && $_POST['action'] == 'enviar_compra') {
    if (empty($_SESSION['active'])) {
        echo json_encode(['status' => 'error', 'message' => 'Usuario no autenticado.']);
        exit;
    }

    $productos = json_decode($_POST['productos'], true);
    $nombreUsuario = $_SESSION['nombre'];

    // Aquí puedes implementar la lógica para enviar los detalles de la compra por correo
    // Ejemplo básico utilizando la función mail():
    $para = "libertini.f.a@gmail.com";
    $asunto = "Compra realizada por $nombreUsuario";
    $contenido = "Usuario: $nombreUsuario \nProductos: " . print_r($productos, true);

    if (mail($para, $asunto, $contenido)) {
        echo json_encode(['status' => 'success', 'message' => 'Compra enviada correctamente.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error al enviar la compra. Por favor, inténtalo de nuevo.']);
    }
}

// Función para manejar el carrito de compras
if (isset($_POST['agregarCarrito'])) {
    $producto_id = $_POST['producto_id'];
    $cantidad = $_POST['cantidad'];

    session_start();
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = array();
    }

    $_SESSION['carrito'][] = array(
        'producto_id' => $producto_id,
        'cantidad' => $cantidad
    );

    echo "Producto agregado al carrito.";
}

// Otras funciones AJAX que puedas necesitar
// ...

?>
