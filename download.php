<?php
// Database connection
$db_host = "lsql113.infinityfree.com";
$db_user = "if0_37727371";
$db_pass = "KXwmtA5GRICY";
$db_name = "if0_37727371_cloudhackathon";

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM files";
$result = $conn->query($sql);
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
    <title>File Upload and Download</title>
</head>
<body>
    <div class="container mt-5">
        <h2 class="animate__animated animate__fadeInDown">Uploaded Files</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-striped animate__animated animate__fadeInUp">
                <thead>
                    <tr>
                        <th>File Name</th>
                        <th>File Size</th>
                        <th>File Type</th>
                        <th>Download</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $file_path = "uploads/" . $row['filename'];
                            ?>
                            <tr>
                                <td><?php echo $row['filename']; ?></td>
                                <td><?php echo $row['filesize']; ?> bytes</td>
                                <td><?php echo $row['filetype']; ?></td>
                                <td><a href="<?php echo $file_path; ?>" class="btn btn-primary" download>Download</a></td>
                                <td><a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this file?');">Delete</a></td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="5">No files uploaded yet.</td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
            <form id="uploadForm" action="upload.php" method="POST" enctype="multipart/form-data" class="animate__animated animate__fadeInUp">

            <button type="submit" class="btn btn-primary">Back to Uploads</button>
        </form>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">File Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    File deleted successfully.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Show modal if deletion was successful
        $(document).ready(function() {
            var urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('deleteSuccess')) {
                $('#deleteModal').modal('show');
                setTimeout(function() {
                    $('#deleteModal').modal('hide');
                }, 3000); // Hide after 3 seconds
            }
        });
    </script>
</body>
</html>

<?php
$conn->close();
?>
