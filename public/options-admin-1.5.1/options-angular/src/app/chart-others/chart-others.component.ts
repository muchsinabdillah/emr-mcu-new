import { Component, OnInit } from '@angular/core';
import { AmChartsService } from "amcharts3-angular2";

@Component({
	selector: 'app-chart-others',
	templateUrl: './chart-others.component.html',
	styleUrls: ['./chart-others.component.scss']
})
export class ChartOthersComponent implements OnInit {

	constructor(private AmCharts: AmChartsService) { }

	ngOnInit() {
        // chart1
        var chart1 = this.AmCharts.makeChart("chart1", {
          "theme": "light",
          "type": "gauge",
          "fontFamily": "Poppins",
          "axes": [{
            "topTextFontSize": 20,
            "topTextYOffset": 70,
            "axisColor": "#31d6ea",
            "axisThickness": 1,
            "endValue": 100,
            "gridInside": true,
            "inside": true,
            "radius": "50%",
            "valueInterval": 10,
            "tickColor": "#67b7dc",
            "startAngle": -90,
            "endAngle": 90,
            "unit": "%",
            "bandOutlineAlpha": 0,
            "bands": [{
              "color": "#3498db",
              "endValue": 100,
              "innerRadius": "105%",
              "radius": "170%",
              "gradientRatio": [0.5, 0, -0.5],
              "startValue": 0
            }, {
              "color": "#27ae60",
              "endValue": 0,
              "innerRadius": "105%",
              "radius": "170%",
              "gradientRatio": [0.5, 0, -0.5],
              "startValue": 0
            }]
          }],
          "arrows": [{
            "alpha": 1,
            "innerRadius": "35%",
            "nailRadius": 0,
            "radius": "170%"
          }]
        });

        setInterval(randomValue, 2000);

        // set random value
        function randomValue() {
          var value = Math.round(Math.random() * 100);
          chart1.arrows[0].setValue(value);
          chart1.axes[0].setTopText(value + " %");
          // adjust darker band to new value
          chart1.axes[0].bands[1].setEndValue(value);
        }

        // Chart 2
        var gaugeChart = this.AmCharts.makeChart( "chart2", {
          "type": "gauge",
          "theme": "light",
          "fontFamily": "Poppins",
          "axes": [ {
            "axisThickness": 1,
            "axisAlpha": 0.2,
            "tickAlpha": 0.2,
            "valueInterval": 20,
            "bands": [ {
              "color": "#84b761",
              "endValue": 90,
              "startValue": 0
            }, {
              "color": "#fdd400",
              "endValue": 130,
              "startValue": 90
            }, {
              "color": "#cc4748",
              "endValue": 220,
              "innerRadius": "95%",
              "startValue": 130
            } ],
            "bottomText": "0 km/h",
            "bottomTextYOffset": -20,
            "endValue": 220
          } ],
          "arrows": [ {} ],
          "export": {
            "enabled": true
          }
        } );

        setInterval( randomValue2, 2000 );

        // set random value
        function randomValue2() {
          var value = Math.round( Math.random() * 200 );
          if ( gaugeChart ) {
            if ( gaugeChart.arrows ) {
              if ( gaugeChart.arrows[ 0 ] ) {
                if ( gaugeChart.arrows[ 0 ].setValue ) {
                  gaugeChart.arrows[ 0 ].setValue( value );
                  gaugeChart.axes[ 0 ].setBottomText( value + " km/h" );
                }
              }
            }
          }
        }

        // Chart 3
        var chart3 = this.AmCharts.makeChart( "chart3", {
          "type": "gauge",
          "theme": "dark",
          "fontFamily": "Poppins",
          "startDuration": 0.3,
          "marginTop": 20,
          "marginBottom": 50,
          "axes": [ {
            "axisAlpha": 0.3,
            "endAngle": 360,
            "endValue": 12,
            "minorTickInterval": 0.2,
            "showFirstLabel": false,
            "startAngle": 0,
            "axisThickness": 1,
            "valueInterval": 1
          } ],
          "arrows": [ {
            "radius": "50%",
            "innerRadius": 0,
            "clockWiseOnly": true,
            "nailRadius": 10,
            "nailAlpha": 1
          }, {
            "nailRadius": 0,
            "radius": "80%",
            "startWidth": 6,
            "innerRadius": 0,
            "clockWiseOnly": true
          }, {
            "color": "#CC0000",
            "nailRadius": 4,
            "startWidth": 3,
            "innerRadius": 0,
            "clockWiseOnly": true,
            "nailAlpha": 1
          } ],
          "export": {
            "enabled": true
          }
        } );

        // update each second
        setInterval( updateClock, 1000 );

        // update clock
        function updateClock() {
          if(chart3.arrows.length > 0){
            // get current date
            var date = new Date();
            var hours = date.getHours();
            var minutes = date.getMinutes();
            var seconds = date.getSeconds();

            if(chart3.arrows[ 0 ].setValue){
              // set hours
              chart3.arrows[ 0 ].setValue( hours + minutes / 60 );
              // set minutes
              chart3.arrows[ 1 ].setValue( 12 * ( minutes + seconds / 60 ) / 60 );
              // set seconds
              chart3.arrows[ 2 ].setValue( 12 * date.getSeconds() / 60 );
              }
          }
        }

        // Chart 4
        var gaugeChart4 = this.AmCharts.makeChart("chart4", {
          "type": "gauge",
          "theme": "dark",
          "fontFamily": "Poppins",
          "axes": [{
            "axisAlpha": 0,
            "tickAlpha": 0,
            "labelsEnabled": false,
            "startValue": 0,
            "endValue": 100,
            "startAngle": 0,
            "endAngle": 270,
            "bands": [{
              "color": "#eee",
              "startValue": 0,
              "endValue": 100,
              "radius": "100%",
              "innerRadius": "85%"
            }, {
              "color": "#3498db",
              "startValue": 0,
              "endValue": 80,
              "radius": "100%",
              "innerRadius": "85%",
              "balloonText": "90%"
            }, {
              "color": "#eee",
              "startValue": 0,
              "endValue": 100,
              "radius": "80%",
              "innerRadius": "65%"
            }, {
              "color": "#e74c3c",
              "startValue": 0,
              "endValue": 35,
              "radius": "80%",
              "innerRadius": "65%",
              "balloonText": "35%"
            }, {
              "color": "#eee",
              "startValue": 0,
              "endValue": 100,
              "radius": "60%",
              "innerRadius": "45%"
            }, {
              "color": "#27ae60",
              "startValue": 0,
              "endValue": 92,
              "radius": "60%",
              "innerRadius": "45%",
              "balloonText": "92%"
            }, {
              "color": "#eee",
              "startValue": 0,
              "endValue": 100,
              "radius": "40%",
              "innerRadius": "25%"
            }, {
              "color": "#f39c12",
              "startValue": 0,
              "endValue": 68,
              "radius": "40%",
              "innerRadius": "25%",
              "balloonText": "68%"
            }]
          }],
          "allLabels": [{
            "text": "First option",
            "x": "49%",
            "y": "5%",
            "size": 15,
            "bold": true,
            "color": "#3498db",
            "align": "right"
          }, {
            "text": "Second option",
            "x": "49%",
            "y": "15%",
            "size": 15,
            "bold": true,
            "color": "#e74c3c",
            "align": "right"
          }, {
            "text": "Third option",
            "x": "49%",
            "y": "24%",
            "size": 15,
            "bold": true,
            "color": "#27ae60",
            "align": "right"
          }, {
            "text": "Fourth option",
            "x": "49%",
            "y": "33%",
            "size": 15,
            "bold": true,
            "color": "#f39c12",
            "align": "right"
          }],
          "export": {
            "enabled": true
          }
        });
	}

}
