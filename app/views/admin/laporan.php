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

    <a href="<?= BASEURL; ?>/home/index" class="btn btn-outline-secondary me-2">Kembali</a>

    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-auto text-uppercase">
                <h2>laporan data user</h2>
            </div>
        </div>
    </div>

    <div class="row my-3">
        <div class="col col-md-6">
            <div class="input-group">
                <span class="input-group-text" id="basic-addon1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                    </svg>
                </span>
                <input type="text" class="form-control" placeholder="Cari berdasarkan username" id="myInput" onkeyup="myFunction()">
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Username</th>
                    <th scope="col">Nilai Akhir</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Waktu</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody id="myTable">
                <?php foreach ($data['laporan'] as $value) : ?>
                    <tr>
                        <td><?= $value['id']; ?> </td>
                        <td><?= $value['username']; ?></td>
                        <td><?= $value['nilai_akhir']; ?></td>

                        <td>
                            <?php foreach ($data['solusi'] as $solusi) : ?>
                                <?php if ($value['solusi_id'] == $solusi['id']) : ?>
                                    <span class="badge <?= $solusi['warna']; ?>">
                                        <?= $solusi['tingkat_kecocokan']; ?>
                                    </span>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </td>

                        <td><?= $value['timestamps']; ?></td>

                        <td class="text-center">
                            <div class="d-flex align-items-center">
                                <a href="<?= BASEURL; ?>/admin/detail/<?= $value['user_id']; ?>/<?= $value['record']; ?>" class="btn btn-success btn-sm pt-0 me-1" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>

                                <form action="<?= BASEURL; ?>/admin/delete/<?= $value['user_id']; ?>/<?= $value['record']; ?>" method="POST">
                                    <button class="btn btn-danger btn-sm pt-0" title="Hapus" onclick="return confirm('Yakin?');">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>

                <?php if (count($data['laporan']) < 1) : ?>
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

<script>
    function myFunction() {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value;
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>