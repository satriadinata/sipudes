<form action="<?php echo site_url('sk_kelahiran/update') ?>" method='post'>
  <input type="hidden" name="id" value="<?php echo $calon['id'] ?>" >
  <div class="form-group">
    <label for="nomor_surat">Nomor Surat</label>
    <input type="text" class="form-control" value="<?php echo $calon['nomor_surat'] ?>" id="nomor_surat" placeholder="Masukkan Nomor Surat" name="nomor_surat" >
  </div>

  <div class="form-group">
    <label for="nama">Nama</label>
    <input type="text" class="form-control" value="<?php echo $calon['nama'] ?>" id="nama" placeholder="Masukkan Nama" name="nama" >
  </div>

  <div class="form-group">
    <label for="tempat_lahir">Tempat Lahir</label>
    <input type="text" class="form-control" value="<?php echo $calon['tempat_lahir'] ?>" id="tempat_lahir" placeholder="Masukkan Tempat Lahir" name="tempat_lahir" >
  </div>

  <div class="form-group">
    <label for="tgl_lahir">Tanggal Lahir</label>
    <input type="date" class="form-control" value="<?php echo $calon['tgl_lahir'] ?>" id="tgl_lahir" placeholder="Masukkan Tanggal Lahir" name="tgl_lahir" >
  </div>

  <div class="form-group">
      <label for="jenis_kelamin">Jenis Kelamin</label>
      <select class="form-control" name="jenis_kelamin">
        <option <?php echo $calon['jenis_kelamin']=='L' ? 'selected' :'' ?> value="L" >Laki - laki</option>
        <option <?php echo $calon['jenis_kelamin']=='P' ? 'selected' :'' ?> value="P" >Perempuan</option>
      </select>
    </div>

  <div class="form-group">
    <label for="ayah_kandung">Ayah Kandung</label>
    <input type="text" class="form-control" value="<?php echo $calon['ayah_kandung'] ?>" id="ayah_kandung" placeholder="Masukkan Ayah Kandung" name="ayah_kandung" >
  </div>

  <div class="form-group">
    <label for="ibu_kandung">Ibu Kandung</label>
    <input type="text" class="form-control" value="<?php echo $calon['ibu_kandung'] ?>" id="ibu_kandung" placeholder="Masukkan Ibu Kandung" name="ibu_kandung" >
  </div>

  <div class="form-group">
    <label for="anak_ke">Anak Ke</label>
    <input type="number" class="form-control" value="<?php echo $calon['anak_ke'] ?>" id="anak_ke" placeholder="Masukkan Anak Ke" name="anak_ke" >
  </div>
  <!-- /.card-body -->

  <div class="card-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</form>