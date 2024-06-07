import { Component, OnInit } from '@angular/core';

@Component({
	selector: 'app-bt-collapse',
	templateUrl: './bt-collapse.component.html',
	styleUrls: ['./bt-collapse.component.scss']
})
export class BtCollapseComponent implements OnInit {

    public isCollapsed: boolean = false;

	public collapsed(event: any): void {
		console.log(event);
	}

	public expanded(event: any): void {
		console.log(event);
	}

	constructor() { }

	ngOnInit() {
	}

}
