
<?php 
$modul['modul'] = $this->db->get("modul")->result();

?>
      <!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
        <h1>Menu <?= $this->uri->segment(2) ?></h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#"><?= $this->uri->segment(1) ?></a></div>
            <div class="breadcrumb-item"><a href="#"><?= $this->uri->segment(2) ?></a></div>
            
        </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Halaman manajemen <?= $this->uri->segment(2) ?></h2>
            <p class="section-lead">Halaman ini digunakan untuk mengelola data <?= $this->uri->segment(2) ?>.</p>
            <div class="card">
                <div class="card-header">
                    <h4>Data Hak akses user</h4>
                </div>
                
                <div class="card-body">
                    <?php $user_privilege = $this->db->get('user_privilege')->result(); ?>
                    <div class="col-12 col-md-12 col-lg-12">
                        <select class="form-control" id="user_privilege-id">
                            <?php foreach ($user_privilege as $key => $value): ?>
                                <option value="<?= $value->id ?>"><?= $value->nama ?></option>
                            <?php endforeach ?>
                            
                        </select>
                    </div>
                    <hr>
                    
                    <div class="col-12 col-md-12 col-lg-12">
                        <?php $modul = $this->db->get('modul')->result(); ?>
                        <?php foreach($modul as $key){ if($key->nama!='Generator Ajax'){?>
                            <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="mod-<?= $key->id ?>" onclick="modul_all('<?= $key->id ?>')">
                                        <label class="form-check-label" for="mod-<?= $key->id ?>">
                                            <?= $key->nama ?>
                                        </label>
                                        <?php $menu = $this->db->get_where('menu', array('id_modul'=>$key->id))->result(); ?>
                                        <?php foreach($menu as $x){?>
                                            <div class="form-check">
                                                <input class="form-check-input <?= $key->id ?>-mod" onclick="menu_('<?= $x->id ?>')" data-tes="<?= $x->id ?>" data-modul="<?= $key->id ?>" type="checkbox" id="m-<?= $x->id ?>">
                                                <label class="form-check-label" for="m-<?= $x->id ?>">
                                                    <?= $x->menu_nama ?>
                                                </label>
                                            </div>
                                        <?php }?>
                                    </div>
                            </div>
                        <?php }}?>
                    </div>
                </div>
                <div class="card-footer bg-whitesmoke">
                    <button type="button" class="btn btn-primary" id="btn-simpan-1">Simpan</button>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
var save_method = "add";
var global_id;
var all_menus = [
    <?php $mm = $this->db->get('menu')->result(); foreach ($mm as $key => $value): ?>
        "<?= $value->id ?>",
    <?php endforeach ?>
    ];
var all_moduls = [
    <?php foreach ($modul as $key => $value): ?>
        "<?= $value->id ?>",
    <?php endforeach ?>
];
var global_menu = [];
var temp_mod = [];
var temp_men = [];

$(document).ready(function(){
    show_privilege();

});

$('#user_privilege-id').change(function(e){
    show_privilege();
});

function show_privilege()
{
    $.ajax({
        url : "<?= base_url() ?>setting/User_privilege/show_privilege",
        type: "POST",
        data: {user_privilege: $("#user_privilege-id").val()},
        dataType: "JSON",
        async: false,
        success: function(data)
        {
            
            temp_men = [];
            temp_mod = [];
            global_menu = [];
            for (var i = 0; i < data.length; i++) {

                temp_men.push(data[i].id_menu);
                temp_mod.push(data[i].id_modul);
                if (data[i].id_menu!=null) {
                    global_menu.push(data[i].id_modul+"|"+data[i].id_menu);
                }
                else
                {
                    global_menu.push(data[i].id_modul+"| ");
                }
            }

            for (var i = 0; i < all_moduls.length; i++) {
                if (!temp_mod.includes(all_moduls[i])) {
                    $("#mod-"+all_moduls[i]).prop('checked', false);
                }
                else
                {
                    $("#mod-"+all_moduls[i]).prop('checked', true);
                }

                
            }

            for (var i = 0; i < all_menus.length; i++) {
                if (!temp_men.includes(all_menus[i])) {
                    $("#m-"+all_menus[i]).prop('checked', false);

                }
                else
                {
                    $("#m-"+all_menus[i]).prop('checked', true);
                }
            }

            console.log(global_menu);
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            
        }
    });
}

function modul_all(id)
{
    if ($("#mod-"+id).is(':checked')) {
        adding_arre(id, 'modul');
    }
    else
    {
        remove_arre(id, 'modul');
    }
}

function menu_(id){
    if ($("#m-"+id).is(':checked')) {
        if (!global_menu.includes($("#m-"+id).data('modul')+"|"+$("#m-"+id).data('tes'))) {
            global_menu.push($("#m-"+id).data('modul')+"|"+$("#m-"+id).data('tes'));
        }
        console.log(global_menu);
    }
    else
    {
        item = $("#m-"+id).data('modul')+"|"+$("#m-"+id).data('tes');
        var index = global_menu.indexOf(item);
        if (index!==-1) {
            global_menu.splice(index, 1);
        }
        console.log(global_menu);
    }
}

function adding_arre(id, type)
{
    $("."+id+"-mod").prop('checked', true);
    if (type=='modul') {
        var check_mod = [];
        $("."+id+"-mod").each(function(){
            
            check_mod.push($(this).data('modul')+"|"+$(this).data('tes'));
            if (!global_menu.includes($(this).data('modul')+"|"+$(this).data('tes'))) {
                global_menu.push($(this).data('modul')+"|"+$(this).data('tes'));
            }
            
        });
        if (check_mod.length<1) {
            if (!global_menu.includes(id)) {
                global_menu.push(id+"| ");
            }
        }
        // console.log(check_mod.length);
        
        console.log(global_menu);
    }
    
}

function remove_arre(id, type)
{
    $("."+id+"-mod").prop('checked', false);
    if (type=='modul') {
        $("."+id+"-mod").each(function(){
            item = $(this).data('modul')+"|"+$(this).data('tes');
            var index = global_menu.indexOf(item);
            if (index!==-1) {
                global_menu.splice(index, 1);
            }
        });
        var check_mod = id;
        var index = global_menu.indexOf(id+"| ");
        if (index!==-1) {
            global_menu.splice(index, 1);
        }
        
        console.log(global_menu);
    }
}

$("#btn-simpan-1").click(function(){
    $.ajax({
        url : "<?= base_url() ?>setting/User_privilege/access_control",
        type: "POST",
        data: {akses: global_menu, user_privilege: $("#user_privilege-id").val()},
        dataType: "JSON",
        success: function(data)
        {
            $('#btn-simpan-1').text('Simpan'); //change button text
            $('#btn-simpan-1').attr('disabled',false); //set button enable 
            swal("Success!", "Data berhasil disimpan!", "success");
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btn-simpan-1').text('Menyimpan...'); //change button text
            $('#btn-simpan-1').attr('disabled',false); //set button enable 
        }
    });
});
</script>