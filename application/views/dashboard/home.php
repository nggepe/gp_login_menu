<?php $loginsession = $this->session->userdata('loginsession');?>
      <!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
        <h1>Dashboard</h1>
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
            <h4>User & Agent</h4>
            </div>
            <div class="card-body row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-circle"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>IP Address</h4>
                            </div>
                            <div class="card-body">
                                <?php echo $alamat_ip ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="far fa-newspaper"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Platform</h4>
                            </div>
                            <div class="card-body">
                                <?php echo $platform ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="far fa-file"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Browser</h4>
                            </div>
                            <div class="card-body">
                                <?php echo $agent ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card col-md-12">
                    <div class="card-header">
                        <h4>Profil</h4>
                    </div>
                    <div class="card-body">
                        <div class="row pb-2">
                            <div class="col-md-2 col-sm-4">
                                <div class="avatar-item mb-0">
                                    <img alt="image" src="<?= base_url() ?>assets/admin/assets/img/avatar/avatar-4.png" class="img-fluid" data-toggle="tooltip" title="Egi Ferdian">
                                    <div class="avatar-badge" title="Admin" data-toggle="tooltip"><i class="fas fa-cog"></i></div>
                                </div>
                            </div>
                            <div class="col-md-10 col-sm-8">
                                <table>
                                    <tr>
                                        <td >Nama</td>
                                        <td class="text-left" width="2%">:</td>
                                        <td><b><?= $loginsession['nama'] ?></b></td>
                                    </tr>
                                    <tr>
                                        <td >Username</td>
                                        <td class="text-left" width="2%">:</td>
                                        <td><b><?= $loginsession['username'] ?></b></td>
                                    </tr>
                                    <tr>
                                        <td >Alamat</td>
                                        <td class="text-left" width="2%">:</td>
                                        <td><b><?= $loginsession['alamat'] ?></b></td>
                                    </tr>
                                    <tr>
                                        <td >Nomor Telepon</td>
                                        <td class="text-left" width="2%">:</td>
                                        <td><b><?= $loginsession['no_telp'] ?></b></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-footer bg-whitesmoke">
                Support By Gilang Pratama
            </div>
        </div>
        </div>
    </section>
</div>

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

    function trigger_clicks(element)
    {
        $('#'+element).trigger("click");
    }
</script>
