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
            <h3 class="card-title" style="line-height: 40px;" >Data Surat Keterangan Kelahiran</h3>

            <div class="card-tools" style="" >
              <a href="<?php echo site_url('sk_domisili/add') ?>" class="btn btn-primary">Tambah Data</a>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive">
            <table id="tableDaftar" class="table table-hover text-nowrap">
              <thead>
                <th>Nomor Surat</th>
                <th>Nama</th>
                <th>Ayah Kandung</th>
                <th>Ibu Kandung</th>
                <th>Tanggal Lahir</th>
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
<!-- modal -->
<div class="modal fade" id="modal-edit">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modalDataEdit">
        <!-- <p>One fine body&hellip;</p> -->
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-det">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Detail</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modaldet">
        <!-- <p>One fine body&hellip;</p> -->
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<script>
  var tabel=null;
  $(document).ready(function() {
    tabel=$('#tableDaftar').DataTable({
      "ajax": {
        url : "<?php echo site_url("sk_kelahiran/getAll")?>",
        type : 'GET'
      }
    });
  });
  function edit(id){
    let data={
      id:id,
    }
    $.ajax({
      url: "<?php echo site_url('sk_kelahiran/edit') ?>",
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
        url: "<?php echo site_url('sk_kelahiran/hapus') ?>",
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