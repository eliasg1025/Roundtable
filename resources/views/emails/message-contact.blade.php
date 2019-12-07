<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Mensaje contacto</title>
</head>
<body>
	Contenido email
	<p>Recibiste un mensaje de: {{ $mail['name'] . ' ' . $mail['last_name']}} de <strong>{{ $mail['company_name'] }}</strong></p>
	<p>Correo: {{ $mail['email'] }}</p>
	<br>
	<p>{{ $mail['message'] }}</p></body>
</html>
