drop database if exists taller;
create database taller;
use taller;

create table usuarios(
	id int primary key auto_increment,
 	dni varchar(9) unique null,
    nombre varchar(100),
    ps blob,
    perfil enum('A','M') default 'M' not null
)engine innodB;
insert into usuarios values (default,'admin','admin', sha2('admin',512),'A');

create table propietario(
	codigo int auto_increment primary key,
    dni varchar(9) unique not null,
    nombre varchar(100) not null,
    telefono varchar(9) not null,
    email varchar(320) null
)engine innodb;
insert into propietario values
	(null, '1A','Paco Pérez','123456789', null),
    (null, '1C','Nuria Roca', '675432123','nuriaroca@gmail.com'),
    (null, '1D','Pablo Motos', '897665544', 'pablomotos@gmail.com'),
    (null, '1E','Mónica Madina','456789123', null),
    (null, '1F','Esther Gómez','567891234', null),
    (null, '1G','Pedro Picapiedra','678912345', null),
    (null, '1H','Bilma Picapiedra','789123456', null);
create table vehiculo(
	codigo int auto_increment primary key,
    propietario int not null,
    matricula varchar(7) null unique,
    color varchar(20) null,
    foreign key (propietario) references propietario(codigo) on update cascade on delete restrict
)engine Innodb;
insert into vehiculo values
	(null, 1,'1111AAA',null),
    (null, 2,null,'Rojo'),
    (null, 3,null,'Blanco'),
    (null, 4,'2222BBB',null),
    (null, 5,null,null),
    (null, 6,'1234FGH',null),
    (null, 7,null,'Negro');
create table pieza(
	codigo varchar(3) primary key,
    clase enum('Refrigeracion','Filtro','Motor', 'Otros') not null,
    descripcion varchar(255) not null,
    precio float not null,
    stock int not null default 20
)engine Innodb;
insert into pieza values
	('F1','Filtro', 'Filtro Aire', 7.0,12),
	('F2','Filtro', 'Filtro Aceite', 15.0,6),
    ('F3','Filtro', 'Filtro Polen', 13.0,32),
    ('F4','Filtro', 'Filtro Combustible', 10.0,11),
    ('M1','Motor', 'Manguito', 25.0,2),
    ('M2','Motor', 'Calentador', 35.0,4),
	('M3','Motor', 'Correa de distribución', 70.0,7),
    ('R1','Refrigeracion', 'Ventilador', 15.0,10),
    ('R2','Refrigeracion', 'Termostato', 20.0,20),
    ('O1','Otros', 'Bomba combustible', 23.0,20),
    ('O2','Otros', 'Radiador', 12.0,20),
    ('O3','Otros', 'Bomba de agua', 10.0,20);
    
create table reparacion(
	id int auto_increment primary key,
    coche int not null,
    fechaHora datetime not null,
    tiempo float null,
    pagado boolean not null default false,
    usuario int not null,
    foreign key (coche) references vehiculo(codigo) on update cascade on delete restrict,
    foreign key (usuario) references usuarios(id) on update cascade on delete restrict,
    precioH float null default 0,
	importeTotal float not null default 0
)engine Innodb;


INSERT INTO reparacion(id,coche,fechaHora,tiempo,pagado,usuario,precioH) 
VALUES (1,1,'2020-08-25 15:01:00',2,1,1,0),
(2,2,'2022-03-25 05:28:00',12,1,1,0),(3,3,'2021-03-10 22:14:00',2,1,1,0),
(4,4,'2020-10-07 20:07:00',2,1,1,0),(5,5,'2021-10-10 07:13:00',2,1,1,0),
(6,1,'2020-06-19 02:22:00',2,1,1,0),(7,2,'2020-05-28 22:09:00',2,1,1,0),
(8,3,'2022-02-22 05:00:00',2,1,1,0),(9,1,'2021-06-29 22:30:00',2,1,1,0),
(10,2,'2020-08-22 12:12:00',2,1,1,0),(11,3,'2022-06-01 10:30:00',12,0,1,0),
(12,4,'2022-05-30 17:00:00',2,0,1,0),(13,5,'2022-05-14 09:00:00',2,0,1,0);
create table piezaReparacion(
	reparacion int,
    pieza varchar(3),    
    importe float not null,
    cantidad int not null default 1,
    primary key (reparacion, pieza),
    foreign key (reparacion) references reparacion(id) on update cascade on delete restrict,
    foreign key (pieza) references pieza(codigo) on update cascade on delete restrict
)engine Innodb;
INSERT INTO piezaReparacion(reparacion,pieza,importe) VALUES (1,'F1',7),(1,'O1',15),(2,'F2',15),(2,'O1',15),(2,'F3',70),(3,'O1',15),(3,'R1',7),(4,'O1',15),(4,'R2',35),(5,'F3',13),(5,'O1',15),
(6,'M1',23),(6,'O1',15),(7,'R1',15),(7,'F3',70),(8,'O2',12),(8,'M1',15),(9,'O1',15),(10,'O1',15),(11,'M1',15),(11,'O2',35),(12,'F2',15),(12,'O1',15);    


	
delimiter //
create function pagarReparacion(pRep int) returns float deterministic
begin
	declare vImporte float default 0;
    declare tiempo float;
    declare precioH float;
    
	 select sum(importe*cantidad) into vImporte
				from piezaReparacion
                where reparacion = pRep;
	if(vImporte is null) then
		set vImporte = 0;
	end if;
	-- Obtener el tiempo total de la repación y el precio por hora
    select tiempo, precioH 
		into tiempo, precioH
		from reparacion
		where id = pRep;
	if(tiempo is not null and precioH is not null) then
		set vImporte = vImporte + (tiempo * precioH);
    end if;
    -- Actualizar el importe total en la reparación
    update reparacion set importeTotal = vImporte, pagado=true where id = pRep;
	return vImporte;
end//

create procedure obtenerReparaciones(pPropietario varchar(100))
begin
	select v.nombrepropietario, v.matricula, r.fechaHora, r.tiempo, totalReparacion(r.id)  from reparacion r inner join vehiculo v on r.coche = v.codigo where v.nombrePropietario like concat('%',pPropietario,'%');
end//

create procedure generarFactura(pIdRep int)
begin
	-- Devuelve en los parámetro de salida los datos de la mano de obra 
	select 'Mano de Obra' as descripcion,  precioH as importe, tiempo as cantidad, precioH * tiempo as total
        from reparacion
        where id = pIdRep;
	-- Detalle de piezas
	select descripcion, importe, cantidad, importe*cantidad as total 
		from piezareparacion inner join pieza on pieza = codigo
		where reparacion = pIdRep;
		
end//
