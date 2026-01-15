<?php
include "koneksi.php";

$hlm = (isset($_POST['hlm'])) ? $_POST['hlm'] : 1;
$limit = 4;
$limit_start = ($hlm - 1) * $limit;

// Pastikan query mengambil semua kolom
$sql = "SELECT * FROM gallery ORDER BY tanggal DESC LIMIT $limit_start, $limit";
$hasil = $conn->query($sql);
$no = $limit_start + 1;
?>

<table class="table table-hover">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th class="w-25">Judul</th>
            <th class="w-75">Keterangan</th> 
            <th class="w-25">Gambar</th>
            <th class="w-25">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $hasil->fetch_assoc()) { 
            // PERBAIKAN: Antisipasi perbedaan huruf besar/kecil pada nama kolom database
            $val_judul = $row['judul'] ?? $row['Judul'] ?? 'Tanpa Judul';
            $val_ket   = $row['keterangan'] ?? $row['Keterangan'] ?? 'Tanpa Keterangan';
        ?>
            <tr>
                <td><?= $no++ ?></td>
                <td>
                    <strong><?= $val_judul ?></strong><br>
                    <small>pada : <?= $row["tanggal"] ?></small>
                </td>
                <td><?= $val_ket ?></td> 
                <td>
                    <?php if ($row["gambar"] != '' && file_exists('img/' . $row["gambar"])) { ?>
                        <img src="img/<?= $row["gambar"] ?>" width="100">
                    <?php } ?>
                </td>
                <td>
                    <a href="#" class="badge rounded-pill text-bg-success" data-bs-toggle="modal" data-bs-target="#modalEditGal<?= $row['id'] ?>"><i class="bi bi-pencil"></i></a>
                    
                    <a href="#" class="badge rounded-pill text-bg-danger" data-bs-toggle="modal" data-bs-target="#modalHapusGal<?= $row['id'] ?>"><i class="bi bi-x-circle"></i></a>

                    <div class="modal fade" id="modalEditGal<?= $row['id'] ?>" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5">Edit Gallery</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <form method="post" action="admin.php?page=gallery" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                        <input type="hidden" name="gambar_lama" value="<?= $row['gambar'] ?>">
                                        <div class="mb-3">
                                            <label class="form-label">Judul</label>
                                            <input type="text" class="form-control" name="judul" value="<?= $val_judul ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Keterangan</label>
                                            <textarea class="form-control" name="keterangan" required><?= $val_ket ?></textarea>
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

                    <div class="modal fade" id="modalHapusGal<?= $row['id'] ?>" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5">Konfirmasi Hapus</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <form method="post" action="admin.php?page=gallery">
                                    <div class="modal-body">
                                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                        <input type="hidden" name="gambar" value="<?= $row['gambar'] ?>">
                                        <p>Yakin ingin menghapus data <strong><?= $val_judul ?></strong>?</p>
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
$sql_total = "SELECT * FROM gallery";
$total_data = $conn->query($sql_total)->num_rows;
$total_halaman = ceil($total_data / $limit);
?>
<div class="d-flex justify-content-between mt-3">
    <div>Total Gallery : <?= $total_data ?></div>
    <nav>
        <ul class="pagination">
            <?php for($i=1; $i<=$total_halaman; $i++){ ?>
                <li class="page-item <?= ($hlm == $i)? 'active' : '' ?>">
                    <a class="page-link halaman" id="<?= $i ?>" href="#"><?= $i ?></a>
                </li>
            <?php } ?>
        </ul>
    </nav>
</div>