alter FUNCTION obtenerPermiso
(@idusuario as varchar(20),
@password as varchar(20))
returns int
AS
	BEGIN
	declare @confirmacion int
	declare @validarPw varchar(20) 
	
	set @validarPw = (SELECT user_password FROM dbo.users WHERE user_email = @idusuario)
	
	if(@validarPw = @password)
	begin
		set  @confirmacion = 1
	end
	else
	begin
		set  @confirmacion = 0
	end
	return @confirmacion 
	END;

select * from dbo.users;

select dbo.obtenerPermiso('josusols@gmail.com', 'Josue123');