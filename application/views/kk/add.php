<?php $this->load->view('layouts/header.php') ?>
<!-- Main content -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />

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
            <h3 class="card-title">Tambah Kartu Keluarga</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form method="post" action="<?php echo site_url('KartuK/post') ?>" >
            <div class="card-body">
              <?php if ($this->session->flashdata('error')!=null):?>
                <div class="alert alert-danger">
                  <?php print_r($this->session->flashdata('error')); ?>
                </div>
              <?php endif; ?>

              <div class="form-group" >
                <label for="nomor_keluarga">No. KK</label>
                <input type="text" class="form-control" value="<?php echo $this->session->flashdata('input') ? $this->session->flashdata('input')['nomor_keluarga'] :'' ?>" id="nomor_keluarga" placeholder="Masukkan No. KK" name="nomor_keluarga" >
              </div>

              <div class="form-group">
                <label for="alamat_keluarga">Alamat Keluarga</label>
                <textarea name="alamat_keluarga" value="" class="form-control" rows="3" placeholder="Masukkan alamat Keluarga"><?php echo $this->session->flashdata('input') ? $this->session->flashdata('input')['alamat_keluarga'] :null ?></textarea>
              </div>

              <div class="form-group">
                <label for="desa_kelurahan_keluarga">Desa/Kelurahan</label>
                <input type="text" value="<?php echo $this->session->flashdata('input') ? $this->session->flashdata('input')['desa_kelurahan_keluarga'] :'' ?>" class="form-control" name="desa_kelurahan_keluarga" id="desa_kelurahan_keluarga" placeholder="Masukkan Desa/Kelurahan">
              </div>

              <div class="form-group">
                <label for="kecamatan_keluarga">Kecamatan</label>
                <input type="text" value="<?php echo $this->session->flashdata('input') ? $this->session->flashdata('input')['kecamatan_keluarga'] :'' ?>" class="form-control" id="kecamatan_keluarga" name="kecamatan_keluarga" placeholder="Masukkan Kecamatan">
              </div>

              <div class="form-group">
                <label for="kabupaten_kota_keluarga">Kabupaten</label>
                <input type="text" value="<?php echo $this->session->flashdata('input') ? $this->session->flashdata('input')['kabupaten_kota_keluarga'] :'' ?>" class="form-control" id="kabupaten_kota_keluarga" name="kabupaten_kota_keluarga" placeholder="Masukkan Kabupaten">
              </div>

              <div class="form-group">
                <label for="provinsi_keluarga">Provinsi</label>
                <input type="text" value="<?php echo $this->session->flashdata('input') ? $this->session->flashdata('input')['provinsi_keluarga'] :'' ?>" class="form-control" id="provinsi_keluarga" name="provinsi_keluarga" placeholder="Masukkan Provinsi">
              </div>

              <div class="form-group">
                <label for="negara_keluarga">Negara</label>
                <input type="text" value="<?php echo $this->session->flashdata('input') ? $this->session->flashdata('input')['negara_keluarga'] :'' ?>" class="form-control" id="negara_keluarga" name="negara_keluarga" placeholder="Masukkan Negara">
              </div>

              <div class="form-group">
                <label for="rt_keluarga">RT</label>
                <input type="number" value="<?php echo $this->session->flashdata('input') ? $this->session->flashdata('input')['rt_keluarga'] :'' ?>" name="rt_keluarga" class="form-control" id="rt_keluarga" placeholder="Masukkan RT (Harus 3 digit) ">
              </div>

              <div class="form-group">
                <label for="rw_keluarga">RW</label>
                <input type="number" value="<?php echo $this->session->flashdata('input') ? $this->session->flashdata('input')['rw_keluarga'] :'' ?>" name="rw_keluarga" class="form-control" id="rw_keluarga" placeholder="Masukkan RW (Harus 3 digit)">
              </div>

              <div class="form-group">
                <label for="kode_pos_keluarga">Kode Pos</label>
                <input type="number" value="<?php echo $this->session->flashdata('input') ? $this->session->flashdata('input')['kode_pos_keluarga'] :'' ?>" name="kode_pos_keluarga" class="form-control" id="kode_pos_keluarga" placeholder="Masukkan Kode Pos">
              </div>

              <div class="form-group">
                <label for="nik_kepala_keluarga">Kepala Keluarga</label>
                <select id="nik_kepala_keluarga" class="form-control" name="nik_kepala_keluarga">
                  <?php foreach ($warga as $value) :?>
                    <option <?php echo $this->session->flashdata('input') && $this->session->flashdata('input')['nik_kepala_keluarga']==$value->nik_warga ? 'selected' :'' ?> value="<?php echo $value->nik_warga ?>" ><?php echo $value->nik_warga.' '.$value->nama_warga; ?></option>
                  <?php endforeach ?>
                </select>
              </div>

              <div id="target" class="form-group">
                
              </div>
              <div style="margin-top: 20px;margin-bottom: 20px;" >
                <a onclick="tambahAnggota()" class="btn btn-primary">Tambah Anggota</a>
                <a onclick="kurangAnggota()" class="btn btn-warning">Reset</a>
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
  <script>
    $(document).ready(function () {
      $('select').selectize({
        sortField: 'text'
      });
    });
    id=1;
    function tambahAnggota(){
      var eleme="<div class='row'><div class='col-sm-6'><div class='form-group'><label>Anggota Keluarga</label><select id='sel"+id+"' style='margin-bottom:10px;' name='ang"+id+"' class='form-control' ><?php foreach ($warga as $value):?><option value='<?php echo $value->id_warga ?>''><?php echo $value->nama_warga.' '.$value->nik_warga; ?></option><?php endforeach ?></select></div></div><div class='col-sm-6'><div class='form-group'><label>Status Dalam Keluarga</label><select name='stat"+id+"' class='form-control'><option value='SUAMI' >SUAMI</option><option value='ISTRI' >ISTRI</option><option value='ANAK' >ANAK</option><option value='MENANTU' >MENANTU</option><option value='CUCU' >CUCU</option><option value='ORANGTUA' >ORANGTUA</option><option value='MERTUA' >MERTUA</option><option value='FAMILI LAIN' >FAMILI LAIN</option><option value='PEMBANTU' >PEMBANTU</option><option value='LAINNYA' >LAINNYA</option></select></div></div>";
      $("#target").append(eleme);
      id+=1;
      $('select').selectize({
        sortField: 'text'
      });
    }
    function kurangAnggota(){
      $('#target').html("<label for='anggota'>Aggota Keluarga</label>");
    }
  </script>
  <!-- /.content -->
  <?php $this->load->view('layouts/footer.php') ?>