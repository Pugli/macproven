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

PRE ENTREGA COSAS PENDIENTES:
BAJAS LOGICAS;
MODIFICAR EVENTOS;
HACER CARGA DINAMICA, PLAZA EVENTO;
REMAINDER;

checkCalendarByArtist($idArtist)) // Dao Calendar // TRUE O FALSE -- AND FECHA FUTURA.
checkCalendarsFutureByEvent($idEvent) // Dao Calendar // TRUE O FALSE -- AND FECHA FUTURA.
checkCalendarByEventPlace($idEventPlace) // DAO Calendar // TRUE O FALSE -- AND FECHA FUTURA.
checkCalendarByPlaceType($idPlaceType) // DAO Calendar // TRUE O FALSE -- AND FECHA FUTURA.
checkEventByCategory($idCategory) // Dao Event // TRUE O FALSE.
checkEventSeatByCalendar($calendarId) // Dao Calendar // TRUE O FALSE -- AND FECHA FUTURA.
checkPurchasesByEventSeat($eventSeatId) // Dao EventSeat // TRUE O FALSE --

