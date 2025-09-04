<?php

    function loadEnv($path)
    {
        if (!file_exists($path)) {
            throw new Exception("El archivo .env no existe en: $path");
        }

        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            // Ignorar comentarios
            if (strpos(trim($line), '#') === 0) {
                continue;
            }

            // Separar clave y valor
            list($name, $value) = explode('=', $line, 2);

            $name = trim($name);
            $value = trim($value, "\"'"); // Remueve comillas si las hay

            // Configurar la variable de entorno
            putenv("$name=$value");
            $_ENV[$name] = $value;
            $_SERVER[$name] = $value;
        }
    }

    // Si no hay variables de entorno las buscará en el archivo .env
    if (!getenv('DB_HOST') || !getenv('DB_USER') || !getenv('DB_PASS') || !getenv('DB_NAME')){
            loadEnv(__DIR__ . '/.env');
    }

    $host = getenv('DB_HOST');
    $user = getenv('DB_USER');
    $clave = getenv('DB_PASS');
    $bd = getenv('DB_NAME');
    $conexion = mysqli_connect($host,$user,$clave,$bd);

    if (mysqli_connect_errno()){
        echo "No se pudo conectar a la base de datos";
        exit();
    }

    mysqli_select_db($conexion,$bd) or die("No se encuentra la base de datos");
    mysqli_set_charset($conexion,"utf8");
