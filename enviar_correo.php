<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibe los datos del formulario
    $nombre = trim($_POST["name"]);
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $mensaje = trim($_POST["message"]);

    // Validación básica (puedes personalizar según tus necesidades)
    if (empty($nombre) || empty($email) || empty($mensaje)) {
        // Si algún campo está vacío, muestra un mensaje de error
        echo json_encode(array("status" => "error", "message" => "Por favor, completa todos los campos."));
        exit;
    }

    // Configura la dirección de correo a donde quieres recibir los mensajes
    $recipient = "agustinvalenzuela1990@gmail.com";

    // Configura el asunto del correo
    $subject = "Nuevo mensaje de contacto de $nombre";

    // Construye el cuerpo del correo
    $email_content = "Nombre: $nombre\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Mensaje:\n$mensaje\n";

    // Construye los headers del correo
    $email_headers = "From: $nombre <$email>";

    // Envía el correo electrónico
    if (mail($recipient, $subject, $email_content, $email_headers)) {
        // Si se envía correctamente, devuelve una respuesta de éxito
        echo json_encode(array("status" => "success", "message" => "¡Tu mensaje ha sido enviado con éxito!"));
    } else {
        // Si hay un problema al enviar el correo, muestra un mensaje de error
        echo json_encode(array("status" => "error", "message" => "Hubo un problema al enviar tu mensaje. Por favor, intenta de nuevo más tarde."));
    }
} else {
    // Si se accede al script directamente sin enviar datos por POST, muestra un mensaje de error
    echo json_encode(array("status" => "error", "message" => "Acceso no permitido."));
}
?>
