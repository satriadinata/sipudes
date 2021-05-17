<div style="display: flex;justify-content: space-around;" class="card-body">
  <div>

    <div class="form-group">
      <label for="nomor_keluarga">No. KK</label>
      <h5><?php echo $calon['nomor_keluarga']?></h5>
    </div>

    <div class="form-group">
      <label for="alamat_keluarga">Alamat Keluarga</label>
      <h5><?php echo $calon['alamat_keluarga']?></h5>
    </div>

    <div class="form-group">
      <label for="desa_kelurahan_keluarga">Desa/Kelurahan</label>
      <h5><?php echo $calon['desa_kelurahan_keluarga']?></h5>
    </div>

    <div class="form-group">
      <label for="kecamatan_keluarga">Kecamatan</label>
      <h5><?php echo $calon['kecamatan_keluarga'] ?></h5>
    </div>

    <div class="form-group">
      <label for="kabupaten_kota_keluarga">Kabupaten</label>
      <h5><?php echo $calon['kabupaten_kota_keluarga'] ?></h5>
    </div>

    <div class="form-group">
      <label for="provinsi_keluarga">Provinsi</label>
      <h5><?php echo $calon['provinsi_keluarga'] ?></h5>
    </div>

    <div class="form-group">
      <label for="negara_keluarga">Negara</label>
      <h5><?php echo $calon['negara_keluarga']?></h5>
    </div>

    <div class="form-group">
      <label for="rt_keluarga">RT</label>
      <h5><?php echo $calon['rt_keluarga'] ?></h5>
    </div>

    <div class="form-group">
      <label for="rw_keluarga">RW</label>
      <h5><?php echo $calon['rw_keluarga']?></h5>
    </div>

    <div class="form-group">
      <label for="kode_pos_keluarga">Kode Pos</label>
      <h5><?php echo $calon['kode_pos_keluarga'] ?></h5>
    </div>
    
  </div>

  <div>
    <div class="form-group">
      <label for="id_kepala_keluarga">Kepala Keluarga</label>
      <h5>
        <?php foreach ($warga as $value) :?>
          <?php  
          if ($value->nik_warga==$calon['nik_kepala_keluarga']){
            echo $value->nama_warga;
          }
          ?>
        <?php endforeach ?>
      </h5>
    </div>

    <div id="target" class="form-group">
      <label for="anggota">Aggota Keluarga</label>
      <table>
        <tbody class="table" >
          <?php foreach ($anggota as $key => $value):?>
            <tr>
              <?php foreach ($warga as $v) {
                if($value->id_warga==$v->id_warga){?>
                  <td><?php echo $v->nama_warga; ?></td>
                  <td><?php echo $value->shdk; ?></td>
                  <?php
                }?>
              <?php } ?>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>

</div>