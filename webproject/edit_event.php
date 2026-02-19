<?php
include 'db.php';

$pageTitle = "Edit Event";
include 'header.php';

$id = (int)($_GET['id'] ?? 0);
if ($id <= 0) die("Invalid ID");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $event_date = $_POST['event_date'];

    $sql = "UPDATE events 
            SET title='$title', description='$description', event_date='$event_date'
            WHERE id=$id";

    $conn->query($sql);
    header("Location: events.php");
    exit();
}

$result = $conn->query("SELECT * FROM events WHERE id=$id");
$event = $result->fetch_assoc();
if (!$event) die("Event not found");
?>

<h2>Edit Event</h2>

<form method="POST" onsubmit="return validateEditEvent()">
    Title:
    <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($event['title']); ?>">

    Description:
    <input type="text" name="description" value="<?php echo htmlspecialchars($event['description']); ?>">

    Date:
    <input type="date" name="event_date" value="<?php echo $event['event_date']; ?>">

    <button type="submit" id="updateBtn">Update Event</button>
</form>

<script>
function validateEditEvent(){
    let title = document.getElementById("title").value;
    if(title === ""){
        alert("Title is required!");
        return false;
    }
    return true;
}

document.getElementById("updateBtn").addEventListener("mouseover", function(){
    this.style.cursor = "pointer";
});
</script>

<?php include 'footer.php'; ?>
