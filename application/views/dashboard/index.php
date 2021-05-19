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
		<!-- Small boxes (Stat box) -->
		<?php if($user['user_role']<=5 && $user['user_role']>=3): ?>
			<div class="row">
				<div class="col-lg-3 col-6">
					<!-- small box -->
					<div class="small-box bg-info">
						<div class="inner">
							<h3><?php echo $kk; ?></span></h3>

							<p>Kartu Keluarga</p>
						</div>
						<div class="icon">
							<i class="fas fa-address-card"></i>
						</div>
						<a href="<?php echo site_url('KartuK') ?>" class="small-box-footer"><i class="fas fa-calendar"></i></a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-6">
					<!-- small box -->
					<div class="small-box bg-success">
						<div class="inner">
							<h3><?php echo $total_warga; ?></h3>
							<p>Penduduk</p>
						</div>
						<div class="icon">
							<i class="fas fa-user"></i>
						</div>
						<a href="<?php echo site_url('warga') ?>" class="small-box-footer"><i class="fas fa-user"></i></a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-6">
					<!-- small box -->
					<div class="small-box bg-warning">
						<div class="inner">
							<h3><?php echo $rt; ?></h3>

							<p>Akun RT</p>
						</div>
						<div class="icon">
							<i class="fas fa-arrow-circle-right"></i>
						</div>
						<a href="<?php echo site_url('akun') ?>" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-6">
					<!-- small box -->
					<div class="small-box bg-danger">
						<div class="inner">
							<h3><?php echo $rw; ?></h3>

							<p>Akun RW</p>
						</div>
						<div class="icon">
							<i class="fas fa-arrow-circle-left"></i>
						</div>
						<a href="<?php echo site_url('akun') ?>" class="small-box-footer"><i class="fas fa-arrow-circle-left"></i></a>
					</div>
				</div>
				<!-- ./col -->
			</div>

			<div class="row">
				<div class="col-lg-3 col-6">
					<!-- small box -->
					<div class="small-box bg-info">
						<div class="inner">
							<h3><?php echo $ttl_laki; ?></span></h3>

							<p>Laki - laki</p>
						</div>
						<div class="icon">
							<i class="fas fa-mars"></i>
						</div>
						<a href="<?php echo site_url('home') ?>" class="small-box-footer"><i class="fas fa-mars"></i></a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-6">
					<!-- small box -->
					<div class="small-box bg-success">
						<div class="inner">
							<h3><?php echo $ttl_pere; ?></h3>
							<p>Perempuan</p>
						</div>
						<div class="icon">
							<i class="fas fa-venus"></i>
						</div>
						<a href="<?php echo site_url('warga') ?>" class="small-box-footer"><i class="fas fa-venus"></i></a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-6">
					<!-- small box -->
					<div class="small-box bg-warning">
						<div class="inner">
							<h3><?php echo $dewasa; ?></h3>

							<p>Diatas 17 Tahun</p>
						</div>
						<div class="icon">
							<i class="fas fa-child"></i>
						</div>
						<a href="<?php echo site_url('home') ?>" class="small-box-footer"><i class="fas fa-child"></i></a>
					</div>
				</div>
				<!-- ./col -->
			</div>

			<?php elseif ($user['user_role']<=2) :?>
				<div class="row">
					<div class="col-lg-6 col-15">
						<!-- small box -->
						<div class="small-box bg-info">
							<div class="inner">
								<h3><?php echo $jmlh_kk; ?></span></h3>

								<p>Kartu Keluarga</p>
							</div>
							<div class="icon">
								<i class="fas fa-address-card"></i>
							</div>
							<a href="<?php echo site_url('KartuK') ?>" class="small-box-footer"><i class="fas fa-calendar"></i></a>
						</div>
					</div>
					<!-- ./col -->
					<div class="col-lg-6 col-15">
						<!-- small box -->
						<div class="small-box bg-success">
							<div class="inner">
								<h3><?php echo $jmlh_warga; ?></h3>
								<p>Penduduk</p>
							</div>
							<div class="icon">
								<i class="fas fa-user"></i>
							</div>
							<a href="<?php echo site_url('warga') ?>" class="small-box-footer"><i class="fas fa-user"></i></a>
						</div>
					</div>
					<!-- ./col -->
					<!-- ./col -->
					<!-- ./col -->
				</div>
			<?php elseif ($user['user_role']==9):?>
				<div class="row">
				<div class="col-lg-3 col-6">
					<!-- small box -->
					<div class="small-box bg-info">
						<div class="inner">
							<h3><?php echo $jmlh_desa; ?></span></h3>

							<p>Jumlah Desa</p>
						</div>
						<div class="icon">
							<i class="fas fa-address-card"></i>
						</div>
						<a href="<?php echo site_url('KartuK') ?>" class="small-box-footer"><i class="fas fa-calendar"></i></a>
					</div>
				</div>
				<!-- ./col -->
			</div>
			<?php endif ?>
			<!-- /.row (main row) -->
		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->
	<?php $this->load->view('layouts/footer.php') ?>