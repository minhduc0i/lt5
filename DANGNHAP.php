<?php
// Khởi tạo biến lỗi
$errors = [];
$successMessage = '';

// Kiểm tra xem form đã được gửi chưa
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Kiểm tra Email
    if (empty($email)) {
        $errors['email'] = "Vui lòng nhập email.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Email không hợp lệ.";
    }

    // Kiểm tra Mật khẩu
    if (empty($password)) {
        $errors['password'] = "Vui lòng nhập mật khẩu.";
    }

    // Nếu không có lỗi
    if (empty($errors)) {
        // Tạm thời hiển thị thông báo thành công
        // Sau này có thể kiểm tra với database
        $successMessage = "Đăng nhập thành công!";
        $email = $password = '';
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./reset.css">
    <link rel="stylesheet" href="./style.css">
    <title>Login Page</title>
</head>
<body>
    <div class="wrapper fade-in-down">
        <div id="form-content">
            <!-- Tabs Titles -->
            <a href="DANGNHAP.php">
                <h2 class="active">Đăng nhập</h2>
            </a>
            <a href="register.php">
                <h2 class="inactive underline-hover">Đăng ký</h2>
            </a>

            <!-- Icon -->
            <div class="fade-in first">
                <img src="./imgs/avatar.png" id="avatar" alt="User Icon">
            </div>

            <!-- Thông báo thành công hoặc lỗi -->
            <?php if ($successMessage): ?>
                <div class="success-message">
                    <p><?php echo $successMessage; ?></p>
                </div>
            <?php endif; ?>

            <!-- Form đăng nhập -->
            <form method="POST" action="login.php">
                <!-- Email -->
                <input
                    type="email"
                    id="Email"
                    class="fade-in second"
                    name="email"
                    placeholder="Email"
                    value="<?php echo isset($email) ? $email : ''; ?>"
                />
                <?php if (isset($errors['email'])): ?>
                    <p class="error"><?php echo $errors['email']; ?></p>
                <?php endif; ?>

                <!-- Mật khẩu -->
                <input
                    type="password"
                    id="password"
                    class="fade-in third"
                    name="password"
                    placeholder="Mật khẩu"
                />
                <?php if (isset($errors['password'])): ?>
                    <p class="error"><?php echo $errors['password']; ?></p>
                <?php endif; ?>

                <input type="submit" class="fade-in four" value="Đăng nhập">
            </form>

            <!-- Quên mật khẩu -->
            <div id="form-footer">
                <a class="underline-hover" href="#">Quên mật khẩu?</a>
            </div>
        </div>
    </div>
</body>
</html>
