import { Component, OnInit } from '@angular/core';
import { AmChartsService } from "amcharts3-angular2";

@Component({
	selector: 'app-dashboard',
	templateUrl: './dashboard.component.html',
	styleUrls: ['./dashboard.component.scss']
})
export class DashboardComponent implements OnInit {

    private timer: any;
    private chart: any;
    private chart2: any;

	constructor(private AmCharts: AmChartsService) { }

	ngOnInit() {
        this.chart = this.AmCharts.makeChart("prod-chart", {
			"type": "serial",
			"theme": "light",
            "fontFamily": "Poppins",
			"marginTop": 0,
			"marginRight": 80,
			"dataProvider": this.makeRandomDataProvider(),
			"valueAxes": [{
				"axisAlpha": 0,
				"position": "left"
			}],
			"graphs": [{
				"id": "g1",
				"balloonText": "[[category]]<br><b><span style='font-size:14px;'>[[value]]</span></b>",
				"bullet": "round",
				"bulletSize": 8,
				"lineColor": "#27ae60",
				"lineThickness": 2,
				"negativeLineColor": "#e74c3c",
				"type": "smoothedLine",
				"valueField": "value"
			}],
			"chartScrollbar": {
				"graph": "g1",
				"gridAlpha": 0,
				"color": "#888888",
				"scrollbarHeight": 55,
				"backgroundAlpha": 0,
				"selectedBackgroundAlpha": 0.1,
				"selectedBackgroundColor": "#888888",
				"graphFillAlpha": 0,
				"autoGridCount": true,
				"selectedGraphFillAlpha": 0,
				"graphLineAlpha": 0.2,
				"graphLineColor": "#c2c2c2",
				"selectedGraphLineColor": "#888888",
				"selectedGraphLineAlpha": 1
			},
			"chartCursor": {
				"categoryBalloonDateFormat": "YYYY",
				"cursorAlpha": 0,
				"valueLineEnabled": true,
				"valueLineBalloonEnabled": true,
				"valueLineAlpha": 0.5,
				"fullWidth": true
			},
			"dataDateFormat": "YYYY",
			"categoryField": "year",
			"categoryAxis": {
				"minPeriod": "YYYY",
				"parseDates": true,
				"minorGridAlpha": 0.1,
				"minorGridEnabled": true
			},
			"export": {
				"enabled": true
			}
		});

		// Updates the chart every 3 seconds
		this.timer = setInterval(() => {
			// This must be called when making any changes to the chart
			this.AmCharts.updateChart(this.chart, () => {
				this.chart.dataProvider = this.makeRandomDataProvider();
			});
		}, 3000);

        this.chart2 = this.AmCharts.makeChart("traffic-chart", {
            "type": "serial",
            "theme": "light",
            "fontFamily": "Poppins",
            "marginRight":30,
            "legend": {
                "equalWidths": false,
                "periodValueText": "total: [[value.sum]]",
                "position": "top",
                "valueAlign": "left",
                "valueWidth": 100
            },
            "dataProvider": [{
                "year": 2000,
                "cars": 1691,
                "motorcycles": 737,
                "bicycles": 112
            }, {
                "year": 2001,
                "cars": 1298,
                "motorcycles": 680,
                "bicycles": 101
            }, {
                "year": 2002,
                "cars": 1275,
                "motorcycles": 664,
                "bicycles": 97
            }, {
                "year": 2003,
                "cars": 1246,
                "motorcycles": 648,
                "bicycles": 93
            }, {
                "year": 2004,
                "cars": 1318,
                "motorcycles": 697,
                "bicycles": 111
            }, {
                "year": 2005,
                "cars": 1213,
                "motorcycles": 633,
                "bicycles": 87
            }, {
                "year": 2006,
                "cars": 1199,
                "motorcycles": 621,
                "bicycles": 79
            }, {
                "year": 2007,
                "cars": 1110,
                "motorcycles": 210,
                "bicycles": 81
            }, {
                "year": 2008,
                "cars": 1165,
                "motorcycles": 232,
                "bicycles": 75
            }, {
                "year": 2009,
                "cars": 1145,
                "motorcycles": 219,
                "bicycles": 88
            }, {
                "year": 2010,
                "cars": 1163,
                "motorcycles": 201,
                "bicycles": 82
            }, {
                "year": 2011,
                "cars": 1180,
                "motorcycles": 285,
                "bicycles": 87
            }],
            "valueAxes": [{
                "stackType": "regular",
                "gridAlpha": 0.07,
                "position": "left",
                "title": "Traffic incidents"
            }],
            "colors": [
        		"#3498db",
        		"#3498db",
                "#27ae60",
                "#27ae60"
        	],
            "graphs": [{
                "balloonText": "<img src='http://www.amcharts.com/lib/3/images/car.png' style='vertical-align:bottom; margin-right: 10px; width:28px; height:21px;'><span style='font-size:14px; color:#000000;'><b>[[value]]</b></span>",
                "fillAlphas": 0.7,
                "hidden": true,
                "lineAlpha": 0.4,
                "title": "Cars",
                "valueField": "cars"
            }, {
                "balloonText": "<img src='http://www.amcharts.com/lib/3/images/motorcycle.png' style='vertical-align:bottom; margin-right: 10px; width:28px; height:21px;'><span style='font-size:14px; color:#000000;'><b>[[value]]</b></span>",
                "fillAlphas": 0.7,
                "lineAlpha": 0.4,
                "title": "Motorcycles",
                "valueField": "motorcycles"
            }, {
                "balloonText": "<img src='http://www.amcharts.com/lib/3/images/bicycle.png' style='vertical-align:bottom; margin-right: 10px; width:28px; height:21px;'><span style='font-size:14px; color:#000000;'><b>[[value]]</b></span>",
                "fillAlphas": 0.6,
                "lineAlpha": 0.4,
                "title": "Bicycles",
                "valueField": "bicycles"
            }],
            "plotAreaBorderAlpha": 0,
            "marginTop": 10,
            "marginLeft": 0,
            "marginBottom": 0,
            "chartScrollbar": {},
            "chartCursor": {
                "cursorAlpha": 0
            },
            "categoryField": "year",
            "categoryAxis": {
                "startOnAxis": true,
                "axisColor": "#DADADA",
                "gridAlpha": 0.07,
                "title": "Year",
                "guides": [{
                    category: "2003",
                    toCategory: "2005",
                    lineColor: "#CC0000",
                    lineAlpha: 1,
                    fillAlpha: 0.2,
                    fillColor: "#CC0000",
                    dashLength: 2,
                    inside: true,
                    labelRotation: 90,
                    label: "fines for speeding increased"
                }, {
                    category: "2007",
                    lineColor: "#CC0000",
                    lineAlpha: 1,
                    dashLength: 2,
                    inside: true,
                    labelRotation: 90,
                    label: "motorcycle fee introduced"
                }]
            },
            "export": {
            	"enabled": true
             }

        });
	}

    makeRandomDataProvider() {
		var dataProvider = [];

		// Generate random data
		for (var year = 1985; year <= 2005; ++year) {
			dataProvider.push({
				year: "" + year,
				value: Math.floor(Math.random() * 100) - 50
			});
		}

		return dataProvider;
	}

    ngOnDestroy() {
        clearInterval(this.timer);
        this.AmCharts.destroyChart(this.chart);
	}

}
