<?php defined('BASEPATH') OR exit('No direct script access allowed');

 
class Cs extends CI_Controller
{

 	public function __construct()
	{
		parent::__construct();
          if(!$this->session->userdata('user_id')){
             redirect('login', 'refresh');
          }
        //   if($this->session->userdata('group_id') !== '4'){
        //     redirect('404_override', 'refresh');
        //   }
        $this->load->library('bot_tele');
        $this->load->library('Tools');
        $this->load->model('Admin');
        

	}

    function master_komplain(){
        $user_id = $this->session->userdata('user_id');
        $group_id = $this->Admin->get_group($user_id);
        $data['menu'] = $this->Admin->get_menu($group_id);
        $data['user'] = $this->Admin->get_user($user_id);
        $data['page'] = 'cs/komplain';
        $data['title'] = 'Komplain';
        $this->load->view('dashboard/index', $data);
    }

    function laporan_komplain(){
        $user_id = $this->session->userdata('user_id');
        $group_id = $this->Admin->get_group($user_id);
        $data['menu'] = $this->Admin->get_menu($group_id);
        $data['user'] = $this->Admin->get_user($user_id);
        $data['page'] = 'cs/laporan_komplain';
        $data['title'] = 'Laporan Komplain';
        $this->load->view('dashboard/index', $data);
    }


    function get_komplain(){
        $user = $this->input->post('user', true);
        $status = $this->input->post('status', true);
        $date_1 = $this->input->post('date_1', true);
        $date_2 = $this->input->post('date_2', true);
        $where = array(
            "tipe" => "komplain"
        );
        if($user !== "" && $user !== null){
            $where['id_user_booble'] =  $user;
        }
        if($status !== ""  && $status !== null){
            $where['status'] =  $status;
        }
        if($date_1 !== ""  && $date_1 !== null){
            $where['DATE(last_update) >= '] =  $date_1;
        }
        if($date_2 !== ""  && $date_2 !== null){
            $where['DATE(last_update) <= '] =  $date_2;
        }


        $query = $this->db->select(['a.id', 'a.id_user_booble','a.komplain' , 'a.priority', 'a.status', 'a.device', 'DATE(a.create_at) as create_at'])
        ->where($where)
        ->or_where('tipe', 'Request CS')
        ->from('komplain a')
        ->order_by('a.create_at', 'desc');
        $column_order = array('id', 'create_at');
		$column_search = array('a.id', 'a.create_at');
		$order = array('a.create_at' => 'DESC');
        
		$list = $this->datatables->get_datatables($query, $column_order, $column_search, $order);
		$data = array();
		$no = $_POST['start'];
		$i 	= 1;
        $data = array();
        $row = array();
        $priority = array('Very Low', 'Low', 'Medium', 'High', 'Very High', 'Emergency');
        foreach ($list['result'] as $tampil) {
            $row['no'] = $i;
            $row['tgl_masuk'] = $tampil->create_at;
            $get_user = $this->db->get_where('users_booble', ['id' => $tampil->id_user_booble])->row('nm_user');
            $row['nm_user'] = $get_user;        
            $row['komplain'] =   $tampil->komplain;
            $row['priority'] = $tampil->priority;
            $html = "";
            for($j=0; $j<count($priority); $j++){
                $selected = "";
                if($tampil->priority == $priority[$j]){
                    $selected = "selected";
                }
                $html .= "<option value='".$priority[$j]."' ".$selected." >". $priority[$j] ."</option>";
            }
            $row['priority'] = '<select class="form-control" id="prio_'.$tampil->id.'" onchange="ganti_priority(\''.$tampil->id.'\')">'. $html . '</select>';
            if($tampil->status == 'Pending'){
                $row['status'] = '<span class="badge_bb badge_bb-secondary">Pending</span>' ;
            }elseif($tampil->status == 'Proses'){
                $row['status'] = '<span class="badge_bb badge_bb-info">Proses</span>' ;  
            }elseif($tampil->status == 'Selesai'){
                $row['status'] = '<span class="badge_bb badge_bb-success">Selesai</span>' ;
            }elseif($tampil->status == 'Testing QA'){
                $row['status'] = '<span class="badge_bb badge_bb-warning">Testing QA</span>' ;
            }
            $row['device'] = $tampil->device ;
            $row['aksi'] = "<div class='button-list'>
                                        <button type='button' onclick='edit(" . $tampil->id . ");' class='btn btn-twitter waves-effect waves-light btn-sm' >
                                           <i class='fa fa-pencil-square-o'></i>
                                        </button>
                               
										<button class='btn btn-danger waves-effect waves-light btn-sm' onclick='hapus(" . $tampil->id . ");'>
											<i class='fa fa-trash-o'></i>
										</button>
                        	</div>";
             
            $data[] = $row;
            $i++;
        }

        $output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->datatables->count_all($query),
			"recordsFiltered" => $list['count_filtered'],
			"data" => $data
		);
		echo json_encode($output);
    }

    function get_komplain_by_id(){
        $id = $this->input->post('id');
        $get_komplain = $this->db->get_where('komplain', ['id' => $id])->row();
        $data = array(
            'komplain' => $get_komplain,
            'file' => []
        );
        $cek_file = $this->db->get_where('komplain_file', ['id_komplain' => $get_komplain->id]);
        if($cek_file->num_rows() > 0){
                $files = array();
                $in_file = array();
                foreach($cek_file->result() as $cf){
                    $in_file['file'] = $cf->file;
                    $in_file['id'] = $cf->id;
                    $files[] = $in_file;
                }
                $data['file'] = $files;
        }

        echo json_encode(['status' => true, 'data' => $data]);
    }


    function get_user_booble(){
        $get_user_booble = $this->db->query("SELECT * FROM users_booble")->result();
        $html = "<option value=''>Pilih User</option>";
        foreach($get_user_booble as $gb){
            $html .= "<option value=".$gb->id.">" . $gb->nm_user . "</option>";
        }
        echo json_encode(['status' => true, 'html'=> $html]);
    }

    function get_user_booble_by_name(){
        $name = $this->input->post('user');
        $get_user_booble = $this->db->query("SELECT * FROM users_booble WHERE nm_user LIKE '%$name%'")->result();
        // $html = "<option value=''>Pilih User</option>";
        $res = array();
        foreach($get_user_booble as $gb){
            // $res_tmp = array(
            //     'id' => $gb->id,
            //     'nm_user' => $gb->nm_user
            // );
            $res[] = $gb->nm_user;
        }
        echo json_encode($res);
    }
    function ganti_prio(){
        $id = $this->input->post('id');
        $val = $this->input->post('val');
        $query = $this->db->query("UPDATE komplain SET priority='$val' WHERE id = '$id'");
        $get = $this->db->query("SELECT a.*, b.nm_user, b.id as id_booble FROM komplain a JOIN users_booble b ON a.id_user_booble=b.id ")->row();


        $send = $this->bot_tele->send_msg($get->id, $get->device, $get->status, $get->komplain, $get->nm_user, $get->priority, 'edit');
        if($send){
            echo json_encode(['status' => true]);
        }else{
            echo json_encode(['status' => false]);
        }

        
    }

    function simpan_komplain(){
        $aksi = $this->input->post('aksi');
        $user_id = $this->session->userdata('user_id');
        $today = date('Y-m-d H:i:s');
        $user_booble = $this->input->post('user_booble');
        $komplain = $this->input->post('komplain');
        $device = $this->input->post('device');
        $priority = $this->input->post('priority');
        $data = array(
            'id_user_booble' => $this->input->post('user_booble'),
            'komplain' => $this->input->post('komplain'),
            'priority' => $this->input->post('priority'),
            'tipe' => 'Komplain',
            'status' => 'Pending',
            'device' => $this->input->post('device'),
            'create_at' => $today,
            'create_by' => $user_id,
            'last_update' => $today
        );
        if($aksi == '1'){
            $in = $this->db->insert('komplain', $data);
            if($in){
                $id_kom = $this->db->insert_id();
                $fileCount = count($_FILES['file_1']['name']);
                if($fileCount > 0 && $_FILES['file_1']['name'][0] !== ""  ) {
                    for($x=0 ; $x < $fileCount ; $x++){
                        $do_up = $this->_do_upload2('file_1', 'assets/upload/komplain',  $_FILES['file_1']['name'][$x], $x);
                        if($do_up){
                            $arr_file_up = array(
                                    'id_komplain' => $id_kom,
                                    'file' => $do_up['file_name'],
                                    'tipe' => $do_up['ext']
                            );


                            $in = $this->db->insert('komplain_file', $arr_file_up);
                            
                        }
                    }
                }
                if($in){
                    $uname_booble = $this->db->get_where('users_booble',['id' => $user_booble])->row('nm_user');
                  
                    $tele = $this->bot_tele->send_msg($id_kom, $device, 'Pending', $komplain, $uname_booble, $priority, 'new');
                    // $send = $this->bot_tele->send_msg($get->id, $get->device, $get->status, $get->komplain, $get->nm_user, $get->priority, 'edit');
                    if($tele){
                           echo json_encode(['status' => true, 'id' => $id_kom]);
                            
                    }else{
                        echo json_encode(['status' => false, 'here' => 'no']);

                    }
                }

                
            }
        }else if($aksi == '2'){
            $id = $this->input->post('id');
            $data = array(
                'id_user_booble' => $this->input->post('user_booble'),
                'komplain' => $this->input->post('komplain'),
                'priority' => $this->input->post('priority'),
                'device' => $this->input->post('device'),
                'last_update' => $today
            );

            $up =  $this->db->where('id', $id);
            $query =  $this->db->update('komplain',$data);
            if($query){
                if(isset($_FILES['file_1'])){
                    $fileCount = count($_FILES['file_1']['name']);
                    if($fileCount > 0 && $_FILES['file_1']['name'][0] !== ""  ) {
                        for($x=0 ; $x < $fileCount ; $x++){
                            $do_up = $this->_do_upload2('file_1', 'assets/upload/komplain',  $_FILES['file_1']['name'][$x], $x);
                            if($do_up){
                                $arr_file_up = array(
                                    'id_komplain' => $id,
                                    'file' => $do_up['file_name'],
                                    'tipe' => $do_up['ext']
                                );

                                $this->db->insert('komplain_file', $arr_file_up);
                            }
                        }
                    }
                }
               
            }

             echo json_encode(['status' => true]);

        }
    }
    private function _do_upload2($inputname, $folder, $filename, $arr=0){
        $ekstensi_diperbolehkan    = array('png', 'jpg', 'gif', 'jpeg', 'JPG', 'mp4', '3gp', 'm4v', 'f4v', 'lrv');
        $nama = $_FILES[$inputname]['name'][$arr];
        $x = explode('.', $nama);
        $temp = explode(".", $_FILES[$inputname]["name"][$arr]);
        $newfilename =   $arr. round(microtime(true)) . '.' . end($temp);
        $ekstensi = strtolower(end($x));
        $ukuran    = $_FILES[$inputname]['size'][$arr];
        $file_tmp = $_FILES[$inputname]['tmp_name'][$arr];

        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            if ($ukuran < 100044070) {
                if (move_uploaded_file($file_tmp, $folder . '/' . $newfilename)) {
                    if($ekstensi=="png" || $ekstensi == "jpg" || $ekstensi == "jpeg"){
                        $tipe_ext = 'foto';
                    }else{
                        $tipe_ext = 'video';
                    }
                    $data['file_name'] = $newfilename;
                    $data['ext'] = $tipe_ext;
                    return $data;
                } else {
                    $data['message']    = 'Upload error: Gagal upload file...'.$inputname;
                    $data['status']        = FALSE;
                    echo json_encode($data);
                    exit();
                }
            } else {
                $data['message']    = 'Upload error: Ukuran file terlalu besar. Minimal 1 MB';
                $data['status']        = FALSE;
                echo json_encode($data);
                exit();
            }
        } else {
            $data['message']    = 'Upload error: Jenis file tidak di izinkan. Silahkan upload file png, jpg, gif, jpeg.'.$filename;
            $data['status']        = FALSE;
            echo json_encode($data);
            exit();
        }
    } 

    function delete_file(){
        $id = $this->input->post('id');
        $del = $this->db->query("DELETE FROM komplain_file WHERE id='$id'");
        if($del){
            echo json_encode(['status' => true]);
        }
    }
    
    function laporan_komplain_html(){
        $user = $this->input->post('user');
        $status = $this->input->post('status');
        $date_1 = $this->input->post('date1');
        $date_2 = $this->input->post('date2');

        $where = "";
        if($user != "" && $user != "all" ){
            $where .= " AND b.nm_user LIKE '%$user%'";
        }
        if($status != "" && $status != "all" ){
            $where .= " AND a.status = '$status'";
        }
        if($date_1 != "" ){
            $where .= " AND DATE(a.create_at) >= '$date_1' AND DATE(a.create_at) <= '$date_2' ";
        }

        $sql = "SELECT a.*, b.nm_user FROM komplain a JOIN users_booble b ON a.id_user_booble=b.id
        WHERE a.id <> '' $where";

        $data = $this->db->query($sql)->result();
        $no = 1;
        $html = "";
        foreach($data as $d){
            $html .= "<tr>
                            <td class='text-center'>".$no."</td>
                            <td class='text-center'>".$d->create_at."</td>
                            <td class='text-center'>".$d->nm_user."</td>
                            <td class='text-center'>".$d->komplain."</td>
                            <td class='text-center'>".$d->status."</td>
                    </tr>
                        ";

            $no++;
        }
        $periode_lap = $this->tools->date_to_day($date_1);
        if($date_1 != $date_2){
            $periode_lap .= " - ". $this->tools->date_to_day($date_2);
        }

        echo json_encode(['status' => true, 'html' => $html, 'sql' => $sql, 'periode' => $periode_lap]);
        
    }

    function tambah_user(){
        $data = array(
            'nm_user' => $this->input->post('nama')
        );
        $in = $this->db->insert('users_booble', $data);
        if($in){
            echo json_encode(['status' => true]);
        }else{
            echo json_encode(['status' => false]);
        }
    }

    function hapus_komplain(){
        $id = $this->input->post('id', true);
        $this->db->where('id', $id);
        $del = $this->db->delete('komplain');

        if($del) {
            echo json_encode(['status' => true]);
        }else{
            echo json_encode(['status' => false]);
        }
    }

    function get_komplain_dashboard(){
        $data = $this->Admin->get_komplain_dahsboard();

        if($data){
            echo json_encode(['status' => true, 'data' => $data]);
        }else{
            echo json_encode(['status' => false]);
        }
    }

    function get_chart(){
        $periode = $this->input->post('periode', true);
        $data = $this->Admin->get_chart($periode);
        echo json_encode(['status' => true, 'data' => $data]);
    }

    function get_most_complain(){
        $data = $this->Admin->get_most_complain();
        if(!$data){
            echo json_encode(['status' => false]);
        }else{
           echo json_encode(['status' => true, "data" => $data]);
        }
    }

}


?> 