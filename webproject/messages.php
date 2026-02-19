<?php
include 'db.php';

$pageTitle = "Messages";
include 'header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    $sql = "INSERT INTO messages (name, email, message)
            VALUES ('$name', '$email', '$message')";

    $conn->query($sql);
}
?>

<h4 class="mb-3">Send Message</h4>

<form method="POST" onsubmit="return validateMsg()" class="mb-4">

  <div class="mb-3">
    <label class="form-label">Name</label>
    <input type="text" name="name" id="msgName" class="form-control">
  </div>

  <div class="mb-3">
    <label class="form-label">Email</label>
    <input type="email" name="email" id="msgEmail" class="form-control">
  </div>

  <div class="mb-3">
    <label class="form-label">Message</label>
    <textarea name="message" id="msgText" rows="4" class="form-control"></textarea>
  </div>

  <button type="submit" id="sendBtn" class="btn btn-primary">Send Message</button>
</form>

<h4 class="mb-3">Message List</h4>

<?php
$result = $conn->query("SELECT * FROM messages ORDER BY id DESC");

while ($row = $result->fetch_assoc()) {

    echo "<div class='card mb-3'>";
    echo "<div class='card-body'>";
    echo "<h5 class='card-title'>" . htmlspecialchars($row["name"]) . "</h5>";
    echo "<h6 class='card-subtitle mb-2 text-muted'>" . htmlspecialchars($row["email"]) . "</h6>";
    echo "<p class='card-text'>" . nl2br(htmlspecialchars($row["message"])) . "</p>";
    echo "<a class='btn btn-sm btn-warning me-2' href='edit_messages.php?id=" . $row["id"] . "'>Edit</a>";
    echo "<a class='btn btn-sm btn-danger' href='delete.php?table=messages&id=" . $row["id"] . "'>Delete</a>";
    echo "</div></div>";
}
?>

<script>
function validateMsg() {
    let name = document.getElementById("msgName").value;
    let msg = document.getElementById("msgText").value;

    if (name === "" || msg === "") {
        alert("Name and message are required!");
        return false;
    }
    return true;
}


document.getElementById("msgText").addEventListener("keyup", function () {
console.log("Typing...");
});
</script>

<?php include 'footer.php'; ?>

