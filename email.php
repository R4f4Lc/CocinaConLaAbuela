<?php

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';


function email() {

	if (isset($_POST["nombre"]) && isset($_POST["email"]) && isset($_POST["motivo"]) && isset($_POST["consulta"])) {

		$mail = new PHPMailer\PHPMailer\PHPMailer(true);
			try {
				include 'PHPMailer/email_configuration.php';
				$mail->isSMTP();                                      // Set mailer to use SMTP
				$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
				$mail->SMTPAuth = true;                               // Enable SMTP authentication
				$mail->Username = $email;                 // SMTP username
				$mail->Password = $password;                           // SMTP password
				$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
				$mail->Port = 587;                                    // TCP port to connect to

				    //Recipients
				$mail->setFrom('recetas.abuela.daw@gmail.com', 'Cocina con la Abuela');
				$mail->addAddress($_POST['email'], $_POST['nombre']);    // Add a recipient

				    //Content
				$mail->isHTML(true);                                  // Set email format to HTML
				$mail->Subject = 'Cocina con la Abuela';
				$mail->Body    = 'Gracias por ponerte en contacto con nosotros. La información enviada ha sido la siguiente:
				    <p>Motivo:'.$_POST['motivo'].'<br>Consulta:'.$_POST['consulta'].'<p>Le responderemos cuando nos sea posible. Un saludo, Cocina con la Abuela';
				$mail->AltBody = 'Gracias por ponerte en contacto con nosotros. La información enviada ha sido la siguiente:
				    Motivo:'.$_POST['motivo'].'.Consulta:'.$_POST['consulta'].'. Le responderemos cuando nos sea posible. Un saludo, Cocina con la Abuela';

				$mail->send();
				echo '<div class="alert alert-success" role="alert"><h4 class="alert-heading">¡Bien!</h4><i class="fa fa-check"></i> Mensaje enviado correctamente.</div>';
				
				} catch (Exception $e) {

				echo '<div class="alert alert-danger" role="alert"><h4 class="alert-heading">¡Error!</h4><i class="fa fa-times"></i> Error. El mensaje no ha sido enviado.</div>';
				}
	}
}
?>