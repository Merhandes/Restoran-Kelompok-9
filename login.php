<?php
include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
}

if (isset($_POST['submit'])) {
   $emailOrUsername = $_POST['emailOrUsername'];
   $emailOrUsername = filter_var($emailOrUsername, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   if (isset($_SESSION['captcha']) && $_SESSION['captcha'] !== $_POST['captcha']) {
      $message[] = 'CAPTCHA tidak cocok!';
   } else {
      $select_user = $conn->prepare("SELECT * FROM `users` WHERE (email = ? OR username = ?) AND password = ?");
      $select_user->execute([$emailOrUsername, $emailOrUsername, $pass]);
      $row = $select_user->fetch(PDO::FETCH_ASSOC);

      if ($select_user->rowCount() > 0) {
         $_SESSION['user_id'] = $row['id'];
         header('location: home.php');
         exit();
      } else {
         $message[] = 'Incorrect username or password!';
      }
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <link rel="icon" href="project images/logo-2.avif" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="form-container">

   <form action="" method="post">
      <h3>Login sekarang</h3>
      <input type="text" name="emailOrUsername" required placeholder="Masukkan username/email" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" required placeholder="Masukkan password" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="text" name="captcha" required placeholder="Masukkan CAPTCHA" class="box">
      <div class="captcha-container">
    <img src="captcha.php" alt="CAPTCHA Image" id="captchaImage">
    <button type="button" id="refreshCaptcha"><i class="fas fa-redo"></i> Refresh</button>
</div>

      <input type="submit" value="login sekarang" name="submit" class="btn">
      <p>Tidak punya akun? <a href="register.php">Daftar sekarang</a></p>
   </form>

   <script>
      document.getElementById("refreshCaptcha").addEventListener("click", function() {
    const captchaImage = document.getElementById("captchaImage");
    captchaImage.src = "captcha.php?" + new Date().getTime();
});

      </script>
</section>

<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
