<?php
require_once __DIR__ . '/dbconnect.php';
require_once __DIR__ . '/app/util/log_helper.php';

$log_helper = __DIR__ . '/app/util/log_helper.php';
if (file_exists($log_helper)) {
    require_once $log_helper;
}

// Only handle the form when it’s submitted; otherwise just render the page (no warnings).
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($username === '' || $password === '') {
        echo "<script>alert('Please fill both the username and password fields!');</script>";
    } else {

        $stmt = $conn->prepare("
            SELECT admin_id, username, firstname, lastname
            FROM admin
            WHERE username = ? AND password = ?
        ");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $res = $stmt->get_result();
        
        if ($row = $res->fetch_assoc()) {
            $_SESSION['username']  = $row['username'];
            $_SESSION['full_name'] = trim($row['firstname'] . ' ' . $row['lastname']);
            $_SESSION['role']      = 'admin';

            // Log exactly once per login
            $log_helper = __DIR__ . '/app/util/log_helper.php';
            if (file_exists($log_helper)) {
                require_once $log_helper;
                if (empty($_SESSION['__login_logged'])) {
                    log_action($_SESSION['username'], $_SESSION['role'], 'LOGIN', 'user', $_SESSION['username'], null);
                    $_SESSION['__login_logged'] = true; // guard against duplicates
                }
            }

            //  HTTP redirect 
            header('Location: /LibraryManagementSystem/app/book/book.php');
            exit;
        } else {
            echo "<script>alert('Login Failed. Check your username or password');</script>";
        }
        $stmt->close();
    }
}
?>

<html>
<head>
    <title>Welcome | Library Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
    <meta content="Coderthemes" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <link href="assets/css/vendor/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css">
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="light-style">
</head>

<body>
    <section style="background-color: #313a46; height: 100vh">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row">
                            <div class="col-md-6 col-lg-5  d-none d-md-block ">
                                <img src="images/library1.jpg" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">
                                    <form action="index.php" method="POST">
                                        <div class="d-flex align-items-center mb-3 pb-1">
                                            <span class="h1 fw-bold mb-0">Library Management System</span>
                                        </div>
                                        <div class="form-outline mb-4">
                                            <input type="text" class="form-control form-control-lg" name="username" required />
                                            <label class="form-label">Username</label>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="password" class="form-control form-control-lg" name="password" required />
                                            <label class="form-label" for="form2Example27">Password</label>
                                        </div>

                                        <div class="pt-1 mb-4 text-center">
                                            <input type="submit" class="btn btn-dark btn-lg btn-block" value="Login" name="submit">
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
