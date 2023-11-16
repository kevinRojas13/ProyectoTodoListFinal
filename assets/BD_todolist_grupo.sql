CREATE DATABASE login_register_db;
USE login_register_db;

CREATE TABLE usuarios(
id INT auto_increment primary key,
nombre_completo varchar(100),
correo varchar(100),
usuario varchar(100),
contrasena varchar(100)
);

CREATE TABLE tareas(
nombre varchar(150),
fecha date,
descripcion varchar(500)
)

--
select * from tareas;
select * from usuarios;

delete from usuarios
where id = 4;

select nombre_completo 
from usuarios
where correo='lstyle@chistemas.com';



