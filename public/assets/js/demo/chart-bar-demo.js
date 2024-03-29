// Bar Chart Example
var ctx = document.getElementById("myBarChart");

var crimes_per_category = JSON.parse(document.getElementById("crimes_per_category").value);
console.log(crimes_per_category);
var total_crimes_array = crimes_per_category.map(function(crime) {
    return crime.total_crimes;
});

var crime_locations_array = crimes_per_category.map(function(crime) {
    return crime.category_name;
});

var dataArray = total_crimes_array.join(", ");
var dataArrayAsNumbers = dataArray.split(",").map(Number);

var myBarChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: crime_locations_array,
    datasets: [{
      label: "",
      backgroundColor: "#4e73df",
      hoverBackgroundColor: "#2e59d9",
      borderColor: "#4e73df",
      data: dataArrayAsNumbers,
    }],
  },
  options: {
    maintainAspectRatio: false,
    layout: {
        padding: {
            left: 10,
            right: 25,
            top: 25,
            bottom: 0
          }
    },
    scales: {
        xAxes: [{
            time: {
              unit: 'month'
            },
            gridLines: {
              display: false,
              drawBorder: false
            },
            ticks: {
            //   maxTicksLimit: 6
            },
            // maxBarThickness: 25,
          }],
          yAxes: [{
            ticks: {
              min: 0,
            //   maxTicksLimit: 5,
              padding: 10,
              // Include a dollar sign in the ticks
              callback: function(value, index, values) {
                return number_format(value);
              }
            },
            gridLines: {
                color: "rgb(234, 236, 244)",
                zeroLineColor: "rgb(234, 236, 244)",
                drawBorder: false,
                borderDash: [2],
                zeroLineBorderDash: [2]
              }
        }],
    },
    legend: {
      display: false
    },
    tooltips: {
        titleMarginBottom: 10,
        titleFontColor: '#6e707e',
        titleFontSize: 14,
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        caretPadding: 10,
      callbacks: {
        label: function(tooltipItem, chart) {
          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
          var formattedValue = new Intl.NumberFormat().format(tooltipItem.yLabel);
          return datasetLabel + formattedValue;
        }
      }
    },
  }
});
