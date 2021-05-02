<?php $this->load->view('layouts/header.php') ?>
<!-- Main content -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0"><?php echo $title; ?></h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <!-- <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Dashboard v1</li>
        </ol> -->
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Tambah Warga</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form method="post" action="<?php echo site_url('warga/post') ?>" >
            <div class="card-body">
              <?php if ($this->session->flashdata('error')!=null):?>
                <div class="alert alert-danger">
                  <?php print_r($this->session->flashdata('error')); ?>
                </div>
              <?php endif; ?>
              <div class="form-group">
                <label for="nik_warga">NIK</label>
                <input type="text" class="form-control" value="<?php echo $this->session->flashdata('input') ? $this->session->flashdata('input')['nik_warga'] :'' ?>" id="nik_warga" placeholder="Masukkan NIK" name="nik_warga" >
              </div>

              <div class="form-group">
                <label for="nama_warga">Nama Lengkap</label>
                <input type="text" value="<?php echo $this->session->flashdata('input') ? $this->session->flashdata('input')['nama_warga'] :'' ?>" class="form-control" name="nama_warga" id="nama_warga" placeholder="Masukkan Nama Lengkap">
              </div>

              <div class="form-group">
                <label for="tempat_lahir_warga">Tempat Lahir</label>
                <input type="text" value="<?php echo $this->session->flashdata('input') ? $this->session->flashdata('input')['tempat_lahir_warga'] :'' ?>" class="form-control" id="tempat_lahir_warga" name="tempat_lahir_warga" placeholder="Masukkan Tempat Lahir">
              </div>

              <div class="form-group">
                <label for="tanggal_lahir_warga">Tanggal Lahir</label>
                <input type="date" value="<?php echo $this->session->flashdata('input') ? $this->session->flashdata('input')['tanggal_lahir_warga'] :'' ?>" class="form-control" id="tanggal_lahir_warga" name="tanggal_lahir_warga" placeholder="Masukkan Tanggal Lahir">
              </div>

              <div class="form-group">
                <label for="jenis_kelamin_warga">Jenis Kelamin</label>
                <select class="form-control" name="jenis_kelamin_warga">
                  <option <?php echo $this->session->flashdata('input') && $this->session->flashdata('input')['jenis_kelamin_warga']=='L' ? 'selected' :'' ?> value="L" >Laki - laki</option>
                  <option <?php echo $this->session->flashdata('input') && $this->session->flashdata('input')['jenis_kelamin_warga']=='P' ? 'selected' :'' ?> value="P" >Perempuan</option>
                </select>
              </div>

              <div class="form-group">
                <label for="alamat_ktp_warga">Alamat KTP</label>
                <textarea name="alamat_ktp_warga" value="" class="form-control" rows="3" placeholder="Masukkan alamat KTP"><?php echo $this->session->flashdata('input') ? $this->session->flashdata('input')['alamat_ktp_warga'] :null ?></textarea>
              </div>

              <div class="form-group">
                <label for="alamat_warga">Alamat Warga</label>
                <textarea name="alamat_warga" value="" class="form-control" rows="3" placeholder="Masukkan alamat Warga"><?php echo $this->session->flashdata('input') ? $this->session->flashdata('input')['alamat_warga'] :null ?></textarea>
              </div>

              <div class="form-group">
                <label for="desa_kelurahan_warga">Desa Kelurahan</label>
                <input type="text" class="form-control" name="desa_kelurahan_warga" value="<?php echo $this->session->flashdata('input') ? $this->session->flashdata('input')['desa_kelurahan_warga'] :'' ?>" id="desa_kelurahan_warga" placeholder="Masukkan Desa Kelurahan">
              </div>

              <div class="form-group">
                <label for="kecamatan_warga">Kecamatan</label>
                <input type="text" name="kecamatan_warga" value="<?php echo $this->session->flashdata('input') ? $this->session->flashdata('input')['kecamatan_warga'] :'' ?>" class="form-control" id="kecamatan_warga" placeholder="Masukkan Kecamatan">
              </div>

              <div class="form-group">
                <label for="kabupaten_kota_warga">Kabupaten/Kota</label>
                <input type="text" name="kabupaten_kota_warga" value="<?php echo $this->session->flashdata('input') ? $this->session->flashdata('input')['kabupaten_kota_warga'] :'' ?>" class="form-control" id="kabupaten_kota_warga" placeholder="Masukkan Kabupaten/Kota">
              </div>

              <div class="form-group">
                <label for="provinsi_warga">Provinsi</label>
                <input type="text" value="<?php echo $this->session->flashdata('input') ? $this->session->flashdata('input')['provinsi_warga'] :'' ?>" name="provinsi_warga" class="form-control" id="provinsi_warga" placeholder="Masukkan Provinsi">
              </div>

              <div class="form-group">
                <label for="negara_warga">Negara</label>
                <input type="text" value="<?php echo $this->session->flashdata('input') ? $this->session->flashdata('input')['negara_warga'] :'' ?>" name="negara_warga" class="form-control" id="negara_warga" placeholder="Masukkan Negara">
              </div>

              <div class="form-group">
                <label for="rt_warga">RT</label>
                <input type="number" value="<?php echo $this->session->flashdata('input') ? $this->session->flashdata('input')['rt_warga'] :'' ?>" name="rt_warga" class="form-control" id="rt_warga" placeholder="Masukkan RT (Harus 3 digit) ">
              </div>

              <div class="form-group">
                <label for="rw_warga">RW</label>
                <input type="number" value="<?php echo $this->session->flashdata('input') ? $this->session->flashdata('input')['rw_warga'] :'' ?>" name="rw_warga" class="form-control" id="rw_warga" placeholder="Masukkan RW (Harus 3 digit)">
              </div>

              <div class="form-group">
                <label for="agama_warga">Agama</label>
                <select id="agama_warga" class="form-control" name="agama_warga">
                  <option <?php echo $this->session->flashdata('input') && $this->session->flashdata('input')['agama_warga']=='Islam' ? 'selected' :'' ?> value="Islam" >Islam</option>
                  <option <?php echo $this->session->flashdata('input') && $this->session->flashdata('input')['agama_warga']=='Kristen' ? 'selected' :'' ?> value="Kristen" >Kristen</option>
                  <option <?php echo $this->session->flashdata('input') && $this->session->flashdata('input')['agama_warga']=='Katholik' ? 'selected' :'' ?> value="Katholik" >Katholik</option>
                  <option <?php echo $this->session->flashdata('input') && $this->session->flashdata('input')['agama_warga']=='Hindu' ? 'selected' :'' ?> value="Hindu" >Hindu</option>
                  <option <?php echo $this->session->flashdata('input') && $this->session->flashdata('input')['agama_warga']=='Budha' ? 'selected' :'' ?> value="Budha" >Budha</option>
                  <option <?php echo $this->session->flashdata('input') && $this->session->flashdata('input')['agama_warga']=='Konghucu' ? 'selected' :'' ?> value="Konghucu" >Konghucu</option>
                </select>
              </div>

              <div class="form-group">
                <label for="pendidikan_terakhir_warga">Pendidikan Terakhir</label>
                <input type="text" value="<?php echo $this->session->flashdata('input') ? $this->session->flashdata('input')['pendidikan_terakhir_warga'] :'' ?>" name="pendidikan_terakhir_warga" class="form-control" id="pendidikan_terakhir_warga" placeholder="Masukkan Pendidikan Terakhir">
              </div>

              <div class="form-group">
                <label for="pekerjaan_warga">Pekerjaan</label>
                <input type="text" class="form-control" value="<?php echo $this->session->flashdata('input') ? $this->session->flashdata('input')['pekerjaan_warga'] :'' ?>" name="pekerjaan_warga" id="pekerjaan_warga" placeholder="Masukkan Pekerjaan">
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
                  <option <?php echo $this->session->flashdata('input') && $this->session->flashdata('input')['status_warga']=='Tetap' ? 'selected' :'' ?> value="Tetap" >Tetap</option>
                  <option <?php echo $this->session->flashdata('input') && $this->session->flashdata('input')['status_warga']=='Kontrak' ? 'selected' :'' ?> value="Kontrak" >Kontrak</option>
                </select>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
  <?php $this->load->view('layouts/footer.php') ?>