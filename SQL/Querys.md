//---Creation of Table eventPlaces---//
create table eventPlaces(
  quantity INT NOT NULL,
  id_eventPlace INT NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (id_eventPlace)
  );
  
//---Agregacion de columna name--//
 alter table eventplaces add column name varchar(50) not null;
