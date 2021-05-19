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
        <div class="card">

          <div class="card-header" style="vertical-align: middle;">
            <h3 class="card-title" style="line-height: 40px;" >Data Profil Desa</h3>

            <div class="card-tools" style="" >
              <a href="<?php echo site_url('KartuK/sync_kodepos') ?>" class="btn btn-primary">Sync Kode Pos ke KK</a>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive">
            <table id="tableDaftar" class="table table-hover text-nowrap">
              <thead>
                <th>Nama Desa</th>
                <th>Kepala Desa</th>
                <th>Kecamatan</th>
                <th>Kabupaten</th>
                <th>Provinsi</th>
                <th>Kode Pos</th>
                <th>Actions</th>
              </thead>
              <tbody>
                <tr>
                  <td><?php echo $profil['nama_desa']; ?></td>
                  <td><?php echo $kepala_desa!=null ? $kepala_desa['nama_warga']:'Belum di set'; ?></td>
                  <td><?php echo $profil['kec_desa']; ?></td>
                  <td><?php echo $profil['kab_desa']; ?></td>
                  <td><?php echo $profil['prov_desa']; ?></td>
                  <td><?php echo $profil['kode_pos']; ?></td>
                  <td>
                    <button data-toggle='modal' data-target='#modal-edit' class="btn btn-primary" onclick="edit(<?php echo $profil['id_profil_desa']; ?>)" >Edit</button>
                  </td>
                </tr>
              </tbody>
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

<script>
  function edit(id){
    let data={
      id:id,
    }
    $.ajax({
      url: "<?php echo site_url('profil/edit') ?>",
      type:'post',
      data:data,
      success: function(result){
        $("#modalDataEdit").html(result);

      }
    });
    $('select').selectize({
      sortField: 'text'
    });
  };
</script>
<?php $this->load->view('layouts/footer.php') ?>