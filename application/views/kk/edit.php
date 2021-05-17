<?php $this->load->view('layouts/header.php') ?>
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
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Tambah Kartu Keluarga</h3>
          </div>


          <form method="post" action="<?php echo site_url('KartuK/update') ?>" >
            <input type="hidden" name="id_keluarga" value="<?php echo $calon['id_keluarga'] ?>">
            <div class="card-body">
              <div class="form-group">
                <label for="nomor_keluarga">No. KK</label>
                <input type="text" class="form-control" value="<?php echo $calon['nomor_keluarga']?>" id="nomor_keluarga" placeholder="Masukkan No. KK" name="nomor_keluarga" >
              </div>

              <div class="form-group">
                <label for="alamat_keluarga">Alamat Keluarga</label>
                <textarea name="alamat_keluarga" value="" class="form-control" rows="3" placeholder="Masukkan alamat Keluarga"><?php echo $calon['alamat_keluarga']?></textarea>
              </div>

              <div class="form-group">
                <label for="desa_kelurahan_keluarga">Desa/Kelurahan</label>
                <input type="text" value="<?php echo $calon['desa_kelurahan_keluarga']?>" class="form-control" name="desa_kelurahan_keluarga" id="desa_kelurahan_keluarga" placeholder="Masukkan Desa/Kelurahan">
              </div>

              <div class="form-group">
                <label for="kecamatan_keluarga">Kecamatan</label>
                <input type="text" value="<?php echo $calon['kecamatan_keluarga'] ?>" class="form-control" id="kecamatan_keluarga" name="kecamatan_keluarga" placeholder="Masukkan Kecamatan">
              </div>

              <div class="form-group">
                <label for="kabupaten_kota_keluarga">Kabupaten</label>
                <input type="text" value="<?php echo $calon['kabupaten_kota_keluarga'] ?>" class="form-control" id="kabupaten_kota_keluarga" name="kabupaten_kota_keluarga" placeholder="Masukkan Kabupaten">
              </div>

              <div class="form-group">
                <label for="provinsi_keluarga">Provinsi</label>
                <input type="text" value="<?php echo $calon['provinsi_keluarga'] ?>" class="form-control" id="provinsi_keluarga" name="provinsi_keluarga" placeholder="Masukkan Provinsi">
              </div>

              <div class="form-group">
                <label for="negara_keluarga">Negara</label>
                <input type="text" value="<?php echo $calon['negara_keluarga']?>" class="form-control" id="negara_keluarga" name="negara_keluarga" placeholder="Masukkan Negara">
              </div>

              <div class="form-group">
                <label for="rt_keluarga">RT</label>
                <input type="number" value="<?php echo $calon['rt_keluarga'] ?>" name="rt_keluarga" class="form-control" id="rt_keluarga" placeholder="Masukkan RT (Harus 3 digit) ">
              </div>

              <div class="form-group">
                <label for="rw_keluarga">RW</label>
                <input type="number" value="<?php echo $calon['rw_keluarga']?>" name="rw_keluarga" class="form-control" id="rw_keluarga" placeholder="Masukkan RW (Harus 3 digit)">
              </div>

              <div class="form-group">
                <label for="kode_pos_keluarga">Kode Pos</label>
                <input type="number" value="<?php echo $calon['kode_pos_keluarga'] ?>" name="kode_pos_keluarga" class="form-control" id="kode_pos_keluarga" placeholder="Masukkan Kode Pos">
              </div>

              <div class="form-group">
                <label for="nik_kepala_keluarga">Kepala Keluarga</label>
                <select class="form-control" name="nik_kepala_keluarga">
                  <?php foreach ($warga as $value) :?>
                    <option <?php echo $calon['nik_kepala_keluarga']==$value->nik_warga ? 'selected' :'' ?> value="<?php echo $value->nik_warga ?>" ><?php echo $value->nik_warga.' '.$value->nama_warga; ?></option>
                  <?php endforeach ?>
                </select>
              </div>

              <div id="target" class="form-group">
                <?php $last=0 ?>
                <?php foreach ($anggota as $key => $value) : $last+=1 ?>
                  <?php if ($value->shdk!='KEPALA KELUARGA'): ?>
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- select -->
                      <div class="form-group">
                        <label>Anggota Keluarga</label>
                        <select id='sel<?php echo $key+1 ?>' style='margin-bottom:10px;' name='ang<?php echo $key+1 ?>' class='form-control' >
                          <?php foreach ($warga as $v):?>
                            <option <?php echo $value->id_warga==$v->id_warga ? 'selected' :'' ?> value='<?php echo $v->id_warga ?>'><?php echo $v->nama_warga.' '.$v->nik_warga; ?></option>
                          <?php endforeach ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Status Hubungan dalam Keluarga</label>
                        <select name="stat<?php echo $key+1 ?>" class="form-control">
                          <option <?php echo $value->shdk=='SUAMI' ? 'selected' :'' ?>  value="SUAMI" >SUAMI</option>
                          <option <?php echo $value->shdk=='ISTRI' ? 'selected' :'' ?> value="ISTRI" >ISTRI</option>
                          <option <?php echo $value->shdk=='ANAK' ? 'selected' :'' ?> value="ANAK" >ANAK</option>
                          <option <?php echo $value->shdk=='MENANTU' ? 'selected' :'' ?> value="MENANTU" >MENANTU</option>
                          <option <?php echo $value->shdk=='CUCU' ? 'selected' :'' ?> value="CUCU" >CUCU</option>
                          <option <?php echo $value->shdk=='ORANGTUA' ? 'selected' :'' ?> value="ORANGTUA" >ORANGTUA</option>
                          <option <?php echo $value->shdk=='MERTUA' ? 'selected' :'' ?> value="MERTUA" >MERTUA</option>
                          <option <?php echo $value->shdk=='FAMILI LAIN' ? 'selected' :'' ?> value="FAMILI LAIN" >FAMILI LAIN</option>
                          <option <?php echo $value->shdk=='PEMBANTU' ? 'selected' :'' ?> value="PEMBANTU" >PEMBANTU</option>
                          <option <?php echo $value->shdk=='LAINNYA' ? 'selected' :'' ?> value="LAINNYA" >LAINNYA</option>
                        </select>
                      </div>
                    </div>
                  </div>
                <?php endif ?>
                <?php endforeach ?>
              </div>
              <div style="margin-top: 20px;margin-bottom: 20px;" >
                <a onclick="tambahAnggota()" class="btn btn-primary">Tambah Anggota</a>
                <a onclick="location.reload()" class="btn btn-warning">Reset Anggota</a>
                <a onclick="kurangAnggota()" class="btn btn-danger">Hapus Semua</a>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</section>
<script>
  $(document).ready(function () {
    $('select').selectize({
      sortField: 'text'
    });
  });
  id=<?php echo $last ?>;
  function tambahAnggota(){
    id+=1;
    var eleme="<select id='sel"+id+"' style='margin-bottom:10px;' name='ang"+id+"' class='form-control' ><?php foreach ($warga as $value):?><option value='<?php echo $value->id_warga ?>''><?php echo $value->nama_warga.' '.$value->nik_warga; ?></option><?php endforeach ?></select>";
    var eleme2="<div class='row'><div class='col-sm-6'><div class='form-group'><label>Anggota Keluarga</label><select id='sel"+id+"' style='margin-bottom:10px;' name='ang"+id+"' class='form-control' ><?php foreach ($warga as $value):?><option value='<?php echo $value->id_warga ?>''><?php echo $value->nama_warga.' '.$value->nik_warga; ?></option><?php endforeach ?></select></div></div><div class='col-sm-6'><div class='form-group'><label>Status Dalam Keluarga</label><select name='stat"+id+"' class='form-control'><option value='SUAMI' >SUAMI</option><option value='ISTRI' >ISTRI</option><option value='ANAK' >ANAK</option><option value='MENANTU' >MENANTU</option><option value='CUCU' >CUCU</option><option value='ORANGTUA' >ORANGTUA</option><option value='MERTUA' >MERTUA</option><option value='FAMILI LAIN' >FAMILI LAIN</option><option value='Pembantu' >Pembantu</option><option value='Lainnya' >Lainnya</option></select></div></div>";
    $("#target").append(eleme2);
    $('select').selectize();
  }
  function kurangAnggota(){
    $('#target').html("");
  }
</script>
<?php $this->load->view('layouts/footer.php') ?>