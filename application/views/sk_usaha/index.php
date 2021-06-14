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
        <div class="card">
          <div class="card-header" style="vertical-align: middle;">
            <h3 class="card-title" style="line-height: 40px;" >Data Surat Keterangan Usaha</h3>

            <div class="card-tools" style="" >
              <a href="<?php echo site_url('sk_usaha/add') ?>" class="btn btn-primary">Tambah Data</a>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive">
            <table id="tableDaftar" class="table table-hover text-nowrap">
              <thead>
                <th>Nomor Surat</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Alamat KTP</th>
                <th>Dibuat tanggal</th>
                <th>Actions</th>
              </thead>
            </table>
          </div>
          <div class="card-footer">

          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<script>
  var tabel=null;
  $(document).ready(function() {
    tabel=$('#tableDaftar').DataTable({
      "ajax": {
        url : "<?php echo site_url("sk_usaha/getAll")?>",
        type : 'GET'
      }
    });
  });
  function edit(id){
    let data={
      id:id,
    }
    $.ajax({
      url: "<?php echo site_url('warga/edit') ?>",
      type:'post',
      data:data,
      success: function(result){
        $("#modalDataEdit").html(result);
      }
    });
  };
  function det(id){
    let data={
      id:id,
    }
    $.ajax({
      url: "<?php echo site_url('warga/detail') ?>",
      type:'post',
      data:data,
      success: function(result){
        $("#modaldet").html(result);
      }
    });
  };
  function hapus(id){
    var confirm=window.confirm('Yakin?');
    if (confirm) {
      let data={
        id:id,
      };
      $.ajax({
        url: "<?php echo site_url('sk_usaha/hapus') ?>",
        type:'post',
        data:data,
        beforeSend:function(){
          $('#hps'+id).html('Processing <i class="fas fa-sync-alt fa-spin" ></i>');
        },
        success: function(result){
          tabel.ajax.reload()
        }
      });
    }
  }
</script>
<?php $this->load->view('layouts/footer.php') ?>