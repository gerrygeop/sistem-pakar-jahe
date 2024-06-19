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

<div class="container py-5 mb-3">

    <div class="row">
        <div class="col-12 col-md-8 ms-auto px-0">
            <?php Flasher::alert(); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-4 py-1">
            <h4 class="text-secondary">Edit Username</h4>
        </div>

        <div class="col-12 col-md-8 p-5 bg-white shadow-sm border rounded">
            <form action="<?= BASEURL; ?>/user/update" method="POST">

                <div class="row gy-3">
                    <div class="mb-5">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?= $data['user']['username'] ?>" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <a href="<?= BASEURL; ?>/home/index" class="btn btn-outline-secondary me-2">Batal</a>
                        <button type="submit" class="btn btn-dark">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <hr class="my-5">

    <div class="row mb-5">
        <div class="col-12 col-md-4 py-1">
            <h4 class="text-secondary">Edit Password</h4>
        </div>

        <div class="col-12 col-md-8 p-5 bg-white shadow-sm border rounded">
            <form action="<?= BASEURL; ?>/user/updatePassword" method="POST">

                <div class="row gy-3">
                    <div class="mb-5">
                        <label for="password" class="form-label">Password Lama</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>

                    <div class="mb-5">
                        <label for="new_password" class="form-label">Password Baru</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" required>
                    </div>
                    <div class="mb-5">
                        <label for="confirm_password" class="form-label">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <a href="<?= BASEURL; ?>/home/index" class="btn btn-outline-secondary me-2">Batal</a>
                        <button type="submit" class="btn btn-dark">Update Password</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>