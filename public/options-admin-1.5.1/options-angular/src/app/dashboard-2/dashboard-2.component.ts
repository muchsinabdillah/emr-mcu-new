import { Component, OnInit } from '@angular/core';
import { AmChartsService } from "amcharts3-angular2";

@Component({
	selector: 'app-dashboard-2',
	templateUrl: './dashboard-2.component.html',
	styleUrls: ['./dashboard-2.component.scss']
})
export class Dashboard2Component implements OnInit {

    private timer: any;
    private chart: any;
    private chart2: any;

	constructor(private AmCharts: AmChartsService) { }

	ngOnInit() {
        this.chart = this.AmCharts.makeChart("bar-chart", {
            "type": "serial",
            "theme": "light",
            "fontFamily": "Poppins",
            "dataProvider": [ {
            "country": "USA",
            "visits": 2025
            }, {
            "country": "China",
            "visits": 1882
            }, {
            "country": "Japan",
            "visits": 1809
            }, {
            "country": "Germany",
            "visits": 1322
            }, {
            "country": "UK",
            "visits": 1122
            }, {
            "country": "France",
            "visits": 1114
            }, {
            "country": "India",
            "visits": 984
            } ],
            "valueAxes": [ {
            "gridColor": "#FFFFFF",
            "gridAlpha": 0.2,
            "dashLength": 0
            } ],
            "gridAboveGraphs": true,
            "startDuration": 1,
            "graphs": [ {
            "balloonText": "[[category]]: <b>[[value]]</b>",
            "fillAlphas": 0.8,
            "lineAlpha": 0.2,
            "type": "column",
            "valueField": "visits"
            } ],
            "chartCursor": {
            "categoryBalloonEnabled": false,
            "cursorAlpha": 0,
            "zoomable": false
            },
            "categoryField": "country",
            "categoryAxis": {
            "gridPosition": "start",
            "gridAlpha": 0,
            "tickPosition": "start",
            "tickLength": 20
            },
            "export": {
                "enabled": true
            }
        });

        this.chart2 = this.AmCharts.makeChart("pie-chart", {
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
       }
}
