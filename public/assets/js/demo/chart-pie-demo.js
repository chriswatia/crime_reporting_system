// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
var ctx = document.getElementById("myPieChart");

var total_crimes = JSON.parse(document.getElementById("total_crimes").value);
var total_crimes_array = total_crimes.map(function(crime) {
    return crime.total_crimes;
});

var crime_locations_array = total_crimes.map(function(crime) {
    return crime.crime_location;
});


var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: crime_locations_array,
    datasets: [{
      data: total_crimes_array,
      backgroundColor: generateBackgroundColors(total_crimes_array.length),
    //   hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
    //   hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});

function generateBackgroundColors(count) {
    var colors = [];
    for (var i = 0; i < count; i++) {
      colors.push(dynamicColor());
    }
    return colors;
  }

  function dynamicColor() {
    var letters = '0123456789ABCDEF';
    var color = '#';
    for (var i = 0; i < 6; i++) {
      color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
  }
