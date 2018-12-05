# macproven
# PRE ENTREGA 21/10 : 18:00HS.
Tp Final del 4to cuatrimestre

1.-Artista ./
2.-Categoria ./
3.-Evento ./
4.-Lugar Evento ./
5.-Tipo plaza
6.-Plaza Evento
7.-Calendario

NO SE PUEDE USAR EL MISMO NIVEL DE JERARQUIA
Ver porque el primer calendario lo agrega por duplicado.
Checkear la repeticion de la localidad en plaza evento.
Borrar eliminar, o controlar el cascade.
Router para que no deje mandar fruta url.
Constantes de querys(crear archivo para no mandar choclo en los select de los dao).

casos de uso, diagrama de clases, 1 o 2 historias narrativas, (class model -> (click derecho)code engineering -> import source directory)
phpMyAdmin genere el der


<?php
    include("lib/qrcode/qrlib.php");  // include, hay q pegarle a la carpeta...
    $tempDir ="lib/tmp/"; // variable con una carpeta temporal donde aloja los qrs creados

    $filename=  rand(01,99).".png"; 
$qrContent= "MACC";
QRcode::png($qrContent, $tempDir.$filename, QR_ECLEVEL_L, 9);  //esta linea crea y almacena el qr
?>
<img src="<?php echo FRONT_ROOT.$tempDir.$filename?>" alt="Qr Code" 



------------ FALTA PARA ENTREGA DE MIERCOLES -------------------

IMPLEMENTAR VISTA DE FACTURACION
TRY AND CATCH
NO LISTAR PLAZA EVENTO SI NO HAY CALENDARIO
VISTA DE BUSQUEDAS
VALIDAR NO COMPRAR MAS DE REMANENTES
VISTA DE ARTISTAS AñADIR CALENDARIO.
INCLUDE CUANDO SE MODIFICA UN EVENTO (no muestra ninguna vista al modificar)
verificar/sacar alertas que aparecen al agregar una plaza evento 
------------ FALTA PARA ENTREGA DE MIERCOLES --------------------



