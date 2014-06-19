CREATE DATABASE DB_Donaciones;

use DB_Donaciones;

create table TB_Citas
(
	Id_sita int auto_increment primary key,
	fecha_cita date,
	horario varchar(15),
	lugar varchar(30),
	localidad varchar(30),
	donacion  varchar(30)
);

create table TB_Administracion (
	id_accion int auto_increment primary key,
	tipo bool,
	fecha date,
	cantidad int,
	descripcion varchar(255)
);

create table TB_LitrosSangre (
	litros int DEFAULT 0
);

insert into TB_LitrosSangre (litros) values (0);