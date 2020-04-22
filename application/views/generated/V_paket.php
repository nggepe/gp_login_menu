

<?php 
$modul['modul'] = $this->db->get("modul")->result();
?>

<div class="main-content">
    <section class="section">
        <div class="section-header">
        <h1>Menu paket</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#"><?= $this->uri->segment(1) ?></a></div>
            <div class="breadcrumb-item"><a href="#"><?= $this->uri->segment(2) ?></a></div>

        </div>
        </div>

        <div class="section-body">
	        <h2 class="section-title">Halaman manajemen paket</h2>
	        <p class="section-lead">Halaman ini digunakan untuk mengelola data paket.</p>
	        <div class="card">
	        	<div class="card-header">
	                <h4>Tabel data paket</h4>
	            </div>
	            
	            <div class="card-body">
	                <button class="btn btn-md btn-info" id="btn-tambah"><i class="fa fa-plus"></i> Tambah data paket</button>
	                <hr>
	                <div class="table-responsive">
	                    <table class="table table-striped" id="ajax_table">
	                        <thead>
	                            <tr>
	                            	<th>No</th>
	                                <th>nama</th>
									
	                                <th>#</th>
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
		                    <label class="form-label" for="nama">nama</label>
		                    <input type="text" class="form-control" name="nama" id="nama" placeholder="nama">
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


<script>
var save_method = "add";
var global_id;
$(document).ready(function(){
    table = $('#ajax_table').DataTable({
        "order": [],
        "ajax": {
            "url": "<?php echo base_url('generated/paket/ajaxTable');?>",
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
    $(".modal-title").text("Tambah data paket");
});

function clear_data()
{
    $('#nama').val('');
	
}

function form_validation()
{
    var status ="true";
    
	if ($("#nama").val()=="") {
        $("#nama").addClass("is-invalid");
        notif_warning('#nama', 'Wajib diisi!');
        status = "false";
    }
    else {
        $("#nama").removeClass("is-invalid");
        $("#nama").next().text("");
    }
		
    return status;    
}
$("#btn-simpan").click(function(){
    status = form_validation();
    $('#btn-simpan').text('Menyimpan...'); //change button text
    $('#btn-simpan').attr('disabled',true); //set button enable 
    if(status =="true") {
        if (save_method=="add") {
            url = "<?= base_url() ?>generated/paket/ajax_save";
        }
        else{
            url = "<?= base_url() ?>generated/paket/ajax_update/"+global_id;
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
        url : "<?php echo base_url(); ?>generated/paket/ajax_edit/"+id,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {
            $("#nama").val(data.nama);
			
            $('#modal_form').modal("show");
            $(".modal-title").text("Ubah data paket");
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
                url : "<?php echo base_url(); ?>generated/paket/ajax_delete/"+id,
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
	