<form action="<?php echo site_url('profil/update') ?>" method='post'>
  <input type="hidden" name="id_profil_desa" value="<?php echo $calon['id_profil_desa'] ?>" >
  <div class="card-body">
    <?php if ($this->session->flashdata('error')!=null):?>
      <div class="alert alert-danger">
        <?php print_r($this->session->flashdata('error')); ?>
      </div>
    <?php endif; ?>
    <div class="form-group">
      <label for="nama_desa">Nama Desa</label>
      <input type="text" class="form-control" value="<?php echo $calon['nama_desa'] ?>" id="nama_desa" placeholder="Masukkan Nama Desa" name="nama_desa" >
    </div>

    <div class="form-group">
      <label for="kepala_desa">Kepala Desa</label>
      <select class="form-control" name="kepala_desa">
        <?php foreach ($warga as $key => $value) :?>
          <option <?php echo $calon['kepala_desa']==$value->id_warga ? 'selected' :'' ?> value="<?php echo $value->id_warga ?>" ><?php echo $value->nik_warga.' '.$value->nama_warga; ?></option>
        <?php endforeach ?>
      </select>
    </div>

    <div class="form-group">
      <label for="kec_desa">Kecamatan</label>
      <input type="text" value="<?php echo $calon['kec_desa'] ?>" class="form-control" name="kec_desa" id="kec_desa" placeholder="Masukkan Kecamatan">
    </div>

    <div class="form-group">
      <label for="kab_desa">Kabupaten</label>
      <input type="text" value="<?php echo $calon['kab_desa'] ?>" class="form-control" name="kab_desa" id="kab_desa" placeholder="Masukkan Kabupaten">
    </div>

    <div class="form-group">
      <label for="prov_desa">Provinsi</label>
      <input type="text" value="<?php echo $calon['prov_desa'] ?>" class="form-control" name="prov_desa" id="prov_desa" placeholder="Masukkan Provinsi">
    </div>

    <div class="form-group">
      <label for="kode_pos">Kode Pos</label>
      <input type="text" value="<?php echo $calon['kode_pos'] ?>" class="form-control" name="kode_pos" id="kode_pos" placeholder="Masukkan Kode Pos">
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