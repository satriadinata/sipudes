<form method="post" action="<?php echo site_url('KartuK/update') ?>" >
  <input type="hidden" name="id_keluarga" value="<?php echo $calon['id_keluarga'] ?>">
  <div class="card-body">
    <div class="form-group">
      <label for="nomor_keluarga">No. KK</label>
      <input type="text" class="form-control" value="<?php echo $calon['nomor_keluarga']?>" id="nomor_keluarga" placeholder="Masukkan No. KK" name="nomor_keluarga" >
    </div>

    <div class="form-group">
      <label for="id_kepala_keluarga">Kepala Keluarga</label>
      <select class="form-control" name="id_kepala_keluarga">
        <?php foreach ($warga as $value) :?>
          <option <?php echo $calon['id_kepala_keluarga']==$value->id_warga ? 'selected' :'' ?> value="<?php echo $value->id_warga ?>" ><?php echo $value->nama_warga; ?></option>
        <?php endforeach ?>
      </select>
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

    <div id="target" class="form-group">
      <?php $last=0 ?>
      <label for="anggota">Aggota Keluarga</label>
      <?php foreach ($anggota as $key => $value) : $last+=1 ?>
        <select id='sel<?php echo $key+1 ?>' style='margin-bottom:10px;' name='ang<?php echo $key+1 ?>' class='form-control' >
          <?php foreach ($warga as $v):?>
            <option <?php echo $value->id_warga==$v->id_warga ? 'selected' :'' ?> value='<?php echo $v->id_warga ?>'><?php echo $v->nama_warga.' '.$v->nik_warga; ?></option>
          <?php endforeach ?>
        </select>
      <?php endforeach ?>

    </div>
    <div style="margin-top: 20px;margin-bottom: 20px;" >
      <a onclick="tambahAnggota()" class="btn btn-primary">Tambah Anggota</a>
      <a onclick="kurangAnggota()" class="btn btn-danger">Kurang Anggota</a>
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </div>
</form>
<script>
  id=<?php echo $last ?>;
  function tambahAnggota(){
    id+=1;
    var eleme="<select id='sel"+id+"' style='margin-bottom:10px;' name='ang"+id+"' class='form-control' ><?php foreach ($warga as $value):?><option value='<?php echo $value->id_warga ?>''><?php echo $value->nama_warga.' '.$value->nik_warga; ?></option><?php endforeach ?></select>";
    $("#target").append(eleme);
  }
  function kurangAnggota(){
    $('#sel'+id).remove();
    id--;
  }
</script>