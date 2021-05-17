<form action="<?php echo site_url('akun_operator/update') ?>" method='post'>
  <input type="hidden" name="id_user" value="<?php echo $calon['id_user'] ?>" >
  <div class="card-body">
    <?php if ($this->session->flashdata('error')!=null):?>
      <div class="alert alert-danger">
        <?php print_r($this->session->flashdata('error')); ?>
      </div>
    <?php endif; ?>

    <div class="form-group">
      <label for="email">NIK - Warga</label>
      <select class="form-control" name="email">
        <?php foreach ($warga as $key => $value) :?>
          <option <?php echo $calon['email']==$value->nik_warga ? 'selected' :'' ?> value="<?php echo $value->nik_warga ?>" ><?php echo $value->nik_warga.' '.$value->nama_warga; ?></option>
        <?php endforeach ?>
      </select>
    </div>

    <div class="form-group">
      <label for="password">Kecamatan</label>
      <input type="text" value="<?php echo $calon['password'] ?>" class="form-control" name="password" id="password" placeholder="Masukkan Kecamatan">
    </div>

  </div>
  <!-- /.card-body -->

  <div class="card-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</form>
<script>
  $(document).ready(function () {
    $('select').selectize({
      sortField: 'text'
    });
  });
</script>