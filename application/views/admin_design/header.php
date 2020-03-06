
<?php $loginsession = $this->session->userdata('loginsession');
$modul = $this->db->get("modul")->result();
?>

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
  <!-- <link rel="stylesheet" href="<?= base_url() ?>assets/admin/awesome/css/all.css"> -->

  <!-- CSS Libraries -->

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/assets/css/style.css">
  <!-- <link rel="stylesheet" href="<?= base_url() ?>assets/admin/assets/css/components.css"> -->
  <!-- <link rel="stylesheet" href="<?= base_url() ?>assets/helper/css/custom.css"> -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/modules/datatables/datatables.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/modules/select2/select2.css">
	<link href="<?php echo base_url(); ?>assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
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
				if (in_array($key->id, $loginsession['access_control']['modul'])) {?>
				<?php
					if ($key->tipe=="dropdown") {
				?>
					<li class="nav-item dropdown" id="top_<?= $key->id ?>">
						<a href="javascript:void(0)" onclick="modul(this)" class="nav-link has-dropdown"><i class="<?= $key->icon ?>"></i><span><?= $key->nama ?></span></a>
						<ul class="dropdown-menu" style=" ">
						<?php
							$this->db->from('menu');
							$this->db->where('id_modul', $key->id);
							$this->db->order_by('menu_nama', 'asc');
							$menu = $this->db->get()->result();
							foreach ($menu as $menus) {
								if (in_array($menus->id, $loginsession['access_control']['menu'])) {
									$url_men = explode("/", $menus->url);
								
						?>
									<li class="menu-link" id="<?= $url_men[0].'-'.$url_men[1]?>"><a class="nav-link" onclick="menu(this)" id="sub_<?= $menus->id ?>" href="#<?= $menus->url ?>"><?= $menus->menu_nama ?></a></li>
						<?php
								}
							}
						?>
						</ul>
					</li>
				<?php
					}
					else{ $url_mod = explode("/", $key->url);
				?>
					<li class="nav-item single-el" id="<?= $url_mod[0].'-'.$url_mod[1] ?>">
						<a href="#<?= $key->url ?>" onclick="single(this)" class="nav-link"><i class="<?= $key->icon ?>"></i><span><?= $key->nama ?></span></a>
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
    <div id="ajax-content">
        
    </div>


<!-- foooter -->
			<footer class="main-footer">
	        	<div class="footer-left">
	          		Copyright &copy; Reswara 2019 <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad Nauval Azhar</a>
	        	</div>
	        	<div class="footer-right">
	          		2.3.0
	        	</div>
	      	</footer>
    	</div>
  	</div>
</body>
</html>

  <!-- General JS Scripts -->
  	<script type="text/javascript"> (function() { var css = document.createElement('link'); css.href = '<?= base_url() ?>assets/admin/awesome/css/all.css'; css.rel = 'stylesheet'; css.type = 'text/css'; document.getElementsByTagName('head')[0].appendChild(css); })(); </script>
  	<script type="text/javascript"> (function() { var css = document.createElement('link'); css.href = '<?= base_url() ?>assets/admin/assets/css/components.css'; css.rel = 'stylesheet'; css.type = 'text/css'; document.getElementsByTagName('head')[0].appendChild(css); })(); </script>
  	<script type="text/javascript"> (function() { var css = document.createElement('link'); css.href = '<?= base_url() ?>assets/helper/css/custom.css'; css.rel = 'stylesheet'; css.type = 'text/css'; document.getElementsByTagName('head')[0].appendChild(css); })(); </script>
  	<script src="<?php echo base_url(); ?>assets/admin/modules/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/admin/modules/popper.js"></script>
	<script src="<?php echo base_url(); ?>assets/admin/modules/tooltip.js"></script>
	<script src="<?php echo base_url(); ?>assets/admin/modules/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/admin/modules/nicescroll/jquery.nicescroll.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/admin/modules/moment.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/admin/assets/js/stisla.js"></script>

  <!-- JS Libraies -->

	<script src="<?php echo base_url(); ?>assets/admin/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/admin/modules/jquery-ui/jquery-ui.min.js"></script>
	<!-- Template JS File -->
	<script src="<?= base_url() ?>assets/admin/assets/js/scripts.js"></script>
	<script src="<?= base_url() ?>assets/admin/assets/js/custom.js"></script>
	<script src="<?php echo base_url(); ?>assets/admin/modules/datatables/datatables.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/admin/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/admin/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugins/sweetalert/sweetalert.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/admin/modules/select2/select2.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/helper/js/custom_helper.js"></script>

  <!-- Page Specific JS File -->
</body>
</html>
<script>
	
	function modul(el)
	{
		elementClass = el.parentElement.classList;
		if (elementClass.length===3) {
			el.parentElement.classList.remove("active");
		}
		else{
			el.parentElement.classList.add("active");
		}
		// console.log(elementClass[0]);
	}

	function menu(el)
	{
		elementClass = el.parentElement.classList;
		$("."+elementClass[0]).removeClass("active");
		$(".single-el").removeClass("active");
		el.parentElement.classList.add("active");
		// console.log(elementClass[0]);
	}

	function single(el)
	{
		el.parentElement.classList.add("active");
		$(".menu-link").removeClass("active");
	}

	$("#search_key").keyup(function(event){
		if (event.keyCode === 40) {
			$("#search-item-0").focus();
			// $("#search_key").blur();
		}
		else {
			$.ajax({
				url : "<?= base_url() ?>Search/search",
				type: "POST",
				data: {"key": $("#search_key").val()},
				dataType: "JSON",
				success: function(data)
				{
					var string = "";
					for (i = 0; i < data.length; i++) {
						string = string+'<div class="search-item">'+
							'<a id="search-item-'+i+'" href="#'+data[i].url+'"><i class="'+data[i].icon+'"></i> &nbsp; '+data[i].nama+'</a>'+
						'</div>';
					}
					$("#item_pencarian").html(string);
				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					alert('Error adding / update data');
				}
			});
		}
	});
	
</script>
<script>
	var ajax_url;

    $(document).ready(function(){
        
        var ajax_url = location.hash.replace(/^#/, '');
        var ajax_url = location.hash.replace(/^#/, '');
		var class_mod = ajax_url.split("/");
		$("#"+class_mod[0]+"-"+class_mod[1]).addClass("active");
		if($("#"+class_mod[0]+"-"+class_mod[1]).parent().attr("class")=="dropdown-menu")
		{
			$("#"+class_mod[0]+"-"+class_mod[1]).parent().addClass("active");
		};
		if (ajax_url!=''){
        	LoadAjaxContent(ajax_url);
		}

    });
    function LoadAjaxContent(url){
		$('#ajax-content').html("<div class='main-content'><section class='section'><div class='section-header'><i class='fa fa-spinner fa-pulse'></i></div></section></div>");
		$.ajax({
			mimeType: 'text/html; charset=utf-8', // ! Need set mimeType only when run from local file
			url: url,
			type: 'GET',
			success: function(data) {
				$('#ajax-content').html(data);
			},
			error: function (jqXHR, textStatus, errorThrown) {
				// swal(errorThrown, "Data berhasil disimpan!", "warning");

				console.log(textStatus);
			},
			dataType: "html",
			async: false
		});
	}
	$(window).on('hashchange', function() {
	  	var ajax_url = location.hash.replace(/^#/, '');
	  	document.title = ajax_url;
       	LoadAjaxContent(ajax_url);

	});
</script>