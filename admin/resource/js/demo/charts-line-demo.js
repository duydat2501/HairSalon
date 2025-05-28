document.addEventListener('DOMContentLoaded', function () {
  setTimeout(function () {
      if (document.querySelector('#visitor-chart')) {
        visitorChart();
      }else if (document.querySelector('#service-chart')) {
        serviceChart();
      } 
    }, 500);
  });
  function serviceChart() {
    (function () {
      fetch('?page=chart&action=service_stats&type=week')
      .then(res => res.json())
      .then(data => {
        console.log(data);
        
        var options = {
            chart: {
              height: 450,
              type: 'area',
              toolbar: {
                show: false
              }
            },
            dataLabels: {
              enabled: false
            },
            colors: ['#1890ff', '#13c2c2', '#52c41a'],
            series: [{
              name: 'Doanh thu (triệu)',
              data: data.revenue
            },{
              name: 'Dịch vụ sử dụng',
              data: data.new_order
            },{
              name: 'Đơn mới',
              data: data.used_service
            }],
            stroke: {
              curve: 'smooth',
              width: 2
            },
            xaxis: {
              categories: data.date,
            }
          };
          var chart = new ApexCharts(document.querySelector('#service-chart'), options);
          chart.render();
      })
      .catch(err => console.log(err));
    })();

    // Monthly Chart
     (function () {
      fetch('?page=chart&action=service_stats&type=month')
      .then(res => res.json())
      .then(data => {
        console.log(data);
        
        var options = {
            chart: {
              height: 450,
              type: 'area',
              toolbar: {
                show: false
              }
            },
            dataLabels: {
              enabled: false
            },
            colors: ['#1890ff', '#13c2c2', '#52c41a'],
            series: [{
              name: 'Doanh thu (triệu)',
              data: data.revenue
            },{
              name: 'Dịch vụ sử dụng',
              data: data.new_order
            },{
              name: 'Đơn mới',
              data: data.used_service
            }],
            stroke: {
              curve: 'smooth',
              width: 2
            },
            xaxis: {
              categories: data.date,
            }
          };
          var chart = new ApexCharts(document.querySelector('#service-chart-1'), options);
          chart.render();
      })
      .catch(err => console.log(err));
    })();

    // Year Chart
     (function () {
      fetch('?page=chart&action=service_stats&type=year')
      .then(res => res.json())
      .then(data => {
        var options = {
            chart: {
              height: 450,
              type: 'area',
              toolbar: {
                show: false
              }
            },
            dataLabels: {
              enabled: false
            },
            colors: ['#1890ff', '#13c2c2', '#52c41a'],
            series: [{
              name: 'Doanh thu (triệu)',
              data: data.revenue
            },{
              name: 'Dịch vụ sử dụng',
              data: data.new_order
            },{
              name: 'Đơn mới',
              data: data.used_service
            }],
            stroke: {
              curve: 'smooth',
              width: 2
            },
            xaxis: {
              categories: data.month,
            }
          };
          var chart = new ApexCharts(document.querySelector('#service-chart-2'), options);
          chart.render();
      })
      .catch(err => console.log(err));
    })();
  }
  function visitorChart() {
    (function () {
      fetch('?page=chart&action=order_stats&type=week')
      .then(res => res.json())
      .then(data => {
        var options = {
            chart: {
              height: 450,
              type: 'area',
              toolbar: {
                show: false
              }
            },
            dataLabels: {
              enabled: false
            },
            colors: ['#1890ff', '#13c2c2'],
            series: [{
              name: 'Số đơn',
              data: data.counts
            }],
            stroke: {
              curve: 'smooth',
              width: 2
            },
            xaxis: {
              categories: data.labels,
            }
          };
          var chart = new ApexCharts(document.querySelector('#visitor-chart'), options);
          chart.render();
      })
      .catch(err => console.error(err));
    //   Monthly Chart
    fetch('?page=chart&action=order_stats&type=month')
      .then(res => res.json())
      .then(data => {
        var options = {
          chart: {
            height: 450,
            type: 'area',
            toolbar: {
              show: false
            }
          },
          dataLabels: {
            enabled: false
          },
          colors: ['#1890ff', '#13c2c2'],
          series: [{
            name: 'Số đơn',
            data: data.counts
          }],
          stroke: {
            curve: 'smooth',
            width: 2
          },
          xaxis: {
            categories: data.labels,
          }
        };
        var chart = new ApexCharts(document.querySelector('#visitor-chart-1'), options);
        chart.render();
      }).catch(err => console.error(err));
    //  Yearly Chart
    fetch('?page=chart&action=order_stats&type=year')
      .then(res => res.json())
      .then(data => {
        var options = {
          chart: {
            height: 450,
            type: 'area',
            toolbar: {
              show: false
            }
          },
          dataLabels: {
            enabled: false
          },
          colors: ['#1890ff', '#13c2c2'],
          series: [{
            name: 'Số đơn',
            data: data.counts
          }],
          stroke: {
            curve: 'smooth',
            width: 2
          },
          xaxis: {
            categories: data.labels,
          }
        };
        var chart = new ApexCharts(document.querySelector('#visitor-chart-2'), options);
        chart.render();
      })

    })();
  }