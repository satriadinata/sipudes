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
          <form method="post" action="<?php echo site_url('akun/post') ?>" >
            <div class="card-body">
              <?php if ($this->session->flashdata('error')!=null):?>
                <div class="alert alert-danger">
                  <?php print_r($this->session->flashdata('error')); ?>
                </div>
              <?php endif; ?>

              <div class="form-group">
                <label for="id_warga">NIK - Nama Warga</label>
                <select class="form-control" name="id_warga">
                  <?php foreach ($warga as $value):?>
                    <option onclick="dt(<?php echo $value->id_warga; ?>)" value="<?php echo $value->id_warga ?>" ><?php echo $value->nik_warga.'-'.$value->nama_warga; ?></option>
                  <?php endforeach ?>
                </select>
              </div>


              <div class="form-group">
                <label for="user_role">Akun RT/RW</label>
                <select class="form-control" name="user_role">
                  <option onclick="rw()" <?php echo $this->session->flashdata('input') && $this->session->flashdata('input')['user_role']==2 ? 'selected' :'' ?> value="2" >RW</option>
                  <option onclick="rt()" <?php echo $this->session->flashdata('input') && $this->session->flashdata('input')['user_role']==1 ? 'selected' :'' ?> value="1" >RT</option>
                </select>
              </div>

              <div id="ch">
                
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