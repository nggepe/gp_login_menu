<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Layout &rsaquo; Default &mdash; Tani Agung</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/awesome/css/all.css">

  <!-- CSS Libraries -->

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/assets/css/style.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/assets/css/components.css">
</head>

<body>
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
			<li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link nav-link-lg message-toggle beep"><i class="far fa-envelope"></i></a>
			<div class="dropdown-menu dropdown-list dropdown-menu-right">
				<div class="dropdown-header">Messages
				<div class="float-right">
					<a href="#">Mark All As Read</a>
				</div>
				</div>
				<div class="dropdown-list-content dropdown-list-message">
				<a href="#" class="dropdown-item dropdown-item-unread">
					<div class="dropdown-item-avatar">
					<img alt="image" src="<?= base_url() ?>assets/admin/assets/img/avatar/avatar-1.png" class="rounded-circle">
					<div class="is-online"></div>
					</div>
					<div class="dropdown-item-desc">
					<b>Kusnaedi</b>
					<p>Hello, Bro!</p>
					<div class="time">10 Hours Ago</div>
					</div>
				</a>
				<a href="#" class="dropdown-item dropdown-item-unread">
					<div class="dropdown-item-avatar">
					<img alt="image" src="<?= base_url() ?>assets/admin/assets/img/avatar/avatar-2.png" class="rounded-circle">
					</div>
					<div class="dropdown-item-desc">
					<b>Dedik Sugiharto</b>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
					<div class="time">12 Hours Ago</div>
					</div>
				</a>
				<a href="#" class="dropdown-item dropdown-item-unread">
					<div class="dropdown-item-avatar">
					<img alt="image" src="<?= base_url() ?>assets/admin/assets/img/avatar/avatar-3.png" class="rounded-circle">
					<div class="is-online"></div>
					</div>
					<div class="dropdown-item-desc">
					<b>Agung Ardiansyah</b>
					<p>Sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
					<div class="time">12 Hours Ago</div>
					</div>
				</a>
				<a href="#" class="dropdown-item">
					<div class="dropdown-item-avatar">
					<img alt="image" src="<?= base_url() ?>assets/admin/assets/img/avatar/avatar-4.png" class="rounded-circle">
					</div>
					<div class="dropdown-item-desc">
					<b>Ardian Rahardiansyah</b>
					<p>Duis aute irure dolor in reprehenderit in voluptate velit ess</p>
					<div class="time">16 Hours Ago</div>
					</div>
				</a>
				<a href="#" class="dropdown-item">
					<div class="dropdown-item-avatar">
					<img alt="image" src="<?= base_url() ?>assets/admin/assets/img/avatar/avatar-5.png" class="rounded-circle">
					</div>
					<div class="dropdown-item-desc">
					<b>Alfa Zulkarnain</b>
					<p>Exercitation ullamco laboris nisi ut aliquip ex ea commodo</p>
					<div class="time">Yesterday</div>
					</div>
				</a>
				</div>
				<div class="dropdown-footer text-center">
				<a href="#">View All <i class="fas fa-chevron-right"></i></a>
				</div>
			</div>
			</li>
			<li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell"></i></a>
			<div class="dropdown-menu dropdown-list dropdown-menu-right">
				<div class="dropdown-header">Notifications
				<div class="float-right">
					<a href="#">Mark All As Read</a>
				</div>
				</div>
				<div class="dropdown-list-content dropdown-list-icons">
				<a href="#" class="dropdown-item dropdown-item-unread">
					<div class="dropdown-item-icon bg-primary text-white">
					<i class="fas fa-code"></i>
					</div>
					<div class="dropdown-item-desc">
					Template update is available now!
					<div class="time text-primary">2 Min Ago</div>
					</div>
				</a>
				<a href="#" class="dropdown-item">
					<div class="dropdown-item-icon bg-info text-white">
					<i class="far fa-user"></i>
					</div>
					<div class="dropdown-item-desc">
					<b>You</b> and <b>Dedik Sugiharto</b> are now friends
					<div class="time">10 Hours Ago</div>
					</div>
				</a>
				<a href="#" class="dropdown-item">
					<div class="dropdown-item-icon bg-success text-white">
					<i class="fas fa-check"></i>
					</div>
					<div class="dropdown-item-desc">
					<b>Kusnaedi</b> has moved task <b>Fix bug header</b> to <b>Done</b>
					<div class="time">12 Hours Ago</div>
					</div>
				</a>
				<a href="#" class="dropdown-item">
					<div class="dropdown-item-icon bg-danger text-white">
					<i class="fas fa-exclamation-triangle"></i>
					</div>
					<div class="dropdown-item-desc">
					Low disk space. Let's clean it!
					<div class="time">17 Hours Ago</div>
					</div>
				</a>
				<a href="#" class="dropdown-item">
					<div class="dropdown-item-icon bg-info text-white">
					<i class="fas fa-bell"></i>
					</div>
					<div class="dropdown-item-desc">
					Welcome to Stisla template!
					<div class="time">Yesterday</div>
					</div>
				</a>
				</div>
				<div class="dropdown-footer text-center">
				<a href="#">View All <i class="fas fa-chevron-right"></i></a>
				</div>
			</div>
			</li>
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
		<a href="#">Tani Agung</a>
		</div>
		<div class="sidebar-brand sidebar-brand-sm">
		<a href="index.html">St</a>
		</div>
		<ul class="sidebar-menu">
			<li class="menu-header">Menu</li>
			<?php foreach ($modul as $key) { ?>
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
						?>
							<li><a class="nav-link" id="sub_<?= $menus->id ?>" href="<?= base_url().$menus->url ?>"><?= $menus->menu_nama ?></a></li>
						<?php
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
				


			<?php } ?>
			
		</ul>

		<div class="mt-4 mb-4 p-3 hide-sidebar-mini">
			<a href="<?= base_url() ?>user_auth/login/logout" class="btn btn-primary btn-lg btn-block btn-icon-split">
			<i class="fas fa-rocket"></i> Logout
			</a>
		</div>
	</aside>
	</div>
