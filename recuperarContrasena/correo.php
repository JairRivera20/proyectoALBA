<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    /* $mail->SMTPDebug = SMTP::DEBUG_SERVER;  */                     //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'albasena343@gmail.com';                     //SMTP username
    $mail->Password   = 'ldskowddlllymvgy';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('albasena343@gmail.com', 'ALBA');
    $mail->addAddress($correo);     //Add a recipient


    /*     $mail->addAddress('ellen@example.com');               //Name is optional
    $mail->addReplyTo('info@example.com', 'Information');
    $mail->addCC('cc@example.com');
    $mail->addBCC('bcc@example.com'); */

    //Attachments
   /*  $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
 */
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Restablecimiento de Clave';
    $mail->Body    = '
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
    
        <div>
            <div>

                <h1>¡Hola de nuevo!</h1>
                
                <p>Usted ha solicitado el restablecimiento de su contraseña en ALBA.
                <br>
                Para ingresar de nuevo a la plataforma esta es su nueva contraseña temporal:</p>
                <h2> '.$contrasena.' </h2>
                <br>
                <a style="text-decoration: none; color: white;" href="https://pruebas.migtutor.com/login/login.php">
                <button style="background-color: #39A900;
                        font-size: 20px;
                        width: 200px;
                        padding: 20px;
                        border-radius: 10px;
                        border: none;
                        color: white;
						cursor: pointer;">
                Iniciar Sesión
                </button>
                </a>
                <br>
                <br>
                <p>
                **********************NO RESPONDER - Mensaje Generado Automáticamente**********************
                <br>
                <br>
                Este correo es únicamente informativo y es de uso exclusivo del destinatario(a), puede contener información privilegiada y/o confidencial. 
                Si no es usted el destinatario(a) deberá borrarlo inmediatamente. Queda notificado que el mal uso, divulgación no autorizada, 
                alteración y/o  modificación malintencionada sobre este mensaje y sus anexos quedan estrictamente prohibidos
                y pueden ser legalmente sancionados. -El SENA  no asume ninguna responsabilidad por estas circunstancias.
                </p>

            </div>
        </div>
    
    </body>
    </html>';

/*     $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
 */
    $enviado = false;

    $mail->send();
    $enviado = true;

} catch (Exception $e) {

    echo "Hubo un Error:" , $mail->ErrorInfo;
    
}


?>