import { Component, OnInit } from '@angular/core';

@Component({
	selector: 'app-table-filter',
	templateUrl: './table-filter.component.html',
	styleUrls: ['./table-filter.component.scss']
})
export class TableFilterComponent implements OnInit {

    rows = [];
    expanded = {};
    timeout: any;
    loadingInd: boolean = true;
    temp = [];

    constructor() {
        this.fetch((data) => {

            this.temp = [...data];
            
            this.rows = data;
            this.loadingInd = false;
        });
    }

    onPage(event) {
        clearTimeout(this.timeout);
        this.timeout = setTimeout(() => {
            console.log('paged!', event);
        }, 100);
    }

    fetch(cb) {
        const req = new XMLHttpRequest();
        req.open('GET', `assets/data/100k.json`);

        req.onload = () => {
            const rows = JSON.parse(req.response);

            for (const row of rows) {
                row.height = Math.floor(Math.random() * 80) + 50;
            }

            cb(rows);
        };

        req.send();
    }

    updateFilter(event) {
        const val = event.target.value;

        // console.log(val);

        // filter our data
        const temp = this.temp.filter(function(d) {
          return d.name.toLowerCase().indexOf(val) !== -1 || !val;
        });

        // update the rows
        this.rows = temp;
        // Whenever the filter changes, always go back to the first page
        // this.table.offset = 0;
      }


    ngOnInit() {
    }

}
