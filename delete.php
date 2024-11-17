<?php
$msg = '';
$msg_class = '';

if (isset($_GET['id'])) {
    $file_id = $_GET['id'];

    // Database connection
    $db_host = "lsql113.infinityfree.com";
    $db_user = "if0_37727371";
    $db_pass = "KXwmtA5GRICY";
    $db_name = "if0_37727371_cloudhackathon";

    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get file information from the database
    $sql = "SELECT filename FROM files WHERE id = $file_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $file_path = "uploads/" . $row['filename'];

        // Delete the file from the directory
        if (file_exists($file_path)) {
            unlink($file_path);
        }

        // Delete the file information from the database
        $sql = "DELETE FROM files WHERE id = $file_id";
        if ($conn->query($sql) === TRUE) {
            $msg = "File deleted successfully.";
            $msg_class = 'alert-success';
        } else {
            $msg = "Error deleting file: " . $conn->error;
            $msg_class = 'alert-danger';
        }
    } else {
        $msg = "File not found.";
        $msg_class = 'alert-danger';
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <title>File Deletion</title>
</head>
<body>
    <div class="container mt-5">
        <div id="deleteMessage" class="alert <?php echo $msg_class; ?> animate__animated animate__fadeInUp">
            <?php echo $msg; ?>
        </div>
        <form action="download.php" method="POST" enctype="multipart/form-data" class="animate__animated animate__fadeInUp">
            <div class="mb-3">
            </div>
            <button type="submit" class="btn btn-primary">View Uploaded Files</button>
        </form>
    </div>
</body>
</html>
