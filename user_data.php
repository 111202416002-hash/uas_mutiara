<?php
include "koneksi.php";

$hlm = (isset($_POST['hlm'])) ? $_POST['hlm'] : 1;
$limit = 4;
$limit_start = ($hlm - 1) * $limit;

$sql = "SELECT * FROM user ORDER BY id DESC LIMIT $limit_start, $limit";
$hasil = $conn->query($sql);
$no = $limit_start + 1;
?>

<table class="table table-hover">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Username</th>
            <th>Foto</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $hasil->fetch_assoc()) { ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><strong><?= $row["username"] ?></strong></td>
                <td>
                    <?php if ($row["foto"] != '' && file_exists('img/' . $row["foto"])) { ?>
                        <img src="img/<?= $row["foto"] ?>" width="100" class="rounded-circle">
                    <?php } else { echo "Tanpa Foto"; } ?>
                </td>
                <td>
                    <a href="#" class="badge rounded-pill text-bg-success" data-bs-toggle="modal" data-bs-target="#modalEditU<?= $row['id'] ?>"><i class="bi bi-pencil"></i></a>
                    
                    <a href="#" class="badge rounded-pill text-bg-danger" data-bs-toggle="modal" data-bs-target="#modalHapusU<?= $row['id'] ?>"><i class="bi bi-x-circle"></i></a>

                    <div class="modal fade" id="modalEditU<?= $row['id'] ?>" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5">Edit User</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <form method="post" action="admin.php?page=user" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                        <input type="hidden" name="foto_lama" value="<?= $row['foto'] ?>">
                                        <div class="mb-3">
                                            <label class="form-label">Username</label>
                                            <input type="text" class="form-control" name="username" value="<?= $row['username'] ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Password Baru (kosongkan jika tidak ganti)</label>
                                            <input type="password" class="form-control" name="password">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Ganti Foto</label>
                                            <input type="file" class="form-control" name="foto">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" name="update" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="modalHapusU<?= $row['id'] ?>" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5">Konfirmasi Hapus</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <form method="post" action="admin.php?page=user">
                                    <div class="modal-body">
                                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                        <input type="hidden" name="foto" value="<?= $row['foto'] ?>">
                                        <p>Yakin ingin menghapus user <strong><?= $row['username'] ?></strong>?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" name="hapus" class="btn btn-danger">Hapus</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php 
$total_records = $conn->query("SELECT * FROM user")->num_rows;
$jumlah_page = ceil($total_records / $limit);
?>
<div class="d-flex justify-content-between align-items-center">
    <p>Total User : <?= $total_records; ?></p>
    <nav>
        <ul class="pagination">
            <?php for($i = 1; $i <= $jumlah_page; $i++){
                $link_active = ($hlm == $i)? ' active' : '';
                echo '<li class="page-item halaman '.$link_active.'" id="'.$i.'"><a class="page-link" href="#">'.$i.'</a></li>';
            } ?>
        </ul>
    </nav>
</div>