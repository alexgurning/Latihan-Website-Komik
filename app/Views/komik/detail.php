<?php

use CodeIgniter\Filters\CSRF;
?>
<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container mt-5">
 <div class="row">
  <div class="col">
   <h2 class="mt-2">Detail Komik</h2>
   <div class="card mb-3" style="max-width: 540px;">
    <div class="row no-gutters">
     <div class="col-md-4">
      <img src="http://localhost/ci4komik/public/img/<?= $komik['sampul']; ?>" class="card-img" alt="My Komik">
     </div>
     <div class="col-md-8">
      <div class="card-body">
       <h5 class="card-title"><?= $komik['judul']; ?></h5>
       <p class="card-text"><b>Penulis : </b><?= $komik['penulis']; ?></p>
       <p class="card-text"><small class="text-muted"><b>Penerbit : </b><?= $komik['penerbit']; ?></small></p>

       <a href="http://localhost/ci4komik/public/komik/edit/<?= $komik['slug']; ?>" class="btn btn-warning">Edit</a>


       <form action="http://localhost/ci4komik/public/komik/<?= $komik['no']; ?>" method="post" class="d-inline">
        <?= csrf_field(); ?>
        <input type="hidden" name="_method" value="DELETE">

        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda Yakin ?'); ">Delete</button>
       </form>




       <br><br>
       <a href="<?= base_url('/komik'); ?>">Kembali ke daftar Komik</a>
      </div>
     </div>
    </div>
   </div>

  </div>
 </div>
</div>
<?= $this->endSection(); ?>