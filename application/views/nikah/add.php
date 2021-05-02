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
            <h3 class="card-title">Tambah Surat Nikah</h3>
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

              <h6>Data Mempelai 1</h6>
              <hr>

              <div class="form-group">
                <label for="id_mempelai1">Mempelai 1</label>
                <select class="form-control" name="id_mempelai1">
                  <?php foreach ($warga as $value):?>
                  <option value="<?php echo $value->id_warga ?>" ><?php echo $value->nama_warga; ?></option>
                <?php endforeach ?>
                </select>
              </div>


              <br>
              <br>
              <h6>Data Mempelai 2</h6>
              <hr>

              <div class="form-group">
                <label for="nama_mempelai2">Nama Mempelai 2</label>
                <input type="text" class="form-control" value="<?php echo $this->session->flashdata('input') ? $this->session->flashdata('input')['nama_mempelai2'] :'' ?>" id="nama_mempelai2" placeholder="Masukkan Nama Mempelai 2" name="nama_mempelai2" >
              </div>

              <div class="form-group">
                <label for="tempat_lahir">Tempat Lahir</label>
                <input type="text" value="<?php echo $this->session->flashdata('input') ? $this->session->flashdata('input')['tempat_lahir'] :'' ?>" class="form-control" name="tempat_lahir" id="tempat_lahir" placeholder="Masukkan Tempat Lahir">
              </div>

              <div class="form-group">
                <label for="tanggal_lahir">Tanggal Lahir</label>
                <input type="date" value="<?php echo $this->session->flashdata('input') ? $this->session->flashdata('input')['tanggal_lahir'] :'' ?>" class="form-control" id="tanggal_lahir" name="tanggal_lahir" placeholder="Masukkan Tanggal Lahir">
              </div>

              <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <select class="form-control" name="jenis_kelamin">
                  <option <?php echo $this->session->flashdata('input') && $this->session->flashdata('input')['jenis_kelamin']=='L' ? 'selected' :'' ?> value="L" >Laki - laki</option>
                  <option <?php echo $this->session->flashdata('input') && $this->session->flashdata('input')['jenis_kelamin']=='P' ? 'selected' :'' ?>value="P" >Perempuan</option>
                </select>
              </div>

              <div class="form-group">
                <label for="status_perkawinan">Status Perkawinan</label>
                <textarea name="status_perkawinan" value="" class="form-control" rows="3" placeholder="Masukkan Status Perkawinan"><?php echo $this->session->flashdata('input') ? $this->session->flashdata('input')['status_perkawinan'] :null ?></textarea>
              </div>

              <div class="form-group">
                <label for="negara">Kewarganegaraan</label>
                <input type="text" class="form-control" value="<?php echo $this->session->flashdata('input') ? $this->session->flashdata('input')['negara'] :'' ?>" name="negara" id="negara" placeholder="Masukkan Kewarganegaraan">
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
                <label for="pekerjaan">Pekerjaan</label>
                <input type="text" class="form-control" value="<?php echo $this->session->flashdata('input') ? $this->session->flashdata('input')['pekerjaan'] :'' ?>" name="pekerjaan" id="pekerjaan" placeholder="Masukkan Pekerjaan">
              </div>

              <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea name="alamat" value="" class="form-control" rows="3" placeholder="Masukkan alamat"><?php echo $this->session->flashdata('input') ? $this->session->flashdata('input')['alamat'] :null ?></textarea>
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