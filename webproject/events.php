<?php
include 'db.php';

$pageTitle = "Events";
include 'header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $description = $_POST["description"];
    $event_date = $_POST["event_date"];

    $sql = "INSERT INTO events (title, description, event_date)
            VALUES ('$title', '$description', '$event_date')";

    $conn->query($sql);
}
?>
<h4 class="mb-3">Add Event</h4>

<form method="POST" onsubmit="return validateEvent()" class="mb-4">
  <div class="mb-3">
    <label class="form-label">Title</label>
    <input type="text" name="title" id="title" class="form-control">
  </div>

  <div class="mb-3">
    <label class="form-label">Description</label>
    <input type="text" name="description" class="form-control">
  </div>

  <div class="mb-3">
    <label class="form-label">Date</label>
    <input type="date" name="event_date" class="form-control">
  </div>

  <button type="submit" id="addBtn" class="btn btn-primary">Add Event</button>
</form>

<hr>

<h4 class="mb-3">Event List</h4>

<?php
$result = $conn->query("SELECT * FROM events ORDER BY id DESC");
while ($row = $result->fetch_assoc()) {
    echo "<div class='card mb-3'>";
    echo "<div class='card-body'>";
    echo "<h5 class='card-title'>" . htmlspecialchars($row["title"]) . "</h5>";
    echo "<h6 class='card-subtitle mb-2 text-muted'>Date: " . $row["event_date"] . "</h6>";
    echo "<p class='card-text'>" . htmlspecialchars($row["description"]) . "</p>";
    echo "<a class='btn btn-sm btn-warning me-2' href='edit_event.php?id=" . $row["id"] . "'>Edit</a>";
    echo "<a class='btn btn-sm btn-danger' href='delete.php?table=events&id=" . $row["id"] . "'>Delete</a>";
    echo "</div></div>";
}
?>

<script>
// JavaScript validation (required)
function validateEvent() {
    let title = document.getElementById("title").value;
    if (title === "") {
        alert("Title is required!");
        return false;
    }
    return true;
}

// JavaScript event handler (required)
document.getElementById("addBtn").addEventListener("mouseover", function () {
    this.style.cursor = "pointer";
});
</script>

<?php include 'footer.php'; ?>
