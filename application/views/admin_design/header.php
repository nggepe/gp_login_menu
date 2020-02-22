<?php $loginsession = $this->session->userdata('loginsession');?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <?php if ($this->uri->segment(2)!="Home" and $this->uri->segment(2) !="" ) {
  		$title = $this->uri->segment(1)." ".$this->uri->segment(2);
  }
  	else {
  		$title = $this->uri->segment(1);
  	}
   ?>
  <title>GP | <?= $title ?> </title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/awesome/css/all.css">

  <!-- CSS Libraries -->

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/assets/css/style.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/assets/css/components.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/helper/css/custom.css">
</head>

<body oncontextmenu="return false;">
  	<div id="app">
    	<div class="main-wrapper">
      		<div class="navbar-bg"></div>
      		<nav class="navbar navbar-expand-lg main-navbar">
        		<form class="form-inline mr-auto">
          			<ul class="navbar-nav mr-3">
            			<li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            			<li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
          			</ul>
          			<div class="search-element">
            			<input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="250" id="search_key">
            			<button class="btn" type="submit"><i class="fas fa-search"></i></button>
            			<div class="search-backdrop"></div>
            			<div class="search-result">
              			<div class="search-header">
                		Hasil Pencarian
              		</div>
					<div id="item_pencarian">
						<div class="search-item">
							<a href="#"><i class="fa fa-eye"></i> &nbsp; ketik dulu ya..</a>
						</div>
					</div>
            	</div>
          	</div>
        </form>
		<ul class="navbar-nav navbar-right">
			<li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
			<img alt="image" src="<?= base_url() ?>assets/admin/assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
			<div class="d-sm-none d-lg-inline-block">Hi, <?= $this->session->userdata('loginsession')['nama'] ?></div></a>
			<div class="dropdown-menu dropdown-menu-right">
				<div class="dropdown-title">Logged in 5 min ago</div>
				<a href="features-profile.html" class="dropdown-item has-icon">
				<i class="far fa-user"></i> Profile
				</a>
				<a href="features-activities.html" class="dropdown-item has-icon">
				<i class="fas fa-bolt"></i> Activities
				</a>
				<a href="features-settings.html" class="dropdown-item has-icon">
				<i class="fas fa-cog"></i> Settings
				</a>
				<div class="dropdown-divider"></div>
				<a href="<?= base_url() ?>user_auth/login/logout" class="dropdown-item has-icon text-danger">
				<i class="fas fa-sign-out-alt"></i> Logout
				</a>
			</div>
			</li>
		</ul>
	</nav>
<?php 
	
?>

	<div class="main-sidebar">
	<aside id="sidebar-wrapper">
		<div class="sidebar-brand">
		<a href="#">GP</a>
		</div>
		<div class="sidebar-brand sidebar-brand-sm">
		<a href="index.html">St</a>
		</div>
		<ul class="sidebar-menu">
			<li class="menu-header">Menu</li>
			<?php foreach ($modul as $key) { if (in_array($key->id, $loginsession['access_control']['modul'])) {?>
				<?php
					if ($key->tipe=="dropdown") {
				?>
					<li class="nav-item dropdown" id="top_<?= $key->id ?>">
						<a href="javascript:void(0)" class="nav-link has-dropdown" onclick="modul('<?= $key->id ?>')"><i class="<?= $key->icon ?>"></i><span><?= $key->nama ?></span></a>
						<ul class="dropdown-menu" style=" ">
						<?php
							$this->db->from('menu');
							$this->db->where('id_modul', $key->id);
							$this->db->order_by('menu_nama', 'asc');
							$menu = $this->db->get()->result();
							foreach ($menu as $menus) {
								if (in_array($menus->id, $loginsession['access_control']['menu'])) {
									
								
						?>
									<li><a class="nav-link" id="sub_<?= $menus->id ?>" href="<?= base_url().$menus->url ?>"><?= $menus->menu_nama ?></a></li>
						<?php
								}
							}
						?>
						</ul>
					</li>
				<?php
					}
					else{
				?>
					<li class="nav-item" id="top_<?= $key->id ?>">
						<a href="<?= base_url().$key->url ?>" class="nav-link"><i class="<?= $key->icon ?>"></i><span><?= $key->nama ?></span></a>
					</li>
				<?php
					}
				?>
				


			<?php }} ?>
			
		</ul>

		<div class="mt-4 mb-4 p-3 hide-sidebar-mini">
			<a href="<?= base_url() ?>user_auth/login/logout" class="btn btn-primary btn-lg btn-block btn-icon-split">
			<i class="fas fa-rocket"></i> Logout
			</a>
		</div>
	</aside>
	</div>
