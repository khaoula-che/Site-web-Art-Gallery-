<!DOCTYPE html>
<html>
<head>
	<title>Modifier le captcha</title>
</head>
<body>
	<h1>Modifier le captcha</h1>
	<form action="modif-image-captcha.php" method="post" enctype="multipart/form-data">
		<label for="image_upload">Ajouter une nouvelle image :</label>
		<input type="file" id="image_upload" name="image_upload"><br><br>
		<input type="submit" value="Ajouter"><br><br>
		<h2>Images existantes :</h2>
	</form>
</body>
</html>
