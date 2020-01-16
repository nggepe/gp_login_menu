
<?php 
$modul['modul'] = $this->db->get("modul")->result();
$this->load->view('admin_design/header', $modul); 
?>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/modules/datatables/datatables.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/modules/select2/select2.css">
<link href="<?php echo base_url(); ?>assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
      <!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
        <h1>Menu Pegawai</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#"><?= $this->uri->segment(1) ?></a></div>
            <div class="breadcrumb-item"><a href="#">Pegawai</a></div>
            
        </div>
        </div>

        <div class="section-body">
        <h2 class="section-title">Halaman manajemen Pegawai</h2>
        <p class="section-lead">Halaman ini digunakan untuk mengelola data Pegawai.</p>
        <div class="card">
            <div class="card-header">
                <h4>Tabel data Pegawai</h4>
            </div>
            
            <div class="card-body">
                <button class="btn btn-md btn-info" id="btn-tambah"><i class="fa fa-plus"></i> Tambah data Pegawai</button>
                
                <hr>
                <div class="table-responsive">
                    <table class="table table-striped" id="ajax_table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>No Telepon</th>
                                <th>Username</th>
                                <th>Act</th>
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
                    <label class="form-label" for="nama">Nama</label>
                    <input type="text" class="form-control" name="nama" id="nama" placeholder="isi nama user">
                </div>
                <div class="form-group">
                    <label class="form-label" for="id_master_jabatan">Jabatan</label>
                    <input type="text" name="id_master_jabatan" id="id_master_jabatan" class="form-control">
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label" for="no_telpon">No Telepon</label>
                    <input type="text" class="form-control" name="no_telpon" id="no_telpon" placeholder="isi no telepon user">
                </div>
                <div class="form-group">
                    <label class="form-label" for="username">Username</label>
                    <input type="text" class="form-control" name="username" id="username" placeholder="isi username">
                </div>
                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="isi password">
                </div>
                <div class="form-group">
                    <label class="form-label" for="password2">Confirm Password</label>
                    <input type="password" class="form-control" name="password2" id="password2" placeholder="konfirmasi password">
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
<script src="<?php echo base_url(); ?>assets/admin/modules/select2/select2.min.js"></script>
<script src="<?php echo base_url(); ?>assets/helper/js/custom_helper.js"></script>
<script>
var save_method = "add";
var global_id;
var global_modul = [];
var global_menu = [];

$(document).ready(function(){
    table = $('#ajax_table').DataTable({
        "order": [],
        "ajax": {
            "url": "<?php echo base_url('master/user/ajaxTable');?>",
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
    $(".modal-title").text("Tambah data Pegawai");
});



function clear_data()
{
    $("#nama").val("");
    $("#alamat").val("");
    $("#no_telpon").val("");
    $("#username").val("");
    $("#password").val("");
    $("#password2").val("");
    $("#id_master_jabatan").select2("val", "");
}

function form_validation()
{
    var status ="true";
    if ($("#nama").val()=="") {
        $("#nama").addClass("is-invalid");
        notif_warning('#nama','Wajib diisi !');
        status = "false";
    }
    else{
        $("#nama").removeClass("is-invalid");
        $("#nama").next().text("");
    }
    if ($("#no_telpon").val()=="") {
        $("#no_telpon").addClass("is-invalid");
        notif_warning('#no_telpon','Wajib diisi !');
        status = "false";
    }
    else{
        $("#no_telpon").removeClass("is-invalid");
        $("#no_telpon").next().text("");
    }
    if ($("#username").val()=="") {
        $("#username").addClass("is-invalid");
        notif_warning('#username','Wajib diisi !');
        status = "false";
    }
    else{
        $("#username").removeClass("is-invalid");
        $("#username").next().text("");
    }
    if ($("#password").val()=="") {
        $("#password").addClass("is-invalid");
        notif_warning('#password','Wajib diisi !');
        status = "false";
    }
    else if($("#password").val() != $("#password2").val()){
        $("#password2").addClass("is-invalid");
        notif_warning('#password2','Password harus sama !');
        status = "false";
        
    }
    else{
        $("#password").removeClass("is-invalid");
        $("#password").next().text("");
        $("#password2").removeClass("is-invalid");
        $("#password2").next().text("");
    }
    if ($("#id_master_jabatan").val()=="") {
        $("#id_master_jabatan").addClass("is-invalid");
        notif_warning('#id_master_jabatan','Wajib diisi !');
        status = "false";
    }
    else{
        $("#id_master_jabatan").removeClass("is-invalid");
        $("#id_master_jabatan").next().text("");
    }
    return status;
}

$("#btn-simpan").click(function(){
    status = form_validation();
    if (status =="true") {
        if (save_method=="add") {
            url = "<?= base_url() ?>master/user/ajax_save";
        }
        else{
            url = "<?= base_url() ?>master/user/ajax_update/"+global_id;
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
                $('#btn-simpan').text('Menyimpan...'); //change button text
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
        url : "<?php echo base_url(); ?>master/user/ajax_edit/"+id,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {
            $("#nama").val(data.nama);
            $("#alamat").val(data.alamat);
            $("#no_telpon").val(data.no_telpon);
            $("#username").val(data.username);
            $('#modal_form').modal("show");
            $("#id_master_jabatan").select2("val", data.id_master_jabatan);
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
                url : "<?php echo base_url(); ?>master/user/ajax_delete/"+id,
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
$('#id_master_jabatan').select2({
        placeholder : "Input jabatan",
        allowClear : true,
        ajax: {
            url: '<?php echo base_url(); ?>master/User/select2_jabatan',
            dataType: 'json',
            type: 'post',
            quietMillis: 100,
            data: function ( term, page ) {
                return { query: term, limit: 10,page : page };
            },
            results: function (data, page) {
                var more = (page * 10) < data.total;
                return {results: data.rows, more : more};
            }
        },
        initSelection : function( el, cb ) {
            var id = $(el).val();
            $.ajax({
                url: '<?php echo base_url(); ?>master/User/select2_jabatan',
                data: { id: id },
                dataType: 'json',
                type: 'post'
            }).done( function( data ) {
                if ( data.rows && data.rows.length ) {
                    cb( data.rows[0] );
                }
            });
        },
        id: function( data ) {
            return data.id;
        },
        formatResult: function ( data ) {
            return "<div>" +data.nama+"<div>";
        },
        formatSelection: function ( data ) {
            $('#id_master_jabatan').val(data.id);
            return data.nama;
            
        },
        escapeMarkup: function (m) { return m; } // we do not want to escape markup since we are displaying html in results
    }).on('select2-clearing', function(){
        $('.btn-simpan').attr('disabled',false);
    });
</script>