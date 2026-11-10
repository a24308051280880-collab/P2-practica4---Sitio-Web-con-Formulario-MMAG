<?php // Inicia el código PHP.
// Inicia o recupera la sesión del usuario.
session_start();
// Carga el archivo necesario.
require "config.php";

// Guarda o actualiza el dato que se utiliza.
$carrito = $_SESSION["carrito"] ?? [];

// Comprueba una condición.
if ($_SERVER["REQUEST_METHOD"] !== "POST" || empty($carrito)) {
    // Redirige al usuario a otra página.
    header("Location: carrito.php");
    // Detiene la ejecución del archivo.
    exit;
// Cierra el bloque de instrucciones.
}

// Recibir y validar datos del formulario
// Guarda o actualiza el dato que se utiliza.
$nombre = trim($_POST["nombre"] ?? "");
// Guarda o actualiza el dato que se utiliza.
$direccion = trim($_POST["direccion"] ?? "");
// Guarda o actualiza el dato que se utiliza.
$numero_tarjeta = preg_replace("/\D/", "", $_POST["numero_tarjeta"] ?? "");
// Guarda o actualiza el dato que se utiliza.
$fecha_expiracion = trim($_POST["fecha_expiracion"] ?? "");
// Guarda o actualiza el dato que se utiliza.
$cvv = trim($_POST["cvv"] ?? "");

// Comprueba una condición.
if (empty($nombre) || empty($direccion) || strlen($numero_tarjeta) !== 16 || empty($fecha_expiracion) || empty($cvv)) {
    // Muestra un mensaje y detiene el programa.
    die("Por favor completa correctamente todos los campos del formulario de pago.");
// Cierra el bloque de instrucciones.
}

// Calcular total final
// Guarda o actualiza el dato que se utiliza.
$total = 0;
// Recorre los elementos de la lista.
foreach ($carrito as $item) {
    // Guarda o actualiza el dato que se utiliza.
    $total += $item["precio"] * $item["cantidad"];
// Cierra el bloque de instrucciones.
}

// Para seguridad, guardamos solo los últimos 4 dígitos
// Guarda o actualiza el dato que se utiliza.
$tarjeta_ultimos4 = substr($numero_tarjeta, -4);
// Guarda o actualiza el dato que se utiliza.
$usuario_id = $_SESSION["usuario_id"] ?? null;

// Intenta ejecutar este proceso.
try {
    // Guarda o actualiza el dato que se utiliza.
    $pdo->beginTransaction();

    // 1. Guardar la orden general en 'pedidos'
    // Guarda o actualiza el dato que se utiliza.
    $stmtPedido = $pdo->prepare("
        // Ejecuta la instrucción correspondiente.
        INSERT INTO pedidos (usuario_id, nombre_cliente, direccion_envio, tarjeta_ultimos4, fecha_expiracion, total) 
        // Ejecuta la instrucción correspondiente.
        VALUES (?, ?, ?, ?, ?, ?)
    // Ejecuta la instrucción correspondiente.
    ");
    // Guarda o actualiza el dato que se utiliza.
    $stmtPedido->execute([$usuario_id, $nombre, $direccion, $tarjeta_ultimos4, $fecha_expiracion, $total]);
    // Guarda o actualiza el dato que se utiliza.
    $pedido_id = $pdo->lastInsertId();

    // 2. Guardar cada ítem del carrito en 'detalle_pedidos'
    // Guarda o actualiza el dato que se utiliza.
    $stmtDetalle = $pdo->prepare("
        // Ejecuta la instrucción correspondiente.
        INSERT INTO detalle_pedidos (pedido_id, producto_id, opcion_talla, cantidad, precio_unitario) 
        // Ejecuta la instrucción correspondiente.
        VALUES (?, ?, ?, ?, ?)
    // Ejecuta la instrucción correspondiente.
    ");

    // Recorre los elementos de la lista.
    foreach ($carrito as $item) {
        // Guarda o actualiza el dato que se utiliza.
        $stmtDetalle->execute([
            // Guarda o actualiza el dato que se utiliza.
            $pedido_id,
            // Guarda o actualiza el dato que se utiliza.
            $item["id"],
            // Guarda o actualiza el dato que se utiliza.
            $item["talla"],
            // Guarda o actualiza el dato que se utiliza.
            $item["cantidad"],
            // Guarda o actualiza el dato que se utiliza.
            $item["precio"]
        // Ejecuta la instrucción correspondiente.
        ]);
    // Cierra el bloque de instrucciones.
    }

    // Guarda o actualiza el dato que se utiliza.
    $pdo->commit();

    // Limpiar carrito tras completar la compra exitosamente
    // Elimina el dato indicado.
    unset($_SESSION["carrito"]);

    // Redirige al usuario a otra página.
    header("Location: index.php?pedido=ok");
    // Detiene la ejecución del archivo.
    exit;

// Cierra el bloque de instrucciones.
} catch (PDOException $e) {
    // Guarda o actualiza el dato que se utiliza.
    $pdo->rollBack();
    // Muestra un mensaje y detiene el programa.
    die("Error al procesar la compra en la base de datos: " . $e->getMessage());
// Cierra el bloque de instrucciones.
}
// Termina el bloque de PHP.
?>
