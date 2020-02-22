
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
        <h1>Data <?= $this->uri->segment(2) ?></h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#"><?= $this->uri->segment(1) ?></a></div>
            <div class="breadcrumb-item"><a href="#"><?= $this->uri->segment(2) ?></a></div>
        </div>
        </div>

        <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Generator</h4>
            </div>
            <div class="card-body row">
                    <div class="col-md-12 text-right">
                        
                        <h4 style="float: right; cursor: pointer; color: blue;" onclick="Petunjuk()">Petunjuk <i class="fa fa-question-circle"></i></h4>
                    </div>
                    <div class="form-group col-md-6">
                        <form id="menus">
                        <label for="menu_name">Nama menu</label>
                        <input type="text" class="form-control" name="menu_name" id="menu_name" onkeyup="table_checker()">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="modul_id">Pilih Modul</label>
                        <input type="text" class="form-control" name="modul_id" id="modul_id">
                        </form>
                    </div>
                    <div class="col-md-12">
                        <button class="btn btn-md btn-primary" onclick="add_columns()"><i class="fa fa-plus"></i> Add Column</button>
                        <button class="btn btn-md btn-danger" id="btn-hapus" onclick="remove_columns()"><i class="fa fa-trash"></i> Delete</button>
                        <hr>
                    </div>
                
                <div class="col-md-12">
                        <form id="save_table">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>DataType</th>
                                <th>Length/set</th>
                                <th>Allow null?</th>
                                <th>Is Primary?</th>
                                <th>Auto Increment?</th>
                            </tr>
                        </thead>
                            <tbody id="columdatas">
                                
                            </tbody>
                    </table>
                        </form>
                    <div class="text-right"><button class="btn btn-md btn-primary" id="btn-simpan" onclick="build()"><i class="fa fa-save"></i> Save</button></div>
                </div>
            </div>
            <div class="card-footer bg-whitesmoke">
            This is card footer
            </div>
        </div>
        </div>
    </section>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="modal_petunjuk">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Rules/Tutorial</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <ul>
                    <li><b>Kolom</b> pertama dianggap sebagai <b>id</b> oleh sistem</li>
                    <li>Oleh karena itu, harap anda mengisi kolom <b>pertama</b> seperti <b>format yang sudah disediakan</b></li>
                    <li>Selain <b>2 poin</b> diatas beberapa format pengisian formulir akan divalidasi secara <b>Otomatis</b> oleh sistem</li>
                    <li>Jika ada <b>keluhan atau saran</b> silakan langsung buat <b>Issue</b> di <i><b><u><a target="_blank" href="https://github.com/nggepe/gp_login_menu/issues">github</a></u></b></i></li>
                </ul>
            </div>
            <div class="modal-footer bg-whitesmoke br">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
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
<script type="text/javascript">
var global_save = [];
var iteration = 0;
var global_iteration_save = [];
var datatype = [
    "TINYINT",
    "INT",

    "FLOAT",
    "DOUBLE",
    "DECIMAL",

    "CHAR",
    "VARCHAR",
    "TEXT",

    "DATE",
    "TIME",
    "YEAR",
    "DATETIME",
    "TIMESTAMP",

    "ENUM"
];

var no_length_type = [

    "FLOAT",
    "DOUBLE",
    "DECIMAL",

    "TEXT",

    "DATE",
    "TIME",
    "YEAR",
    "DATETIME",
    "TIMESTAMP",
];

var innerdatatype = "";

for (var i = 0; i < datatype.length; i++) {
    innerdatatype+='<option value="'+datatype[i]+'">'+datatype[i]+'</option>';
}

$("#btn-hapus").hide();
$(document).ready(function(){
    var globalName = '<input type="text" class="form-control" name="colums_name[]" onchange="save_change('+iteration+','+"'"+'name'+"'"+')" id="colums_name'+iteration+'" placeholder="Nama kolom" value="id">';
    var tipedata = '<select type="text" class="form-control" name="datatype[]" id="datatype'+iteration+'" onchange="save_change('+iteration+','+"'"+'datatype'+"'"+')">';
    tipedata+= "<option value='INT'>INT</option>";
    tipedata+= innerdatatype;
    tipedata+='</select>';

    var length_set = '<input type="text" class="form-control" name="length_set[]" id="length_set'+iteration+'" onchange="save_change('+iteration+','+"'"+'length_set'+"'"+')" value="11">';
    var allow_null = '<select type="text" name="isnull_[]" id="isnull_'+iteration+'" onchange="save_change('+iteration+','+"'"+'allow_null'+"'"+')">'+
                                '<option value="N">N</option>'+
                                '<option value="Y">Y</option>'+
                            '</select>';
    var is_primary = '<select type="text" name="isprimary[]" id="isprimary'+iteration+'" onchange="save_change('+iteration+','+"'"+'is_primary'+"'"+')">'+
                                '<option value="Y">Y</option>'+
                                '<option value="N">N</option>'+
                            '</select>';
    var is_auto = '<select onkeyup="last_row(event)" type="text" name="is_auto[]" id="is_auto'+iteration+'" onchange="save_change('+iteration+','+"'"+'is_auto'+"'"+')">'+
                                '<option value="Y">Y</option>'+
                                '<option value="N">N</option>'+
                            '</select>';
    local_save = [];

    global_iteration_save = [];
    $("#btn-hapus").hide();

    local_save['name'] = globalName;
    local_save['tipe'] = tipedata;
    local_save['length_set'] = length_set;
    local_save['allow_null'] = allow_null;
    local_save['is_primary'] = is_primary;
    local_save['is_auto'] = is_auto;
    global_save[iteration] = local_save;
    iteration+=1;
    refresh();
});

function Petunjuk()
{
    $("#modal_petunjuk").modal("show");
}

function add_columns(){
    var globalName = '<input type="text" class="form-control" name="colums_name[]" onchange="save_change('+iteration+','+"'"+'name'+"'"+')" id="colums_name'+iteration+'" placeholder="Nama kolom">';
    var tipedata = '<select type="text" class="form-control" name="datatype[]" id="datatype'+iteration+'" onchange="save_change('+iteration+','+"'"+'datatype'+"'"+')">';
    tipedata+= "<option value='VARCHAR'>VARCHAR</option>"
    tipedata+= innerdatatype;
    tipedata+='</select>';

    var length_set = '<input type="text" class="form-control" name="length_set[]" id="length_set'+iteration+'" onchange="save_change('+iteration+','+"'"+'length_set'+"'"+')">';
    var allow_null = '<select type="text" name="isnull_[]" id="isnull_'+iteration+'" onchange="save_change('+iteration+','+"'"+'allow_null'+"'"+')">'+
                                '<option value="Y">Y</option>'+
                                '<option value="N">N</option>'+
                            '</select>';
    var is_primary = '<select onkeyup="last_row(event)" type="text" name="isprimary[]" id="isprimary'+iteration+'" onchange="save_change('+iteration+','+"'"+'is_primary'+"'"+')">'+
                                '<option value="N">N</option>'+
                                '<option value="Y">Y</option>'+
                            '</select>';
    var is_auto = '<select onkeyup="last_row(event)" type="text" name="is_auto[]" id="is_auto'+iteration+'" onchange="save_change('+iteration+','+"'"+'is_auto'+"'"+')">'+
                                '<option value="N">N</option>'+
                                '<option value="Y">Y</option>'+
                            '</select>';
    local_save = [];

    global_iteration_save = [];
    $("#btn-hapus").hide();

    local_save['name'] = globalName;
    local_save['tipe'] = tipedata;
    local_save['length_set'] = length_set;
    local_save['allow_null'] = allow_null;
    local_save['is_primary'] = is_primary;
    local_save['is_auto'] = is_auto;
    global_save[iteration] = local_save;
    iteration+=1;
    refresh();
    var panjang = global_save.length - 1;
    setTimeout(function() { $('#colums_name'+panjang).focus() }, 500);
}

function save_change(id, columndatatype)
{
    if (columndatatype=="name") {
        global_save[id]['name'] = '<input type="text" class="form-control" name="colums_name[]" onchange="save_change('+id+','+"'"+'name'+"'"+')" id="colums_name'+id+'" placeholder="Nama kolom" value="'+$("#colums_name"+id).val()+'">';
    }
    else if (columndatatype=="datatype") {
        var tipedata = '<select type="text" class="form-control" name="datatype[]" id="datatype'+id+'" onchange="save_change('+id+','+"'"+'datatype'+"'"+')">';
        tipedata+= '<option value="'+$('#datatype'+id).val()+'" selected>'+$('#datatype'+id).val()+'</option>';
        tipedata+= innerdatatype;
        tipedata+='</select>';
        global_save[id]['tipe'] = tipedata;
        if (no_length_type.includes($('#datatype'+id).val())) {
            global_save[id]['length_set'] = '<input type="text" readonly class="form-control" name="length_set[]" id="length_set'+id+'" value="" onchange="save_change('+id+','+"'"+'length_set'+"'"+')">';
        }
        else if ($('#datatype'+id).val()=='ENUM') {
            global_save[id]['length_set'] = '<input type="text" class="form-control" name="length_set[]" id="length_set'+id+'" value="'+"'"+"Y"+"'"+", '"+"N"+"'"+'" onchange="save_change('+id+','+"'"+'length_set'+"'"+')">';
        }
        else {
            global_save[id]['length_set'] = '<input type="text" class="form-control" name="length_set[]" id="length_set'+id+'" value="'+$('#length_set'+id).val()+'" onchange="save_change('+id+','+"'"+'length_set'+"'"+')">';
        }
    }
    else if (columndatatype=="length_set") {
        global_save[id]['length_set'] = '<input type="text" class="form-control" name="length_set[]" id="length_set'+id+'" value="'+$('#length_set'+id).val()+'" onchange="save_change('+id+','+"'"+'length_set'+"'"+')">';
    }
    else if (columndatatype=="allow_null") {
        
        var allow_null = '<select type="text" name="isnull_[]" id="isnull_'+id+'" onchange="save_change('+id+','+"'"+'allow_null'+"'"+')">'+
                '<option value="'+$("#isnull_"+id).val()+'">'+$("#isnull_"+id).val()+'</option>'+
                '<option value="Y">Y</option>'+
                '<option value="N">N</option>'+
            '</select>';
        global_save[id]['allow_null'] = allow_null;
    }
    else if (columndatatype=="is_primary") {
        var is_primary = '<select type="text" onkeyup="last_row(event)" name="isprimary[]" id="isprimary'+id+'" onchange="save_change('+id+','+"'"+'is_primary'+"'"+')">'+
                '<option value="'+$("#isprimary"+id).val()+'">'+$("#isprimary"+id).val()+'</option>'+
                '<option value="N">N</option>'+
                '<option value="Y">Y</option>'+
            '</select>';
        global_save[id]['is_primary'] = is_primary;
    }
    else if (columndatatype=="is_auto") {
        var is_auto = '<select onkeyup="last_row(event)" type="text" name="is_auto[]" id="is_auto'+id+'" onchange="save_change('+id+','+"'"+'is_auto'+"'"+')">'+
                        '<option value="'+$("#is_auto"+id).val()+'">'+$("#is_auto"+id).val()+'</option>'+
                        '<option value="N">N</option>'+
                        '<option value="Y">Y</option>'+
                    '</select>';
        global_save[id]['is_auto'] = is_auto;
    }
    refresh();
}

function last_row(event)
{
    var x = event.which || event.keyCode;
    if (x==9) {
        add_columns();
    }
}

function refresh()
{
    var strings = "";
    for (var i = 0; i < global_save.length; i++) {
        strings+="<tr>";
        strings+='<td><input type="checkbox" style="cursor: pointer;" id="checkit'+i+'" onclick="checkMe('+i+')"></td>';
        strings+="<td>";
        strings+=   global_save[i]['name'];
        strings+="</td>";
        strings+="<td>";
        strings+=   global_save[i]['tipe'];
        strings+="</td>";
        strings+="<td>";
        strings+=   global_save[i]['length_set'];
        strings+="</td>";
        strings+="<td>";
        strings+=   global_save[i]['allow_null'];
        strings+="</td>";
        strings+="<td>";
        strings+=   global_save[i]['is_primary'];
        strings+="</td>";
        strings+="<td>";
        strings+=   global_save[i]['is_auto'];
        strings+="</td>";
        strings+="</tr>";
    }
    $("#columdatas").html(strings);
}

function checkMe(id){
    x = document.getElementById("checkit"+id).checked;
    if (x == true) {
        if (!global_iteration_save.includes(id)) {
            global_iteration_save.push(id);
        }
    }
    else
    {
        if (global_iteration_save.includes(id)) {
            var key = global_iteration_save.indexOf(id);
            global_iteration_save.splice(key,1);
        }
    }

    if (global_iteration_save.length>0) {
        $("#btn-hapus").show();
    }
    else{
        $("#btn-hapus").hide();
    }
    console.log(global_iteration_save);
}

function remove_columns()
{
    global_iteration_save.sort();
    global_iteration_save.reverse();
    for (var i = 0; i < global_iteration_save.length; i++) {
        global_save.splice(global_iteration_save[i],1);
    }
    iteration = global_save.length;
    global_iteration_save = [];
    $("#btn-hapus").hide();
    refresh();
}

function build()
{
    var textStatus = validator();
    if (textStatus['status'] == "true") {
        $("#btn-simpan").html('Sedang menyimpan....');
        $('#btn-simpan').attr('disabled',true);
        $.ajax({
            url : "<?php echo base_url() ?>/setting/generator_/build",
            type: "POST",
            data: $("#save_table").serialize()+"&"+$('#menus').serialize(),
            dataType: "JSON",
            async: false,
            success: function(inserted)
            {
                $("#btn-simpan").html('<i class="fa fa-save"></i> Save</button>');
                $('#btn-simpan').attr('disabled',false);
                swal({   
                    title: "Access Control",   
                    text: "Langsung beri hak aksess ke user ini?",   
                    type: "warning",   
                    showCancelButton: true,   
                    confirmButtonColor: "#DD6B55",   
                    confirmButtonText: "Iya",   
                    cancelButtonText: "Tidak",   
                    closeOnConfirm: true,
                    closeOnCancel: true 
                }, function(isConfirm){   
                    if (isConfirm) {

                        $.ajax({
                            url : "<?php echo base_url(); ?>setting/generator_/access_control_builder",
                            type: "POST",
                            dataType: "JSON",
                            data: inserted,
                            success: function(data)
                            {
                                
                                swal({   
                                    title: "Nice!",   
                                    text: "Langsung ke halaman menu ya telah dibuat?",   
                                    type: "warning",   
                                    showCancelButton: true,   
                                    confirmButtonColor: "#DD6B55",   
                                    confirmButtonText: "Iya",   
                                    cancelButtonText: "Tidak",   
                                    closeOnConfirm: true,
                                    closeOnCancel: true 
                                }, function(isConfirm){   
                                    if (isConfirm) {
                                        window.location.replace("<?php echo base_url() ?>/"+data['url']);
                                    }
                                });
                            },
                            error: function (jqXHR, textStatus, errorThrown)
                            {
                                alert('Error get data from ajax');
                            }
                        });
                        
                    }
                });
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Aw!", "Ooops, ada kesalahan nih check lagi ya!", "warning");
                $("#btn-simpan").html('<i class="fa fa-save"></i> Save</button>');
                $('#btn-simpan').attr('disabled',false); //set button enable
            }
        });
    }
    else
    {
        if (textStatus['warning'].length == 0) {
            swal("Failed!", "Isi data secara lengkap bos!", "warning");
        }
        else{
            teksting = "";
            for (var i = 0; i < textStatus['warning'].length; i++) {
                teksting+=textStatus['warning'][i]+"\n";
            }
            swal("Failed!", teksting, "warning");
            
        }
    }
    
}

function validator()
{
    var textStatus = "true";
    var warning = [];
    var output = [];
    if (global_save.length<1) {
        textStatus = "false";
        warning.push("Kok ga ada kolom sih!");
    }
    else if (global_save.length<2) {
        textStatus = "false";
        warning.push("Masa cuma 1 kolom sih. minimal ada id dan 1 kolom lagi, rugi buat gw!");
    }
    else
    {
        for (var i = 0; i < global_save.length; i++) {
            if ($("#colums_name"+i).val()=="") {
                textStatus = "false";
                $("#colums_name"+i).addClass("is-invalid");
                notif_warning("#colums_name"+i,'Wajib diisi !');
            }
            else {
                $("#colums_name"+i).removeClass("is-invalid");
                $("#colums_name"+i).next().text("");
            }

            if (no_length_type.includes($("#datatype"+i).val())) {
                $("#length_set"+i).removeClass("is-invalid");
                $("#length_set"+i).next().text("");
            }
            else {
                if ($("#length_set"+i).val()=="") {
                    textStatus = "false";
                    $("#length_set"+i).addClass("is-invalid");
                    notif_warning("#length_set"+i,'Wajib diisi !');
                }
                else {
                    $("#length_set"+i).removeClass("is-invalid");
                    $("#length_set"+i).next().text("");
                }
                
            }
        }
    }
    if ($("#menu_name").val()=="") {
        textStatus = "false";
        $("#menu_name").addClass("is-invalid");
        notif_warning('#menu_name','Wajib diisi !');
    }
    else
    {
        table_checker();
    }
    if ($("#modul_id").val()=="") {
        textStatus = "false";
        $("#modul_id").addClass("is-invalid");
        notif_warning('#modul_id','Wajib diisi !');
    }
    else
    {
        $("#modul_id").removeClass("is-invalid");
        $("#modul_id").next().text("");
    }
    
    output['status'] = textStatus;
    output['warning'] = warning;
    return output;
}

function table_checker()
{
    textStatus = "true";
    $.ajax({
        url : "<?php echo base_url() ?>/setting/generator_/table_checker",
        type: "POST",
        data: $('#menus').serialize(),
        dataType: "JSON",
        async: false,
        success: function(data)
        {
            if (data=="false") {

                textStatus = "false";
                $("#menu_name").addClass("is-invalid");
                notif_warning("#menu_name",'Tabelnya sudah ada boss!');
            }
            else
            {
                $("#menu_name").removeClass("is-invalid");
                $("#menu_name").next().text("");
            }
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btn-simpan').text('Menyimpan...'); //change button text
            $('#btn-simpan').attr('disabled',false); //set button enable 
        }
    });
    if (textStatus=="false") {
        return textStatus;
    }
    
}

$('#modul_id').select2({
    placeholder : "Nama modul",
    allowClear : true,
    ajax: {
        url: '<?php echo base_url(); ?>setting/generator_/select2_modul',
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
            url: '<?php echo base_url(); ?>setting/generator_/select2_modul',
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
        $('#modul_id').val(data.id);
        return data.nama;
    },
    escapeMarkup: function (m) { return m; } // we do not want to escape markup since we are displaying html in results
}).on('select2-clearing', function(){
    $('.btn-simpan').attr('disabled',false);
});
</script>