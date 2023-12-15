<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tools extends CI_Model {

    function date_to_day($tgl){
        return date("d F Y", strtotime($tgl));
    }

}



?>