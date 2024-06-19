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

    <!-- Button Section -->
    <div class="d-print-none mb-5 d-flex">
        <a href="<?= BASEURL; ?>/admin/laporanDataUser" class="btn btn-outline-secondary me-2">Kembali</a>
        <button class="btn btn-outline-primary d-flex align-items-center" onclick="printPage()">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer-fill me-1" viewBox="0 0 16 16">
                <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z" />
                <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
            </svg>
            <span>Print</span>
        </button>
    </div>

    <div class="row mb-5">
        <div class="col-12 col-lg-4 p-0 pe-lg-2 ps-lg-2 mb-5 m-lg-0">

            <!-- Tabel Biodata -->
            <div class="bg-white border rounded mb-3">
                <h5 class="px-2 pt-2 text-decoration-underline">Profil</h5>
                <table class="table mb-0">
                    <tr>
                        <th class="fs-6 fw-bolder">Username</th>
                        <td><?= $data['mhs']['username'] ?></td>
                    </tr>
                </table>
            </div>

            <!-- Tabel keterangan -->
            <div class="bg-white p-1 border rounded">
                <h5 class="px-2 pt-2 text-decoration-underline">Keterangan</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Kategori</th>
                            <th scope="col">% Interval</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['solusi'] as $solusi) : ?>
                            <tr class="<?= $solusi['warna'] ?>">
                                <td><?= $solusi['tingkat_kecocokan'] ?></td>
                                <td>
                                    <?= $solusi['min'] ?>% - <?= $solusi['max'] ?>%
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tabel Hasil dan Solusi -->
        <div class="col-12 col-lg-8 px-2 py-3 ms-auto bg-white border rounded">
            <div class="d-flex flex-column justify-content-around h-100">

                <div class="card text-center mb-5">
                    <div class="card-header">
                        Tingkat Kecanduan
                    </div>

                    <?php foreach ($data['solusi'] as $solusi) : ?>
                        <?php
                        if (
                            $data['laporan']['nilai_akhir'] >= $solusi['min'] &&
                            $data['laporan']['nilai_akhir'] <= $solusi['max']
                        ) :
                        ?>
                            <div class="card-body <?= $solusi['warna'] ?>">
                                <h5 class="card-title">
                                    <?= $solusi['tingkat_kecocokan'] ?>
                                </h5>

                                <h5 class="card-title">
                                    <?= $data['laporan']['nilai_akhir'] ?>
                                </h5>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>

                <div class="card text-center">
                    <div class="card-header">
                        Solusi
                    </div>

                    <?php foreach ($data['solusi'] as $solusi) : ?>
                        <?php
                        if (
                            $data['laporan']['nilai_akhir'] >= $solusi['min'] &&
                            $data['laporan']['nilai_akhir'] <= $solusi['max']
                        ) :
                        ?>
                            <div class="card-body <?= $solusi['warna'] ?>">
                                <h5 class="card-title">
                                    <?= $solusi['solusi'] ?>
                                </h5>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>

            </div>
        </div>
    </div>

    <div class="row mb-5">
        <!-- tabel nilai CF -->
        <div class="col-12 col-lg-8 ms-auto px-2 py-2 bg-white border rounded">

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Kriteria</th>
                            <th scope="col">Enterpretasi nilai CF</th>
                            <th scope="col">CF sequencial</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['riwayatResponden'] as $key => $value) : ?>
                            <tr <?php foreach ($data['solusi'] as $solusi) : ?> <?php if ($value['tingkatan'] == $solusi['id']) : ?> class="<?= $solusi['warna'] ?>" <?php endif; ?> <?php endforeach; ?>>
                                <td>
                                    <?= $value['kriteria'] ?>
                                </td>
                                <td>
                                    <?= $value['r_cf'] ?>
                                </td>
                                <td>
                                    <?= $value['H'] ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <div class="row mb-5">
        <!-- Tabel nilai CF gabungan -->
        <div class="col-12 col-lg-8 ms-auto px-2 pb-2 pt-3 bg-white border rounded">
            <h5 class="px-2 pt-2 text-decoration-underline">CF gabungan</h5>

            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th scope="col">Kategori</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['nilaiH']['combin'] as $key => $combin) : ?>
                            <tr>
                                <?php foreach ($data['solusi'] as $solusi) : ?>
                                    <?php if ($key == $solusi['id']) : ?>
                                        <th <?php if ($solusi['warna'] == 'bg-orange') : ?> style="background-color: #ff8906;" <?php else : ?> class="<?= $solusi['warna'] ?>" <?php endif; ?>>
                                            <?= $solusi['tingkat_kecocokan'] ?>
                                        </th>
                                    <?php endif; ?>
                                <?php endforeach; ?>

                                <?php foreach ($combin as $value_combin) : ?>
                                    <td>
                                        <?= $value_combin ?>
                                    </td>
                                <?php endforeach; ?>
                            </tr>
                        <?php endforeach; ?>

                        <tr class="align-middle">
                            <th scope="row">Hasil</th>
                            <td colspan="5" <?php foreach ($data['solusi'] as $solusi) : ?> <?php
                                                                                            if (
                                                                                                $data['nilaiH']['hasilBagiSeratus'] >= $solusi['min'] &&
                                                                                                $data['nilaiH']['hasilBagiSeratus'] <= $solusi['max']
                                                                                            ) :
                                                                                            ?> <?php if ($solusi['warna'] == 'bg-orange') : ?> style="background-color: #ff8906; color: #fff;" <?php else : ?> class="<?= $solusi['warna'] ?>" <?php endif; ?> <?php endif; ?> <?php endforeach; ?>>
                                <p class="text-center pt-3">
                                    <?= $data['nilaiH']['hasilBagiSeratus'] ?>
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>

<script>
    function printPage() {
        window.print();
    }
</script>