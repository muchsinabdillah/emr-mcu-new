import { Component, OnInit } from '@angular/core';
import { AmChartsService } from "amcharts3-angular2";

@Component({
	selector: 'app-chart-pie-chart',
	templateUrl: './chart-pie-chart.component.html',
	styleUrls: ['./chart-pie-chart.component.scss']
})
export class ChartPieChartComponent implements OnInit {

	constructor(private AmCharts: AmChartsService) { }

	ngOnInit() {
        // chart1
        var chart1 = this.AmCharts.makeChart( "chart1", {
          "type": "pie",
          "theme": "light",
          "fontFamily": "Poppins",
          "dataProvider": [ {
            "country": "Lithuania",
            "litres": 501.9
          }, {
            "country": "Czech Republic",
            "litres": 301.9
          }, {
            "country": "Ireland",
            "litres": 201.1
          }, {
            "country": "Germany",
            "litres": 165.8
          }, {
            "country": "Australia",
            "litres": 139.9
          }, {
            "country": "Austria",
            "litres": 128.3
          }, {
            "country": "UK",
            "litres": 99
          }, {
            "country": "Belgium",
            "litres": 60
          }, {
            "country": "The Netherlands",
            "litres": 50
          } ],
          "valueField": "litres",
          "titleField": "country",
           "balloon":{
           "fixedPosition":true
          },
          "export": {
            "enabled": true
          }
        } );

        // chart2
        var chart2 = this.AmCharts.makeChart("chart2", {
            "type": "pie",
            "theme": "light",
            "fontFamily": "Poppins",
            "innerRadius": "40%",
            "gradientRatio": [-0.4, -0.4, -0.4, -0.4, -0.4, -0.4, 0, 0.1, 0.2, 0.1, 0, -0.2, -0.5],
            "dataProvider": [{
                "country": "Lithuania",
                "litres": 501.9
            }, {
                "country": "Czech Republic",
                "litres": 301.9
            }, {
                "country": "Ireland",
                "litres": 201.1
            }, {
                "country": "Germany",
                "litres": 165.8
            }, {
                "country": "Australia",
                "litres": 139.9
            }, {
                "country": "Austria",
                "litres": 128.3
            }],
            "balloonText": "[[value]]",
            "valueField": "litres",
            "titleField": "country",
            "balloon": {
                "drop": true,
                "adjustBorderColor": false,
                "color": "#FFFFFF",
                "fontSize": 16
            },
            "export": {
                "enabled": true
            }
        });


        // Chart 4
        var chart4 = this.AmCharts.makeChart( "chart4", {
          "type": "pie",
          "theme": "light",
          "fontFamily": "Poppins",
          "dataProvider": [ {
            "country": "Lithuania",
            "value": 260
          }, {
            "country": "Ireland",
            "value": 201
          }, {
            "country": "Germany",
            "value": 65
          }, {
            "country": "Australia",
            "value": 39
          }, {
            "country": "UK",
            "value": 19
          }, {
            "country": "Latvia",
            "value": 10
          } ],
          "valueField": "value",
          "titleField": "country",
          "outlineAlpha": 0.4,
          "depth3D": 15,
          "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
          "angle": 30,
          "export": {
            "enabled": true
          }
        } );

        // Chart 5
        var chart5 = this.AmCharts.makeChart( "chart5", {
          "type": "pie",
          "theme": "light",
          "fontFamily": "Poppins",
          "titles": [ {
            "text": "Visitors countries",
            "size": 16
          } ],
          "dataProvider": [ {
            "country": "United States",
            "visits": 7252
          }, {
            "country": "China",
            "visits": 3882
          }, {
            "country": "Japan",
            "visits": 1809
          }, {
            "country": "Germany",
            "visits": 1322
          }, {
            "country": "United Kingdom",
            "visits": 1122
          }, {
            "country": "France",
            "visits": 414
          }, {
            "country": "India",
            "visits": 384
          }, {
            "country": "Spain",
            "visits": 211
          } ],
          "valueField": "visits",
          "titleField": "country",
          "startEffect": "elastic",
          "startDuration": 2,
          "labelRadius": 15,
          "innerRadius": "50%",
          "depth3D": 10,
          "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
          "angle": 15,
          "export": {
            "enabled": true
          }
        } );
	}

}
