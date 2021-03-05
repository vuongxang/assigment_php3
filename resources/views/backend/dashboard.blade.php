@extends('backend.layouts.main') @section('content')
<div class="row">
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-aqua">
      <div class="inner">
        <h3>{{ $postsCount }}</h3>

        <p>New Posts</p>
      </div>
      <div class="icon">
        <i class="ion ion-bag"></i>
      </div>
      <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-green">
      <div class="inner">
        <h3>{{ $catesCount }}<sup style="font-size: 20px"></sup></h3>

        <p>Category</p>
      </div>
      <div class="icon">
        <i class="ion ion-stats-bars"></i>
      </div>
      <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-yellow">
      <div class="inner">
        <h3>{{ $views }}</h3>

        <p>Views</p>
      </div>
      <div class="icon">
        <i class="ion ion-person-add"></i>
      </div>
      <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-red">
      <div class="inner">
        <h3>65</h3>

        <p>Unique Visitors</p>
      </div>
      <div class="icon">
        <i class="ion ion-pie-graph"></i>
      </div>
      <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
</div>

<!-- Chart JS-->
<div class="panel-body">
  <canvas id="line-chart"></canvas>
</div>
@endsection @section('page-script')
<script type="text/javascript">
  window.onload = function () {
    Chart.defaults.global.defaultFontColor = "#000000";
    Chart.defaults.global.defaultFontFamily = "Arial";
    var lineChart = document.getElementById("line-chart");

    //Lấy dữ liệu lượt xem 7 ngày gần nhất
    const dayDataUrl = "{{route('daydata')}}";
    const viewsDataUrl = "{{route('viewdata')}}";

    var dataDay = "";
    var viewData = "";

    //gán dữ liệu dayData
    fetch(viewsDataUrl, {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
      },
    })
      .then((responseData) => responseData.json())
      .then((data) => {
        viewData = data;
      });

    //Gán dữ liệu vào view data
    fetch(dayDataUrl, {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
      },
    })
      .then((responseData) => responseData.json())
      .then((daysData) => {
        dataDay = daysData;
      });

    setTimeout(() => {
      var myChart = new Chart(lineChart, {
        type: "line",
        data: {
          labels: dataDay,
          datasets: [
            {
              label: "Total Views",
              data: viewData,
              backgroundColor: "rgba(0, 128, 128, 0.3)",
              borderColor: "rgba(0, 128, 128, 0.7)",
              borderWidth: 1,
            },
            // {
            //     label: 'Ruby Activities',
            //     data: [18, 72, 10, 39, 19, 75],
            //     backgroundColor: 'rgba(0, 128, 128, 0.7)',
            //     borderColor: 'rgba(0, 128, 128, 1)',
            //     borderWidth: 1
            // }
          ],
        },
        options: {
          scales: {
            yAxes: [
              {
                ticks: {
                  beginAtZero: true,
                },
              },
            ],
          },
        },
      });
    }, 1000);
  };
</script>
@endsection