<?php
 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Admin extends CI_Model
{

      	public function __construct()
	{
		parent::__construct();
		// if(!$this->session->userdata('user_id')){
        //      redirect('login', 'refresh');
        // }

        $this->load->model('Admin');
        $this->load->library('datatables');
    
        

	}

    function get_group($id){
        $get = $this->db->get_where('users_groups', ['user_id' => $id])->row('group_id');

        return $get;
    }

    function get_menu($gid){
        $get = $this->db->query("SELECT a.* FROM menu a
        JOIN menu_groups b on a.id=b.id_menu
        WHERE b.id_group = '$gid' AND a.status= '1'
        ORDER BY a.urut ASC
        ")->result();

        return $get;
    }

    function get_user($uid){
        $get = $this->db->query("SELECT CONCAT(a.first_name, ' ', IFNULL( a.last_name, '')) as nama ,
        b.group_id as otoritas,
        a.username, a.email
        FROM users a
        JOIN users_groups b ON a.id=b.user_id
        JOIN groups c ON b.group_id=c.id
        WHERE a.id = '$uid'")->row();
        return  $get;
    }

    function get_komplain($id){
        $kom = $this->db->query("SELECT a.*, b.id as id_booble, b.nm_user
        FROM komplain a
        JOIN users_booble b ON a.id_user_booble=b.id
        WHERE a.id = '$id'
        ")->row();

        return $kom;
    }

    function get_komplain_dahsboard(){
        $today = date('Y-m-d');
        $lastSevenDays = date("Y-m-d", strtotime("-7 days"));
        $res['today'] = $this->db->query("SELECT COUNT(id) as hari_ini FROM komplain WHERE DATE(create_at) = '$today'")->row('hari_ini');
        $res['week'] = $this->db->query("SELECT COUNT(id) as minggu_ini FROM komplain WHERE DATE(create_at) <= '$today' AND DATE(create_at) >= '$lastSevenDays'")->row('minggu_ini');
        $res['pending'] = $this->db->query("SELECT COUNT(id) as pending FROM komplain WHERE status = 'Pending'")->row('pending');
        $res['finish_today'] = $this->db->query("SELECT COUNT(id) as finish FROM komplain WHERE DATE(create_at) = '$today' AND status = 'Selesai'")->row('finish');

        return $res;
    }

    function get_chart($periode){
        if($periode == "Tahun"){
            $data = $this->db->query("SELECT MONTH(create_at) AS bulan,  COUNT(id) AS total FROM komplain GROUP BY MONTH(create_at) ORDER BY MONTH(create_at) ASC")->result();
            $all_month = array(
                "1" => array(
                    "nama" => "Jan",
                    "val" => 0
                ),
                "2" => array(
                    "nama" => "Feb",
                    "val" => 0
                ),
                "3" => array(
                    "nama" => "Mar",
                    "val" => 0
                ),
                "4" => array(
                    "nama" => "Apr",
                    "val" => 0
                ),
                "5" => array(
                    "nama" => "Mei",
                    "val" => 0
                ),
                "6" => array(
                    "nama" => "Jun",
                    "val" => 0
                ),
                "7" => array(
                    "nama" => "Jul",
                    "val" => 0
                ),
                "8" => array(
                    "nama" => "Agu",
                    "val" => 0
                ),
                "9" => array(
                    "nama" => "Sep",
                    "val" => 0
                ),
                "10" => array(
                    "nama" => "Okt",
                    "val" => 0
                ),
                "11" => array(
                    "nama" => "Nov",
                    "val" => 0
                ),
                "12" => array(
                    "nama" => "Des",
                    "val" => 0
                )
            );
            foreach($data as $dm){
                $all_month[$dm->bulan]["val"] = $dm->total;
            }
            $data = $all_month;
            
            
        }
        elseif($periode == "Bulan"){
            $date = $this->getFirstLast();
            $first = $date['first'];
            $last = $date['last'];
            $data = $this->db->query("SELECT
                    YEAR(create_at) AS YEAR,
                    MONTH(create_at) AS MONTH,
                    WEEK(create_at) AS week_number,
                    COUNT(*) AS total_records
                FROM
                    komplain
                WHERE
                    DATE(create_at) >= '$first' AND DATE(create_at) <= '$last'
                GROUP BY
                    YEAR(create_at),
                    MONTH(create_at),
                    WEEK(create_at)
                ORDER BY
                    YEAR, MONTH, week_number")->result();    
        }
        elseif($periode == "Pekan"){
            $data = $this->db->query("SELECT
                            adw.nama,
                            COUNT(yt.create_at) AS val
                        FROM
                            (SELECT 1 AS nama
                            UNION SELECT 2
                            UNION SELECT 3
                            UNION SELECT 4
                            UNION SELECT 5
                            UNION SELECT 6
                            UNION SELECT 7) adw
                        LEFT JOIN
                            komplain yt ON adw.nama = DAYOFWEEK(yt.create_at)
                            AND WEEK(yt.create_at) = WEEK(CURDATE())
                            AND YEAR(yt.create_at) = YEAR(CURDATE())
                            AND MONTH(yt.create_at) = MONTH(CURDATE())
                        GROUP BY
                            adw.nama
                        ORDER BY
                            adw.nama
                    ")->result();

        $all_day = array(
                "1" => array(
                    "nama" => "Senin",
                    "val" => 0
                ),
                "2" => array(
                    "nama" => "Selasa",
                    "val" => 0
                ),
                "3" => array(
                    "nama" => "Rabu",
                    "val" => 0
                ),
                "4" => array(
                    "nama" => "Kamis",
                    "val" => 0
                ),
                "5" => array(
                    "nama" => "Jumat",
                    "val" => 0
                ),
                "6" => array(
                    "nama" => "Sabtu",
                    "val" => 0
                ),
                "7" => array(
                    "nama" => "Minggu",
                    "val" => 0
                )
            );
        foreach($data as $dd){
            $all_day[$dd->nama]["val"] = $dd->val;
            // if($dd->nama == "1"){$dd->nama = "Senin";}
            // if($dd->nama == "2"){$dd->nama = "Selasa";}
            // if($dd->nama == "3"){$dd->nama = "Rabu";}
            // if($dd->nama == "4"){$dd->nama = "Kamis";}
            // if($dd->nama == "5"){$dd->nama = "Jumat";}
            // if($dd->nama == "6"){$dd->nama = "Sabtu";}
            // if($dd->nama == "7"){$dd->nama = "Minggu";}
            
        }
        $data = $all_day;
        }
        
        return $data;
    }

    private function getFirstLast() {
 
        $currentMonth = date('m');
        $currentYear = date('Y');

        // Get the first date of the month
        $firstDate = date('Y-m-01', strtotime("$currentYear-$currentMonth"));

        // Get the last date of the month
        $lastDate = date('Y-m-t', strtotime("$currentYear-$currentMonth"));
        $res['first'] = $firstDate;
        $res['last'] = $lastDate;

        return $res;
    }

    function get_most_complain(){
        $data = $this->db->query("SELECT COUNT(a.id) as total, b.nm_user FROM komplain a JOIN users_booble b ON a.id_user_booble=b.id LIMIT 5");
        if($data->num_rows() > 0){
            return $data->result();    
        }
        return false;
    }

    


   
}