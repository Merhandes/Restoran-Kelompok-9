<?php
include '../components/connect.php';
session_start();

if(isset($_POST['submit'])) {
    $message = [];

    if(isset($_POST['captcha']) && isset($_SESSION['captcha'])){
        if($_POST['captcha'] !== $_SESSION['captcha']){
            $message[] = 'CAPTCHA tidak cocok!';
        }
    } else {
        $message[] = 'CAPTCHA tidak diatur!';
    }

    if(empty($message)) { 
        $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $pass = filter_var(sha1($_POST['pass']), FILTER_SANITIZE_STRING);

        $select_admin = $conn->prepare("SELECT * FROM `admin` WHERE name = ? AND password = ?");
        $select_admin->execute([$name, $pass]);

        if($select_admin->rowCount() > 0){
            $fetch_admin_id = $select_admin->fetch(PDO::FETCH_ASSOC);
            $_SESSION['admin_id'] = $fetch_admin_id['id'];
            header('location:dashboard.php');
            exit;
        } else {
            $message[] = 'Incorrect username or password!';
        }
    }

    if(!empty($message)) {
        foreach($message as $msg) {
            echo "<div class='message'><span>$msg</span><i class='fas fa-times' onclick='this.parentElement.remove();'></i></div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <link rel="icon" href="../project images/logo-2.avif" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<section class="form-container">

   <form action="" method="POST">
      <h3>Login sekarang</h3>
      <input type="text" name="name" maxlength="20" required placeholder="Masukkan username" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" maxlength="20" required placeholder="Masukkan password" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="text" name="captcha" required placeholder="Masukkan CAPTCHA" class="box">
   <div class="captcha-container">
      <img src="../captcha.php" alt="CAPTCHA Image" id="captchaImage">
      <button type="button" id="refreshCaptcha"><i class="fas fa-redo"></i> Refresh</button>
   </div>
      <input type="submit" value="login sekarang" name="submit" class="btn">
   </form>

</section>

<script>
   document.getElementById('refreshCaptcha').addEventListener('click', function() {
    const captchaImage = document.getElementById('captchaImage');
    captchaImage.src = '../captcha.php?' + new Date().getTime();
});

   </script>

</body>
</html>