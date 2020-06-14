<canvas id="myPieChart"></canvas>

<script>
// Define a plugin to provide data labels
Chart.plugins.register({
  afterDatasetsDraw: function (chart, easing) {
    // To only draw at the end of animation, check for easing === 1
    var ctx = chart.ctx;

    chart.data.datasets.forEach(function (dataset, i) {
      var dataSum = 0;
      dataset.data.forEach(function (element){
          dataSum += element;
      });

      var meta = chart.getDatasetMeta(i);
        if (!meta.hidden) {
          meta.data.forEach(function (element, index) {
              // Draw the text in black, with the specified font
              ctx.fillStyle = '#000';

              var fontSize = 12;
              var fontStyle = 'normal';
              var fontFamily = 'Helvetica Neue';
              ctx.font = Chart.helpers.fontString(fontSize, fontStyle, fontFamily);

                // Just naively convert to string for now
              var labelString = chart.data.labels[index];
              var dataString = (Math.round(dataset.data[index] / dataSum * 1000)/10).toString() + "%";

                // Make sure alignment settings are correct
              ctx.textAlign = 'center';
              ctx.textBaseline = 'middle';

              var padding = 5;
              var position = element.tooltipPosition();
              ctx.fillText(labelString, position.x, position.y - (fontSize / 2) - padding);
              ctx.fillText(dataString, position.x, position.y + (fontSize / 2) - padding);
          });
        }
    });
  }
});
  var ctx = document.getElementById("myPieChart");
    var myPieChart = new Chart(ctx, {
      type: 'pie',
      data: {
        labels:[
          @foreach ($targetQ->answer_sentences as $answer)
          @if(count($answer->answer_logs))
            '{{$answer->sentence}}',
          @endif
          @endforeach
        ],
        datasets: [{
            backgroundColor:[
              @foreach ($targetQ->answer_sentences as $answer)
                @if(count($answer->answer_logs))
                  '{{config('global.colors.'.$loop->index)}}',
                @endif
              @endforeach
            ],
            data: [
              @foreach ($targetQ->answer_sentences as $answer)
                @if(count($answer->answer_logs))
                  {{count($answer->answer_logs)}},
                @endif
              @endforeach
            ]
        }]
      },
      options: {
        showAllTooltips: true,
        legend: {
          display: false,
        },
        // tooltips:{
        //   callbacks: {
        //     label: function(tooltipItem, data) {
        //       //get the concerned dataset
        //       var dataset = data.datasets[tooltipItem.datasetIndex];
        //       //calculate the total of this data set
        //       var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {
        //         return previousValue + currentValue;
        //       });
        //       //get the current items value
        //       var currentValue = dataset.data[tooltipItem.index];
        //       //calculate the percentage based on the total and current item, also this does a rough rounding to give a whole number
        //       var percentage = Math.floor(((currentValue/total) * 100)+0.5);

        //       return percentage + '%';
        //     }
        //   },
        // },
        animation:false,
        maintainAspectRatio: false,
      }
    });
</script>
