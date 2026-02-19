<?php
include 'db.php';

$pageTitle = "Edit User";
include 'header.php';

$id = (int)($_GET['id'] ?? 0);
if ($id <= 0) die("Invalid ID");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "UPDATE users 
            SET name='$name', email='$email', password='$password'
            WHERE id=$id";

    $conn->query($sql);
    header("Location: users.php");
    exit();
}

$result = $conn->query("SELECT * FROM users WHERE id=$id");
$user = $result->fetch_assoc();
if (!$user) die("User not found");
?>

<h2>Edit User</h2>

<form method="POST" onsubmit="return validateEditUser()">
    Name:
    <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($user['name']); ?>">

    Email:
    <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>">

    Password:
    <input type="text" name="password" value="<?php echo htmlspecialchars($user['password']); ?>">

    <button type="submit" id="updateUserBtn">Update User</button>
</form>

<script>
function validateEditUser(){
    let name = document.getElementById("name").value;
    if(name === ""){
        alert("Name is required!");
        return false;
    }
    return true;
}

document.getElementById("updateUserBtn").addEventListener("mouseover", function(){
    this.style.cursor = "pointer";
});
</script>

<?php include 'footer.php'; ?>
