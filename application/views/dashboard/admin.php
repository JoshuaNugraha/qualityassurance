 <div class="container-fluid py-4">
      <div class="row" id="section1">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>User table</h6>
              
            </div>
            
            <div class="card-body px-4 pt-0 pb-2">
              <button class="btn bg-gradient-dark mb-0" onclick="section2();"><i class="fa fa-plus" aria-hidden="true"></i> Tambah</button>
              <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0 table-striped" id="datable2">
                                  <thead>
                                      <tr>
                                          <th class="text-uppercase text-secondary text-xs font-weight-bolder ">No</th>
                                          <th class="text-uppercase text-secondary text-xs font-weight-bolder ">Nama User</th>
                                          <th class="text-uppercase text-secondary text-xs font-weight-bolder ">Otoritas</th>
                                          <th class="text-uppercase text-secondary text-xs font-weight-bolder  ps-2">Login</th>
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
              <h6>Tambah User</h6>
            </div>
            
                <div class="card">
                <div class="card-body p-3">
                   <button class="btn bg-gradient-dark mb-0" onclick="section1();"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</button>
                    <form action="" role="form" id="form_user">
                         <div class="row">
                            <div class="col-6">
                                 <div class="form-group">
                                    <label for="nm_lengkap">Nama</label>
                                    <input type="text" class="form-control" id="nm_lengkap" name="nm_lengkap" aria-describedby="emailHelp" placeholder="Enter name">
                                  
                                </div>
                            </div>
                            <div class="col-6">
                                 <div class="form-group">
                                    <label for="otoritas">Otoritas</label>
                                        <select class="form-control"  id="otoritas" name="otoritas">
                                          <?php 
                                            $get_group = $this->db->query('SELECT * FROM groups')->result();
                                            foreach($get_group as $gg){ ?>
                                              <option value="<?= $gg->id ?>"><?= $gg->name; ?></option>
                                            <?php }
                                          ?>
                                            
                                            
                                        </select>
                                </div>
                            </div>
                         </div>
                         <div class="row">
                            <div class="col-6">
                                 <div class="form-group">
                                    <label for="username">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email">
                                    <small>email akan digunakan ketika login</small>
                                   
                                </div>
                            </div>
                            <div class="col-6">
                                 <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="text" class="form-control" id="password" name="password"   aria-describedby="emailHelp" placeholder="Enter password">
                                </div>
                            </div>
                         </div>
                         <input type="hidden" id="aksi" name="aksi" value="1">
                         <input type="hidden" id="id" name="id" value="">
                         <button type="button" class="btn btn-primary mb-2" onclick="simpan_user()">Simpan</button>
                    </form>
                </div>
            </div>
          </div>
        </div>
      </div>
      
      
     
    </div>


    <script>
      $(document).ready(function (){
          section1();
          table();
      });

      function table(){
          let table = new DataTable('#datable2',
            {
                "processing": false,
                "serverSide": true,
                "bLengthChange": false,
                "bDestroy": true,
                "ajax": {
                    "url" : 'master/get_user',
                    "dataType": 'json',
                    "method" : "POST"
                 },
                "columns": [ 
                        {
                            "data": "no",
                            "className": "text-left"
                        },
                        {
                            "data": "nm_user",
                            "className": "text-left"
                        },
                        {
                            "data": "otoritas",
                            "className": "text-left"
                        },
                        {
                            "data": "login",
                            "className": "text-left"
                        },
                        {
                            "data": "aksi",
                            "className": "text-center"
                        },
                    ],
                    "bAutoWidth": false,
                    "columnDefs": [
                    { "width": "100px", "targets": [0] },
                    { "width": "100px", "targets": [1] },
                    { "width": "100px", "targets": [2] },
                    { "width": "100px", "targets": [3] }
                    ]
            }
         );

      }
      
      function section1(){
        $("#section2").hide();
        $("#section1").show();
        $("#form_user").trigger('reset');
      }
      function section2(){
        $("#section1").hide();
        $("#section2").show();
      }

      function cek_form(){
        if($("#nm_lengkap").val() == ''){
          Swal.fire(
            'Nama masih kosong!',
            '',
            'error'
          )
          return false;
        }
        if($("#otoritas").val() == ''){
          Swal.fire(
            'Otoritas masih kosong!',
            '',
            'error'
          )
          return false;
        }
        if($("#email").val() == ''){
          Swal.fire(
            'Email masih kosong!',
            '',
            'error'
          )
          return false;
        }
        if($("#aksi").val() == '1'){
          if($("#password").val() == ''){
            Swal.fire(
              'Password masih kosong!',
              '',
              'error'
            )
            return false;
          }
        }
      
        return true;
    }

      function simpan_user(){
        let cek = cek_form();
        
        if(cek == true){
        
          let form = $('#form_user')[0]; 
          let formData = new FormData(form);
          $.ajax({
          method : 'POST',
          url : 'auth/simpan_user' ,
          contentType: false,
          processData: false,
          data : formData ,
          dataType : 'JSON' ,
          success : function(data){
            if(data.status){
            
              Swal.fire({
                title: 'Berhasil',
                confirmButtonText: 'Ok',
                icon:'success'
              }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                window.location.href = "<?= base_url('dashboard') ?>";
              })
            }else{
              Swal.fire(
                'Terjadi kesalahan',
                data.msg,
                'error'
              )
            }
          }
          });
        }
    }

    function hapus(id){
       Swal.fire({
              title: 'Hapus user?',
              text: 'User yang telah dihapus tidak dapat dikembalikan lagi',
              showCancelButton : true,
              confirmButtonText: 'Hapus',
              cancelButtonText: 'Batal',
              icon:'warning'
            }).then((result) => {
              /* Read more about isConfirmed, isDenied below */
               if (result.isConfirmed){
                    $.ajax({
                        method : 'POST',
                        url : 'Auth/hapus_user' ,
                        data : {id} ,
                        dataType : 'JSON' ,
                        success : function(data){
                          if(data.status){
                            Swal.fire('Berhasil menghapus user', '', 'success');
                            table();
                          }else{
                            Swal.fire('Gagal', 'Terjadi kesalahan server', 'error');
                          } 
                        }
                    });
               }
               
            })
    }

    function edit(id){
        $.ajax({
        method : 'POST',
        url : 'master/get_user_by_id' ,
        data : {id} ,
        dataType : 'JSON' ,
        success : function(data){
            section2();
            $("#aksi").val("2");
            $("#id").val(id);
            data = data.data;
            $("#nm_lengkap").val(data.nama);
            $("#otoritas").val(data.otoritas);
            $("#email").val(data.email);
        }
        });
    }

    </script>