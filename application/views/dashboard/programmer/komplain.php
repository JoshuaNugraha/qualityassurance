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
.image_kom{
    width:170px; height:170px;
    
}
.image_kom:hover{
    cursor: pointer;
    opacity: 0.5;
}

.modal_zoom {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 99999; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}
.modal_zoom .modal-content {
    margin: auto;
    display: block;
    width: 75%;
    //max-width: 75%;
}
.modal_zoom #caption {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
    text-align: center;
    color: #ccc;
    padding: 10px 0;
    height: 150px;
}
@-webkit-keyframes zoom {
    from {-webkit-transform:scale(1)}
    to {-webkit-transform:scale(2)}
}
 
@keyframes zoom {
    from {transform:scale(0.4)}
    to {transform:scale(1)}
}
@-webkit-keyframes zoom-out {
    from {transform:scale(1)}
    to {transform:scale(0)}
}
@keyframes zoom-out {
    from {transform:scale(1)}
    to {transform:scale(0)}
}
.modal_zoom .modal-content, #caption {
    -webkit-animation-name: zoom;
    -webkit-animation-duration: 0.6s;
    animation-name: zoom;
    animation-duration: 0.6s;
}
.out {
  animation-name: zoom-out;
  animation-duration: 0.6s;
}
@media only screen and (max-width: 700px){
    .modal_zoom .modal-content {
        width: 100%;
    }
}


</style>

<div id="modal_zoom" class="modal_zoom">
   <img class="modal-content" id="img01">
    <div id="caption"></div>
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
                <div class="col-lg-9 col-md-8 col-sm-6">
                <div class="row">
                    <div class="col-lg-3 col-sm-12">
                        <input type="text" class="form-control" id="date_filter" name="date_filter">
                    </div>
                    <div class="col-lg-3 col-sm-12">
                        <select name="user_filter" id="user_booble_filter" class="select2 form-control ">
                                <option value="">All User</option>
                        </select>
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
                        <select name="device_filter" id="device_filter" class="form-control">
                            <option value="">All Devices</option>
                            <option value="Web">Web</option>
                            <option value="Tablet">Web</option>
                            <option value="Potrait">Web</option>
                            <option value="IOS">IOS</option>
                        </select>
                    </div>
                   <div class="row mt-2">
                     <div class="col-lg-3 col-sm-12">
                        <div class="row">
                            <div class="col-6">
                                <button class="btn btn-info" type="button" onclick="filter_table()">Filter</button>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-warning" type="button" onclick="reset_filter()">Reset</button>
                            </div>   
                        </div>
                    </div>
                   </div>
                    
                </div>
                    
                </div>
                

              </div>
              <div class="table-responsive p-0 ">
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
              <h6>Detail Komplain</h6>
            </div>
            
                <div class="card">
                <div class="card-body p-3">
                   <button class="btn bg-gradient-dark mb-0" onclick="section1();"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</button>
                    <div class="container mt-5" style="font-size: 16px; font-weight:700;">
                        <div class="row">
                            <div class="col-12">
                                User : <span id="detail_user"></span>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                Prioritas : <span id="detail_priority"></span>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                Tanggal Masuk : <span id="detail_date"></span>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                Detail : 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                 <textarea cols="80" rows="10" id="detail_isi" readonly></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                Files : 
                            </div>
                        </div>
                        <div class="row" >
                            <div class="col-12" id="row_foto">
                               
                               <!-- <img src="<?= base_url() ?>/assets/upload/komplain/1700634452_IMG_4061.JPG-1700634452.JPG" alt="" class="image_kom">
                               <img src="<?= base_url() ?>/assets/upload/komplain/1700634710.png" alt="" class="image_kom"> -->
                            </div>
                        </div>
                        <div class="row mt-4" >
                            <div class="col-12" id="row_video">
                                
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12" id="row_file">

                            </div>
                        </div>
                    </div>
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
<?php 
    $url_id = $this->input->get('url');
?>

    <script>
        
        $(document).ready(function (){
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
                cb  (start, end);
            let url = '<?= $url_id; ?>' ;
            if(url != null && url != ""){
                section2(url);
            }else{
                section1();
            }
            
            
        
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
                    "url" : 'programmer/get_komplain',
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
            $('#aksi').val('1');
            load_user_booble();
        }
        function section2(url){
            $("#row_foto").html('');
            $("#row_video").html('');
            $("#row_file").html('');
            $.ajax({
                method : 'POST',
                url : 'programmer/get_komplain_by_id' ,
                data : {id: url} ,
                dataType : 'JSON' ,
                success : function(data){
                    if(data.status){
                        $("#detail_user").html(data.html.nm_user);
                        $("#detail_priority").html(data.html.priority);
                        $("#detail_date").html(data.html.tanggal_masuk);
                        $("#detail_isi").html(data.html.komplain);
                        
                        let foto_len = data.file.foto;
                        let video_len = data.file.video;
                        let file_len = data.file.file;
                        if( foto_len.length > 0){
                            for(let i = 0; i < foto_len.length ; i++){
                                $("#row_foto").append(foto_len[i]);
                            }
                        }
                        if( video_len.length > 0){
                            for(let i = 0; i < video_len.length ; i++){
                                console.log("masuk " + i);
                                $("#row_video").append(video_len[i]);
                            }
                        }
                        if( file_len.length > 0){
                            for(let i = 0; i < file_len.length ; i++){
                                $("#row_file").append(file_len[i]);
                            }
                        }
                        
                    }
                }
                });
                
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

        
       

        function reset_input(){
            $("#file_1").val('');
        }
        function del_field(id){
            
            $("#"+id).remove();
        }

        function ganti_status(id){
            let new_val = $("#prio_"+id).val();
            $.ajax({
            method : 'POST',
            url : 'programmer/ganti_status' ,
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
         
        // Get the modal
            var modal = document.getElementById('modal_zoom');
            
            // Get the image and insert it inside the modal - use its "alt" text as a caption
            var img = document.getElementById('myImg');
            var modalImg = document.getElementById("img01");
            var captionText = document.getElementById("caption");
            // img.onclick = function(){
            //     modal.style.display = "block";
            //     modalImg.src = this.src;
            //     modalImg.alt = this.alt;
            //     captionText.innerHTML = this.alt;
            // }
             

            function image_kom(id){
                modal.style.display = "block";
                modalImg.src = $("#foto_"+id).attr('src');
                modalImg.alt = $("#foto_"+id).attr('alt');
        
            }
                
                
            
            
            
            // When the user clicks on <span> (x), close the modal
            modal.onclick = function() {
                img01.className += " out";
                setTimeout(function() {
                modal.style.display = "none";
                img01.className = "modal-content";
                }, 400);
                
            }    
        


    </script>