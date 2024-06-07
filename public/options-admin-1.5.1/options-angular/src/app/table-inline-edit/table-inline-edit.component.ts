import { Component, OnInit } from '@angular/core';

@Component({
	selector: 'app-table-inline-edit',
	templateUrl: './table-inline-edit.component.html',
	styleUrls: ['./table-inline-edit.component.scss']
})
export class TableInlineEditComponent implements OnInit {

    editing = {};
	rows = [];
    loadingInd: boolean = true;

	constructor() {
		this.fetch((data) => {
			this.rows = data;
            this.loadingInd = false;
		});
	}

	fetch(cb) {
		const req = new XMLHttpRequest();
		req.open('GET', `assets/data/company.json`);

		req.onload = () => {
			cb(JSON.parse(req.response));
		};

		req.send();
	}

	updateValue(event, cell, cellValue, row) {
		this.editing[row.$$index + '-' + cell] = false;
		this.rows[row.$$index][cell] = event.target.value;
	}

	ngOnInit() {
	}

}
