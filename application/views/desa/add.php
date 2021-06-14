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
            <h3 class="card-title">Tambah Akun</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form method="post" action="<?php echo site_url('desa/post') ?>" >
            <div class="card-body">
              <?php if ($this->session->flashdata('error')!=null):?>
                <div class="alert alert-danger">
                  <?php print_r($this->session->flashdata('error')); ?>
                </div>
              <?php endif; ?>

              <div class="form-group">
                <label for="kode_desa">Kode Desa</label>
                <input type="text" class="form-control" value="<?php echo $this->session->flashdata('input') ? $this->session->flashdata('input')['kode_desa'] :'' ?>" id="kode_desa" placeholder="Masukkan Kode Desa" name="kode_desa" >
              </div>

              <div class="form-group">
                <label for="nama_desa">Nama Desa</label>
                <input type="text" class="form-control" value="<?php echo $this->session->flashdata('input') ? $this->session->flashdata('input')['nama_desa'] :'' ?>" id="nama_desa" placeholder="Masukkan Nama Desa" name="nama_desa" >
              </div>

              <div class="form-group">
                <label for="kec_desa">Kecamatan Desa</label>
                <input type="text" class="form-control" value="<?php echo $this->session->flashdata('input') ? $this->session->flashdata('input')['kec_desa'] :'' ?>" id="kec_desa" placeholder="Masukkan Kecamatan Desa" name="kec_desa" >
              </div>

              <div class="form-group">
                <label for="kab_desa">Kabupaten Desa</label>
                <input type="text" class="form-control" value="<?php echo $this->session->flashdata('input') ? $this->session->flashdata('input')['kab_desa'] :'' ?>" id="kab_desa" placeholder="Masukkan Kabupaten Desa" name="kab_desa" >
              </div>

              <div class="form-group">
                <label for="prov_desa">Provinsi Desa</label>
                <input type="text" class="form-control" value="<?php echo $this->session->flashdata('input') ? $this->session->flashdata('input')['prov_desa'] :'' ?>" id="prov_desa" placeholder="Masukkan Provinsi Desa" name="prov_desa" >
              </div>

              <div class="form-group">
                <label for="kode_pos">Kode Pos Desa</label>
                <input type="text" class="form-control" value="<?php echo $this->session->flashdata('input') ? $this->session->flashdata('input')['kode_pos'] :'' ?>" id="kode_pos" placeholder="Masukkan Kode Pos Desa" name="kode_pos" >
              </div>
              

              <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" value="<?php echo $this->session->flashdata('input') ? $this->session->flashdata('input')['email'] :'' ?>" id="email" placeholder="Masukkan Email" name="email" >
              </div>

              <div class="form-group">
                <label for="password">Password</label>
                <input type="text" class="form-control" value="<?php echo $this->session->flashdata('input') ? $this->session->flashdata('input')['password'] :'' ?>" id="password" placeholder="Masukkan password" name="password" >
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
    function rw(){
      var ehe="<div class='form-group'><label for='rw'>RW</label><input type='text' class='form-control' value='<?php echo $this->session->flashdata('input') ? $this->session->flashdata('input')['rw'] :'' ?>' id='rw' placeholder='Masukkan RT/RW Berapa (3 digit)' name='rw' ></div>";
      $('#ch').html(ehe);
    }
    function rt(){
      var ehe="<div class='form-group'><label for='rw'>RW</label><input type='text' class='form-control' value='<?php echo $this->session->flashdata('input') ? $this->session->flashdata('input')['rw'] :'' ?>' id='rw' placeholder='Masukkan RW Berapa (3 digit)' name='rw' ></div>"+"<div class='form-group'><label for='rt'>RT</label><input type='text' class='form-control' value='<?php echo $this->session->flashdata('input') ? $this->session->flashdata('input')['rt'] :'' ?>' id='rt' placeholder='Masukkan RT Berapa (3 digit)' name='rt' ></div>";
      $('#ch').html(ehe);
    }
    function dt(id){
      $.ajax({
      url: "<?php echo site_url('sk_domisili/dt') ?>",
      type:'post',
      data:{id:id},
      success: function(result){
        $("#res").html(result);
      }
    });
    }
  </script>
  <!-- /.content -->
  <?php $this->load->view('layouts/footer.php') ?>