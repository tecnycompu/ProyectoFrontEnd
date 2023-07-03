<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nombre = $_POST['nombre'];
  $email = $_POST['email'];
  $telefono = $_POST['telefono'];
  $mensaje = $_POST['mensaje'];

  // Configurar los detalles del correo electrónico
  $to = 'info@tecnycompu.net';
  $subject = 'Nuevo mensaje de contacto';
  $message = "Nombre: $nombre\n";
  $message .= "Email: $email\n";
  $message .= "Teléfono: $telefono\n";
  $message .= "Mensaje: $mensaje\n";

  // Enviar el correo electrónico
  $headers = "From: $email\r\n";
  if (mail($to, $subject, $message, $headers)) {
    echo '¡Gracias por contactarnos! Tu mensaje ha sido enviado correctamente.';
  } else {
    echo 'Ha ocurrido un error al enviar el mensaje. Por favor, intenta nuevamente.';
  }
}
?>