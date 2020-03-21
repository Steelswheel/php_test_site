<?php
if (isset($_GET['do']) && $_GET['do'] == 'exit') {
  unset($_SESSION['login']);
  unset($_SESSION['password']);
  session_destroy();
  echo "<meta http-equiv=\"refresh\" content=\"1;URL=/auth.php\">";
}
?>
