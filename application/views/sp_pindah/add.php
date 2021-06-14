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
            <h3 class="card-title">Tambah Surat Pengantar Pindah Antar Kabupaten atau Provinsi</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form method="post" action="<?php echo site_url('sp_pindah/post') ?>" >
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
                <label for="id_warga">NIK - Nama Warga</label>
                <select class="form-control" name="id_warga">
                  <?php foreach ($warga as $value):?>
                    <option value="<?php echo $value->id_warga ?>" ><?php echo $value->nik_warga.'-'.$value->nama_warga; ?></option>
                  <?php endforeach ?>
                </select>
              </div>

              <div class="form-group">
                <label for="alamat_tujuan">Alamat Tujuan</label>
               <textarea name="alamat_tujuan" class="form-control" id="alamat_tujuan"></textarea>
              </div>

              <div class="form-group">
                <label for="jmlh_org">Jumlah Orang yang Pindah</label>
                <input type="number" class="form-control" value="<?php echo $this->session->flashdata('input') ? $this->session->flashdata('input')['jmlh_org'] :'' ?>" id="jmlh_org" placeholder="Masukkan Jumlah Orang yang Pindah" name="jmlh_org" >
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