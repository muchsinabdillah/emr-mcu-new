import { Component, OnInit } from '@angular/core';
import { AmChartsService } from "amcharts3-angular2";

@Component({
	selector: 'app-chart-column-bar',
	templateUrl: './chart-column-bar.component.html',
	styleUrls: ['./chart-column-bar.component.scss']
})
export class ChartColumnBarComponent implements OnInit {

    private chart: any;
    private chart2: any;

	constructor(private AmCharts: AmChartsService) { }

	ngOnInit() {
        // chart1
        var chart = this.AmCharts.makeChart("chart1", {
          "type": "serial",
          "theme": "light",
          "fontFamily": "Poppins",
          "marginRight": 70,
          "dataProvider": [{
            "country": "USA",
            "visits": 3025,
            "color": "#FF0F00"
          }, {
            "country": "China",
            "visits": 1882,
            "color": "#FF6600"
          }, {
            "country": "Japan",
            "visits": 1809,
            "color": "#FF9E01"
          }, {
            "country": "Germany",
            "visits": 1322,
            "color": "#FCD202"
          }, {
            "country": "UK",
            "visits": 1122,
            "color": "#F8FF01"
          }, {
            "country": "France",
            "visits": 1114,
            "color": "#B0DE09"
          }, {
            "country": "India",
            "visits": 984,
            "color": "#04D215"
          }, {
            "country": "Spain",
            "visits": 711,
            "color": "#0D8ECF"
          }, {
            "country": "Netherlands",
            "visits": 665,
            "color": "#0D52D1"
          }, {
            "country": "Russia",
            "visits": 580,
            "color": "#2A0CD0"
          }, {
            "country": "South Korea",
            "visits": 443,
            "color": "#8A0CCF"
          }, {
            "country": "Canada",
            "visits": 441,
            "color": "#CD0D74"
          }],
          "valueAxes": [{
            "axisAlpha": 0,
            "position": "left",
            "title": "Visitors from country"
          }],
          "startDuration": 1,
          "graphs": [{
            "balloonText": "<b>[[category]]: [[value]]</b>",
            "fillColorsField": "color",
            "fillAlphas": 0.9,
            "lineAlpha": 0.2,
            "type": "column",
            "valueField": "visits"
          }],
          "chartCursor": {
            "categoryBalloonEnabled": false,
            "cursorAlpha": 0,
            "zoomable": false
          },
          "categoryField": "country",
          "categoryAxis": {
            "gridPosition": "start",
            "labelRotation": 45
          },
          "export": {
            "enabled": true
          }

        });

        // chart2
        var chart2 = this.AmCharts.makeChart( "chart2", {
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

        } );

        // chart3
        var chart3 = this.AmCharts.makeChart("chart3", {
            "type": "serial",
        	"theme": "light",
            "fontFamily": "Poppins",
            "legend": {
                "horizontalGap": 10,
                "maxColumns": 1,
                "position": "right",
        		"useGraphSettings": true,
        		"markerSize": 10
            },
            "dataProvider": [{
                "year": 2003,
                "europe": 2.5,
                "namerica": 2.5,
                "asia": 2.1,
                "lamerica": 1.5,
                "meast": 1.2,
                "africa": 0.8
            }, {
                "year": 2004,
                "europe": 2.6,
                "namerica": 2.7,
                "asia": 2.2,
                "lamerica": 1.7,
                "meast": 1.25,
                "africa": 0.6
            }, {
                "year": 2005,
                "europe": 2.8,
                "namerica": 2.9,
                "asia": 2.4,
                "lamerica": 1.6,
                "meast": 1.2,
                "africa": 0.5
            }],
            "valueAxes": [{
                "stackType": "regular",
                "axisAlpha": 0.3,
                "gridAlpha": 0
            }],
            "graphs": [{
                "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                "fillAlphas": 0.8,
                "labelText": "[[value]]",
                "lineAlpha": 0.3,
                "title": "Europe",
                "type": "column",
        		"color": "#000000",
                "valueField": "europe"
            }, {
                "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                "fillAlphas": 0.8,
                "labelText": "[[value]]",
                "lineAlpha": 0.3,
                "title": "North America",
                "type": "column",
        		"color": "#000000",
                "valueField": "namerica"
            }, {
                "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                "fillAlphas": 0.8,
                "labelText": "[[value]]",
                "lineAlpha": 0.3,
                "title": "Asia-Pacific",
                "type": "column",
        		"color": "#000000",
                "valueField": "asia"
            }, {
                "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                "fillAlphas": 0.8,
                "labelText": "[[value]]",
                "lineAlpha": 0.3,
                "title": "Latin America",
                "type": "column",
        		"color": "#000000",
                "valueField": "lamerica"
            }, {
                "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                "fillAlphas": 0.8,
                "labelText": "[[value]]",
                "lineAlpha": 0.3,
                "title": "Middle-East",
                "type": "column",
        		"color": "#000000",
                "valueField": "meast"
            }, {
                "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                "fillAlphas": 0.8,
                "labelText": "[[value]]",
                "lineAlpha": 0.3,
                "title": "Africa",
                "type": "column",
        		"color": "#000000",
                "valueField": "africa"
            }],
            "categoryField": "year",
            "categoryAxis": {
                "gridPosition": "start",
                "axisAlpha": 0,
                "gridAlpha": 0,
                "position": "left"
            },
            "export": {
            	"enabled": true
             }

        });

        // chart4
        var chart4 = this.AmCharts.makeChart( "chart4", {
          "type": "serial",
          "addClassNames": true,
          "theme": "light",
          "autoMargins": false,
          "marginLeft": 30,
          "marginRight": 8,
          "marginTop": 10,
          "marginBottom": 26,
          "fontFamily": "Poppins",
          "balloon": {
            "adjustBorderColor": false,
            "horizontalPadding": 10,
            "verticalPadding": 8,
            "color": "#ffffff"
          },

          "dataProvider": [ {
            "year": 2009,
            "income": 23.5,
            "expenses": 21.1
          }, {
            "year": 2010,
            "income": 26.2,
            "expenses": 30.5
          }, {
            "year": 2011,
            "income": 30.1,
            "expenses": 34.9
          }, {
            "year": 2012,
            "income": 29.5,
            "expenses": 31.1
          }, {
            "year": 2013,
            "income": 30.6,
            "expenses": 28.2,
            "dashLengthLine": 5
          }, {
            "year": 2014,
            "income": 34.1,
            "expenses": 32.9,
            "dashLengthColumn": 5,
            "alpha": 0.2,
            "additional": "(projection)"
          } ],
          "valueAxes": [ {
            "axisAlpha": 0,
            "position": "left"
          } ],
          "startDuration": 1,
          "graphs": [ {
            "alphaField": "alpha",
            "balloonText": "<span style='font-size:12px;'>[[title]] in [[category]]:<br><span style='font-size:20px;'>[[value]]</span> [[additional]]</span>",
            "fillAlphas": 1,
            "title": "Income",
            "type": "column",
            "valueField": "income",
            "dashLengthField": "dashLengthColumn"
          }, {
            "id": "graph2",
            "balloonText": "<span style='font-size:12px;'>[[title]] in [[category]]:<br><span style='font-size:20px;'>[[value]]</span> [[additional]]</span>",
            "bullet": "round",
            "lineThickness": 3,
            "bulletSize": 7,
            "bulletBorderAlpha": 1,
            "bulletColor": "#FFFFFF",
            "useLineColorForBulletBorder": true,
            "bulletBorderThickness": 3,
            "fillAlphas": 0,
            "lineAlpha": 1,
            "title": "Expenses",
            "valueField": "expenses",
            "dashLengthField": "dashLengthLine"
          } ],
          "categoryField": "year",
          "categoryAxis": {
            "gridPosition": "start",
            "axisAlpha": 0,
            "tickLength": 0
          },
          "export": {
            "enabled": true
          }
        } );

        // chart5
        var chart5 = this.AmCharts.makeChart("chart5", {
            "theme": "light",
            "type": "serial",
            "fontFamily": "Poppins",
        	"startDuration": 2,
            "dataProvider": [{
                "country": "USA",
                "visits": 4025,
                "color": "#FF0F00"
            }, {
                "country": "China",
                "visits": 1882,
                "color": "#FF6600"
            }, {
                "country": "Japan",
                "visits": 1809,
                "color": "#FF9E01"
            }, {
                "country": "Germany",
                "visits": 1322,
                "color": "#FCD202"
            }, {
                "country": "UK",
                "visits": 1122,
                "color": "#F8FF01"
            }, {
                "country": "France",
                "visits": 1114,
                "color": "#B0DE09"
            }, {
                "country": "India",
                "visits": 984,
                "color": "#04D215"
            }, {
                "country": "Spain",
                "visits": 711,
                "color": "#0D8ECF"
            }, {
                "country": "Netherlands",
                "visits": 665,
                "color": "#0D52D1"
            }, {
                "country": "Russia",
                "visits": 580,
                "color": "#2A0CD0"
            }, {
                "country": "South Korea",
                "visits": 443,
                "color": "#8A0CCF"
            }, {
                "country": "Canada",
                "visits": 441,
                "color": "#CD0D74"
            }, {
                "country": "Brazil",
                "visits": 395,
                "color": "#754DEB"
            }, {
                "country": "Italy",
                "visits": 386,
                "color": "#DDDDDD"
            }, {
                "country": "Australia",
                "visits": 384,
                "color": "#999999"
            }, {
                "country": "Taiwan",
                "visits": 338,
                "color": "#333333"
            }, {
                "country": "Poland",
                "visits": 328,
                "color": "#000000"
            }],
            "valueAxes": [{
                "position": "left",
                "title": "Visitors"
            }],
            "graphs": [{
                "balloonText": "[[category]]: <b>[[value]]</b>",
                "fillColorsField": "color",
                "fillAlphas": 1,
                "lineAlpha": 0.1,
                "type": "column",
                "valueField": "visits"
            }],
            "depth3D": 20,
        	"angle": 30,
            "chartCursor": {
                "categoryBalloonEnabled": false,
                "cursorAlpha": 0,
                "zoomable": false
            },
            "categoryField": "country",
            "categoryAxis": {
                "gridPosition": "start",
                "labelRotation": 90
            },
            "export": {
            	"enabled": true
             }

        });

        // chart6
        var chart6 = this.AmCharts.makeChart("chart6", {
            "theme": "light",
            "type": "serial",
            "fontFamily": "Poppins",
            "dataProvider": [{
                "country": "USA",
                "year2004": 3.5,
                "year2005": 4.2
            }, {
                "country": "UK",
                "year2004": 1.7,
                "year2005": 3.1
            }, {
                "country": "Canada",
                "year2004": 2.8,
                "year2005": 2.9
            }, {
                "country": "Japan",
                "year2004": 2.6,
                "year2005": 2.3
            }, {
                "country": "France",
                "year2004": 1.4,
                "year2005": 2.1
            }, {
                "country": "Brazil",
                "year2004": 2.6,
                "year2005": 4.9
            }, {
                "country": "Russia",
                "year2004": 6.4,
                "year2005": 7.2
            }, {
                "country": "India",
                "year2004": 8,
                "year2005": 7.1
            }, {
                "country": "China",
                "year2004": 9.9,
                "year2005": 10.1
            }],
            "valueAxes": [{
                "stackType": "3d",
                "unit": "%",
                "position": "left",
                "title": "GDP growth rate",
            }],
            "startDuration": 1,
            "graphs": [{
                "balloonText": "GDP grow in [[category]] (2004): <b>[[value]]</b>",
                "fillAlphas": 0.9,
                "lineAlpha": 0.2,
                "title": "2004",
                "type": "column",
                "valueField": "year2004"
            }, {
                "balloonText": "GDP grow in [[category]] (2005): <b>[[value]]</b>",
                "fillAlphas": 0.9,
                "lineAlpha": 0.2,
                "title": "2005",
                "type": "column",
                "valueField": "year2005"
            }],
            "plotAreaFillAlphas": 0.1,
            "depth3D": 60,
            "angle": 30,
            "categoryField": "country",
            "categoryAxis": {
                "gridPosition": "start"
            },
            "export": {
            	"enabled": true
             }
        });

        // chart7
        var chart7 = this.AmCharts.makeChart("chart7", {
            "theme": "light",
            "type": "serial",
            "fontFamily": "Poppins",
            "dataProvider": [{
                "country": "USA",
                "year2004": 3.5,
                "year2005": 4.2
            }, {
                "country": "UK",
                "year2004": 1.7,
                "year2005": 3.1
            }, {
                "country": "Canada",
                "year2004": 2.8,
                "year2005": 2.9
            }, {
                "country": "Japan",
                "year2004": 2.6,
                "year2005": 2.3
            }, {
                "country": "France",
                "year2004": 1.4,
                "year2005": 2.1
            }, {
                "country": "Brazil",
                "year2004": 2.6,
                "year2005": 4.9
            }],
            "valueAxes": [{
                "unit": "%",
                "position": "left",
                "title": "GDP growth rate",
            }],
            "startDuration": 1,
            "graphs": [{
                "balloonText": "GDP grow in [[category]] (2004): <b>[[value]]</b>",
                "fillAlphas": 0.9,
                "lineAlpha": 0.2,
                "title": "2004",
                "type": "column",
                "valueField": "year2004"
            }, {
                "balloonText": "GDP grow in [[category]] (2005): <b>[[value]]</b>",
                "fillAlphas": 0.9,
                "lineAlpha": 0.2,
                "title": "2005",
                "type": "column",
                "clustered":false,
                "columnWidth":0.5,
                "valueField": "year2005"
            }],
            "plotAreaFillAlphas": 0.1,
            "categoryField": "country",
            "categoryAxis": {
                "gridPosition": "start"
            },
            "export": {
            	"enabled": true
             }

        });

        // chart8
        var chart8 = this.AmCharts.makeChart("chart8", {
              "type": "serial",
              "theme": "light",
              "fontFamily": "Poppins",
              "rotate": true,
              "marginBottom": 50,
              "dataProvider": [{
                "age": "85+",
                "male": -0.1,
                "female": 0.3
              }, {
                "age": "80-54",
                "male": -0.2,
                "female": 0.3
              }, {
                "age": "75-79",
                "male": -0.3,
                "female": 0.6
              }, {
                "age": "70-74",
                "male": -0.5,
                "female": 0.8
              }, {
                "age": "65-69",
                "male": -0.8,
                "female": 1.0
              }, {
                "age": "60-64",
                "male": -1.1,
                "female": 1.3
              }, {
                "age": "55-59",
                "male": -1.7,
                "female": 1.9
              }, {
                "age": "50-54",
                "male": -2.2,
                "female": 2.5
              }, {
                "age": "45-49",
                "male": -2.8,
                "female": 3.0
              }, {
                "age": "40-44",
                "male": -3.4,
                "female": 3.6
              }, {
                "age": "35-39",
                "male": -4.2,
                "female": 4.1
              }, {
                "age": "30-34",
                "male": -5.2,
                "female": 4.8
              }, {
                "age": "25-29",
                "male": -5.6,
                "female": 5.1
              }, {
                "age": "20-24",
                "male": -5.1,
                "female": 5.1
              }, {
                "age": "15-19",
                "male": -3.8,
                "female": 3.8
              }, {
                "age": "10-14",
                "male": -3.2,
                "female": 3.4
              }, {
                "age": "5-9",
                "male": -4.4,
                "female": 4.1
              }, {
                "age": "0-4",
                "male": -5.0,
                "female": 4.8
              }],
              "startDuration": 1,
              "graphs": [{
                "fillAlphas": 0.8,
                "lineAlpha": 0.2,
                "type": "column",
                "valueField": "male",
                "title": "Male",
                "labelText": "[[value]]",
                "clustered": false,
                "labelFunction": function(item) {
                  return Math.abs(item.values.value);
                },
                "balloonFunction": function(item) {
                  return item.category + ": " + Math.abs(item.values.value) + "%";
                }
              }, {
                "fillAlphas": 0.8,
                "lineAlpha": 0.2,
                "type": "column",
                "valueField": "female",
                "title": "Female",
                "labelText": "[[value]]",
                "clustered": false,
                "labelFunction": function(item) {
                  return Math.abs(item.values.value);
                },
                "balloonFunction": function(item) {
                  return item.category + ": " + Math.abs(item.values.value) + "%";
                }
              }],
              "categoryField": "age",
              "categoryAxis": {
                "gridPosition": "start",
                "gridAlpha": 0.2,
                "axisAlpha": 0
              },
              "valueAxes": [{
                "gridAlpha": 0,
                "ignoreAxisWidth": true,
                "labelFunction": function(value) {
                  return Math.abs(value) + '%';
                },
                "guides": [{
                  "value": 0,
                  "lineAlpha": 0.2
                }]
              }],
              "balloon": {
                "fixedPosition": true
              },
              "chartCursor": {
                "valueBalloonsEnabled": false,
                "cursorAlpha": 0.05,
                "fullWidth": true
              },
              "allLabels": [{
                "text": "Male",
                "x": "28%",
                "y": "97%",
                "bold": true,
                "align": "middle"
              }, {
                "text": "Female",
                "x": "75%",
                "y": "97%",
                "bold": true,
                "align": "middle"
              }],
             "export": {
                "enabled": true
              }

            });
	}

}
