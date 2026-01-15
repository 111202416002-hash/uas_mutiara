<?php
include "koneksi.php";

$hlm = (isset($_POST['hlm'])) ? $_POST['hlm'] : 1;
$limit = 4;
$limit_start = ($hlm - 1) * $limit;

$sql = "SELECT * FROM article ORDER BY tanggal DESC LIMIT $limit_start, $limit";
$hasil = $conn->query($sql);
$no = $limit_start + 1;
?>

<table class="table table-hover">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th class="w-25">Judul</th>
            <th class="w-75">Isi</th>
            <th class="w-25">Gambar</th>
            <th class="w-25">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $hasil->fetch_assoc()) { ?>
            <tr>
                <td><?= $no++ ?></td>
                <td>
                    <strong><?= $row["judul"] ?></strong><br>
                    <small>pada : <?= $row["tanggal"] ?><br>oleh : <?= $row["username"] ?></small>
                </td>
                <td><?= $row["isi"] ?></td>
                <td>
                    <?php if ($row["gambar"] != '' && file_exists('img/' . $row["gambar"])) { ?>
                        <img src="img/<?= $row["gambar"] ?>" width="100">
                    <?php } ?>
                </td>
                <td>
                    <a href="#" class="badge rounded-pill text-bg-success" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $row['id'] ?>"><i class="bi bi-pencil"></i></a>
                    <a href="#" class="badge rounded-pill text-bg-danger" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $row['id'] ?>"><i class="bi bi-x-circle"></i></a>

                    <div class="modal fade" id="modalEdit<?= $row['id'] ?>" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5">Edit Article</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <form method="post" action="admin.php?page=article" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                        <input type="hidden" name="gambar_lama" value="<?= $row['gambar'] ?>">
                                        <div class="mb-3">
                                            <label class="form-label">Judul</label>
                                            <input type="text" class="form-control" name="judul" value="<?= $row['judul'] ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Isi</label>
                                            <textarea class="form-control" name="isi" required><?= $row['isi'] ?></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Ganti Gambar</label>
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

                    <div class="modal fade" id="modalHapus<?= $row['id'] ?>" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5">Konfirmasi Hapus</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <form method="post" action="admin.php?page=article">
                                    <div class="modal-body">
                                        <p>Yakin ingin menghapus data <strong><?= $row['judul'] ?></strong>?</p>
                                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                        <input type="hidden" name="gambar" value="<?= $row['gambar'] ?>">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" name="hapus" class="btn btn-danger">Ya, Hapus</button>
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
$sql1 = "SELECT * FROM article";
$hasil1 = $conn->query($sql1); 
$total_records = $hasil1->num_rows;
?>
<p>Total article : <?= $total_records; ?></p>
<nav class="mb-2">
    <ul class="pagination justify-content-end">
    <?php
        $jumlah_page = ceil($total_records / $limit);
        for($i = 1; $i <= $jumlah_page; $i++){
            $link_active = ($hlm == $i)? ' active' : '';
            echo '<li class="page-item halaman '.$link_active.'" id="'.$i.'"><a class="page-link" href="#">'.$i.'</a></li>';
        }
    ?>
    </ul>
</nav>