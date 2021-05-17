<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
<form action="<?php echo site_url('akun/update') ?>" method='post'>
  <input type="hidden" name="id_user" value="<?php echo $calon['id_user'] ?>" >
  <input type="hidden" name="user_role" value="<?php echo $calon['user_role'] ?>" >
  <div class="card-body">
    <?php if ($this->session->flashdata('error')!=null):?>
      <div class="alert alert-danger">
        <?php print_r($this->session->flashdata('error')); ?>
      </div>
    <?php endif; ?>

    <div class="form-group">
      <label for="id_warga">NIK - Nama Warga</label>
      <select id="id_warga" class="form-control" name="id_warga">
        <?php foreach ($warga as $value):?>
          <option onclick="" <?php echo $calon['id_warga']==$value->id_warga ? 'selected' :'' ?> value="<?php echo $value->id_warga ?>" ><?php echo $value->nik_warga.'-'.$value->nama_warga; ?></option>
        <?php endforeach ?>
      </select>
    </div>

    <?php if ($calon['user_role']==2): ?>    
      <div class="form-group">
        <label for="rw">RW</label>
        <input type="text" class="form-control" value="<?php echo $calon['rw'] ?>" id="rw" placeholder="Masukkan RW" name="rw" >
      </div>
      <?php elseif($calon['user_role']==1): ?>
        <div class="form-group">
          <label for="rt">RT</label>
          <input type="text" class="form-control" value="<?php echo $calon['rt'] ?>" id="rt" placeholder="Masukkan RT" name="rt" >
        </div>

        <div class="form-group">
          <label for="rw">RW</label>
          <input type="text" class="form-control" value="<?php echo $calon['rw'] ?>" id="rw" placeholder="Masukkan RW" name="rw" >
        </div>
      <?php endif ?>        

      <div class="form-group">
        <label for="password">Password</label>
        <input type="text" class="form-control" value="<?php echo $calon['password'] ?>" id="password" placeholder="Masukkan password" name="password" >
      </div>

      <!-- /.card-body -->
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>

    </div>
  </form>
<script>
    $(document).ready(function () {
    $('#id_warga').selectize({
      sortField: 'text'
    });
  });
  </script>