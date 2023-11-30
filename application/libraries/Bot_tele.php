<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Bot_tele{
    private $bot_token = '6451957195:AAHohJ6Oz_vl9iqdQW5BqnsFfxOz_FeoVVA';
    private $group_id = '-4099098092';

    private $jojo = '1889801709';
    private $hadyan = '225684335';
    private $taufik = '';
    private $cs     = '';
    private $muflih = '';

    function send_msg($id_kom, $device, $status, $komplain, $user, $priority, $tipe){
        
        if($device == 'Tablet'){
            $tag = "<a href='tg://user?id=$this->hadyan'>[User]</a> 
            Device :".$device."";
        }
        if($device == 'IOS'){
            $tag = "<a href='tg://user?id=$this->hadyan'>[User]</a> 
            Device :".$device."";
        }
        if($device == 'Potrait'){
            $tag = "<a href='tg://user?id=$this->jojo'>[User]</a> 
            Device: ".$device."";
        }
        if($device == 'Web'){
            $tag = "<a href='tg://user?id=$this->jojo'>[User]</a> 
            Device: ".$device."";
        }

        if($tipe == "new"){
            $msg = "Komplain baru telah masuk  
            -<b>Dari</b> : ".$user." 
            -<b>Status</b>: ".$status." 
            -<b>Prioritas</b> : ".$priority." 
            -<b>KOMPLAIN DETAIL</b> : ".$komplain. " 
            -".$tag. "
            URL :".base_url()."komplain-list?url=".$id_kom."
            ";
        }
        if($tipe == "edit"){
            $msg = "Prioritas Telah berubah
            -<b>Dari</b> : ".$user." 
            -<b>Status</b>: ".$status." 
            -<b>Prioritas</b> : ".$priority." 
            -<b>KOMPLAIN DETAIL : </b>".$komplain. " 
            -".$tag. "
            URL :".base_url()."komplain-list?url=".$id_kom."
            ";
        }
        $msg = rawurlencode($msg) ;
        $response = file_get_contents("https://api.telegram.org/bot$this->bot_token/sendMessage?chat_id=".$this->group_id."&text=".$msg."&parse_mode=HTML");
        return true;
       
      

    }


     function send_msg_status($id_kom, $device, $status, $komplain, $user, $priority){

        if($status == "Testing QA"){
            $tag = "<a href='tg://user?id=$this->jojo'>[User]</a>";
            $msg = "Task untuk ditesting  
            -<b>Dari</b> : ".$user." 
            -<b>Status</b>: ".$status." 
            -<b>Prioritas</b> : ".$priority." 
            -<b>KOMPLAIN DETAIL</b> : ".$komplain. " 
            -".$tag . "
                 URL : <a href='".base_url()."komplain-list?url=".$id_kom."'> ".base_url()."komplain-list?url=".$id_kom." </a>
            ";
        }
        if($status == "Selesai"){
            $tag = "<a href='tg://user?id=$this->cs'>[User]</a>";
             $msg = "Task Sudah Selesai
            -<b>Dari</b> : ".$user." 
            -<b>Status</b>: ".$status." 
            -<b>Prioritas</b> : ".$priority." 
            -<b>KOMPLAIN DETAIL</b> : ".$komplain. " 
            -".$tag . "
                URL : <a href='".base_url()."komplain-list?url=".$id_kom."'> Link </a>
            ";
        }
        $msg = rawurlencode($msg) ;
        $response = file_get_contents("https://api.telegram.org/bot$this->bot_token/sendMessage?chat_id=".$this->group_id."&text=".$msg."&parse_mode=HTML");
        return true;
 

    }
    

    
}

?>