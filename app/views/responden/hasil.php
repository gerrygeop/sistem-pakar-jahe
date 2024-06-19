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

    <div class="row">
        <div class="col-6">
            <?php Flasher::flash(); ?>
        </div>
    </div>

    <a href="<?= BASEURL; ?>/home/index" class="btn btn-outline-secondary me-2">Kembali</a>

    <div class="row my-5">
        <div class="col-4">
            <div class="bg-white px-2 py-2 border rounded">
                <ul class="list-group list-group-horizontal">
                    <li class="list-group-item col">
                        Username
                    </li>
                    <li class="list-group-item col">
                        <?= $data['mhs']['username'] ?>
                    </li>
            </div>
        </div>

        <div class="col-8 px-3 py-5 bg-white border rounded">
            <div class="card text-center mb-5">
                <div class="card-header">
                    Tingkat Kecocokan
                </div>

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

                <!-- <div class="card-body">
                    <?php if ($data['nilaiH'] <= 25) : ?>
                        <div class="card-body <?= $data['solusi'][0]['warna'] ?>">
                            <h5 class="card-title">
                                <?= $data['solusi'][0]['tingkat_kecocokan'] ?>
                            </h5>
                            <h5 class="card-title">
                                <?= $data['nilaiH'] ?>
                            </h5>
                        </div>

                    <?php elseif ($data['nilaiH'] >= 25 && $data['nilaiH'] <= 50) : ?>
                        <div class="card-body <?= $data['solusi'][1]['warna'] ?>">
                            <h5 class="card-title">
                                <?= $data['solusi'][1]['tingkat_kecocokan'] ?>
                            </h5>
                            <h5 class="card-title">
                                <?= $data['nilaiH'] ?>
                            </h5>
                        </div>
                    <?php elseif ($data['nilaiH'] >= 50 && $data['nilaiH'] <= 75) : ?>
                        <div class="card-body <?= $data['solusi'][2]['warna'] ?>">
                            <h5 class="card-title">
                                <?= $data['solusi'][2]['tingkat_kecocokan'] ?>
                            </h5>
                            <h5 class="card-title">
                                <?= $data['nilaiH'] ?>
                            </h5>
                        </div>

                    <?php elseif ($data['nilaiH'] >= 75) : ?>
                        <div class="card-body <?= $data['solusi'][3]['warna'] ?>">
                            <h5 class="card-title">
                                <?= $data['solusi'][3]['tingkat_kecocokan'] ?>
                            </h5>
                            <h5 class="card-title">
                                <?= $data['nilaiH'] ?>
                            </h5>
                        </div>

                    <?php else : ?>
                        <div class="card-body">
                            <h5 class="card-title">
                                Tidak diketahui
                            </h5>
                            <h5 class="card-title">
                                <?= $data['nilaiH'] ?>
                            </h5>
                        </div>

                    <?php endif; ?>
                </div> -->
            </div>

            <!-- Komentar -->
            <div class="card text-center">
                <div class="card-header">
                    Komentar
                </div>

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

                <!-- <div>
                    <?php if ($data['nilaiH'] <= 25) : ?>
                        <div class="card-body <?= $data['solusi'][0]['warna'] ?>">
                            <h5 class="card-title">
                                <?= $data['solusi'][0]['solusi'] ?>
                            </h5>
                        </div>
    
                    <?php elseif ($data['nilaiH'] >= 25 && $data['nilaiH'] <= 50) : ?>
                        <div class="card-body <?= $data['solusi'][1]['warna'] ?>">
                            <h5 class="card-title">
                                <?= $data['solusi'][1]['solusi'] ?>
                            </h5>
                        </div>
    
                    <?php elseif ($data['nilaiH'] >= 50 && $data['nilaiH'] <= 75) : ?>
                        <div class="card-body  <?= $data['solusi'][2]['warna'] ?>">
                            <h5 class="card-title">
                                <?= $data['solusi'][2]['solusi'] ?>
                            </h5>
                        </div>
    
                    <?php elseif ($data['nilaiH'] >= 75) : ?>
                        <div class="card-body  <?= $data['solusi'][3]['warna'] ?>">
                            <h5 class="card-title">
                                <?= $data['solusi'][3]['solusi'] ?>
                            </h5>
                        </div>
    
                    <?php else : ?>
                        <div class="card-body">
                            <h5 class="card-title">
                                Solusi tidak diketahui
                            </h5>
                        </div>
    
                    <?php endif; ?>
                </div> -->
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
</div>