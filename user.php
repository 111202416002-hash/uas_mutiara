<?php
include "koneksi.php";

// LOGIKA HAPUS USER
if (isset($_POST['hapus'])) {
    $id = $_POST['id'];
    $foto = $_POST['foto'];

    if ($foto != '' && file_exists("img/" . $foto)) {
        unlink("img/" . $foto);
    }

    $stmt = $conn->prepare("DELETE FROM user WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        echo "<script>alert('Hapus User Berhasil'); document.location='admin.php?page=user';</script>";
    }
    $stmt->close();
}
// 1. LOGIKA SIMPAN (INSERT)
if (isset($_POST['simpan'])) {
    $u_name = $_POST['username'];
    $u_pass = md5($_POST['password']);
    $nama_foto = $_FILES['foto']['name'];
    $final_foto = '';

    if ($nama_foto != '') {
        $file_ext = strtolower(pathinfo($nama_foto, PATHINFO_EXTENSION));
        $final_foto = date("YmdHis") . "." . $file_ext;
        move_uploaded_file($_FILES['foto']['tmp_name'], "img/" . $final_foto);
    }

    $sql = "INSERT INTO user (username, password, foto) VALUES ('$u_name', '$u_pass', '$final_foto')";
    if ($conn->query($sql)) {
        echo "<script>alert('Simpan Berhasil'); document.location='admin.php?page=user';</script>";
    }
}

// 2. LOGIKA UPDATE (EDIT)
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $u_name = $_POST['username'];
    $foto_lama = $_POST['foto_lama'];
    $nama_foto = $_FILES['foto']['name'];

    if ($nama_foto != '') {
        $file_ext = strtolower(pathinfo($nama_foto, PATHINFO_EXTENSION));
        $final_foto = date("YmdHis") . "." . $file_ext;
        move_uploaded_file($_FILES['foto']['tmp_name'], "img/" . $final_foto);
        if ($foto_lama != '' && file_exists("img/" . $foto_lama)) { unlink("img/" . $foto_lama); }
    } else {
        $final_foto = $foto_lama;
    }

    $sql = "UPDATE user SET username='$u_name', foto='$final_foto' WHERE id='$id'";
    if ($conn->query($sql)) {
        echo "<script>alert('Update Berhasil'); document.location='admin.php?page=user';</script>";
    }
}
?>

<div class="container">
    <div class="mb-3">
        <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalTambahU">+ Tambah User</button>
    </div>

    <div id="user_data"></div> 

    <div class="modal fade" id="modalTambahU" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Tambah User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Foto</label>
                            <input type="file" class="form-control" name="foto">
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
</div>

<script>
$(document).ready(function(){
    load_data();
    function load_data(hlm){
        $.ajax({
            url : "user_data.php",
            method : "POST",
            data : {hlm:hlm},
            success : function(data){
                $('#user_data').html(data);
            }
        })
    } 
    $(document).on('click', '.halaman', function(){
        var hlm = $(this).attr("id");
        load_data(hlm);
    });
});
</script>