<?php
include "koneksi.php"; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Flower Dreams</title>
  <link rel="icon" href="img/flower_dreams.png">
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
  />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

  <style>
   .profile-img {
  width: 150px;
  height: 150px;
  object-fit: cover;
  border-radius: 50%;
  border: 4px solid #e6a2cb;
}

.bg-pink-subtle {
  background-color: #ffe6f2 !important;
}

.text-pink {
  color: #e6a2cb !important;
}

body.dark-mode .nama-mahasiswa {
  color: #fff !important;
}
 
body, section, nav, .card, #footer, input, button {
  transition: background-color 0.3s, color 0.3s;
}


body {
  background-color: #fff;
  color: #000;
}

body.dark-mode {
  background-color: #3E0703;
  color: #fff;
}

body.dark-mode nav,
body.dark-mode #hero,
body.dark-mode #gallery,
body.dark-mode .bg-pink-subtle,
body.dark-mode #footer,
body.dark-mode .card,
body.dark-mode section {
  background-color: #3E0703 !important;
  color: #fff !important;
  border-color: #fff !important;
}

body.dark-mode nav {
  background: linear-gradient(90deg, #2B0503, #3E0703);
  color: #fff !important;
  box-shadow: 0 2px 10px rgba(0,0,0,0.3);
}

body.dark-mode nav a {
  color: #fff !important;
}

body.dark-mode #article,
body.dark-mode .card {
  background-color: #2B0503 !important;
  color: #fff !important;
}
body.dark-mode nav a,
body.dark-mode #footer a i,
body.dark-mode .icon-toggle {
  color: #fff !important;
}


body.dark-mode input,
body.dark-mode button {
  background-color: #3E0703 !important;
  color: #fff !important;
  border-color: #fff !important;
}


.icon-container {
  position: fixed;
  bottom: 20px;
  right: 20px;
  display: flex;
  gap: 10px;
  z-index: 2000;
}

.icon-toggle {
  font-size: 32px;
  cursor: pointer;
  color: #000;
  background: none !important;
  border: none !important;
  transition: transform 0.3s ease, color 0.3s ease;
}

.icon-toggle:hover {
  transform: scale(1.1);
}

#moonIcon, #sunIcon, .bi {
  background: none !important;
  border: none !important;
  box-shadow: none !important;
}

  </style>
</head>

<body>
  <!-- NAV -->
  <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
    <div class="container">
      <a class="navbar-brand" href="#">FlowerDreams</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="#article">Article</a></li>
          <li class="nav-item"><a class="nav-link" href="#gallery">Gallery</a></li>
          <li class="nav-item"><a class="nav-link" href="#schedule">Schedule</a></li>
          <li class="nav-item"><a class="nav-link" href="#profile">Profile</a></li>
          <li class="nav-item"><a class="nav-link" href="login.php" target="_blank">Login</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- HERO -->
  <section id="hero" class="text-center p-5 bg-pink-subtle text-sm-start">
    <div class="container">
      <div class="d-sm-flex align-items-center justify-content-between">
        <div>
          <h1 class="fw-bold display-4">Flower Dreams</h1>
          <h4 class="lead display-6">Inspiring Flower Collections</h4>
          <h6>
            <span id="tanggal"></span> <span id="jam"></span>
          </h6>
        </div>
        <img src="img/heroo.jpg" class="img-fluid" width="300">
      </div>
    </div>
  </section>

  <!-- article begin -->
<section id="article" class="text-center p-5">
  <div class="container">
    <h1 class="fw-bold display-4 pb-3">article</h1>
    <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
      <?php
      $sql = "SELECT * FROM article ORDER BY tanggal DESC";
      $hasil = $conn->query($sql); 

      while($row = $hasil->fetch_assoc()){
      ?>
        <div class="col">
          <div class="card h-100">
            <img src="img/<?= $row["gambar"]?>" class="card-img-top" alt="..." />
            <div class="card-body">
              <h5 class="card-title"><?= $row["judul"]?></h5>
              <p class="card-text">
                <?= $row["isi"]?>
              </p>
            </div>
            <div class="card-footer">
              <small class="text-body-secondary">
                <?= $row["tanggal"]?>
              </small>
            </div>
          </div>
        </div>
        <?php
      }
      ?> 
    </div>
  </div>
</section>
<!-- article end -->

  <!-- GALLERY -->
  <section id="gallery" class="text-center p-5 bg-pink-subtle">
    <h1 class="fw-bold display-4 pb-3">Gallery</h1>
    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel" data-bs-interval="2000">
      <div class="carousel-inner">
        <div class="carousel-item active"><img src="img/bunga1.jpg" class="d-block w-100"></div>
        <div class="carousel-item"><img src="img/bunga2.jpg" class="d-block w-100"></div>
        <div class="carousel-item"><img src="img/bunga3.jpg" class="d-block w-100"></div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
      </button>
    </div>
  </section>

  <!-- schedule -->
   <section id="schedule" class="text-center p-5">
     <div class="container my-5">
      <h3 class="text-center fw-bold mb-4">Jadwal Kuliah & Kegiatan Mingguan</h3>
  
      <div class="row g-4">
        <!-- senin -->
         <div class="col-md-3">
     <div class="card border-primary h-100 shadow-sm">
      <div class="card-header bg-primary text-white text-center fw-bold">
        Senin
      </div>
      <div class="card-body text-center">
        <p class="mb-3"><strong>09.00 - 10.30</strong><br>Basis Data<br>Ruang H.3.4</p>
        <p class="mb-0"><strong>13.00 - 15.00</strong><br>Dasar Pemrograman<br>Ruang H.3.1</p>
      </div>
      </div>
      </div>
  
      <!-- selasa -->
      <div class="col-md-3">
        <div class="card border-success h-100 shadow-sm">
         <div class="card-header bg-success text-white text-center fw-bold">
           Selasa
         </div>
         <div class="card-body text-center">
           <p class="mb-3"><strong>08.00 - 09.30</strong><br>Pemrograman Berbasis Web<br>Ruang D.2.J</p>
           <p class="mb-0"><strong>14.00 - 16.00</strong><br>Basis Data<br>Ruang D.3.M</p>
         </div>
         </div>
         </div>

     <!-- rabu -->
      <div class="col-md-3">
        <div class="card border-danger h-100 shadow-sm">
         <div class="card-header bg-danger text-white text-center fw-bold">
           Rabu
         </div>
         <div class="card-body text-center">
           <p class="mb-3"><strong>09.00 - 10.30</strong><br>Pemrograman Berbasis Object<br>Ruang D.2.A</p>
           <p class="mb-0"><strong>13.00 - 15.00</strong><br>Pemrogramann Sisi Server<br>Ruang D.2.A</p>
         </div>
         </div>
         </div>
  
      <!-- kamis -->
      <div class="col-md-3">
        <div class="card border-warning h-100 shadow-sm">
         <div class="card-header bg-warning text-white text-center fw-bold">
           Kamis
         </div>
         <div class="card-body text-center">
           <p class="mb-3"><strong>08.00 - 10.00</strong><br>Pengantar Teknologi Informasit<br>Ruang D.3.N</p>
           <p class="mb-0"><strong>11.00 - 13.00</strong><br>Rapat Koordinasi DOSCOM<br>Ruang Rapat G.1</p>
         </div>
         </div>
         </div>

      <!-- jumat -->
      <div class="col-md-3">
        <div class="card border-info h-100 shadow-sm">
         <div class="card-header bg-info text-white text-center fw-bold">
           Jumat
         </div>
         <div class="card-body text-center">
           <p class="mb-3"><strong>09.00 - 11.00</strong><br>Data Mining<br>Ruang G.2.3</p>
           <p class="mb-0"><strong>13.00 - 15.00</strong><br>International Retrieval<br>Ruang G.2.4</p>
         </div>
         </div>
         </div>

      <!-- sabtu -->
      <div class="col-md-3">
        <div class="card border-secondary h-100 shadow-sm">
         <div class="card-header bg-secondary text-white text-center fw-bold">
           Sabtu
         </div>
         <div class="card-body text-center">
           <p class="mb-3"><strong>08.00 - 10.00</strong><br>Bimbingan Karier<br>Online</p>
           <p class="mb-0"><strong>10.30 - 12.00</strong><br>Bimbingan Skripsi<br>Online</p>
         </div>
         </div>
         </div>
   

      <!-- minggu -->
      <div class="col-md-3">
        <div class="card border-dark h-100 shadow-sm">
         <div class="card-header bg-dark text-white text-center fw-bold">
           Minggu
         </div>
         <div class="card-body text-center">
           <p class="mb-3">Tidak Ada Jadwal</p>
         </div>
         </div>
         </div>
        </section>
   
        </div>
    
      <!-- profil -->
       <section class id="profile" class="text-center p-5">
          <div class="container py-5">
          <div class="card shadow-lg border-0 rounded-4">
          <div class="card-body p-4">
          <div class="row align-items-center">
          
  
       <div class="col-md-3 text-center mb-3 mb-md-0">
       <img src="img/cantik.jpg" alt="Foto Mahasiswa" class="profile-img">
       </div>

          
        <div class="col-md-9">
          <h3 class="fw-bold text-pink mb-3">Profil Mahasiswa</h3>
          <h6 class="nama-mahasiswa text-dark mb-3">Mutiara Ramadhani</h6>
          <table class="info-table">
            <tr>
              <td>NIM</td><td>:</td><td>A11.2024.16002</td>
            </tr>
            <tr>
              <td>Program Studi</td><td>:</td><td>Teknik Informatika</td>
            </tr>
            <tr>
              <td>Fakultas</td><td>:</td><td>Ilmu Komputer</td>
            </tr>
            <tr>
              <td>Email</td><td>:</td><td>ramadhanimutiara879@gmail.com</td>
            </tr>
            <tr>
              <td>No. Telepon</td><td>:</td><td>0838-9550-9991</td>
            </tr>
          </table>
       
        </div>

      </div>
    </div>
  </div>
</div>
</section>


  <!-- FOOTER -->
  <section id="footer" class="text-center p-5">
    <div>
      <a href="https://www.instagram.com/tiaarmdhnii._?igsh=ZDEyNmFmcndvdHNi"><i class="bi bi-instagram h2 p-2"></i></a>
      <i class="bi bi-twitter h2 p-2"></i>
      <i class="bi bi-whatsapp h2 p-2"></i>
    </div>
    <div>Mutiara Ramadhani 2025</div>
  </section>

  <div class="icon-container">
    <i class="bi bi-moon-stars-fill icon-toggle" id="moonIcon"></i>
    <i class="bi bi-brightness-high-fill icon-toggle" id="sunIcon"></i>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    function tampilWaktu() {
      var waktu = new Date();
      var bulan = waktu.getMonth() + 1;
      document.getElementById("tanggal").innerHTML = waktu.getDate() + "/" + bulan + "/" + waktu.getFullYear();
      document.getElementById("jam").innerHTML = waktu.getHours() + ":" + waktu.getMinutes() + ":" + waktu.getSeconds();
      setTimeout(tampilWaktu, 1000);
    }
    tampilWaktu();
  </script>

  <script>
    const moonIcon = document.getElementById("moonIcon");
    const sunIcon = document.getElementById("sunIcon");

    moonIcon.onclick = () => document.body.classList.add("dark-mode");
    sunIcon.onclick = () => document.body.classList.remove("dark-mode");
  </script>
</body>
</html>
