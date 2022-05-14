<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col">
            <a href="<?= base_url('komik/create'); ?>" class="btn btn-primary mt-3">Tambah Data Komik</a>

            <h1 class="text-center mt-2">Daftar Komik</h1>

            <!-- Pesan Flash Data -->
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashData('pesan'); ?>
                </div>
            <?php endif; ?>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Sampul</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($komik as $k) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td>
                                <img src="img/<?= $k['sampul']; ?>" alt="Naruto" class="sampul">
                            </td>
                            <td><?= $k['judul']; ?></td>
                            <td>
                                <a href="http://localhost/ci4komik/public/komik/<?= $k['slug']; ?>" class="btn btn-success">Detail</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>