<?php
session_start();
$db = new SQLite3('lemons.db');

$db->exec("CREATE TABLE IF NOT EXISTS users (username TEXT, password TEXT)");

?>
