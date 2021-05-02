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
            <h3 class="card-title">Tambah Surat Keterangan Domisili</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form method="post" action="<?php echo site_url('sk_domisili/post') ?>" >
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
                    <option onclick="dt(<?php echo $value->id_warga; ?>)" value="<?php echo $value->id_warga ?>" ><?php echo $value->nik_warga.'-'.$value->nama_warga; ?></option>
                  <?php endforeach ?>
                </select>
              </div>


              <br>
              <br>
              <h6>Data Detail</h6>
              <hr>
              <div id="res" class="card">
                
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