<?php $loginsession = $this->session->userdata('loginsession');?>
<?php 
$modul['modul'] = $this->db->get("modul")->result();
$this->load->view('admin_design/header', $modul); 
?>
      <!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
        <h1>Tani Agung Administration</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Layout</a></div>
            <div class="breadcrumb-item">Default Layout</div>
        </div>
        </div>

        <div class="section-body">
        <h2 class="section-title">Home</h2>
        <p class="section-lead">Halaman ini hanya perias dan jalan pintas untuk menuju menu.</p>
        <div class="card card-<?= $style[array_rand($style)] ?>">
            <div class="card-header">
            <h4>Beberapa modul</h4>
            </div>
            <div class="card-body">
                
                <div class="row">
                <?php foreach ($modul['modul'] as $key => $value){ if (in_array($value->id, $loginsession['access_control']['modul'])) {?>
                        <div class="col-6 col-md-6 col-lg-6">
                            <div class="card card-<?= $style[array_rand($style)] ?>">
                                <div class="card-header" style="cursor: pointer;" onclick="trigger_clicks('<?= $value->id ?>-<?= $value->nama ?>')">
                                    <h4><i class="<?= $value->icon ?>"></i> <?= $value->nama ?></h4>
                                    <div class="card-header-action">
                                        <a id="<?= $value->id ?>-<?= $value->nama ?>" data-collapse="#mycard-collapse-<?= $value->id ?>" class="btn btn-icon btn-info" href="#"><i class="fas fa-plus"></i></a>
                                    </div>
                                </div>
                                <div class="collapse" id="mycard-collapse-<?= $value->id ?>">
                                    <div class="card-body" id="<?= $value->id ?>">
                                        <?php
                                            $this->db->where('id_modul', $value->id);
                                            $menu = $this->db->get('menu')->result();
                                            if ($menu) { $warna = $style[array_rand($style)]; ?>
                                                <?php foreach ($menu as $menu): if (in_array($menu->id, $loginsession['access_control']['menu'])) {?>
                                                    <ul class="list-group">
                                                        <a href="<?= base_url()?>/<?= $menu->url ?>">
                                                            <li class="list-group-item list-group-item-<?= $warna ?>"><?= $menu->menu_nama ?></li>
                                                        </a>
                                                    </ul>
                                                <?php } endforeach ?>
                                                
                                            <?php }
                                        ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                <?php }} ?>
                </div>
                
            </p>
            </div>
            <div class="card-footer bg-whitesmoke">
                Tani Agung
            </div>
        </div>
        </div>
    </section>
</div>
<?php $this->load->view('admin_design/footer', $modul); ?>
<script type="text/javascript">
    
    function view_all(id) {
        $.ajax({
                url : "<?= base_url() ?>dashboard/Home/search",
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

    function trigger_clicks(element)
    {
        $('#'+element).trigger("click");
    }
</script>