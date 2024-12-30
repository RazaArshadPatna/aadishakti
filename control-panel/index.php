<?php session_start();

include './include/connection.php';

require_once './include/isLogin.php';

require_once './common/dashboardCounter.php';
$show=false;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Dashboard</title>
  <?php include './include/head.php'; ?>
</head>

<body class="layout-1" data-luno="theme-blue">
  <!-- start: sidebar -->
  <?php include './include/left-side.php'; ?>
  <!-- start: body area -->
  <div class="wrapper">
    <!-- start: page header -->
    <?php include './include/header.php'; ?>
    <!-- start: page toolbar -->
    <div class="page-toolbar px-xl-4 px-sm-2 px-0 py-3">
      <div class="container-fluid">
        <div class="row g-3 mb-3 align-items-center">
          <div class="col">
            <ol class="breadcrumb bg-transparent mb-0">
              <li class="breadcrumb-item"><a class="text-secondary" href="index.php">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
          </div>
        </div> <!-- .row end -->
        <div class="row align-items-center">
          <div class="col">
            <h1 class="fs-5 color-900 mt-1 mb-0">Welcome back, <?php echo $_SESSION['name_admin']; ?></h1>
            
          </div>
          <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-7 col-sm-12 mt-2 mt-md-0">
            <!-- daterange picker -->
            
            <!-- Plugin Js -->
            <script src="./assets/js/bundle/daterangepicker.bundle.js"></script>
            <!-- Jquery Page Js -->
            <script>
              // date range picker
              $(function() {
                $('input[name="daterange"]').daterangepicker({
                  opens: 'left'
                }, function(start, end, label) {
                  console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
                });
              })
            </script>
          </div>
        </div> <!-- .row end -->
      </div>
    </div>
    <!-- start: page body -->
    <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
      <div class="container-fluid">
        <div class="row row-cols-lg-4 row-cols-md-2 row-cols-sm-2 row-cols-1 g-2 mb-4 row-deck mb-5" >
          
         <?php if($show){?>
          <div class="col">
            <div class="card">
              <div class="card-body d-flex align-items-center">
                <div class=""><img class="avatar" src="./assets/img/BTC.svg" alt="BTC" /></div>
                <div class="flex-fill ms-3 text-truncate">
                  <span class="text-muted small text-uppercase">Bitcoin</span>
                  <div class="d-flex justify-content-between align-items-center">
                    <span class="fs-6 fw-bold">$25,450</span>
                    <span class="small text-success">+ 1.25 <i class="fa fa-level-up"></i></span>
                  </div>
                </div>
              </div>
              <div id="apexspark1"></div>
            </div>
          </div>
          <div class="col">
            <div class="card">
              <div class="card-body d-flex align-items-center">
                <div class=""><img class="avatar" src="./assets/img/XRP.svg" alt="BTC" /></div>
                <div class="flex-fill ms-3 text-truncate">
                  <span class="text-muted small text-uppercase">Ripple</span>
                  <div class="d-flex justify-content-between align-items-center">
                    <span class="fs-6 fw-bold">$25,450</span>
                    <span class="small text-success">+ 0.25 <i class="fa fa-level-up"></i></span>
                  </div>
                </div>
              </div>
              <div id="apexspark2"></div>
            </div>
          </div>
          <div class="col">
            <div class="card">
              <div class="card-body d-flex align-items-center">
                <div class=""><img class="avatar" src="./assets/img/neo.svg" alt="BTC" /></div>
                <div class="flex-fill ms-3 text-truncate">
                  <span class="text-muted small text-uppercase">Neo</span>
                  <div class="d-flex justify-content-between align-items-center">
                    <span class="fs-6 fw-bold">$25,450</span>
                    <span class="small text-success">+ 0.50 <i class="fa fa-level-up"></i></span>
                  </div>
                </div>
              </div>
              <div id="apexspark3"></div>
            </div>
          </div>
          <div class="col">
            <div class="card">
              <div class="card-body d-flex align-items-center">
                <div class=""><img class="avatar" src="./assets/img/ETH.svg" alt="BTC" /></div>
                <div class="flex-fill ms-3 text-truncate">
                  <span class="text-muted small text-uppercase">Ethereum</span>
                  <div class="d-flex justify-content-between align-items-center">
                    <span class="fs-6 fw-bold">$25,450</span>
                    <span class="small text-danger">- 0.73 <i class="fa fa-level-down"></i></span>
                  </div>
                </div>
              </div>
              <div id="apexspark4"></div>
            </div>
          </div>
        <?php }?>
      </div>
    </div>
    <?php include './include/footer.php'; ?>
    <script>
	$('.menu-dashboard').addClass("active");
      // top sparklines
    $(function() {
      var randomizeArray = function(arg) {
        var array = arg.slice();
        var currentIndex = array.length,
          temporaryValue, randomIndex;
        while (0 !== currentIndex) {
          randomIndex = Math.floor(Math.random() * currentIndex);
          currentIndex -= 1;
          temporaryValue = array[currentIndex];
          array[currentIndex] = array[randomIndex];
          array[randomIndex] = temporaryValue;
        }
        return array;
      }
      // data for the sparklines that appear below header area
      var sparklineData = [47, 45, 54, 38, 56, 47, 45, 54, 38, 56, 38, 56, 24, 65, 31];
      // topb big chart
      var spark1 = {
        chart: {
          type: 'area',
          height: 60,
          sparkline: {
            enabled: true
          },
        },
        stroke: {
          width: 1
        },
        series: [{
          data: randomizeArray(sparklineData)
        }],
        colors: ['#f8921a'],
      }
      var spark1 = new ApexCharts(document.querySelector("#apexspark1"), spark1);
      spark1.render();
      var spark2 = {
        chart: {
          type: 'area',
          height: 60,
          sparkline: {
            enabled: true
          },
        },
        stroke: {
          width: 1
        },
        series: [{
          data: randomizeArray(sparklineData)
        }],
        colors: ['#0077af'],
      }
      var spark2 = new ApexCharts(document.querySelector("#apexspark2"), spark2);
      spark2.render();
      var spark3 = {
        chart: {
          type: 'area',
          height: 60,
          sparkline: {
            enabled: true
          },
        },
        stroke: {
          width: 1
        },
        colors: ['#6fb92c'],
        series: [{
          data: randomizeArray(sparklineData)
        }],
      }
      var spark3 = new ApexCharts(document.querySelector("#apexspark3"), spark3);
      spark3.render();
      var spark4 = {
        chart: {
          type: 'area',
          height: 60,
          sparkline: {
            enabled: true
          },
        },
        stroke: {
          width: 1
        },
        colors: ['#141414'],
        series: [{
          data: randomizeArray(sparklineData)
        }],
      }
      var spark4 = new ApexCharts(document.querySelector("#apexspark4"), spark4);
      spark4.render();
    });
    // BTC
    $(function() {
      var options = {
        chart: {
          height: 340,
          type: 'candlestick',
          toolbar: {
            show: false,
          },
        },
        plotOptions: {
          candlestick: {
            colors: {
              upward: 'var(--chart-color1)',
              downward: 'var(--chart-color5)',
            },
            wick: {
              useFillColor: true
            }
          }
        },
        series: [{
          data: [{
            x: new Date(1538778600000),
            y: [6629.81, 6650.5, 6623.04, 6633.33]
          }, {
            x: new Date(1538780400000),
            y: [6632.01, 6643.59, 6620, 6630.11]
          }, {
            x: new Date(1538782200000),
            y: [6630.71, 6648.95, 6623.34, 6635.65]
          }, {
            x: new Date(1538784000000),
            y: [6635.65, 6651, 6629.67, 6638.24]
          }, {
            x: new Date(1538785800000),
            y: [6638.24, 6640, 6620, 6624.47]
          }, {
            x: new Date(1538787600000),
            y: [6624.53, 6636.03, 6621.68, 6624.31]
          }, {
            x: new Date(1538789400000),
            y: [6624.61, 6632.2, 6617, 6626.02]
          }, {
            x: new Date(1538791200000),
            y: [6627, 6627.62, 6584.22, 6603.02]
          }, {
            x: new Date(1538793000000),
            y: [6605, 6608.03, 6598.95, 6604.01]
          }, {
            x: new Date(1538794800000),
            y: [6604.5, 6614.4, 6602.26, 6608.02]
          }, {
            x: new Date(1538796600000),
            y: [6608.02, 6610.68, 6601.99, 6608.91]
          }, {
            x: new Date(1538798400000),
            y: [6608.91, 6618.99, 6608.01, 6612]
          }, {
            x: new Date(1538800200000),
            y: [6612, 6615.13, 6605.09, 6612]
          }, {
            x: new Date(1538802000000),
            y: [6612, 6624.12, 6608.43, 6622.95]
          }, {
            x: new Date(1538803800000),
            y: [6623.91, 6623.91, 6615, 6615.67]
          }, {
            x: new Date(1538805600000),
            y: [6618.69, 6618.74, 6610, 6610.4]
          }, {
            x: new Date(1538807400000),
            y: [6611, 6622.78, 6610.4, 6614.9]
          }, {
            x: new Date(1538809200000),
            y: [6614.9, 6626.2, 6613.33, 6623.45]
          }, {
            x: new Date(1538811000000),
            y: [6623.48, 6627, 6618.38, 6620.35]
          }, {
            x: new Date(1538812800000),
            y: [6619.43, 6620.35, 6610.05, 6615.53]
          }, {
            x: new Date(1538814600000),
            y: [6615.53, 6617.93, 6610, 6615.19]
          }, {
            x: new Date(1538816400000),
            y: [6615.19, 6621.6, 6608.2, 6620]
          }, {
            x: new Date(1538818200000),
            y: [6619.54, 6625.17, 6614.15, 6620]
          }, {
            x: new Date(1538820000000),
            y: [6620.33, 6634.15, 6617.24, 6624.61]
          }, {
            x: new Date(1538821800000),
            y: [6625.95, 6626, 6611.66, 6617.58]
          }, {
            x: new Date(1538823600000),
            y: [6619, 6625.97, 6595.27, 6598.86]
          }, {
            x: new Date(1538825400000),
            y: [6598.86, 6598.88, 6570, 6587.16]
          }, {
            x: new Date(1538827200000),
            y: [6588.86, 6600, 6580, 6593.4]
          }, {
            x: new Date(1538829000000),
            y: [6593.99, 6598.89, 6585, 6587.81]
          }, {
            x: new Date(1538830800000),
            y: [6587.81, 6592.73, 6567.14, 6578]
          }, {
            x: new Date(1538832600000),
            y: [6578.35, 6581.72, 6567.39, 6579]
          }, {
            x: new Date(1538834400000),
            y: [6579.38, 6580.92, 6566.77, 6575.96]
          }, {
            x: new Date(1538836200000),
            y: [6575.96, 6589, 6571.77, 6588.92]
          }, {
            x: new Date(1538838000000),
            y: [6588.92, 6594, 6577.55, 6589.22]
          }, {
            x: new Date(1538839800000),
            y: [6589.3, 6598.89, 6589.1, 6596.08]
          }, {
            x: new Date(1538841600000),
            y: [6597.5, 6600, 6588.39, 6596.25]
          }, {
            x: new Date(1538843400000),
            y: [6598.03, 6600, 6588.73, 6595.97]
          }, {
            x: new Date(1538845200000),
            y: [6595.97, 6602.01, 6588.17, 6602]
          }, {
            x: new Date(1538847000000),
            y: [6602, 6607, 6596.51, 6599.95]
          }, {
            x: new Date(1538848800000),
            y: [6600.63, 6601.21, 6590.39, 6591.02]
          }, {
            x: new Date(1538850600000),
            y: [6591.02, 6603.08, 6591, 6591]
          }, {
            x: new Date(1538852400000),
            y: [6591, 6601.32, 6585, 6592]
          }, {
            x: new Date(1538854200000),
            y: [6593.13, 6596.01, 6590, 6593.34]
          }, {
            x: new Date(1538856000000),
            y: [6593.34, 6604.76, 6582.63, 6593.86]
          }, {
            x: new Date(1538857800000),
            y: [6593.86, 6604.28, 6586.57, 6600.01]
          }, {
            x: new Date(1538859600000),
            y: [6601.81, 6603.21, 6592.78, 6596.25]
          }, {
            x: new Date(1538861400000),
            y: [6596.25, 6604.2, 6590, 6602.99]
          }, {
            x: new Date(1538863200000),
            y: [6602.99, 6606, 6584.99, 6587.81]
          }, {
            x: new Date(1538865000000),
            y: [6587.81, 6595, 6583.27, 6591.96]
          }, {
            x: new Date(1538866800000),
            y: [6591.97, 6596.07, 6585, 6588.39]
          }, {
            x: new Date(1538868600000),
            y: [6587.6, 6598.21, 6587.6, 6594.27]
          }, {
            x: new Date(1538870400000),
            y: [6596.44, 6601, 6590, 6596.55]
          }, {
            x: new Date(1538872200000),
            y: [6598.91, 6605, 6596.61, 6600.02]
          }, {
            x: new Date(1538874000000),
            y: [6600.55, 6605, 6589.14, 6593.01]
          }, {
            x: new Date(1538875800000),
            y: [6593.15, 6605, 6592, 6603.06]
          }, {
            x: new Date(1538877600000),
            y: [6603.07, 6604.5, 6599.09, 6603.89]
          }, {
            x: new Date(1538879400000),
            y: [6604.44, 6604.44, 6600, 6603.5]
          }, {
            x: new Date(1538881200000),
            y: [6603.5, 6603.99, 6597.5, 6603.86]
          }, {
            x: new Date(1538883000000),
            y: [6603.85, 6605, 6600, 6604.07]
          }, {
            x: new Date(1538884800000),
            y: [6604.98, 6606, 6604.07, 6606]
          }, ]
        }],
        xaxis: {
          type: 'datetime'
        },
        yaxis: {
          tooltip: {
            enabled: true
          }
        }
      }
      var chart = new ApexCharts(document.querySelector("#apex-BTC"), options);
      chart.render();
    });
    // ETC
    $(function() {
      var options = {
        chart: {
          height: 340,
          type: 'candlestick',
          toolbar: {
            show: false,
          },
        },
        plotOptions: {
          candlestick: {
            colors: {
              upward: 'var(--chart-color1)',
              downward: 'var(--chart-color5)',
            },
            wick: {
              useFillColor: true
            }
          }
        },
        series: [{
          data: [{
            x: new Date(1538778600000),
            y: [6629.81, 6650.5, 6623.04, 6633.33]
          }, {
            x: new Date(1538780400000),
            y: [6632.01, 6643.59, 6620, 6630.11]
          }, {
            x: new Date(1538818200000),
            y: [6619.54, 6625.17, 6614.15, 6620]
          }, {
            x: new Date(1538820000000),
            y: [6620.33, 6634.15, 6617.24, 6624.61]
          }, {
            x: new Date(1538821800000),
            y: [6625.95, 6626, 6611.66, 6617.58]
          }, {
            x: new Date(1538823600000),
            y: [6619, 6625.97, 6595.27, 6598.86]
          }, {
            x: new Date(1538825400000),
            y: [6598.86, 6598.88, 6570, 6587.16]
          }, {
            x: new Date(1538827200000),
            y: [6588.86, 6600, 6580, 6593.4]
          }, {
            x: new Date(1538829000000),
            y: [6593.99, 6598.89, 6585, 6587.81]
          }, {
            x: new Date(1538830800000),
            y: [6587.81, 6592.73, 6567.14, 6578]
          }, {
            x: new Date(1538832600000),
            y: [6578.35, 6581.72, 6567.39, 6579]
          }, {
            x: new Date(1538834400000),
            y: [6579.38, 6580.92, 6566.77, 6575.96]
          }, {
            x: new Date(1538836200000),
            y: [6575.96, 6589, 6571.77, 6588.92]
          }, {
            x: new Date(1538838000000),
            y: [6588.92, 6594, 6577.55, 6589.22]
          }, {
            x: new Date(1538839800000),
            y: [6589.3, 6598.89, 6589.1, 6596.08]
          }, {
            x: new Date(1538841600000),
            y: [6597.5, 6600, 6588.39, 6596.25]
          }, {
            x: new Date(1538843400000),
            y: [6598.03, 6600, 6588.73, 6595.97]
          }, {
            x: new Date(1538845200000),
            y: [6595.97, 6602.01, 6588.17, 6602]
          }, {
            x: new Date(1538847000000),
            y: [6602, 6607, 6596.51, 6599.95]
          }, {
            x: new Date(1538848800000),
            y: [6600.63, 6601.21, 6590.39, 6591.02]
          }, {
            x: new Date(1538850600000),
            y: [6591.02, 6603.08, 6591, 6591]
          }, {
            x: new Date(1538852400000),
            y: [6591, 6601.32, 6585, 6592]
          }, {
            x: new Date(1538854200000),
            y: [6593.13, 6596.01, 6590, 6593.34]
          }, {
            x: new Date(1538856000000),
            y: [6593.34, 6604.76, 6582.63, 6593.86]
          }, {
            x: new Date(1538857800000),
            y: [6593.86, 6604.28, 6586.57, 6600.01]
          }, {
            x: new Date(1538859600000),
            y: [6601.81, 6603.21, 6592.78, 6596.25]
          }, {
            x: new Date(1538861400000),
            y: [6596.25, 6604.2, 6590, 6602.99]
          }, {
            x: new Date(1538863200000),
            y: [6602.99, 6606, 6584.99, 6587.81]
          }, {
            x: new Date(1538865000000),
            y: [6587.81, 6595, 6583.27, 6591.96]
          }, {
            x: new Date(1538782200000),
            y: [6630.71, 6648.95, 6623.34, 6635.65]
          }, {
            x: new Date(1538794800000),
            y: [6604.5, 6614.4, 6602.26, 6608.02]
          }, {
            x: new Date(1538796600000),
            y: [6608.02, 6610.68, 6601.99, 6608.91]
          }, {
            x: new Date(1538798400000),
            y: [6608.91, 6618.99, 6608.01, 6612]
          }, {
            x: new Date(1538800200000),
            y: [6612, 6615.13, 6605.09, 6612]
          }, {
            x: new Date(1538802000000),
            y: [6612, 6624.12, 6608.43, 6622.95]
          }, {
            x: new Date(1538803800000),
            y: [6623.91, 6623.91, 6615, 6615.67]
          }, {
            x: new Date(1538805600000),
            y: [6618.69, 6618.74, 6610, 6610.4]
          }, {
            x: new Date(1538807400000),
            y: [6611, 6622.78, 6610.4, 6614.9]
          }, {
            x: new Date(1538809200000),
            y: [6614.9, 6626.2, 6613.33, 6623.45]
          }, {
            x: new Date(1538811000000),
            y: [6623.48, 6627, 6618.38, 6620.35]
          }, {
            x: new Date(1538812800000),
            y: [6619.43, 6620.35, 6610.05, 6615.53]
          }, {
            x: new Date(1538814600000),
            y: [6615.53, 6617.93, 6610, 6615.19]
          }, {
            x: new Date(1538816400000),
            y: [6615.19, 6621.6, 6608.2, 6620]
          }, {
            x: new Date(1538866800000),
            y: [6591.97, 6596.07, 6585, 6588.39]
          }, {
            x: new Date(1538868600000),
            y: [6587.6, 6598.21, 6587.6, 6594.27]
          }, {
            x: new Date(1538870400000),
            y: [6596.44, 6601, 6590, 6596.55]
          }, {
            x: new Date(1538872200000),
            y: [6598.91, 6605, 6596.61, 6600.02]
          }, {
            x: new Date(1538784000000),
            y: [6635.65, 6651, 6629.67, 6638.24]
          }, {
            x: new Date(1538785800000),
            y: [6638.24, 6640, 6620, 6624.47]
          }, {
            x: new Date(1538787600000),
            y: [6624.53, 6636.03, 6621.68, 6624.31]
          }, {
            x: new Date(1538789400000),
            y: [6624.61, 6632.2, 6617, 6626.02]
          }, {
            x: new Date(1538791200000),
            y: [6627, 6627.62, 6584.22, 6603.02]
          }, {
            x: new Date(1538793000000),
            y: [6605, 6608.03, 6598.95, 6604.01]
          }, {
            x: new Date(1538874000000),
            y: [6600.55, 6605, 6589.14, 6593.01]
          }, {
            x: new Date(1538875800000),
            y: [6593.15, 6605, 6592, 6603.06]
          }, {
            x: new Date(1538877600000),
            y: [6603.07, 6604.5, 6599.09, 6603.89]
          }, {
            x: new Date(1538879400000),
            y: [6604.44, 6604.44, 6600, 6603.5]
          }, {
            x: new Date(1538881200000),
            y: [6603.5, 6603.99, 6597.5, 6603.86]
          }, {
            x: new Date(1538883000000),
            y: [6603.85, 6605, 6600, 6604.07]
          }, {
            x: new Date(1538884800000),
            y: [6604.98, 6606, 6604.07, 6606]
          }, ]
        }],
        xaxis: {
          type: 'datetime'
        },
        yaxis: {
          tooltip: {
            enabled: true
          }
        }
      }
      $("#nav_ETC").on("click", function() {
        setTimeout(function() {
          var chart = new ApexCharts(document.querySelector("#apex-ETC"), options);
          chart.render();
        }, 500);
      });
    });
    </script>