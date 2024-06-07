import { Component, OnInit } from '@angular/core';

@Component({
	selector: 'app-bt-button-groups',
	templateUrl: './bt-button-groups.component.html',
	styleUrls: ['./bt-button-groups.component.scss']
})
export class BtButtonGroupsComponent implements OnInit {

    public radioModel: string = 'Left';
    public checkModel:any = {left: false, middle: true, right: false};

	constructor() { }

	ngOnInit() {
	}

}
