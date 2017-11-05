begin tran eliminartabla
drop table ControlProyectos.dbo.users
commit
--rollback

CREATE TABLE users (
  user_id int NOT NULL primary key IDENTITY(1,1),
  user_email varchar(250) DEFAULT NULL unique,
  user_password varchar(200) NOT NULL
);

insert into users (user_email, user_password) VALUES ('josusols@gmail.com', 'Josue123');
insert into users (user_email, user_password) VALUES ('ernestoivan22@gmail.com', 'Ernesto123');

select * from ControlProyectos.dbo.users;

begin tran aceptar
commit