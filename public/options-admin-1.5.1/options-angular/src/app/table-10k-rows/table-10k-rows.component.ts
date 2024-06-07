import { Component, OnInit } from '@angular/core';

@Component({
	selector: 'app-table-10k-rows',
	templateUrl: './table-10k-rows.component.html',
	styleUrls: ['./table-10k-rows.component.scss']
})
export class Table10kRowsComponent implements OnInit {

    rows = [];
    expanded = {};
    timeout: any;
    loadingInd: boolean = true;

	constructor() {
        this.fetch((data) => {
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

	getRowHeight(row) {
		return row.height;
	}

	ngOnInit() {
	}

}
