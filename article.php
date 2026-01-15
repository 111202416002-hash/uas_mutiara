<?php
include "koneksi.php";

// FUNGSI UPLOAD (Langsung di sini agar tidak error failed to open stream)
function upload_foto($file) {
    $target_dir = "img/";
    $target_file = $target_dir . basename($file["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $nama_baru = date("YmdHis") . "." . $imageFileType;

    if (move_uploaded_file($file["tmp_name"], $target_dir . $nama_baru)) {
        return ['status' => true, 'message' => $nama_baru];
    } else {
        return ['status' => false, 'message' => 'Gagal Upload'];
    }
}

// LOGIKA HAPUS ARTICLE
if (isset($_POST['hapus'])) {
    $id = $_POST['id'];
    $gambar = $_POST['gambar'];

    if ($gambar != '' && file_exists("img/" . $gambar)) {
        unlink("img/" . $gambar);
    }

    $stmt = $conn->prepare("DELETE FROM article WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo "<script>alert('Hapus Berhasil'); document.location='admin.php?page=article';</script>";
    }
}

// LOGIKA SIMPAN/UPDATE
if (isset($_POST['simpan'])) {
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $tanggal = date("Y-m-d H:i:s");
    $username = $_SESSION['username']; // Pastikan session sudah start
    $nama_gambar = $_FILES['gambar']['name'];
    $gambar = '';

    if ($nama_gambar != '') {
        $cek_upload = upload_foto($_FILES["gambar"]);
        if ($cek_upload['status']) {
            $gambar = $cek_upload['message'];
        }
    }

    if (isset($_POST['id']) && $_POST['id'] != '') {
        $id = $_POST['id'];
        if ($nama_gambar == '') {
            $gambar = $_POST['gambar_lama'];
        } else {
            if ($_POST['gambar_lama'] != '' && file_exists("img/".$_POST['gambar_lama'])) { 
                unlink("img/" . $_POST['gambar_lama']); 
            }
        }
        $stmt = $conn->prepare("UPDATE article SET judul=?, isi=?, gambar=?, tanggal=?, username=? WHERE id=?");
        $stmt->bind_param("sssssi", $judul, $isi, $gambar, $tanggal, $username, $id);
    } else {
        $stmt = $conn->prepare("INSERT INTO article (judul,isi,gambar,tanggal,username) VALUES (?,?,?,?,?)");
        $stmt->bind_param("sssss", $judul, $isi, $gambar, $tanggal, $username);
    }
    
    if ($stmt->execute()) {
        echo "<script>alert('Simpan Berhasil'); document.location='admin.php?page=article';</script>";
    }
}
?>

<div class="container">
    <button type="button" class="btn btn-secondary mb-2" data-bs-toggle="modal" data-bs-target="#modalTambahArt">
        <i class="bi bi-plus-lg"></i> Tambah Article
    </button>
    <div class="row">
        <div class="table-responsive" id="article_data"></div>
    </div>
</div>

<div class="modal fade" id="modalTambahArt" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Tambah Article</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Judul</label>
                        <input type="text" class="form-control" name="judul" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Isi</label>
                        <textarea class="form-control" name="isi" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gambar</label>
                        <input type="file" class="form-control" name="gambar">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    load_data();
    function load_data(hlm){
        $.ajax({
            url : "article_data.php",
            method : "POST",
            data : { hlm: hlm },
            success : function(data){
                $('#article_data').html(data);
            }
        })
    } 
});
</script>