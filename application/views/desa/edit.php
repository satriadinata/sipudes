<form action="<?php echo site_url('desa/update') ?>" method='post'>
  <input type="hidden" name="id_user" value="<?php echo $calon['id_user'] ?>" >
  <div class="card-body">
    <?php if ($this->session->flashdata('error')!=null):?>
      <div class="alert alert-danger">
        <?php print_r($this->session->flashdata('error')); ?>
      </div>
    <?php endif; ?>

    <div class="form-group">
      <label for="kode_desa">Kode Desa</label>
      <input type="text" class="form-control" value="<?php echo $calon['kode_desa'] ?>" id="kode_desa" placeholder="Masukkan Kode Desa" name="kode_desa" >
    </div>

    <div class="form-group">
      <label for="nama_desa">Nama Desa</label>
      <input type="text" class="form-control" value="<?php echo $calon['nama_desa'] ?>" id="nama_desa" placeholder="Masukkan Nama Desa" name="nama_desa" >
    </div>

    <div class="form-group">
      <label for="email">Email</label>
      <input type="text" class="form-control" value="<?php echo $calon['email'] ?>" id="email" placeholder="Masukkan Email" name="email" >
    </div>

    <div class="form-group">
      <label for="password">Password</label>
      <input type="text" class="form-control" value="<?php echo $calon['password'] ?>" id="password" placeholder="Masukkan password" name="password" >
    </div>

    <!-- /.card-body -->
    <!-- /.card-body -->

    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>

  </div>
</form>