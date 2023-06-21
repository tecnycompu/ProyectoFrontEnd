<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nombre = $_POST['nombre'];
  $correo = $_POST['correo'];
  $mensaje = $_POST['mensaje'];
  $destinatario = 'tecnycompu@gmail.com';
  $asunto = 'Nuevo mensaje de contacto';

  $contenido = "Nombre: $nombre\n";
  $contenido .= "Correo electrónico: $correo\n";
  $contenido .= "Mensaje:\n$mensaje\n";

  $cabeceras = 'From: '.$correo."\r\n".
    'Reply-To: '.$correo."\r\n".
    'X-Mailer: PHP/'.phpversion();

  mail($destinatario, $asunto, $contenido, $cabeceras);

  echo '¡Gracias por tu mensaje! Nos pondremos en contacto contigo pronto.';
}
?>