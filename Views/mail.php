<?php
ini_set( 'display_errors', 1 );
            error_reporting( E_ALL );
            $from = "aguspugli@hotmail.com";
            $to = $user->getEmail();
            $subject = "Bienvenido a Macproven";
            $message = "Usted se ha registrado en la pagina macProven";
            $headers = 'From: '.$from."\r\n".
'Reply-To:'.$from."\r\n".
'X-Mailer: PHP/'.phpversion();
            mail($to,$subject,$message, $headers);
            echo "El mensaje a sido enviado";

            ?>