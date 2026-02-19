<?php
include 'db.php';

$pageTitle = "Users";
include 'header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "INSERT INTO users (name, email, password)
            VALUES ('$name', '$email', '$password')";

    $conn->query($sql);
}
?>

<h4 class="mb-3">Register User</h4>

<form method="POST" onsubmit="return validateUser()" class="mb-4">

  <div class="mb-3">
    <label class="form-label">Name</label>
    <input type="text" name="name" id="userName" class="form-control">
  </div>

  <div class="mb-3">
    <label class="form-label">Email</label>
    <input type="email" name="email" id="userEmail" class="form-control">
  </div>

  <div class="mb-3">
    <label class="form-label">Password</label>
    <input type="password" name="password" id="userPass" class="form-control">
  </div>

  <button type="submit" id="regBtn" class="btn btn-primary">Register</button>
</form>

<h4 class="mb-3">User List</h4>

<?php
$result = $conn->query("SELECT * FROM users ORDER BY id DESC");

while ($row = $result->fetch_assoc()) {

    echo "<div class='card mb-3'>";
    echo "<div class='card-body'>";
    echo "<h5 class='card-title'>" . htmlspecialchars($row["name"]) . "</h5>";
    echo "<p class='card-text'>" . htmlspecialchars($row["email"]) . "</p>";
    echo "<a class='btn btn-sm btn-warning me-2' href='edit_user.php?id=" . $row["id"] . "'>Edit</a>";
    echo "<a class='btn btn-sm btn-danger' href='delete.php?table=users&id=" . $row["id"] . "'>Delete</a>";
    echo "</div></div>";
}
?>

<script>
function validateUser() {
    let name = document.getElementById("userName").value;
    let email = document.getElementById("userEmail").value;

    if (name === "" || email === "") {
        alert("Name and email are required!");
        return false;
    }
    return true;
}

document.getElementById("regBtn").addEventListener("mouseover", function () {
    this.style.cursor = "pointer";
});
</script>

<?php include 'footer.php'; ?>
