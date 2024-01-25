<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <link rel="icon" href="project images/logo-2.avif" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Tentang kami</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<div class="heading">
   <h3>Tentang kami</h3>
   <p><a href="home.php">Home</a> <span> / Tentang kami</span></p>
</div>

<section class="reviews">

   <h1 class="title">Anggota Kelompok</h1>

   <div class="swiper reviews-slider">

      <div class="swiper-wrapper">

         <div class="swiper-slide slide">
            <img src="images/merhandes.jpg" alt="">
            <h3>Merhandes Gunawan</h3>
            <p>NIM: 00000081070</br>Mahasiswa Jurusan Informatika Universitas Multimedia Nusantara Angkatan 2022.</p>
         </div>

         <div class="swiper-slide slide">
            <img src="images/kevin.png" alt="">
            <h3>Farelius Kevin</h3>
            <p>NIM: 00000081783 </br>Mahasiswa Jurusan Informatika Universitas Multimedia Nusantara Angkatan 2022.</p>
         </div>

         <div class="swiper-slide slide">
            <img src="images/terence.png" alt="">
            <h3>Nicholas Terence Siahaan</h3>
            <p>NIM: 00000075128</br>Mahasiswa Jurusan Informatika Universitas Multimedia Nusantara Angkatan 2022.</p>
         </div>

         <div class="swiper-slide slide">
            <img src="images/genadi.png" alt="">
            <h3>Genadi Ikhsan Jaya</h3>
            <p>NIM : 00000080773 </br>Mahasiswa Jurusan Informatika Universitas Multimedia Nusantara Angkatan 2022.</p>
         </div>

         <div class="swiper-slide slide">
            <img src="images/marcellus.png" alt="">
            <h3>Marcellus Eugene</h3>
            <p>NIM : 00000082420 </br>Mahasiswa Jurusan Informatika Universitas Multimedia Nusantara Angkatan 2022.</p>
         </div>

      </div>

      <div class="swiper-pagination"></div>

   </div>

</section>

<!-- reviews section ends -->



















<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->=






<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".reviews-slider", {
   loop:true,
   grabCursor: true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
      slidesPerView: 1,
      },
      700: {
      slidesPerView: 2,
      },
      1024: {
      slidesPerView: 3,
      },
   },
});

</script>

</body>
</html>