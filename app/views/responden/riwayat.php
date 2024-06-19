<?php
if (!isset($_SESSION['user_id'])) {
    header('Location: ' . BASEURL . '/middleware');
    exit;
}
if ($_SESSION['role'] != 'guest') {
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

    <a href="<?= BASEURL; ?>/home/index" class="btn btn-outline-secondary me-2">Kembali</a>

    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-auto">
                <h1>RIWAYAT ANALISA KECOCOKAN</h1>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nilai Akhir</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Waktu</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['riwayat'] as $riwayat) : ?>
                    <tr>
                        <td><?= $riwayat['id']; ?> </td>
                        <td><?= $riwayat['nilai_akhir']; ?></td>

                        <td>
                            <?php foreach ($data['solusi'] as $solusi) : ?>
                                <?php if ($riwayat['solusi_id'] == $solusi['id']) : ?>
                                    <span class="badge text-dark <?= $solusi['warna']; ?>">
                                        <?= $solusi['tingkat_kecocokan']; ?>
                                    </span>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </td>

                        <td><?= $riwayat['timestamps']; ?></td>

                        <td>
                            <a href="<?= BASEURL; ?>/responden/detail/<?= $riwayat['record']; ?>" class="btn btn-outline-dark btn-sm">Detail</a>
                        </td>
                    </tr>
                <?php endforeach ?>

                <?php if (count($data['riwayat']) < 1) : ?>
                    <tr>
                        <td class="text-center fst-italic text-secondary" colspan="6">
                            Belum ada data
                        </td>
                    </tr>
                <?php endif ?>

            </tbody>
        </table>
    </div>

</div>