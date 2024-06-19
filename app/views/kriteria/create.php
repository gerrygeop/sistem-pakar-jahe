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

<div class="container px-5 py-3 mb-5 bg-white shadow-sm border rounded">

    <div class="row my-3 px-5">
        <div class="col-12">
            <h3 class="text-secondary">#Tambah Data Kriteria</h3>
        </div>
    </div>

    <div class="px-5 py-3 rounded">
        <form action="<?= BASEURL; ?>/kriteria/store" method="POST">

            <div class="row gy-5">
                <div class="col-12">
                    <label for="kriteria" class="form-label text-secondary">Kriteria</label>
                    <textarea class="form-control" id="kriteria" name="kriteria" autofocus required></textarea>
                </div>

                <div class="col-12">
                    <label for="tingkatan" class="form-label text-secondary">Tingkatan</label>
                    <select class="form-select" name="tingkatan">
                        <?php foreach ($data['solusi'] as $value) : ?>
                            <option value="<?= $value['id'] ?>">
                                <?= $value['tingkat_kecocokan'] ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>

                <div class="col-12">
                    <label for="MB" class="form-label text-secondary">MB</label>
                    <input type="text" class="form-control" id="MB" name="MB" autofocus required>
                </div>

                <div class="col-12">
                    <label for="MD" class="form-label text-secondary">MD</label>
                    <input type="text" class="form-control" id="MD" name="MD" autofocus required>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-12">
                    <a href="<?= BASEURL; ?>/kriteria/index" class="btn btn-outline-secondary me-2">Batal</a>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </div>
        </form>
    </div>

</div>