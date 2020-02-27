<footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; Tani Agung 2019 <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad Nauval Azhar</a>
        </div>
        <div class="footer-right">
          2.3.0
        </div>
      </footer>
    </div>
  </div>

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

  <!-- Page Specific JS File -->
</body>
</html>
<script>
	
	function modul(id)
	{
		if($("#top_"+id).hasClass("active"))
		{
			$("#top_"+id).removeClass("active");
		}
		else{
			$("#top_"+id).addClass("active");
		}
		
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
							'<a id="search-item-'+i+'" href="<?= base_url() ?>'+data[i].url+'"><i class="'+data[i].icon+'"></i> &nbsp; '+data[i].nama+'</a>'+
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
<?php 
    $stats = "top_";
    $query  = $this->db->get_where('modul', array('url'=>$this->uri->segment(1)."/".$this->uri->segment(2)))->row();
    if ($query=="" || $query==null) {
        $aktif_id = $this->db->get_where('menu', array('url'=>$this->uri->segment(1)."/".$this->uri->segment(2)))->row()->id;
        $stats = "sub_";
    }
    else
    {
		$aktif_id = $query->id;
    }
?>
<script>
    var stats = "<?= $stats ?>";
    $(document).ready(function(){
        if(stats=="top_")
        {
            $("#<?= $stats.$aktif_id ?>").addClass("active");
        }
        else{
            $("#<?= $stats.$aktif_id ?>").parent().addClass("active");
            $("#<?= $stats.$aktif_id ?>").parent().parent().parent().addClass("active");
            $("#<?= $stats.$aktif_id ?>").parent().parent().attr("style", "display: block;");
        }
    });

</script>