<?php
session_start();
$login_error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST['password'];


    if ($password === '12345678') {
        $_SESSION['authenticated'] = true;
        header('Location: upload.php');
        exit();
    } else {
        $login_error = 'Invalid password. Please try again.';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <title>Login</title>
</head>
<body>
    <div class="container mt-5">
        <h2 class="animate__animated animate__fadeInDown">Login</h2>
        <?php if ($login_error != ''): ?>
            <div class="alert alert-danger animate__animated animate__fadeInUp">
                <?php echo $login_error; ?>
            </div>
        <?php endif; ?>
        <form action="login.php" method="POST" class="animate__animated animate__fadeInUp">
            <div class="mb-3">
                <label for="password" class="form-label">Enter Password</label>
                <input type="password" class="form-control" name="password" id="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</body>
</html>
