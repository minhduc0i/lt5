<?php
// Khởi tạo biến lỗi
$errors = [];
$successMessage = '';

// Kiểm tra xem form đã được gửi hay chưa
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lọc và kiểm tra các trường dữ liệu
    $username = isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '';
    $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $repeatPassword = isset($_POST['repeat-password']) ? $_POST['repeat-password'] : '';

    // Kiểm tra Họ tên (không được để trống)
    if (empty($username)) {
        $errors['username'] = "Vui lòng nhập họ tên.";
    }

    // Kiểm tra Email (không được để trống và phải đúng định dạng)
    if (empty($email)) {
        $errors['email'] = "Vui lòng nhập email.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Email không hợp lệ.";
    }

    // Kiểm tra Mật khẩu (không được để trống và ít nhất 6 ký tự)
    if (empty($password)) {
        $errors['password'] = "Vui lòng nhập mật khẩu.";
    } elseif (strlen($password) < 6) {
        $errors['password'] = "Mật khẩu phải có ít nhất 6 ký tự.";
    }

    // Kiểm tra Xác nhận mật khẩu (phải giống với mật khẩu)
    if ($password !== $repeatPassword) {
        $errors['repeat-password'] = "Mật khẩu xác nhận không khớp.";
    }

    // Nếu không có lỗi, xử lý đăng ký
    if (empty($errors)) {
        $successMessage = "Chúc mừng, bạn đã đăng ký thành công!";
        
        // Xóa form đăng ký sau khi đăng ký thành công
        $username = $email = $password = $repeatPassword = '';
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./reset.css" />
    <link rel="stylesheet" href="./style.css" />
    <title>Register Page</title>
  </head>
  <body>
    <div class="wrapper fade-in-down">
      <div id="form-content">
        <!-- Tabs Titles -->
        <a href="DANGNHAP.php">
          <h2 class="inactive underline-hover">Đăng nhập</h2>
        </a>
        <a href="register.php">
          <h2 class="active">Đăng ký</h2>
        </a>

        <!-- Icon -->
        <div class="fade-in first">
          <img src="./imgs/avatar.png" id="avatar" alt="User Icon" />
        </div>

        <!-- Thông báo thành công hoặc lỗi -->
        <?php if ($successMessage): ?>
          <div class="success-message">
            <p><?php echo $successMessage; ?></p>
          </div>
        <?php endif; ?>

        <!-- Form đăng ký -->
        <form method="POST" action="register.php">
          <!-- Họ tên -->
          <input
            type="text"
            id="username"
            class="fade-in first"
            name="username"
            placeholder="Họ tên"
            value="<?php echo isset($username) ? $username : ''; ?>"
          />
          <?php if (isset($errors['username'])): ?>
            <p class="error"><?php echo $errors['username']; ?></p>
          <?php endif; ?>

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
            value="<?php echo isset($password) ? $password : ''; ?>"
          />
          <?php if (isset($errors['password'])): ?>
            <p class="error"><?php echo $errors['password']; ?></p>
          <?php endif; ?>

          <!-- Xác nhận mật khẩu -->
          <input
            type="password"
            id="repeat-password"
            class="fade-in fourth"
            name="repeat-password"
            placeholder="Xác nhận mật khẩu"
            value="<?php echo isset($repeatPassword) ? $repeatPassword : ''; ?>"
          />
          <?php if (isset($errors['repeat-password'])): ?>
            <p class="error"><?php echo $errors['repeat-password']; ?></p>
          <?php endif; ?>

          <input type="submit" class="fade-in five" value="Đăng ký" />
        </form>

        <!-- Remind Passowrd -->
        <div id="form-footer">
          <a class="underline-hover" href="#">Quên mật khẩu?</a>
        </div>
      </div>
    </div>
  </body>
</html>
