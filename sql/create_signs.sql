create table sign_signs
(
	ID serial,
	Text nvarchar(140),
	Code nvarchar(60)
)

alter table sign_signs
add	Added datetime,
add IP nvarchar(28)
