

<?php 
$modul['modul'] = $this->db->get("modul")->result();
$this->load->view('admin_design/header', $modul); 
?>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/modules/datatables/datatables.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
<link href="<?php echo base_url(); ?>assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
      <!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
        <h1>Menu Percobaan ke 2</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#"><?= $this->uri->segment(1) ?></a></div>
            <div class="breadcrumb-item"><a href="#"><?= $this->uri->segment(2) ?></a></div>

        </div>
        </div>

        <div class="section-body">
	        <h2 class="section-title">Halaman manajemen Percobaan ke 2</h2>
	        <p class="section-lead">Halaman ini digunakan untuk mengelola data Percobaan ke 2.</p>
	        <div class="card">
	        	<div class="card-header">
	                <h4>Tabel data Percobaan ke 2</h4>
	            </div>
	            
	            <div class="card-body">
	                <button class="btn btn-md btn-info" id="btn-tambah"><i class="fa fa-plus"></i> Tambah data Percobaan ke 2</button>
	                <hr>
	                <div class="table-responsive">
	                    <table class="table table-striped" id="ajax_table">
	                        <thead>
	                            <tr>
	                                <th>id</th>
									<th>harga</th>
									
	                            </tr>
	                        </thead>
	                        <tbody>

	                        </tbody>
	                    </table>
	                </div>
	            </div>
	            <div class="card-footer bg-whitesmoke">
	            This is card footer
	            </div>
	        </div>
	    </div>
	</section>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="modal_form">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <form id="form_simpan">
                <div class="form-group">
		                    <label class="form-label" for="id">id</label>
		                    <input type="text" class="form-control" name="id" id="id" placeholder="id">
		                </div>
						<div class="form-group">
		                    <label class="form-label" for="harga">harga</label>
		                    <input type="text" class="form-control" name="harga" id="harga" placeholder="harga">
		                </div>
						
            </form>
        </div>
        <div class="modal-footer bg-whitesmoke br">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary" id="btn-simpan"> Simpan</button>
        </div>
    </div>
    </div>
</div>

<?php $this->load->view('admin_design/footer', $modul); ?>
<script src="<?php echo base_url(); ?>assets/admin/modules/datatables/datatables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/sweetalert/sweetalert.min.js"></script>
<script src="<?php echo base_url(); ?>assets/helper/js/custom_helper.js"></script>
<script>
var save_method = "add";
var global_id;
$(document).ready(function(){
    table = $('#ajax_table').DataTable({
        "order": [],
        "ajax": {
            "url": "<?php echo base_url('generated/percobaan_ke_2/ajaxTable');?>",
            "type": "POST"
        },
        "columnDefs": [
            {
                "targets": [0,1],
                "orderable": true,
                "className": "text-center",
            },
            {
                "targets": [ -1 ],
                "orderable": false,
                "className": "text-center",
            },
         ],
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "processing": true,

        "scrollCollapse": true,
    });
});

$("#btn-tambah").click(function(){
    save_method = "add";
    clear_data();
    $("#modal_form").modal("show");
    $(".modal-title").text("Tambah data Percobaan ke 2");
});

function clear_data()
{
    $('#id').val('');
	$('#harga').val('');
	
}

function form_validation()
{
    var status ="true";
    
	if ($("#id").val()=="") {
        $("#id").addClass("is-invalid");
        notif_warning('#id', 'Wajib diisi!');
        status = "false";
    }
    else {
        $("#id").removeClass("is-invalid");
        $("#id").next().text("");
    }
		
	if ($("#harga").val()=="") {
        $("#harga").addClass("is-invalid");
        notif_warning('#harga', 'Wajib diisi!');
        status = "false";
    }
    else {
        $("#harga").removeClass("is-invalid");
        $("#harga").next().text("");
    }
		
    return status;    
}
$("#btn-simpan").click(function(){
    status = form_validation();
    $('#btn-simpan').text('Menyimpan...'); //change button text
    $('#btn-simpan').attr('disabled',true); //set button enable 
    if(status =="true") {
        if (save_method=="add") {
            url = "<?= base_url() ?>generated/percobaan_ke_2/ajax_save";
        }
        else{
            url = "<?= base_url() ?>generated/percobaan_ke_2/ajax_update/"+global_id;
        }
        $.ajax({
            url : url,
            type: "POST",
            data: $('#form_simpan').serialize(),
            dataType: "JSON",
            success: function(data)
            {
                $('#modal_form').modal('hide');
                table.ajax.reload();
                $('#btn-simpan').text('Simpan'); //change button text
                $('#btn-simpan').attr('disabled',false); //set button enable 
                swal("Success!", "Data berhasil disimpan!", "success");
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
                $('#btn-simpan').text('Simpan'); //change button text
                $('#btn-simpan').attr('disabled',false); //set button enable 
            }
        });
    }
});

function edit(id)
{
    global_id = id;
    save_method = "edit";
    $.ajax({
        url : "<?php echo base_url(); ?>generated/percobaan_ke_2/ajax_edit/"+id,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {
            $("#id").val(data.id);
			$("#harga").val(data.harga);
			
            $('#modal_form').modal("show");
            $(".modal-title").text("Ubah data Percobaan ke 2");
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function hapus(id)
{
    swal({   
        title: "Anda yakin?",
        text: "Data akan terhapus secara permanen!",
        type: "warning",
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "Ya, saya yakin!",
        cancelButtonText: "Tidak, batalkan!",
        closeOnConfirm: true,
        closeOnCancel: true 
    }, function(isConfirm){   
        if (isConfirm) {

            $.ajax({
                url : "<?php echo base_url(); ?>generated/percobaan_ke_2/ajax_delete/"+id,
                type: "POST",
                dataType: "JSON",
                success: function(data)
                {
                    table.ajax.reload();
                    swal("Success!", "Data berhasil dihapus!", "success");
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
            
        }
    });
}
</script>
	