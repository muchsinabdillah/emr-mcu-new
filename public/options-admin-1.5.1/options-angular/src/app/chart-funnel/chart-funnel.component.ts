import { Component, OnInit } from '@angular/core';
import { AmChartsService } from "amcharts3-angular2";

@Component({
	selector: 'app-chart-funnel',
	templateUrl: './chart-funnel.component.html',
	styleUrls: ['./chart-funnel.component.scss']
})
export class ChartFunnelComponent implements OnInit {

	constructor(private AmCharts: AmChartsService) { }

	ngOnInit() {
        // chart1
        var chart;
        var data = [
            {
                "title": "Website visits",
                "value": 300
            },
            {
                "title": "Downloads",
                "value": 123
            },
            {
                "title": "Requested price list",
                "value": 98
            },
            {
                "title": "Contaced for more info",
                "value": 72
            },
            {
                "title": "Purchased",
                "value": 35
            },
            {
                "title": "Contacted for support",
                "value": 15
            },
            {
                "title": "Purchased additional products",
                "value": 8
            }
        ];
        var chart1 = this.AmCharts.makeChart( "chart1", {
          "type": "funnel",
          "theme": "light",
          "fontFamily": "Poppins",
          "dataProvider": data,
          "balloon": {
            "fixedPosition": true,
            "cornerRadius": 0,
            "animationTime": 0.2
          },
          "valueField": "value",
          "titleField": "title",
          "marginRight": 220,
          "marginLeft": 15,
          "neckWidth": "40%",
          "neckHeight": "30%",
          "startAlpha": 0,
          "startX": 0,
          "depth3D": 100,
          "angle": 40,
          "funnelAlpha": 0.9,
          "colors": ["#e74c3c", "#f39c12", "#27ae60", "#3498db", "#5bc0de"],
          "outlineAlpha": 1,
          "outlineColor": "#FFFFFF",
          "outlineThickness": 2,
          "labelPosition": "right",
          "balloonText": "[[title]]: [[value]]n[[description]]",
          "export": {
            "enabled": true
          }
        } );

        // Chart 2
        var chart2 = this.AmCharts.makeChart( "chart2", {
          "type": "funnel",
          "theme": "light",
          "fontFamily": "Poppins",
          "dataProvider": [ {
            "title": "Website visits",
            "value": 200
          }, {
            "title": "Downloads",
            "value": 123
          }, {
            "title": "Requested price list",
            "value": 98
          }, {
            "title": "Contaced for more info",
            "value": 72
          }, {
            "title": "Purchased",
            "value": 35
          }, {
            "title": "Contacted for support",
            "value": 35
          }, {
            "title": "Purchased additional products",
            "value": 26
          } ],
          "balloon": {
            "fixedPosition": true
          },
          "valueField": "value",
          "titleField": "title",
          "marginRight": 240,
          "marginLeft": 50,
          "startX": -500,
          "depth3D": 100,
          "angle": 40,
          "colors": ["#e74c3c", "#f39c12", "#27ae60", "#3498db", "#5bc0de"],
          "outlineAlpha": 1,
          "outlineColor": "#FFFFFF",
          "outlineThickness": 2,
          "labelPosition": "right",
          "balloonText": "[[title]]: [[value]]n[[description]]",
          "export": {
            "enabled": true
          }
        } );

        // Chart 3
        var chart3 = this.AmCharts.makeChart( "chart3", {
          "type": "funnel",
          "theme": "light",
          "fontFamily": "Poppins",
          "dataProvider": [ {
            "title": "Website visits",
            "value": 300
          }, {
            "title": "Downloads",
            "value": 123
          }, {
            "title": "Requested price list",
            "value": 98
          }, {
            "title": "Contaced for more info",
            "value": 72
          }, {
            "title": "Purchased",
            "value": 35
          }, {
            "title": "Contacted for support",
            "value": 15
          }, {
            "title": "Purchased additional products",
            "value": 8
          } ],
          "balloon": {
            "fixedPosition": true
          },
          "valueField": "value",
          "titleField": "title",
          "marginRight": 240,
          "marginLeft": 50,
          "startX": -500,
          "rotate": true,
          "colors": ["#e74c3c", "#f39c12", "#27ae60", "#3498db", "#5bc0de"],
          "labelPosition": "right",
          "balloonText": "[[title]]: [[value]]n[[description]]",
          "export": {
            "enabled": true
          }
        } );
	}

}
