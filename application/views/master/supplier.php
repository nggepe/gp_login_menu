
<?php 
$modul['modul'] = $this->db->get("modul")->result();
$this->load->view('admin_design/header', $modul); 
?>
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
        <h2 class="section-title">Halaman <?= $this->uri->segment(2) ?></h2>
        <p class="section-lead">Buat halaman <?= $this->uri->segment(1) ?> disini.</p>
        <div class="card">
            <div class="card-header">
            <h4>Example Card</h4>
            </div>
            <div class="card-body">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
            proident, sunt in culpa qui officia deserunt mollit anim id est laborum. <b>
            </p>
            </div>
            <div class="card-footer bg-whitesmoke">
            This is card footer
            </div>
        </div>
        </div>
    </section>
</div>
<?php $this->load->view('admin_design/footer', $modul); ?>
