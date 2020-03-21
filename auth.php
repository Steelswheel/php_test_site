<?php
session_start();
$login = htmlentities(trim($_POST['login']));
$password = htmlentities(trim($_POST['password']));

if (isset($_SESSION['login'])) {
	echo "<meta http-equiv=\"refresh\" content=\"0;URL=/main.php\">";
}

if (!empty($login) && !empty($password)) {

	$link = mysqli_connect("localhost", "root", "", "test_site") or die('Ошибка соединения с БД');

	/* Проверить соединение */
	if (mysqli_connect_errno()) {
			printf("Попытка соединения не удалась: %s\n", mysqli_connect_error());
			exit();
	}

	$query = "SELECT login, password, name, lastname FROM users WHERE login = ?";

	if ($stmt = mysqli_prepare($link, $query)) {

			mysqli_stmt_bind_param($stmt, 's', $login);

			/* Запустить запрос */
			mysqli_stmt_execute($stmt);

			/* Определить переменные для результата */
			mysqli_stmt_bind_result($stmt, $log, $pass, $n, $ln);

			if (mysqli_stmt_fetch($stmt)) {
					if ($log === $login && $pass === $password) {
						$_SESSION['login'] = $login;
						$_SESSION['password'] = $password;
						$_SESSION['name'] = $n;
						$_SESSION['lastname'] = $ln;
						$alert = "Успешная авторизация!";
						echo "<meta http-equiv=\"refresh\" content=\"2;URL=/main.php\">";
					} elseif($log !== $login || $pass !== $password) {
						$alert = "Данные не верны";
						echo "<meta http-equiv=\"refresh\" content=\"1;URL=/auth.php\">";
					}
			}
			mysqli_stmt_close($stmt);
	} else {
		$alert = "Что-то пошло не так!";
		echo "<meta http-equiv=\"refresh\" content=\"1;URL=/auth.php\">";
		mysqli_stmt_error($stmt);
	}
	mysqli_close($link);
} else {
	$alert = "Введите данные для входа";
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
	<title>
	<?=substr($_SERVER['PHP_SELF'], 0, -4);?>
	</title>
<link rel="stylesheet" type="text/css" href="css/<?php if (isset($_SESSION['style'])) {echo $_SESSION['style'];} else {echo "red";}; echo substr($_SERVER['PHP_SELF'], 0, -3) . "css";?>">
</head>
	<body>
		<div class="alert"><?=$alert?></div>
		<form action="" method="post" class="form">
			<fieldset class="fieldset fieldset__login">
				<div class="label-wrap"><label for="login">Введите логин:</label></div>
				<input name="login" type="text" class="login form__login" value="">
			</fieldset>
			<fieldset class="fieldset fieldset__password">
				<div class="label-wrap"><label for="password">Введите пароль:</label></div>
				<input name="password" type="text" class="password form__password" value="">
			</fieldset>
			<button type="submit" class="button">Авторизация</button>
			<a href="register.php" class="reg-link">Зарегистрироваться</a>
		</form>
	</body>
</html>
