<?php
if (!isset($_SESSION['user_id'])) {
    header('Location: ' . BASEURL . '/middleware');
    exit;
}
if ($_SESSION['role'] != 'admin') {
    header('Location: ' . BASEURL . '/middleware/checkout');
    exit;
}

?>

<div class="container">

    <div class="row">
        <div class="col-6">
            <?php Flasher::flash(); ?>
        </div>
    </div>

    <div class="px-5 py-3 mb-5 bg-white shadow-sm border rounded">
        <div class="row my-3 px-5">
            <div class="col-12">
                <h3 class="text-secondary">#Tambah Data</h3>
            </div>
        </div>

        <div class="px-5 py-3 rounded">
            <form action="<?= BASEURL; ?>/solusi/datapenyakitStore" method="POST">

                <div class="row gy-5">
                    <div class="col-12">
                        <label for="tingkat_kecocokan" class="form-label text-secondary">Tingkatan Kriteria</label>
                        <input type="text" class="form-control" id="tingkat_kecocokan" name="tingkat_kecocokan" required>
                    </div>

                    <div class="col-12">
                        <label for="solusi" class="form-label text-secondary">Komentar</label>
                        <textarea class="form-control" id="solusi" name="solusi" required></textarea>
                    </div>

                    <div class="col-12">
                        <label for="saran" class="form-label text-secondary">Saran</label>
                        <textarea class="form-control" id="saran" name="saran" required></textarea>
                    </div>

                    <div class="col-12">
                        <label for="min" class="form-label text-secondary">Min</label>
                        <input type="text" class="form-control" id="min" name="min">
                    </div>

                    <div class="col-12">
                        <label for="max" class="form-label text-secondary">Max</label>
                        <input type="text" class="form-control" id="max" name="max">
                    </div>

                    <div class="col-12">
                        <label for="warna" class="form-label text-secondary">Warna</label>
                        <select name="warna" id="warna" class="form-select">
                            <option value="bg-warning">Kuning</option>
                            <option value="bg-orange">Jingga/Orange</option>
                            <option value="bg-danger">Merah</option>
                            <option value="bg-primary">Biru</option>
                            <option value="bg-info">Biru Muda</option>
                            <option value="bg-success">Hijau</option>
                        </select>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-12">
                        <a href="<?= BASEURL; ?>/solusi/index" class="btn btn-outline-secondary me-2">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>