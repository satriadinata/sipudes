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
                <label for="tgl_lahir">Tanggal Lahir</label>
                <input type="date" class="form-control" value="<?php echo $this->session->flashdata('input') ? $this->session->flashdata('input')['tgl_lahir'] :'' ?>" id="tgl_lahir" placeholder="Masukkan Tanggal Lahir" name="tgl_lahir" >
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
                <input type="text" class="form-control" value="<?php echo $this->session->flashdata('input') ? $this->session->flashdata('input')['ayah_kandung'] :'' ?>" id="ayah_kandung" placeholder="Masukkan Ayah Kandung" name="ayah_kandung" >
              </div>

              <div class="form-group">
                <label for="ibu_kandung">Ibu Kandung</label>
                <input type="text" class="form-control" value="<?php echo $this->session->flashdata('input') ? $this->session->flashdata('input')['ibu_kandung'] :'' ?>" id="ibu_kandung" placeholder="Masukkan Ibu Kandung" name="ibu_kandung" >
              </div>

              <div class="form-group">
                <label for="anak_ke">Anak Ke</label>
                <input type="number" class="form-control" value="<?php echo $this->session->flashdata('input') ? $this->session->flashdata('input')['anak_ke'] :'' ?>" id="anak_ke" placeholder="Masukkan Anak ke" name="anak_ke" >
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