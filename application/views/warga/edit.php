<form action="<?php echo site_url('warga/update') ?>" method='post'>
  <input type="hidden" name="id_warga" value="<?php echo $calon['id_warga'] ?>" >
  <div class="card-body">
    <?php if ($this->session->flashdata('error')!=null):?>
      <div class="alert alert-danger">
        <?php print_r($this->session->flashdata('error')); ?>
      </div>
    <?php endif; ?>
    <div class="form-group">
      <label for="nik_warga">NIK</label>
      <input type="text" class="form-control" value="<?php echo $calon['nik_warga'] ?>" id="nik_warga" placeholder="Masukkan NIK" name="nik_warga" >
    </div>

    <div class="form-group">
      <label for="nama_warga">Nama Lengkap</label>
      <input type="text" value="<?php echo $calon['nama_warga'] ?>" class="form-control" name="nama_warga" id="nama_warga" placeholder="Masukkan Nama Lengkap">
    </div>

    <div class="form-group">
      <label for="tempat_lahir_warga">Tempat Lahir</label>
      <input type="text" value="<?php echo $calon['tempat_lahir_warga'] ?>" class="form-control" id="tempat_lahir_warga" name="tempat_lahir_warga" placeholder="Masukkan Tempat Lahir">
    </div>

    <div class="form-group">
      <label for="tanggal_lahir_warga">Tanggal Lahir</label>
      <input type="date" value="<?php echo $calon['tanggal_lahir_warga'] ?>" class="form-control" id="tanggal_lahir_warga" name="tanggal_lahir_warga" placeholder="Masukkan Tanggal Lahir">
    </div>

    <div class="form-group">
      <label for="jenis_kelamin_warga">Jenis Kelamin</label>
      <select class="form-control" name="jenis_kelamin_warga">
        <option <?php echo $calon['jenis_kelamin_warga']=='L' ? 'selected' :'' ?> value="L" >Laki - laki</option>
        <option <?php echo $calon['jenis_kelamin_warga']=='P' ? 'selected' :'' ?> value="P" >Perempuan</option>
      </select>
    </div>

    <div class="form-group">
      <label for="alamat_ktp_warga">Alamat KTP</label>
      <textarea name="alamat_ktp_warga" value="" class="form-control" rows="3" placeholder="Masukkan alamat KTP"><?php echo $calon['alamat_ktp_warga'] ?></textarea>
    </div>

    <div class="form-group">
      <label for="alamat_warga">Alamat Warga</label>
      <textarea name="alamat_warga" value="" class="form-control" rows="3" placeholder="Masukkan alamat Warga"><?php echo $calon['alamat_warga'] ?></textarea>
    </div>

    <div class="form-group">
      <label for="desa_kelurahan_warga">Desa Kelurahan</label>
      <input type="text" class="form-control" name="desa_kelurahan_warga" value="<?php echo $calon['desa_kelurahan_warga'] ?>" id="desa_kelurahan_warga" placeholder="Masukkan Desa Kelurahan">
    </div>

    <div class="form-group">
      <label for="kecamatan_warga">Kecamatan</label>
      <input type="text" name="kecamatan_warga" value="<?php echo $calon['kecamatan_warga'] ?>" class="form-control" id="kecamatan_warga" placeholder="Masukkan Kecamatan">
    </div>

    <div class="form-group">
      <label for="kabupaten_kota_warga">Kabupaten/Kota</label>
      <input type="text" name="kabupaten_kota_warga" value="<?php echo $calon['kabupaten_kota_warga'] ?>" class="form-control" id="kabupaten_kota_warga" placeholder="Masukkan Kabupaten/Kota">
    </div>

    <div class="form-group">
      <label for="provinsi_warga">Provinsi</label>
      <input type="text" value="<?php echo $calon['provinsi_warga'] ?>" name="provinsi_warga" class="form-control" id="provinsi_warga" placeholder="Masukkan Provinsi">
    </div>

    <div class="form-group">
      <label for="negara_warga">Negara</label>
      <input type="text" value="<?php echo $calon['negara_warga'] ?>" name="negara_warga" class="form-control" id="negara_warga" placeholder="Masukkan Negara">
    </div>

    <div class="form-group">
      <label for="rt_warga">RT</label>
      <input type="number" value="<?php echo $calon['rt_warga'] ?>" name="rt_warga" class="form-control" id="rt_warga" placeholder="Masukkan RT (Harus 3 digit) ">
    </div>

    <div class="form-group">
      <label for="rw_warga">RW</label>
      <input type="number" value="<?php echo $calon['rw_warga'] ?>" name="rw_warga" class="form-control" id="rw_warga" placeholder="Masukkan RW (Harus 3 digit)">
    </div>

    <div class="form-group">
      <label for="agama_warga">Agama</label>
      <select id="agama_warga" class="form-control" name="agama_warga">
        <option <?php echo $calon['agama_warga']=='Islam' ? 'selected' :'' ?> value="Islam" >Islam</option>
        <option <?php echo $calon['agama_warga']=='Kristen' ? 'selected' :'' ?> value="Kristen" >Kristen</option>
        <option <?php echo $calon['agama_warga']=='Katholik' ? 'selected' :'' ?> value="Katholik" >Katholik</option>
        <option <?php echo $calon['agama_warga']=='Hindu' ? 'selected' :'' ?> value="Hindu" >Hindu</option>
        <option <?php echo $calon['agama_warga']=='Budha' ? 'selected' :'' ?> value="Budha" >Budha</option>
        <option <?php echo $calon['agama_warga']=='Konghucu' ? 'selected' :'' ?> value="Konghucu" >Konghucu</option>
      </select>
    </div>

    <div class="form-group">
      <label for="pendidikan_terakhir_warga">Pendidikan Terakhir</label>
      <input type="text" value="<?php echo $calon['pendidikan_terakhir_warga'] ?>" name="pendidikan_terakhir_warga" class="form-control" id="pendidikan_terakhir_warga" placeholder="Masukkan Pendidikan Terakhir">
    </div>

    <div class="form-group">
      <label for="pekerjaan_warga">Pekerjaan</label>
      <input type="text" class="form-control" value="<?php echo $calon['pekerjaan_warga'] ?>" id="pekerjaan_warga" placeholder="Masukkan Pekerjaan">
    </div>

    <div class="form-group">
      <label for="status_perkawinan_warga">Status Perkawinan</label>
      <select id="status_perkawinan_warga" class="form-control" name="status_perkawinan_warga">
        <option <?php echo $this->session->flashdata('input') && $this->session->flashdata('input')['status_perkawinan_warga']=='Kawin' ? 'selected' :'' ?> value="Kawin" >Kawin</option>
        <option <?php echo $this->session->flashdata('input') && $this->session->flashdata('input')['status_perkawinan_warga']=='Tidak Kawin' ? 'selected' :'' ?> value="Tidak Kawin" >Tidak Kawin</option>
      </select>
    </div>

    <div class="form-group">
      <label for="status_warga">Status Warga</label>
      <select id="status_warga" class="form-control" name="status_warga">
        <option <?php echo $calon['status_warga']=='Tetap' ? 'selected' :'' ?> value="Tetap" >Tetap</option>
        <option <?php echo $calon['status_warga']=='Kontrak' ? 'selected' :'' ?> value="Kontrak" >Kontrak</option>
      </select>
    </div>
  </div>
  <!-- /.card-body -->

  <div class="card-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</form>