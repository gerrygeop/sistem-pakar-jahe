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
            <?php Flasher::alert(); ?>
        </div>
    </div>

    <a href="<?= BASEURL; ?>/home/index" class="btn btn-outline-secondary me-2">Kembali</a>
    <a href="<?= BASEURL; ?>/solusi/create" class="btn btn-dark">Tambah Data</a>

    <div class="table-responsive my-5">
        <table class="table">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Tingkat kecocokan</th>
                    <th>Komentar</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['solusi'] as $value) : ?>
                    <tr>
                        <td><?= $value['id']; ?></td>
                        <td><?= $value['tingkat_kecocokan']; ?></td>
                        <td><?= $value['solusi']; ?></td>

                        <td class="text-center">
                            <div class="d-flex align-items-center">
                                <a href="<?= BASEURL; ?>/solusi/edit/<?= $value['id']; ?>" class="btn btn-primary btn-sm pt-0 me-1" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                <form action="<?= BASEURL; ?>/solusi/delete/<?= $value['id']; ?>" method="POST">
                                    <button class="btn btn-danger btn-sm pt-0" onclick="return confirm('Yakin?');" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach ?>

                <?php if (count($data['solusi']) < 1) : ?>
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