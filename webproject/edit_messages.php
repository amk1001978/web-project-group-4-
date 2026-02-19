<?php
include 'db.php';

$pageTitle = "Edit Message";
include 'header.php';

$id = (int)($_GET['id'] ?? 0);
if ($id <= 0) die("Invalid ID");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $sql = "UPDATE messages 
            SET name='$name', email='$email', message='$message'
            WHERE id=$id";

    $conn->query($sql);
    header("Location: messages.php");
    exit();
}

$result = $conn->query("SELECT * FROM messages WHERE id=$id");
$msg = $result->fetch_assoc();
if (!$msg) die("Message not found");
?>

<h2>Edit Message</h2>

<form method="POST" onsubmit="return validateEditMsg()">
    Name:
    <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($msg['name']); ?>">

    Email:
    <input type="email" name="email" value="<?php echo htmlspecialchars($msg['email']); ?>">

    Message:
    <textarea name="message" id="message" rows="5"><?php echo htmlspecialchars($msg['message']); ?></textarea>

    <button type="submit" id="updateMsgBtn">Update Message</button>
</form>

<script>
function validateEditMsg(){
    let name = document.getElementById("name").value;
    let message = document.getElementById("message").value;
    if(name === "" || message === ""){
        alert("Name and message are required!");
        return false;
    }
    return true;
}

document.getElementById("updateMsgBtn").addEventListener("mouseover", function(){
    this.style.cursor = "pointer";
});
</script>

<?php include 'footer.php'; ?>
