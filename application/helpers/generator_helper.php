<?php
function controler_builder($menu_code, $column, $model_name)
{
	$column_in_ajax = "";
	for ($i=1; $i < count($column) ; $i++) { 
		$column_in_ajax.= "\$row[] = \$key->".$column[$i].";\n\t\t\t";
	}

	$filename = "./application/controllers/generated/".$menu_code.".php";
	$ourFileHandle = fopen($filename, 'w');

$written =  "
<?php
// file ini dibuat di generator Gilang Pratama
defined('BASEPATH') OR exit('No direct script access allowed');

class ".$menu_code." extends User_auth {
	function __construct(){
        parent::__construct();
        \$this->load->model('generated/".$model_name."','".$model_name."');
    }

    public function index()
    {
    	\$this->load->view('generated/V_".$menu_code."');
    }

    public function ajaxTable()
    {
    	\$list = \$this->".$model_name."->tampil();
		\$data = array();
		\$no = \$_POST['start'];
		foreach (\$list as \$key) {
			\$no++;
			\$row = array();
			\$row[] = \$no++;
			".$column_in_ajax."
			\$row[] = '<a class=\"btn btn-sm btn-primary\" href=\"javascript:void(0)\" title=\"Edit\" onclick=\"edit('.\"'\".\$key->".$column[0].".\"'\".')\"><i class=\"fa fa-edit\"></i></a>
				  <a class=\"btn btn-sm btn-danger\" href=\"javascript:void(0)\" title=\"Hapus\" onclick=\"hapus('.\"'\".\$key->".$column[0].".\"'\".')\"><i class=\"fa fa-trash\"></i></a>';
		
			\$data[] = \$row;
		}
		\$output = array(
						\"draw\" => \$_POST['draw'],
						\"recordsTotal\" => \$this->".$model_name."->count_all(),
						\"recordsFiltered\" => \$this->".$model_name."->count_filtered(),
						\"data\" => \$data
				);
		
		echo json_encode(\$output);
    }

    public function ajax_save()
	{
		\$this->".$model_name."->save(\$this->input->post());
		echo json_encode(\"success\");
	}

	public function ajax_edit(\$id)
	{
		\$this->".$model_name."->edit(\$id);
	}

	public function ajax_delete(\$id)
	{
		\$this->".$model_name."->ajax_delete(\$id);
	}

	public function ajax_update(\$id)
	{
		\$this->".$model_name."->update(\$id, \$this->input->post());
	}
}
";

	fwrite($ourFileHandle,$written);

	fclose($ourFileHandle);
}

function model_builder($menu_code, $column, $model_name)
{

	$column_in_array = "";
	foreach ($column as $key => $value) {
		$column_in_array.= "'".$value."', ";
	}

	$filename = "./application/models/generated/".$model_name.".php";
	$ourFileHandle = fopen($filename, 'w');

	$written = "<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
class ".$model_name." extends CI_Model {
	var \$table = '".$menu_code."';
	var \$column = array(".$column_in_array.");
	var \$order = array('".$column[0]."' => 'desc');


	private function _get_datatables_query()
	{
		
		\$this->db->from(\$this->table);

		\$i = 0;
	
		foreach (\$this->column as \$item) // disini ngelooping kolom
		{
			if(\$_POST['search']['value']) // jika kolom search di datatable terisi
			{
				
				if(\$i===0) // looping awal digunakan untuk open bracket atau query '('
				{
					\$this->db->group_start(); // open bracket
					\$this->db->like(\$item, \$_POST['search']['value']);
				}
				else
				{
					\$this->db->or_like(\$item, \$_POST['search']['value']);
				}

				if(count(\$this->column) - 1 == \$i) // looping terakhir untuk close bracket atau query ')'
					\$this->db->group_end(); //close bracket
			}
			\$column[\$i] = \$item; // set variable kolom
			\$i++;
		}
		
		if(isset(\$_POST['order'])) // here order processing
		{
			\$this->db->order_by(\$column[\$_POST['order']['0']['column']], \$_POST['order']['0']['dir']);
			
		} 
		else if(isset(\$this->order))
		{
			\$order = \$this->order;
			
			\$this->db->order_by(key(\$order), \$order[key(\$order)]);
		}
	}
	public function count_filtered()
	{
		\$this->_get_datatables_query();
		\$query = \$this->db->get();
		
		return \$query->num_rows();
	}

	public function count_all()
	{
		\$this->db->from(\$this->table);
		
		return \$this->db->count_all_results();
	}

	public function tampil()
	{
		\$this->_get_datatables_query();
		if(\$_POST['length'] != -1)
		\$this->db->limit(\$_POST['length'], \$_POST['start']);
		\$query = \$this->db->get();
		return \$query->result();
	}

	function save(\$data)
	{
		\$this->db->insert(\$this->table, \$data);
	}

	function update(\$id, \$data)
	{
		\$this->db->where('".$column[0]."', \$id);
		\$this->db->update(\$this->table, \$data);
		echo json_encode(\$data);
	}

	function ajax_delete(\$id)
	{
		\$this->db->where('".$column[0]."', \$id);
		\$this->db->delete(\$this->table);
		echo json_encode(\"success!\");
	}

	function edit(\$id)
	{
		\$this->db->where('".$column[0]."', \$id);
		echo json_encode(\$this->db->get(\$this->table)->row());
	}
}
	";
	fwrite($ourFileHandle,$written);

	fclose($ourFileHandle);
}

function view_builder($menu_code, $column, $menu_name){
	$column_in_thead = "";
	$column_clearing = "";

	$column_validate = "";

	$column_inform = "";
	$column_editing = "";

	for ($i=1; $i < count($column) ; $i++) { 
		$column_in_thead.= "<th>".$column[$i]."</th>\n\t\t\t\t\t\t\t\t\t";
		$column_clearing .= "\$('#".$column[$i]."').val('');\n\t";
		$column_validate .= "
	if ($(\"#".$column[$i]."\").val()==\"\") {
        \$(\"#".$column[$i]."\").addClass(\"is-invalid\");
        notif_warning('#".$column[$i]."', 'Wajib diisi!');
        status = \"false\";
    }
    else {
        \$(\"#".$column[$i]."\").removeClass(\"is-invalid\");
        \$(\"#".$column[$i]."\").next().text(\"\");
    }
		";

		$column_inform .= "<div class=\"form-group\">
		                    <label class=\"form-label\" for=\"".$column[$i]."\">".$column[$i]."</label>
		                    <input type=\"text\" class=\"form-control\" name=\"".$column[$i]."\" id=\"".$column[$i]."\" placeholder=\"".$column[$i]."\">
		                </div>\n\t\t\t\t\t\t";
		$column_editing.= "\$(\"#".$column[$i]."\").val(data.".$column[$i].");\n\t\t\t";
	}

	$filename = "./application/views/generated/V_".$menu_code.".php";
	$ourFileHandle = fopen($filename, 'w');

	$written = "

<?php 
\$modul['modul'] = \$this->db->get(\"modul\")->result();
?>

<div class=\"main-content\">
    <section class=\"section\">
        <div class=\"section-header\">
        <h1>Menu ".$menu_name."</h1>
        <div class=\"section-header-breadcrumb\">
            <div class=\"breadcrumb-item active\"><a href=\"#\"><?= \$this->uri->segment(1) ?></a></div>
            <div class=\"breadcrumb-item\"><a href=\"#\"><?= \$this->uri->segment(2) ?></a></div>

        </div>
        </div>

        <div class=\"section-body\">
	        <h2 class=\"section-title\">Halaman manajemen ".$menu_name."</h2>
	        <p class=\"section-lead\">Halaman ini digunakan untuk mengelola data ".$menu_name.".</p>
	        <div class=\"card\">
	        	<div class=\"card-header\">
	                <h4>Tabel data ".$menu_name."</h4>
	            </div>
	            
	            <div class=\"card-body\">
	                <button class=\"btn btn-md btn-info\" id=\"btn-tambah\"><i class=\"fa fa-plus\"></i> Tambah data ".$menu_name."</button>
	                <hr>
	                <div class=\"table-responsive\">
	                    <table class=\"table table-striped\" id=\"ajax_table\">
	                        <thead>
	                            <tr>
	                            	<th>No</th>
	                                ".$column_in_thead."
	                                <th>#</th>
	                            </tr>
	                        </thead>
	                        <tbody>

	                        </tbody>
	                    </table>
	                </div>
	            </div>
	            <div class=\"card-footer bg-whitesmoke\">
	            This is card footer
	            </div>
	        </div>
	    </div>
	</section>
</div>
<div class=\"modal fade\" tabindex=\"-1\" role=\"dialog\" id=\"modal_form\">
    <div class=\"modal-dialog\" role=\"document\">
    <div class=\"modal-content\">
        <div class=\"modal-header\">
        <h5 class=\"modal-title\">Modal title</h5>
        <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
            <span aria-hidden=\"true\">&times;</span>
        </button>
        </div>
        <div class=\"modal-body\">
            <form id=\"form_simpan\">
                ".$column_inform."
            </form>
        </div>
        <div class=\"modal-footer bg-whitesmoke br\">
        <button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Tutup</button>
        <button type=\"button\" class=\"btn btn-primary\" id=\"btn-simpan\"> Simpan</button>
        </div>
    </div>
    </div>
</div>


<script>
var save_method = \"add\";
var global_id;
$(document).ready(function(){
    table = \$('#ajax_table').DataTable({
        \"order\": [],
        \"ajax\": {
            \"url\": \"<?php echo base_url('generated/".$menu_code."/ajaxTable');?>\",
            \"type\": \"POST\"
        },
        \"columnDefs\": [
            {
                \"targets\": [0,1],
                \"orderable\": true,
                \"className\": \"text-center\",
            },
            {
                \"targets\": [ -1 ],
                \"orderable\": false,
                \"className\": \"text-center\",
            },
         ],
        \"serverSide\": true, //Feature control DataTables' server-side processing mode.
        \"processing\": true,

        \"scrollCollapse\": true,
    });
});

$(\"#btn-tambah\").click(function(){
    save_method = \"add\";
    clear_data();
    $(\"#modal_form\").modal(\"show\");
    $(\".modal-title\").text(\"Tambah data ".$menu_name."\");
});

function clear_data()
{
    ".$column_clearing."
}

function form_validation()
{
    var status =\"true\";
    ".$column_validate."
    return status;    
}
$(\"#btn-simpan\").click(function(){
    status = form_validation();
    $('#btn-simpan').text('Menyimpan...'); //change button text
    $('#btn-simpan').attr('disabled',true); //set button enable 
    if(status ==\"true\") {
        if (save_method==\"add\") {
            url = \"<?= base_url() ?>generated/".$menu_code."/ajax_save\";
        }
        else{
            url = \"<?= base_url() ?>generated/".$menu_code."/ajax_update/\"+global_id;
        }
        $.ajax({
            url : url,
            type: \"POST\",
            data: $('#form_simpan').serialize(),
            dataType: \"JSON\",
            success: function(data)
            {
                $('#modal_form').modal('hide');
                table.ajax.reload();
                $('#btn-simpan').text('Simpan'); //change button text
                $('#btn-simpan').attr('disabled',false); //set button enable 
                swal(\"Success!\", \"Data berhasil disimpan!\", \"success\");
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
    save_method = \"edit\";
    $.ajax({
        url : \"<?php echo base_url(); ?>generated/".$menu_code."/ajax_edit/\"+id,
        type: \"POST\",
        dataType: \"JSON\",
        success: function(data)
        {
            ".$column_editing."
            $('#modal_form').modal(\"show\");
            $(\".modal-title\").text(\"Ubah data ".$menu_name."\");
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
        title: \"Anda yakin?\",
        text: \"Data akan terhapus secara permanen!\",
        type: \"warning\",
        showCancelButton: true,   
        confirmButtonColor: \"#DD6B55\",   
        confirmButtonText: \"Ya, saya yakin!\",
        cancelButtonText: \"Tidak, batalkan!\",
        closeOnConfirm: true,
        closeOnCancel: true 
    }, function(isConfirm){   
        if (isConfirm) {

            $.ajax({
                url : \"<?php echo base_url(); ?>generated/".$menu_code."/ajax_delete/\"+id,
                type: \"POST\",
                dataType: \"JSON\",
                success: function(data)
                {
                    table.ajax.reload();
                    swal(\"Success!\", \"Data berhasil dihapus!\", \"success\");
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
	";

	fwrite($ourFileHandle,$written);

	fclose($ourFileHandle);

}
?>