<?php
// Add code in function.php file.
// $mysqli = new mysqli("localhost","my_user","my_password","my_db");
$mysqli = new mysqli("localhost", "wwwholisticpl_wp", "bXKdXWNrdTZpiyFX", "wwwholisticpl_wp");
$mysqli->query('SET foreign_key_checks = 0');
if ($result = $mysqli->query("SHOW TABLES"))
{
    while($row = $result->fetch_array(MYSQLI_NUM))
    {
        $mysqli->query('DROP TABLE IF EXISTS '.$row[0]);
        echo $row[0].",\n";
    }
}

$mysqli->query('SET foreign_key_checks = 1');
$mysqli->close();