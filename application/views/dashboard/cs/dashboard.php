
      <!-- End Navbar -->
      <div class="container-fluid py-4">
        <div class="row">
          <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
              <div class="card-body p-3">
                <div class="row">
                  <div class="col-8">
                    <div class="numbers">
                      <p class="text-sm mb-0 text-capitalize font-weight-bold">
                        Komplain Hari Ini
                      </p>
                      <h5 class="font-weight-bolder mb-0" id="komplain_today">
                        0      
                                     
                      </h5>
                    </div>
                  </div>
                  <div class="col-4 text-end">
                    <div
                      class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md"
                    >
                      <i
                        class="fa fa-volume-control-phone text-lg opacity-10"
                        aria-hidden="true"
                      ></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
              <div class="card-body p-3">
                <div class="row">
                  <div class="col-8">
                    <div class="numbers">
                      <p class="text-sm mb-0 text-capitalize font-weight-bold">
                        Komplain Pekan Ini
                      </p>
                      <h5 class="font-weight-bolder mb-0" id="komplain_week">
                        0                        
                      </h5>
                    </div>
                  </div>
                  <div class="col-4 text-end">
                    <div
                      class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md"
                    >
                      <i
                        class="fa fa-user text-lg opacity-10"
                        aria-hidden="true"
                      ></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
              <div class="card-body p-3">
                <div class="row">
                  <div class="col-8">
                    <div class="numbers">
                      <p class="text-sm mb-0 text-capitalize font-weight-bold">
                       Komplain Pending
                      </p>
                      <h5 class="font-weight-bolder mb-0" id="total_pending">
                        0
                      </h5>
                    </div>
                  </div>
                  <div class="col-4 text-end">
                    <div
                      class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md"
                    >
                      <i
                        class="fa fa-code text-lg opacity-10"
                        aria-hidden="true"
                      ></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6">
            <div class="card">
              <div class="card-body p-3">
                <div class="row">
                  <div class="col-8">
                    <div class="numbers">
                      <p class="text-sm mb-0 text-capitalize font-weight-bold">
                        Selesai Hari Ini
                      </p>
                      <h5 class="font-weight-bolder mb-0" id="selesai_hari_ini">
                        0
                        
                      </h5>
                    </div>
                  </div>
                  <div class="col-4 text-end">
                    <div
                      class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md"
                    >
                      <i
                        class="fa fa-check text-lg opacity-10"
                        aria-hidden="true"
                      ></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      
        <div class="row mt-4">
          <div class="col-lg-5 mb-lg-0 mb-4">
            <div class="card z-index-2">
              <div class="card-body p-3">
                <div class="row mb-2">
                  <div class="col-12">
                    <select name="periode" id="periode" class="form-control select2" onchange="get_chart()">
                      <option value="Tahun">Per Tahun</option>
                      <option value="Bulan">Per Bulan</option>
                      <option value="Pekan">Per Pekan</option>
                    </select>
                  </div>
                </div>
                <div class="bg-gradient-dark border-radius-lg py-3 pe-1 mb-3">
                  <div class="chart">
                    <canvas
                      id="chart-bars"
                      class="chart-canvas"
                      height="190"
                    ></canvas>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 text-center">
                      <p style="font-weight:700;" id="ket_chart_bar">2023</p>
                  </div>
                </div>
                 
                 
              </div>
            </div>
          </div>
          <div class="col-lg-7">
            <div class="card z-index-2">
              <div class="card-header pb-0">
                <h6>Most Complain User</h6>
                 
              </div>
              <div class="card-body p-3">
                <div class="tab">
                  <table class="table  table-hover">
                      <thead>
                          <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama User</th>
                            <th class="text-center">Total</th>
                          </tr>
                      </thead>
                      <tbody id="body_tab">

                      </tbody>
                  </table>
                 
                </div>
              </div>
            </div>
          </div>
        </div>
      
       
<!-- <script src="<?= base_url() ?>assets/soft_ui/js/plugins/chartjs.min.js"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>  -->
 <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
<script>

  $(document).ready(function (){
    get_komplain_dashboard(); 
    get_chart();
    get_most_complain();
  });

  function get_komplain_dashboard(){
    $.ajax({
      method : 'GET',
      url : 'cs/get_komplain_dashboard' ,
      dataType : 'JSON' ,
      success : function(data){
        if(data.status){        
          $("#komplain_today").html(data.data.today);
          $("#komplain_week").html(data.data.week);
          $("#total_pending").html(data.data.pending);
          $("#selesai_hari_ini").html(data.data.finish_today);
        }
      }
    });
  }
 

  function get_chart(){
    let periode = $("#periode").val();
    $.ajax({
    method : 'POST',
    url : 'cs/get_chart' ,
    data : {periode} ,
    dataType : 'JSON' ,
    success : function(data){
    if(data.status){
      const dataArray = Object.values(data.data);
      let labels_arr = [];
      let total_arr = [];
      for(let i=1; i<=dataArray.length; i++){
        labels_arr.push(data.data[i].nama);
        total_arr.push(data.data[i].val);
      }


    // let chartStatus = Chart.getChart("chart-bars"); // <canvas> id
    //  console.log("status" + chartStatus);
    // if (chartStatus != undefined) {
     
    //   chart_dash.destroy();
    // }
    destroyChartIfNecessary("chart-bars");
    
    

    var ctx = document.getElementById("chart-bars").getContext("2d");
    
    var chart_dash = new Chart(ctx, {
          type: "bar",
          data: {
            labels: labels_arr
            ,
            datasets: [
              {
                label: "Komplain",
                tension: 0.4,
                borderWidth: 0,
                borderRadius: 4,
                borderSkipped: false,
                backgroundColor: "#fff",
                data: total_arr,
                maxBarThickness: 6,
              },
            ],
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
              legend: {
                display: false,
              },
            },
            interaction: {
              intersect: false,
              mode: "index",
            },
            scales: {
              y: {
                grid: {
                  drawBorder: false,
                  display: false,
                  drawOnChartArea: false,
                  drawTicks: false,
                },
                ticks: {
                  suggestedMin: 0,
                  suggestedMax: 500,
                  beginAtZero: true,
                  padding: 15,
                  font: {
                    size: 14,
                    family: "Open Sans",
                    style: "normal",
                    lineHeight: 2,
                  },
                  color: "#fff",
                },
              },
              x: {
                grid: {
                  drawBorder: false,
                  display: false,
                  drawOnChartArea: false,
                  drawTicks: false,
                },
                ticks: {
                  display: true,
                },
              },
            },
          },
        });


      // Add data labels using ctx.fillText
      var datasets = chart_dash.config.data.datasets;
      var xAxis = chart_dash.scales.x;
      var yAxis = chart_dash.scales.y;

      datasets.forEach(function (dataset) {
          for (var i = 0; i < dataset.data.length; i++) {
              var value = dataset.data[i];
              var x = xAxis.getPixelForValue(chart_dash.data.labels[i]) - 10; // Adjust the x position
              var y = yAxis.getPixelForValue(value) - 5; // Adjust the y position
              ctx.fillStyle = '#fff'; // Set the color
              ctx.font = '14px Open Sans'; // Set the font size and family
              ctx.fillText(value, x, y);
          }
      });
      registerNewChart("chart-bars", chart_dash);
      }
      }
      
      });
      
      // chart_dash.destroy();

  }
  const chartsByCanvasId = {};
  const registerNewChart = (canvasId, chart) => {
    chartsByCanvasId[canvasId] = chart;
  }
  const destroyChartIfNecessary = (canvasId) => {
    if (chartsByCanvasId[canvasId]) {
        chartsByCanvasId[canvasId].destroy();
    }
  }

  function get_most_complain(){
    $.ajax({
    method : 'GET',
    url : 'cs/get_most_complain' ,
    dataType : 'JSON' ,
    success : function(data){
      if(data.status){
        let html = "";
        for(let i=0; i<data.data.length; i++){
          let no = i+1;
          html += "<tr>" + 
                    "<td class='text-center'>"+no+"</td>"+
                    "<td class='text-center'>"+data.data[i].nm_user+"</td>"+
                    "<td class='text-center'>"+data.data[i].total+"</td>"+
                    
          +"</tr>";
        }
        $("#body_tab").html(html);
      }
    }
    });
  }


 


</script>