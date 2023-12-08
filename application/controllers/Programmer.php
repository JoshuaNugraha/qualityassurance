<?php defined('BASEPATH') OR exit('No direct script access allowed');

 
class Programmer extends CI_Controller
{

 	public function __construct()
	{
		parent::__construct();
          if(!$this->session->userdata('user_id')){
             redirect('login', 'refresh');
          }
        $this->load->library('bot_tele');

        $this->load->model('Admin');
	}

    function master_komplain(){
        $user_id = $this->session->userdata('user_id');
        $group_id = $this->Admin->get_group($user_id);
        $data['menu'] = $this->Admin->get_menu($group_id);
        $data['user'] = $this->Admin->get_user($user_id);
        $data['page'] = 'programmer/komplain';
        $data['title'] = 'Komplain';
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


        $query = $this->db->select(['a.id', 'a.create_at' , 'a.id_user_booble','a.komplain' , 'a.priority', 'a.status', 'a.device'])
        ->where($where)
        ->or_where('tipe', 'Request CS')
        ->from('komplain a');
        $column_order = array('a.create_at', '');
		$column_search = array('a.id', 'a.create_at');
		$order = array('a.id' => 'DESC');
        
		$list = $this->datatables->get_datatables($query, $column_order, $column_search, $order);
		$data = array();
		$no = $_POST['start'];
		$i 	= 1;
        $data = array();
        $row = array();
        $status = array('Pending', 'Proses', 'Testing QA');
        foreach ($list['result'] as $tampil) {
            $row['no'] = $i;
            $get_user = $this->db->get_where('users_booble', ['id' => $tampil->id_user_booble])->row('nm_user');
            $row['nm_user'] = $get_user;        
            $row['komplain'] =   $tampil->komplain;
            // $row['priority'] = $tampil->priority;
            $html = "";
            for($j=0; $j<count($status); $j++){
                $selected = "";
                if($tampil->status == $status[$j]){
                    $selected = "selected";
                }
                $html .= "<option value='".$status[$j]."' ".$selected." >". $status[$j] ."</option>";
            }
            $row['status'] = '<select class="form-control" id="prio_'.$tampil->id.'" onchange="ganti_status(\''.$tampil->id.'\')">'. $html . '</select>';
            if($tampil->priority == 'Low'){
                $row['priority'] = '<span class="badge_bb badge_bb-secondary">Low</span>' ;
            }elseif($tampil->priority == 'Medium'){
                $row['priority'] = '<span class="badge_bb badge_bb-info">Medium</span>' ;  
            }elseif($tampil->priority == 'High'){
                $row['priority'] = '<span class="badge_bb badge_bb-success">High</span>' ;
            }elseif($tampil->priority == 'Very High'){
                $row['priority'] = '<span class="badge_bb badge_bb-warning">Very High</span>' ;
            }elseif($tampil->priority == 'Emergency'){
                $row['priority'] = '<span class="badge_bb badge_bb-warning">Emergecy</span>' ;
            }elseif($tampil->priority == 'Very Low'){
                $row['priority'] = '<span class="badge_bb badge_bb-secondary">Very Low</span>' ;
            }
            $row['device'] = $tampil->device ;
            $row['aksi'] = "<div class='button-list'>
                                        <button type='button' onclick='section2(" . $tampil->id . ");' class='btn btn-primary waves-effect waves-light btn-sm' >
                                          Detail
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


    function ganti_status(){
        $id = $this->input->post('id');
        $val = $this->input->post('val');
        
        $data = array(
            'status' => $val
        );
        $this->db->where('id', $id);
        $up = $this->db->update('komplain', $data);
        if($up){
                if($val == 'Testing QA' || $val == 'Selesai'){
                    $kom = $this->Admin->get_komplain($id);
                    $send_msg = $this->bot_tele->send_msg_status($kom->id, $kom->device, $kom->status, $kom->komplain, $kom->nm_user, $kom->priority);
                    if(!$send_msg){
                        echo json_encode(['status' => false]);
                    die();
                }
            }
        }
        echo json_encode(['status' => true]);
        
    }

    function get_komplain_by_id(){
        $id = $this->input->post('id');

        $get = $this->db->query("SELECT a.*,DATE(a.create_at) as tanggal_masuk, b.nm_user FROM komplain a JOIN users_booble b ON a.id_user_booble=b.id
        WHERE a.id = '$id'")->row();

        $file_kom = $this->db->get_where('komplain_file', ['id_komplain' => $id]);
        $foto = array();
        $video = array();
        $file = array();

        if($file_kom->num_rows() > 0){
            foreach($file_kom->result() as $fk){
                if($fk->tipe=='foto'){
                    $foto[] = '<img src="'.base_url().'/assets/upload/komplain/'.$fk->file.'" id="foto_'.$fk->id.'" onclick="image_kom(\''.$fk->id.'\')"  class="image_kom">';
                }
                if($fk->tipe=='video'){
                    $video[] = '<video width="400" controls><source src="'.base_url().'/assets/upload/komplain/'.$fk->file.'" type="video/mp4"></video>';
                }
                if($fk->tipe=='file'){
                    $file[] = '<img src="'.base_url().'/assets/upload/komplain/'.$fk->file.'"   class="image_kom">';
                }
            }
        }
        $file_arr = array(
            'foto' => $foto,
            'video' => $video,
            'file' => $file
        );

       

        echo json_encode(['status' => true, 'html' => $get, 'file' => $file_arr, 'id' => $id]);
    }


}