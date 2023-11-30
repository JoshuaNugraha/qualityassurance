<style>
    #title_komp{
        font-size:18px;
        font-weight: 700;
        /* font-style: italic; */
    }
    #tgl_komp{
        font-size:15px;
    }
    #user_komp{
        font-weight:600;
    }
    table, th, td {
    border:1px solid black;
    }
    
</style>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12 ">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h4>Form Laporan Komplain</h4>
                </div>
                <div class="card-body px-4 pt-0 pb-2">
                   <div class="row">
                        <div class="col-12">
                            <form  id="form_lap" class="mt-5 pb-5">
                                <div class="row">
                                    <div class="col-lg-3 col-md-12">
                                        <label for="date_filter">Periode Tanggal Komplain</label>
                                        <input type="text" class="form-control" id="date_filter" name="date_filter">
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <label for="status" >Status</label>
                                        <select name="status" id="status" class="select2 form-control">
                                            <option value="all" selected>Semua Status</option>
                                            <option value="Pending">Pending</option>
                                            <option value="Proses">Proses</option>
                                            <option value="Testing QA">Testing QA</option>
                                            <option value="Selesai">Selesai</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <label for="user_booble">User</label>
                                        <input type="text" class="form-control typeahead" id="user_booble" name="user_booble" placeholder="Kosongkan Untuk Menampilkan Semua User">
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-4">
                                        <button class="btn btn-primary" type="button" onclick="cetak_html()">
                                            Cetak
                                        </button>
                                        <button class="btn btn-danger">
                                            Pdf
                                        </button>
                                        <button class="btn btn-success">
                                            Excel
                                        </button>
                                    </div>                            
                                </div>
                            </form>
                        </div>
                   </div>
                   <div class="row pb-5">
                        <div class="col-12 text-center">
                                <span id="title_komp">
                                    Laporan Kompalin
                                </span>
                                <br>
                                <span id="user_komp">
                                    Kanuku
                                </span>
                                <br>
                                <span id="tgl_komp">
                                    11 Desember 2023
                                </span>
                                <br>
                               
                                <table cellpadding="2" class="mt-3" cellspacing="0" style="border-collapse:collapse;font-size:11.5px;font-family:Arial;" border="1" width="100%">
                                        <thead>
                                            <tr>
                                                <th  height="40px" class="text-center" style="font-weight: bold;font-size: 13px;color:black;">No.</th>
                                                <th  height="40px" class="text-center" style="font-weight: bold;font-size: 13px;color:black;">Tgl Masuk</th>
                                                <th  height="40px" class="text-center" style="font-weight: bold;font-size: 13px;color:black;">User</th>
                                                <th  height="40px" class="text-center" style="font-weight: bold;font-size: 13px;color:black">Detail</th>
                                                <th  height="40px" class="text-center" style="font-weight: bold;font-size: 13px;color:black;">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody id="body_review">
                                            
                                        </tbody>
                                </table>    
                        </div>
                   </div>
                </div>
            </div>
        </div>
    </div>
    
</div>

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="<?=base_url()?>assets/plugins/Bootstrap-3-Typeahead-master/bootstrap3-typeahead.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<script>
    $(document).ready(function (){
        $("#user_booble").typeahead({
			source: function(query, result) {

				var user_booble = $("#user_booble").val();
				if (user_booble.length >= 3) {
                    // alert();
					$.ajax({
						url: "<?= base_url('Cs/get_user_booble_by_name') ?>",
						dataType: "json",
						type: "POST",
						data: ({
							user : user_booble
						}),
						success: function(data) {
							// result($.map(data, function(item) {
							// 	return item;
							// }));
							// id_produx = "";
                            result($.map(data, function(item) {
								return item;
							}));
                            id_produx = "";
						}
					});

				}
			},			 
		});


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

    function cetak_html(){
        let user = $("#user_booble").val();
        let status = $("#status").val();
        let date = $("#date_filter").val();
        let dateRanges = date.split(' - ');
        let date1 = formatDate(dateRanges[0]);
        let date2 = formatDate(dateRanges[1]);
        $.ajax({
            method : 'POST',
            url : 'Cs/laporan_komplain_html' ,
            data : {user, status, date1, date2} ,
            dataType : 'JSON' ,
            success : function(data){
                if(data.status){
                    $("#body_review").html(data.html);
                }
            }
        });
    }
    function formatDate(dateString) {
        var parts = dateString.split('/');
        var formattedDate = parts[2] + '-' + parts[0] + '-' + parts[1];
        return formattedDate;
    }
</script>