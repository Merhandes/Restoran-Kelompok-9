<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['submit'])){
   $first_name = $_POST['first_name'];
   $first_name = filter_var($first_name, FILTER_SANITIZE_STRING);
   $last_name = $_POST['last_name'];
   $last_name = filter_var($last_name, FILTER_SANITIZE_STRING);
   $username = $_POST['username'];
   $username = filter_var($username, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);
   
   $birthdate = $_POST['birthdate'];
   $gender = $_POST['gender'];
   
   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
   $select_user->execute([$email]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if($select_user->rowCount() > 0){
      $message[] = 'Email or number already exists!';
   } else {
      if($pass != $cpass){
         $message[] = 'Confirm password not matched!';
      } else {
         $insert_user = $conn->prepare("INSERT INTO `users`(first_name, last_name, username, email, password, birthdate, gender) VALUES(?,?,?,?,?,?,?)");
         $insert_user->execute([$first_name, $last_name, $username, $email, $cpass, $birthdate, $gender]);
         $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
         $select_user->execute([$email, $pass]);
         $row = $select_user->fetch(PDO::FETCH_ASSOC);
         if($select_user->rowCount() > 0){
            $_SESSION['user_id'] = $row['id'];
            header('location:home.php');
         }
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
   <title>Daftar</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="form-container">

   <form action="" method="post">
      <h3>Daftar sekarang</h3>
      <input type="text" name="first_name" required placeholder="Masukkan nama depan" class="box" maxlength="50">
      <input type="text" name="last_name" required placeholder="Masukkan nama belakang" class="box" maxlength="50">
      <input type="text" name="username" required placeholder="Masukkan username" class="box" maxlength="50">
      <input type="email" name="email" required placeholder="Masukkan email" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" required placeholder="Masukkan password" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="cpass" required placeholder="Konfirmasi password" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="date" name="birthdate" required placeholder="Masukkan tanggal lahir" class="box">
         <select type="gender" name="gender" required placeholder="Masukkan jenis kelamin" class="box">
   <option value="male">Male</option>
   <option value="female">Female</option>
</select>
      <input type="submit" value="Daftar sekarang" name="submit" class="btn">
      <p>sudah punya akun? <a href="login.php">Login sekarang</a></p>
   </form>

</section>

<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>