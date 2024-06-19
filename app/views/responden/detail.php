<?php
if (!isset($_SESSION['user_id'])) {
    header('Location: ' . BASEURL . '/middleware');
    exit;
}
if ($_SESSION['role'] != 'guest') {
    header('Location: ' . BASEURL . '/middleware/checkout');
    exit;
}
$no = 0;
?>

<div class="container">

    <!-- Button Section -->
    <div class="d-print-none mb-5 d-flex">
        <a href="<?= BASEURL; ?>/responden/riwayat" class="btn btn-outline-secondary me-2">Kembali</a>
        <button class="btn btn-outline-dark d-flex align-items-center" onclick="printPage()">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer-fill me-1" viewBox="0 0 16 16">
                <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z" />
                <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
            </svg>
            <span>Print</span>
        </button>
    </div>

    <div class="row mb-5">
        <!-- Tabel Keterangan -->
        <div class="col-12 col-lg-4 p-0 pe-lg-2 ps-lg-2 mb-5 m-lg-0">
            <div class="bg-white px-2 py-2 border rounded">
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

        <div class="col-12 col-lg-8 px-3 py-5 bg-white border rounded">

            <!-- Tingkat Kecanduan -->
            <div class="card text-center mb-5">
                <div class="card-header">Tingkat kecocokan</div>

                <?php foreach ($data['solusi'] as $solusi) : ?>
                    <?php
                    if (
                        $data['nilaiH']['hasilBagiSeratus'] >= $solusi['min'] &&
                        $data['nilaiH']['hasilBagiSeratus'] <= $solusi['max']
                    ) :
                    ?>
                        <div class="card-body <?= $solusi['warna'] ?>">
                            <h5 class="card-title">
                                <?= $solusi['tingkat_kecocokan'] ?>
                            </h5>

                            <h5 class="card-title">
                                <?= $data['nilaiH']['hasilBagiSeratus'] ?>
                            </h5>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

            <!-- Komentar -->
            <div class="card text-center">
                <div class="card-header">Komentar</div>

                <?php foreach ($data['solusi'] as $solusi) : ?>
                    <?php
                    if (
                        $data['nilaiH']['hasilBagiSeratus'] >= $solusi['min'] &&
                        $data['nilaiH']['hasilBagiSeratus'] <= $solusi['max']
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

            <!-- Saran -->
            <div class="card text-center">
                <div class="card-header">Saran</div>

                <?php foreach ($data['solusi'] as $solusi) : ?>
                    <?php
                    if (
                        $data['nilaiH']['hasilBagiSeratus'] >= $solusi['min'] &&
                        $data['nilaiH']['hasilBagiSeratus'] <= $solusi['max']
                    ) :
                    ?>
                        <div class="card-body <?= $solusi['warna'] ?>">
                            <h5>
                                <?= $solusi['saran'] ?>
                            </h5>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

        </div>
    </div>

    <!-- Tabel nilai CF -->
    <div class="row mb-5">
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
                <table class="table">
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
                            <th colspan="5" <?php foreach ($data['solusi'] as $solusi) : ?> <?php
                                                                                            if (
                                                                                                $data['nilaiH']['hasilBagiSeratus'] >= $solusi['min'] &&
                                                                                                $data['nilaiH']['hasilBagiSeratus'] <= $solusi['max']
                                                                                            ) :
                                                                                            ?> <?php if ($solusi['warna'] == 'bg-orange') : ?> style="background-color: #ff8906; color: #fff;" <?php else : ?> class="<?= $solusi['warna'] ?>" <?php endif; ?> <?php endif; ?> <?php endforeach; ?>>
                                <p class="text-center pt-3">
                                    <?= $data['nilaiH']['hasilBagiSeratus'] ?>
                                </p>
                            </th>
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