<!doctype html>
<html lang="en" data-theme="light">
<body>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    define("INITIALIZING_DATABASE",1);
    require_once("db_conn.php");
    DBHelper::initializeDatabase();
}
?>
<form method="POST">
    <input type="submit" value="Initialize Database">
</form>
</body>
</html>








