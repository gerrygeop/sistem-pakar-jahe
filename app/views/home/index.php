<div class="container">
    <header class="d-print-none px-5 py-3 text-white text-center bg-orange rounded">
        <h3>SISTEM PAKAR MENENTUKAN TINGKAT KECOCOKAN LAHAN UNTUK TANAMAN JAHE</h3>
    </header>

    <div class="row my-lg-5 pt-4 text-center">
        <div class="col-12 col-lg-4 text-lg-start pt-lg-4">

            <!-- Menu Admin -->
            <?php if (isset($_SESSION['user_id']) && $_SESSION['role'] == 'admin') : ?>
                <ul class="list-group">
                    <li class="list-group-item bg-orange text-white fw-bold text-center" aria-current="true">Menu Utama</li>
                    <a href="<?= BASEURL; ?>/solusi/index" class="list-group-item list-group-item-action">
                        Data lahan dan solusi
                    </a>
                    <a href="<?= BASEURL; ?>/kriteria/index" class="list-group-item list-group-item-action">
                        Kriteria
                    </a>
                    <a href="<?= BASEURL; ?>/admin/laporanDataUser" class="list-group-item list-group-item-action">
                        Laporan Data User
                    </a>
                </ul>

                <!-- Menu Mahasiswa -->
            <?php elseif (isset($_SESSION['user_id']) && $_SESSION['role'] == 'guest') : ?>
                <ul class="list-group">
                    <li class="list-group-item bg-orange text-white fw-bold text-center" aria-current="true">Menu Utama</li>
                    <a href="<?= BASEURL; ?>/user/profile" class="list-group-item list-group-item-action">
                        Profil
                    </a>
                    <a href="<?= BASEURL; ?>/responden/index" class="list-group-item list-group-item-action">
                        Input data lahan
                    </a>
                    <a href="<?= BASEURL; ?>/responden/riwayat" class="list-group-item list-group-item-action">
                        Hasil analisa
                    </a>
                </ul>

                <!-- Menu Sebelum Login -->
            <?php else : ?>
                <ul class="list-group">
                    <li class="list-group-item bg-orange text-white fw-bold text-center" aria-current="true">Login sebagai</li>
                    <!-- <li class="list-group-item">
                        <svg width="25" height="25" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        Beranda
                    </li> -->
                    <a href="<?= BASEURL; ?>/auth/adminLogin" class="list-group-item list-group-item-action">
                        <svg width="25" height="25" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Admin
                    </a>
                    <a href="<?= BASEURL; ?>/auth" class="list-group-item list-group-item-action">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
                            <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4" />
                        </svg>
                        Guest
                    </a>
                </ul>

            <?php endif; ?>
        </div>

        <div class="col-12 col-lg-8 text-lg-end p-5 p-lg-0">
            <img src="<?= BASEURL; ?>/img/jahe.png" alt="Logo utama" class="img-custom">
        </div>
    </div>

    <div class="row my-5 px-3 py-5 bg-white border rounded">
        <div class="col">
            <p style="text-align: justify;">&emsp;&emsp;Jahe merupakan tanaman yang berupa tumbuhan berbatang temu atau batang yang tersusun atas pelepah daun-daun yang bersatu dan saling melengkung dan termasuk dalam komunitas rempah-rempah yang dapat diperdagangkan di dunia. Tanaman jahe dapat dengan mudah terserang penyakit yang mengakibatkan tanaman tidak dapat tumbuh dengan subur bahkan mati. Penurunan jumlah produksi ini disebabkan oleh banyak faktor (Tindaon et al., 2022).</p>
            <p style="text-align: justify;">&emsp;&emsp;Lahan adalah suatu daerah di permukaan bumi yang ciri-cirinya (characteristics) mencakup semua atribut yang bersifat cukup mantap atau yang dapat diduga bersifat mendaur dari biosfer, atmosfer, tanah, geologi, hidrologi, populasi tumbuhan dan hewan, serta hasil kegiatan manusia pada masa lampau dan masa kini, sepanjang pengenal-pengenal tadi berpengaruh secara signifikan atas penggunaan lahan pada waktu sekarang dan pada waktu mendatang. Penggunaan lahan adalah segala campur tangan manusia, baik secara permanen maupun secara siklus terhadap suatu kelompok sumber daya alam dan sumber daya buatan, yang secara keseluruhan disebut lahan, dengan tujuan untuk mencukupi kebutuhan-kebutuhannya baik secara kebendaan maupun spiritual ataupun kedua-duanya (Mokodompit et al., 2019).</p>
            </ol>
        </div>
    </div>
</div>