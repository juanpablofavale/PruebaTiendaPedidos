$(document).ready(function () {
    let productos = [];
    let items = {
        id: 0
    };

    // Función para mostrar el número de productos en el carrito
    function mostrarCarrito() {
        if (localStorage.getItem("productos") != null) {
            let array = JSON.parse(localStorage.getItem('productos'));
            if (array) {
                $('#carrito').text(array.length);
            }
        }
    }

    // Función para mostrar productos según categoría
    function mostrarProductos(category) {
        if (category === 'all') {
            $('.productos').css('transform', 'scale(1)');
            $('.productos').show();
        } else {
            $('.productos').css('transform', 'scale(0)');
            setTimeout(function () {
                $('.productos').hide();
                $('.productos[category="' + category + '"]').show();
                $('.productos[category="' + category + '"]').css('transform', 'scale(1)');
            }, 400);
        }
    }

    // Mostrar todos los productos al cargar la página
    mostrarProductos('all');

    // Configurar eventos para cambiar la categoría de productos
    $('.nav-link').click(function () {
        let category = $(this).attr('category');

        $('.nav-link').removeClass('active');
        $(this).addClass('active');

        mostrarProductos(category);
    });

    // Agregar producto al hacer clic en 'Agregar'
    $('.agregar').click(function (e) {
        e.preventDefault();
        const id = $(this).data('id');
        items = {
            id: id
        };
        productos.push(items);
        localStorage.setItem('productos', JSON.stringify(productos));
        mostrarCarrito();
    });

    // Redirigir al carrito al hacer clic en el botón 'Ver Carrito'
    $('#btnCarrito').click(function (e) {
        $('#btnCarrito').attr('href', 'carrito.php');
    });

    // Vaciar carrito al hacer clic en el botón 'Vaciar Carrito'
    $('#btnVaciar').click(function () {
        localStorage.removeItem("productos");
        $('#tblCarrito').html('');
        $('#total_pagar').text('0.00');
        mostrarCarrito();
    });

    // Mostrar modal de categorías al hacer clic en 'Abrir Categoría'
    $('#abrirCategoria').click(function () {
        $('#categorias').modal('show');
    });

    // Mostrar modal de productos al hacer clic en 'Abrir Producto'
    $('#abrirProducto').click(function () {
        $('#productos').modal('show');
    });

    // Confirmar eliminación al hacer clic en 'Eliminar'
    $('.eliminar').click(function (e) {
        e.preventDefault();
        if (confirm('¿Está seguro de eliminar?')) {
            this.submit();
        }
    });

    // Mostrar el número inicial de productos en el carrito al cargar la página
    mostrarCarrito();
});
