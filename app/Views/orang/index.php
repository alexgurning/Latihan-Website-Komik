<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
 <h1 class="text-center mt-2">Daftar Orang</h1>
 <div class="row">
  <div class="col-4">


   <form action="" method="post">
    <div class="input-group mb-3">
     <input type="text" class="form-control" placeholder="Masukan Keyword Pencarian" name="keyword">
     <div class="input-group-append">
      <button class="btn btn-primary" type="submit" name="submit">Cari</button>
     </div>
    </div>
   </form>

  </div>
 </div>

 <div class="row">
  <div class="col">

   <table class="table">
    <thead>
     <tr>
      <th scope="col">#</th>
      <th scope="col">Nama</th>
      <th scope="col">Alamat</th>
      <th scope="col">Aksi</th>
     </tr>
    </thead>
    <tbody>
     <?php $i = 1 + (6 * ($currentPage - 1)); ?>
     <?php foreach ($orang as $o) : ?>
      <tr>
       <th scope="row"><?= $i++; ?></th>
       <td><?= $o['nama']; ?></td>
       <td><?= $o['alamat']; ?></td>
       <td>
        <a href="#" class="btn btn-success">Detail</a>
       </td>
      </tr>
     <?php endforeach; ?>
    </tbody>
   </table>

   <?= $pager->links('orang', 'orang_pagination'); ?>

  </div>
 </div>
</div>


<?= $this->endSection(); ?>