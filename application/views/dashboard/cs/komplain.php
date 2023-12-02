<style>
.td_komplain{
    width:400px !important;
    white-space:normal !important;
    text-overflow: ellipsis  !important;
    font-size:12px;
}
.badge_bb {
  color: white;
  padding: 4px 8px;
  text-align: center;
  border-radius: 5px;
}
.badge_bb-primary {
   background-color: #0275d8;
}
.badge_bb-success {
   background-color: #5cb85c;
}
.badge_bb-info {
   background-color: #5bc0de;
}
.badge_bb-warning {
   background-color: #f0ad4e;
}
.badge_bb-danger {
   background-color: #d9534f;
}
.badge_bb-secondary {
   background-color: #292b2c;
}


 

.input-group {
  display: table;
  border-collapse: collapse;
  width: 100%;
}

.input-group > * {
  display: table-cell;
  border: 1px solid #ddd;
  vertical-align: middle;
}

.input-group-icon {
  background-color: #5cb85c;
  color: white;
  padding: 0 20px;
}
.input-group-icon:hover{
    cursor: pointer;
}

.input-group-area {
  width: 100%;
}

.input-group select {
  border: 0;
  display: block;
  width: 100%;
  /* padding: 8px; */
}


</style>

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="close_modal();">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="tambah_user">
            <div class="row">
                <div class="col-lg-12">
                    <label for="nama_user">Nama User</label>
                    <input type="text" class="form-control" id="nama_user">
                </div>
            </div>
            
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="close_modal()">Close</button>
        <button type="button" class="btn btn-primary" onclick="insert_user()">Submit</button>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid py-4">
      <div class="row" id="section1">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Komplain table</h6>
            </div>
            
            <div class="card-body px-4 pt-0 pb-2">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <button class="btn bg-gradient-dark mb-0" onclick="section2();"><i class="fa fa-plus" aria-hidden="true"></i> Tambah</button>
                    </div>
                </div>  
                <div class="row mt-3">
                    <div class="col-lg-3 col-sm-12">
                        <input type="text" class="form-control" id="date_filter" name="date_filter">
                    </div>
                    <div class="col-lg-3 col-sm-12">
                         <label class="input-group">
                            <div class="input-group-area">
                                <select name="user_filter" id="user_booble_filter" class="select2 form-control ">
                                        <option value="">All User</option>
                                </select>
                            </div>
                            <div class="input-group-icon" onclick="tambah_user()" >+</div>
                        </label>
                    </div>
                    <div class="col-lg-3 col-sm-12">
                        <select name="status_filter" id="status_filter" class="form-control">
                            <option value="">All Status</option>
                            <option value="Pending">Pending</option>
                            <option value="Proses">Proses</option>
                            <option value="Selesai">Selesai</option>
                            <option value="Testing QA">Testing QA</option>
                        </select>
                    </div> 
                    <div class="col-lg-3 col-sm-12">
                        <div class="row">
                            <div class="col-5">
                                <button class="btn btn-info" type="button" onclick="filter_table()">Filter</button>
                            </div>
                            <div class="col-4">
                                <button class="btn btn-warning" type="button" onclick="reset_filter()">Reset</button>
                            </div>   
                        </div>
                    </div>
                </div>
              </div>
              <div class="table-responsive p-0 mt-5 px-3">
                    <table class="table align-items-center mb-0 table-striped" id="datable2">
                                  <thead>
                                      <tr>
                                          <th class="text-uppercase text-secondary text-xs font-weight-bolder ">No</th>
                                          <th class="text-uppercase text-secondary text-xs font-weight-bolder">User</th>
                                          <th class="text-uppercase text-secondary text-xs font-weight-bolder" style="width:100px; overflow-wrap: break-word !important;">Komplain</th>
                                          <th class="text-uppercase text-secondary text-xs font-weight-bolder">Priority</th>
                                          <th class="text-uppercase text-secondary text-xs font-weight-bolder">Status</th>
                                          <th class="text-uppercase text-secondary text-xs font-weight-bolder">Device</th>
                                          <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder ">Aksi</th>
                                      </tr>
                                  </thead>
                                  <tbody  id="body_divisi">
                                          
                                  </tbody>

                    </table>
              </div>
            </div>
          </div>
        </div>
      </div>

       <div class="row" id="section2">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Tambah Komplain</h6>
            </div>
            
                <div class="card">
                <div class="card-body p-3">
                   <button class="btn bg-gradient-dark mb-0" onclick="section1();"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</button>
                    <form action="" role="form" id="form_komplain">
                         <div class="row">
                            <div class="col-6">
                                 <div class="form-group">
                                    <label for="nm_lengkap">User</label>
                                    <!-- <input type="text" class="form-control" id="nm_lengkap" name="nm_lengkap" aria-describedby="emailHelp" placeholder="Enter name"> -->
                                    <select name="user_booble" id="user_booble" class="select2 form-control">
                                        
                                    </select>
                                  
                                </div>
                            </div>
                            <div class="col-6">
                                 <div class="form-group">
                                    <label for="otoritas">Prioritas</label>
                                        <select class="form-control select2"  id="priority" name="priority">
                                            <option value="Low">Low</option>
                                            <option value="Very Low">Very Low</option>
                                            <option value="Medium">Medium</option>
                                            <option value="High">High</option>
                                            <option value="Very High">Very High</option>
                                            <option value="Emergency">Emergency</option>     
                                        </select>
                                </div>
                            </div>
                         </div>
                         <div class="row">
                            <div class="col-6">
                                 <div class="form-group">
                                    <label for="device">Device</label>
                                    <!-- <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email"> -->
                                    <select name="device" id="device" class="select2 form-control">
                                        <option value="Web">Web</option>
                                        <option value="Tablet">Tablet</option>
                                        <option value="Potrait">Potrait</option>
                                        <option value="Sales">Sales</option>
                                        <option value="IOS">IOS</option>
                                    </select>  
                                </div>
                            </div>
                            <div class="col-6  ">
                                 <div class="form-group" id="container_file">
                                    <label for="file_1">File</label>
                                    <div class="file_row row">
                                        <div class="col-10"><input type="file" class="form-control file_komplain" id="file_1" name="file_1[]"></div>
                                        <div class="col-2"><button class="btn btn-danger" type="button" onclick="reset_input()">X</button>                           </div>           
                                    </div>
                                </div>
                                <button class="btn btn-warning" type="button" onclick="add_file()"><i class="fa fa-plus"></i></button>
                            </div>
                         </div>
                         <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="komplain">Komplain</label>
                                    <textarea name="komplain" id="komplain" cols="30" rows="10" class="form-control"></textarea>
                                </div>
                            </div>
                         </div>
                         <input type="hidden" id="aksi" name="aksi" value="1">
                         <input type="hidden" id="id" name="id" value="">
                         <button type="button" class="btn btn-primary mb-2" onclick="simpan_komplain()">Simpan</button>
                    </form>
                </div>
            </div>
          </div>
        </div>
      </div>
      
      
     
    </div>

<!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script> -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


    <script>
        
        $(document).ready(function (){
          section1();
          table();
        var start = moment().subtract(29, 'days');
        var end = moment();
        $("#date_filter").daterangepicker(
            {
                startDate: end,
                ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            }, cb
        );
            cb(start, end);
        });
        function cb(start, end) {
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }

        function table(user="", status="", date_1="", date_2=""){
          let table = new DataTable('#datable2',
            {
                "processing": false,
                "serverSide": true,
                "bLengthChange": false,
                "bDestroy": true,
                "ajax": {
                    "url" : 'cs/get_komplain',
                    "dataType": 'json',
                    "method" : "POST",
                    "data" : {user, status, date_1, date_2}
                 },
                "columns": [ 
                        {
                            "data": "no",
                            "className": "text-center"
                        },
                        {
                            "data": "nm_user",
                            "className": "text-left"
                        },
                        {
                            "data": "komplain",
                            "className": "text-left td_komplain"
                        },
                        {
                            "data": "priority",
                            "className": "text-left"
                        },
                        {
                            "data": "status",
                            "className": "text-left"
                        },
                        {
                            "data": "device",
                            "className": "text-left"
                        },
                        {
                            "data": "aksi",
                            "className": "text-left"
                        },
                    ],
                    "bAutoWidth": false,
                    "autoWidth": false,
                    "columnDefs": [
                    { "width": "15px", "targets": [0] },
                    { "width": "100px", "targets": [1] },
                    { "width": "200px", "targets": [2] },
                    { "width": "50px", "targets": [3] },
                    { "width": "50px", "targets": [4] },
                    { "width": "50px", "targets": [5] },
                    { "width": "80px", "targets": [6] },
                    ]
            }
         );

        }
        function section1(){
            $("#section2").hide();
            $("#section1").show();
            $("#form_komplain").trigger('reset');
            $('#form_komplain')[0].reset();
            // $("#container_file").html('<div class="file_row row">'+
            //                             '<div class="col-10"><input type="file" class="form-control file_komplain" id="file_1" name="file_1[]"></div>'+
            //                             '<div class="col-2"><button class="btn btn-danger" type="button" onclick="reset_input()">X</button>'+
            //                             '</div>'+
            //                             '</div>')
            
            reset_files();
            $('#aksi').val('1');
            load_user_booble();
        }

        function reset_files(){
            // $("#file_1").val('');
            // reset_input();
            var fileRows = document.querySelectorAll('.file_row');
            var fileRowCount = fileRows.length;
            for(let i = 1 ; i < fileRowCount; i++){
                $("#row_"+i).remove();
            }
            $("#container_file").html(' <label for="file_1">File</label>'+
                                    '<div class="file_row row">'+
                                        '<div class="col-10"><input type="file" class="form-control file_komplain" id="file_1" name="file_1[]"></div>'+
                                        '<div class="col-2"><button class="btn btn-danger" type="button" onclick="reset_input()">X</button></div>'+
                                '</div>');
            // var row = button.closest('.file_row');

            // // Remove the row
            // row.remove();
        }
        function section2(){
            $("#section1").hide();
            $("#section2").show();
        }

        function load_user_booble(){
            $.ajax({
            method : 'GET',
            url : 'cs/get_user_booble' ,
            dataType : 'JSON' ,
            success : function(data){
                if(data.status){
                    $("#user_booble").html(data.html);
                    $("#user_booble_filter").html(data.html);
                }
            }
            });
        }

        
        function add_file(){
            let length = $('[name^="file_"]').length + 1;
            console.log("leng " + length);
            $("#container_file").append(' <div class="file_row row" id="row_'+length+'">'+
                                        '<div class="col-10"><input type="file" class="form-control file_komplain" id="file_'+length+'" name="file_1[]"></div>'+
                                        '<div class="col-2"><button class="btn btn-danger" type="button" onclick="del_field(\'row_'+length+'\')">X</button>'+
                                        '</div>'+
                                    '</div>');
        }

        function reset_input(){
            // $("#file_1").val('');
            
        var newFileInput = $('<input type="file" class="form-control file_komplain" id="file_1" name="file_1[]">');

        // Replace the original file input with the new one
        $('#file_1').replaceWith(newFileInput);
        }
        function del_field(id){
            
            $("#"+id).remove();
        }
        function ganti_priority(id){
            let new_val = $("#prio_"+id).val();
            $.ajax({
            method : 'POST',
            url : 'cs/ganti_prio' ,
            data : {id, val: new_val} ,
            dataType : 'JSON' ,
            beforeSend: function() {
                swal.fire({
                    html: '<h5>Loading...</h5>',
                    showConfirmButton: false,
                    onRender: function() {
                        // there will only ever be one sweet alert open.
                        $('.swal2-content').prepend(sweet_loader);
                    }
                });
            },
            success : function(data){
                swal.close();   
            }
            });
        }

        function cekFrom(){
            let komplain = $("#komplain").val();
            let user_booble = $("#user_booble").val();
            if(!komplain || komplain == ""){
                swal.fire('From tidak lengkap', 'Komplain masih kosong', 'error');
                return false;
            }
            if(!user_booble || user_booble == ""){
                swal.fire('From tidak lengkap', 'Mohon pilih user', 'error');
                return false;
            }

            return true;
        }

        function simpan_komplain(){
            let cek = cekFrom();
            if(cek){
                console.log($("#komplain").val());
                console.log($("#user_booble").val());
                let formData = new FormData($("#form_komplain")[0]);
                    $.ajax({
                    method : 'POST',
                    url : 'cs/simpan_komplain' ,
                    data : formData ,
                    contentType: false,
                    processData: false,
                    dataType : 'JSON' ,
                    success : function(data){
                        if(data.status){
                            Swal.fire('Berhasil', 'Komplain berhasil ditambah', 'success');
                            table();
                            section1();
                        }else{
                            Swal.fire('Error', 'Terjadi kesalahan', 'error');  
                        }
                        
                    },
                    error: function (){
                        Swal.fire('Error', 'Terjadi kesalahan', 'error');
                    }
                });
            }
            
        }

        function edit(id){
            $.ajax({
            method : 'POST',
            url : 'Cs/get_komplain_by_id' ,
            data : {id} ,
            dataType : 'JSON' ,
            success : function(data){
                if(data.status){
                    $("#user_booble").val(data.data.komplain.id_user_booble).change();
                    $("#priority").val(data.data.komplain.priority).change();
                    $("#device").val(data.data.komplain.device).change();
                    $("#komplain").val(data.data.komplain.komplain);
                    
                    $("#aksi").val('2');
                    $("#id").val(data.data.komplain.id);
                    let pjg = data.data.file.length;
                    console.log("HERE" + data.data.file.length);
                    if( pjg > 0){
                        $("#container_file").html(' <label for="file_1">File</label>');
                        for(let i = 0; i < pjg; i++){
                          
                            console.log("file " + data.data.file[i].file);
                            $("#container_file").append('<div class="file_row row" id="row_'+i+'">'+
                                        '<div class="col-10"><input type="text" class="form-control file_komplain" id="file_'+i+'"  value="'+data.data.file[i].file+'" readonly></div>'+
                                        '<div class="col-2"><button class="btn btn-danger" type="button" onclick="del_field_edit(\''+data.data.file[i].id+' \' , \'row_'+i+'\')">X</button>'+
                                        '</div>'+
                            '</div>');
                        }
                    }else{
                       
                    }
                    section2();

                }
            }
            });
        }
        
        function del_field_edit(id, id_row){
             Swal.fire({
                    title: 'Hapus file dari komplain?',
                    text: 'Aksi ini tidak dapat dikembalikan',
                    confirmButtonText: 'Ok',
                    icon:'warning',
                    showCancelButton: true,
                    cancelButtonText: "Batal"
                        }).then((result) => {
                            
                     if(result.isConfirmed){
                            $.ajax({
                                method : 'POST',
                                url : 'Cs/delete_file' ,
                                data : {id} ,
                                dataType : 'JSON' ,
                                success : function(data){
                                    if(data.status){
                                        $("#" + id_row).remove();
                                    }
                                }
                            });
                     } 
                    
                });
            
        }

        function filter_table(){
            let date = $("#date_filter").val();
            let status = $("#status_filter").val();
            let user = $("#user_booble_filter").val();
            var dateRanges = date.split(' - ');

            // Parse and format the dates
            var date1 = formatDate(dateRanges[0]);
            var date2 = formatDate(dateRanges[1]);
            table(user, status, date1, date2);
        }
        function formatDate(dateString) {
            var parts = dateString.split('/');
            // Note: months are 0-based in JavaScript Date object
            var formattedDate = parts[2] + '-' + parts[0] + '-' + parts[1];
            return formattedDate;
        }

        function reset_filter(){
            let date = $("#date_filter").val();
            let status = $("#status_filter").val();
            let user = $("#user_booble_filter").val();
            
            $("#status_filter").val('').change();
            $("#user_booble_filter").val('').change();
            table();
        }

        function tambah_user(){
            $("#exampleModal").modal('show');
        }
         
        function insert_user(){
            let nama = $("#nama_user").val();
            $.ajax({
                method : 'POST',
                url : 'cs/tambah_user' ,
                data : {nama} ,
                dataType : 'JSON' ,
                success : function(data){
                    if(data.status){
                        swal.fire('Berhasil', '', 'success');
                        $("#nama_user").val('');
                        $("#exampleModal").modal('hide');
                        load_user_booble();
                    }
                }
            });
        }

        function close_modal(){
            $("#nama_user").val('');
            $("#exampleModal").modal('hide');
        }
        
        


    </script>