<?php $this->load->view('layouts/header.php') ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
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
            <h3 class="card-title">Tambah Surat Keterangan Kelahiran</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form method="post" action="<?php echo site_url('sk_kelahiran/post') ?>" >
            <div class="card-body">
              <?php if ($this->session->flashdata('error')!=null):?>
                <div class="alert alert-danger">
                  <?php print_r($this->session->flashdata('error')); ?>
                </div>
              <?php endif; ?>
              <div class="form-group">
                <label for="nomor_surat">Nomor Surat</label>
                <input type="text" class="form-control" value="<?php echo $this->session->flashdata('input') ? $this->session->flashdata('input')['nomor_surat'] :'' ?>" id="nomor_surat" placeholder="Masukkan Nomor Surat" name="nomor_surat" >
              </div>

              <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" value="<?php echo $this->session->flashdata('input') ? $this->session->flashdata('input')['nama'] :'' ?>" id="nama" placeholder="Masukkan Nama" name="nama" >
              </div>

              <div class="form-group">
                <label for="tempat_lahir">Tempat Lahir</label>
                <input type="text" class="form-control" value="<?php echo $this->session->flashdata('input') ? $this->session->flashdata('input')['tempat_lahir'] :'' ?>" id="tempat_lahir" placeholder="Masukkan Tempat Lahir" name="tempat_lahir" >
              </div>

              <div class="form-group">
                <label for="hari">Hari</label>
                <input type="text" class="form-control" value="<?php echo $this->session->flashdata('input') ? $this->session->flashdata('input')['hari'] :'' ?>" id="hari" placeholder="Masukkan Hari Lahir" name="hari" >
              </div>

              <div class="form-group">
                <label for="tgl_lahir">Tanggal Lahir</label>
                <input type="date" class="form-control" value="<?php echo $this->session->flashdata('input') ? $this->session->flashdata('input')['tgl_lahir'] :'' ?>" id="tgl_lahir" placeholder="Masukkan Tanggal Lahir" name="tgl_lahir" >
              </div>

              <div class="form-group">
                <label for="pukul">Waktu Lahir</label>
                <input type="time" class="form-control" value="<?php echo $this->session->flashdata('input') ? $this->session->flashdata('input')['pukul'] :'' ?>" id="pukul" placeholder="Masukkan Waktu Lahir" name="pukul" >
              </div>

              <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <select class="form-control" name="jenis_kelamin">
                  <option <?php echo $this->session->flashdata('input') && $this->session->flashdata('input')['jenis_kelamin']=='L' ? 'selected' :'' ?> value="L" >Laki - laki</option>
                  <option <?php echo $this->session->flashdata('input') && $this->session->flashdata('input')['jenis_kelamin']=='P' ? 'selected' :'' ?> value="P" >Perempuan</option>
                </select>
              </div>

               <div class="form-group">
                <label for="ayah_kandung">Ayah Kandung</label>
                <select class="form-control" name="ayah_kandung">
                  <?php foreach ($warga as $value):?>
                    <option value="<?php echo $value->id_warga ?>" ><?php echo $value->nik_warga.'-'.$value->nama_warga; ?></option>
                  <?php endforeach ?>
                </select>
              </div>

               <div class="form-group">
                <label for="ibu_kandung">Ibu Kandung</label>
                <select class="form-control" name="ibu_kandung">
                  <?php foreach ($warga as $value):?>
                    <option value="<?php echo $value->id_warga ?>" ><?php echo $value->nik_warga.'-'.$value->nama_warga; ?></option>
                  <?php endforeach ?>
                </select>
              </div>

              <div class="form-group">
                <label for="pelapor">Pelapor</label>
                <select class="form-control" name="pelapor">
                  <?php foreach ($warga as $value):?>
                    <option value="<?php echo $value->id_warga ?>" ><?php echo $value->nik_warga.'-'.$value->nama_warga; ?></option>
                  <?php endforeach ?>
                </select>
              </div>

               <div class="form-group">
                <label for="hubungan_pelapor">Hubungan Pelapor dengan Bayi</label>
                <input type="text" class="form-control" value="<?php echo $this->session->flashdata('input') ? $this->session->flashdata('input')['hubungan_pelapor'] :'' ?>" id="hubungan_pelapor" placeholder="Masukkan Hubungan Pelapor dengan Bayi" name="hubungan_pelapor" >
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
  </script>
  <!-- /.content -->
  <?php $this->load->view('layouts/footer.php') ?>