<?php // Inicia el código PHP.
// Inicia o recupera la sesión del usuario.
session_start();
// Carga el archivo necesario.
require "config.php";

// Comprueba una condición.
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Guarda o actualiza el dato que se utiliza.
    $id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
    // Guarda o actualiza el dato que se utiliza.
    $talla = trim($_POST["talla"] ?? "");
    // Guarda o actualiza el dato que se utiliza.
    $cantidad = filter_input(INPUT_POST, "cantidad", FILTER_VALIDATE_INT);

    // Comprueba una condición.
    if ($id && $cantidad > 0) {
        // Guarda o actualiza el dato que se utiliza.
        $stmt = $pdo->prepare("SELECT * FROM productos WHERE id = ?");
        // Guarda o actualiza el dato que se utiliza.
        $stmt->execute([$id]);
        // Guarda o actualiza el dato que se utiliza.
        $producto = $stmt->fetch();

        // Comprueba una condición.
        if ($producto) {
            // Comprueba una condición.
            if (!isset($_SESSION["carrito"])) {
                // Guarda o actualiza el dato que se utiliza.
                $_SESSION["carrito"] = [];
            // Cierra el bloque de instrucciones.
            }

            // Identificador único por producto y variante (talla/presentación)
            // Guarda o actualiza el dato que se utiliza.
            $item_key = $id . "_" . $talla;

            // Comprueba una condición.
            if (isset($_SESSION["carrito"][$item_key])) {
                // Guarda o actualiza el dato que se utiliza.
                $_SESSION["carrito"][$item_key]["cantidad"] += $cantidad;
            // Cierra el bloque de instrucciones.
            } else {
                // Guarda o actualiza el dato que se utiliza.
                $_SESSION["carrito"][$item_key] = [
                    // Ejecuta la instrucción correspondiente.
                    "id" => $producto["id"],
                    // Ejecuta la instrucción correspondiente.
                    "nombre" => $producto["nombre"],
                    // Ejecuta la instrucción correspondiente.
                    "precio" => $producto["precio"],
                    // Ejecuta la instrucción correspondiente.
                    "imagen" => $producto["imagen"],
                    // Ejecuta la instrucción correspondiente.
                    "talla" => $talla,
                    // Ejecuta la instrucción correspondiente.
                    "cantidad" => $cantidad
                // Ejecuta la instrucción correspondiente.
                ];
            // Cierra el bloque de instrucciones.
            }
        // Cierra el bloque de instrucciones.
        }
    // Cierra el bloque de instrucciones.
    }
// Cierra el bloque de instrucciones.
}

// Redirige al usuario a otra página.
header("Location: carrito.php");
// Detiene la ejecución del archivo.
exit;
