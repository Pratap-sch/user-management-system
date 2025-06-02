<?php

// DB Connection
$db = new mysqli('localhost', 'root', '', 'db4');

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

$msg = '';
$uid = '';
$name = '';
$email = '';
$password = '';

// Fetch all records
$sql = $db->query("SELECT * FROM `userdetails` ORDER BY uid ASC");

// Data Updation
if (isset($_GET['act']) && $_GET['act'] == 'edit' && isset($_GET['id']) && $_GET['id'] > 0) {
    $uid = intval($_GET['id']);
    $stmt = $db->prepare("SELECT * FROM `userdetails` WHERE uid = ?");
    $stmt->bind_param('i', $uid);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $uid = $user['uid'];
        $name = $user['name'];
        $email = $user['email'];
    } else {
        $msg = "No record found for ID: $uid";
    }

    // If POST, update
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['name'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        $update = $db->prepare("UPDATE `userdetails` SET name = ?, email = ?, password = ? WHERE uid = ?");
        $update->bind_param('sssi', $name, $email, $password, $uid);

        if ($update->execute()) {
            $msg = "Data updated successfully";
            header("Location: crud.php");
            exit();
        } else {
            $msg = "Update failed: " . $db->error;
        }
    }
} else {
    // Data insert
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

            $insert = $db->prepare("INSERT INTO `userdetails` (name, email, password, lname, mobile, address, dob, age, role, asc_id) VALUES (?, ?, ?, '', 0, '', '0000-00-00', 0, 'user', 0)");
            $insert->bind_param('sss', $name, $email, $password);

            if ($insert->execute()) {
                $msg = "Data inserted successfully";
                header("Location: crud.php");
                exit();
            } else {
                $msg = "Insert failed: " . $db->error;
            }
        } else {
            $msg = "Please fill in all the fields.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            max-width: 900px;
        }
        .form-section, .table-section {
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
        }
        .form-title {
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 20px;
        }
        .table thead th {
            background-color: #0d6efd;
            color: #fff;
        }
        .btn-primary {
            background-color: #0d6efd;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0b5ed7;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="text-center mb-4">
        <h1 class="display-5 fw-bold text-primary">User Management System</h1>
        <p class="lead text-muted">CRUD Application for Managing User Records (Add, Edit, View)</p>
    </div>

    <div class="form-section">
        <div class="form-title">Add / Update User</div>
        <form method="POST">
            <input type="hidden" name="uid" value="<?= htmlspecialchars($uid) ?>">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="name" class="form-control" placeholder="e.g. John Doe" value="<?= htmlspecialchars($name) ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="e.g. user@example.com" value="<?= htmlspecialchars($email) ?>" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter password" required>
            </div>
            <div class="text-end">
                <button class="btn btn-primary px-4">Submit</button>
            </div>
        </form>
        <?php if (!empty($msg)): ?>
            <div class="alert alert-info mt-3"> <?= htmlspecialchars($msg) ?> </div>
        <?php endif; ?>
    </div>

    <div class="table-section">
        <div class="form-title">All Users</div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>UID</th>
                <th>Name</th>
                <th>Email</th>
                <th class="text-end">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php while ($row = $sql->fetch_assoc()) { ?>
                <tr>
                    <td><?= htmlspecialchars($row['uid']) ?></td>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td class="text-end">
                        <a href="?act=edit&id=<?= $row['uid'] ?>" class="btn btn-sm btn-primary">Edit</a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
