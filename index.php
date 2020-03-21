<?php
if (isset($_SESSION['login']) && isset($_SESSION['password'])) {
	echo "<meta http-equiv=\"refresh\" content=\"0;URL=/main.php\">";
} else {
	echo "Вы не авторизованы!";
	echo "<meta http-equiv=\"refresh\" content=\"0;URL=/auth.php\">";
}
?>
