<!doctype html>
<html lang="en">
<body>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once("db_conn.php");
    DBHelper::initializeDatabase();
    echo "<h3>Database Initialized</h3>";
}
?>
<form method="POST">
    <input type="submit" value="Initialize Database">
</form>
</body>
</html>








