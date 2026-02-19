<?php
include 'db.php';

$allowed = ["events", "users", "messages"];

$table = $_GET["table"];
$id = (int)$_GET["id"];

if (!in_array($table, $allowed)) {
    die("Not allowed");
}

$sql = "DELETE FROM $table WHERE id=$id";
$conn->query($sql);

header("Location: " . $_SERVER["HTTP_REFERER"]);
exit();
?>
