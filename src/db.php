<?php
$conn = new mysqli('db', 'app_user', 'password', 'sqli_lab');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
