import { Component, OnInit } from '@angular/core';

@Component({
	selector: 'app-bt-tooltips',
	templateUrl: './bt-tooltips.component.html',
	styleUrls: ['./bt-tooltips.component.scss']
})
export class BtTooltipsComponent implements OnInit {

    public content: string = 'Vivamus sagittis lacus vel augue laoreet rutrum faucibus.';

	constructor() { }

	ngOnInit() {
	}

}
