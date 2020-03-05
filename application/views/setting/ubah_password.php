
<?php 
$loginsession = $this->session->userdata('loginsession');
?>
      <!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
        <h1>Menu Ubah Password</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#"><?= $this->uri->segment(1) ?></a></div>
            <div class="breadcrumb-item"><a href="#"><?= $this->uri->segment(2) ?></a></div>
            
        </div>
        </div>

        <div class="section-body">
        <h2 class="section-title">Halaman Ubah Password</h2>
        <p class="section-lead">Halaman Ubah Password.</p>
        <div class="card">
            
            
            <div class="card-body">
                <form method="POST" id="form-ubah">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" class="form-control" value="<?php echo $loginsession['username'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="password_lama">Password Lama</label>
                        <input type="password" id="password_lama" name="password_lama" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password_baru">Password Baru</label>
                        <input type="password" id="password_baru" name="password_baru" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="konfirm_password_baru">Konfirmasi Password Baru</label>
                        <input type="password" id="konfirm_password_baru" name="konfirm_password_baru" onkeyup="new_password_validation()" class="form-control">
                    </div>
                </form>
                <div class="form-group text-right">
                    <button id="btn-simpan" class="btn btn-lg btn-primary"><i class="fa fa-save"></i> Simpan</button>
                </div>
            </div>
            <div class="card-footer bg-whitesmoke">
            This is card footer
            </div>
        </div>
        </div>
    </section>
</div>


<script>

function clear_data()
{
    $("#nama").val("");
}

function form_validation()
{
    var status ="true";
    if ($("#username").val()=="") {
        $("#username").addClass("is-invalid");
        notif_warning('#username','Wajib diisi !');
        status = "false";
    }
    else{
        $("#username").removeClass("is-invalid");
        $("#username").next().text("");
    }

    if ($("#konfirm_password_baru").val()!==$("#password_baru").val()) {
        $("#konfirm_password_baru").addClass("is-invalid");
        notif_warning('#konfirm_password_baru','Belum sama!');
        status = "false";
    }
    else{
        $("#konfirm_password_baru").removeClass("is-invalid");
        $("#konfirm_password_baru").next().text("");
    }
    return status;
}

function new_password_validation()
{
    if ($("#konfirm_password_baru").val()!==$("#password_baru").val()) {
        $("#konfirm_password_baru").addClass("is-invalid");
        notif_warning('#konfirm_password_baru','Belum sama!');
        status = "false";
    }
    else{
        $("#konfirm_password_baru").removeClass("is-invalid");
        $("#konfirm_password_baru").next().text("");
    }
}

$("#btn-simpan").click(function(){
    status = form_validation();
    if (status=="true"){
        $('#btn-simpan').html('Sedang mengunggah...');
        $('#btn-simpan').attr('disabled',true);
        $.ajax({
            url : "<?php echo base_url(); ?>/setting/Ubah_password/submit",
            type: "POST",
            data: $('#form-ubah').serialize(),
            dataType: "JSON",
            success: function(data)
            {
                if (data['status']=="true") {
                    $('#btn-simpan').html('<i class="fa fa-save"></i> Simpan');
                    $('#btn-simpan').attr('disabled',false);
                    swal("Success!", "Data berhasil disimpan!", "success");
                    $("#password_lama").removeClass("is-invalid");
                    $("#password_lama").next().text("");
                }
                else
                {
                    $('#btn-simpan').html('<i class="fa fa-save"></i> Simpan');
                    $('#btn-simpan').attr('disabled',false);
                    swal("Failed!", "Mohon isi dengan benar!", "warning");
                    for (var i = 0; i < data['data'].length; i++) {
                        $(data['data'][i]['element']).addClass("is-invalid");
                        notif_warning(data['data'][i]['element'], data['data'][i]['validate']);
                    }
                    console.log(data);
                }
                
                // window.reload();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
                $('#btn-simpan').html('<i class="fa fa-save"></i> Simpan');
                $('#btn-simpan').attr('disabled',false);
            }
        });
    }
});
</script>