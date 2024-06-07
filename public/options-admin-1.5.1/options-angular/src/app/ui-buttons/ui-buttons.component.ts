import { Component, OnInit } from '@angular/core';

@Component({
	selector: 'app-ui-buttons',
	templateUrl: './ui-buttons.component.html',
	styleUrls: ['./ui-buttons.component.scss']
})
export class UiButtonsComponent implements OnInit {

    // trigger-variable for Ladda
    isLoading: boolean = false;
    public checkModel:any = {left: true, middle: false, right: false};
	public radioModel: string = 'Middle';

	constructor() { }

	ngOnInit() {
	}

    startLoading() {
        this.isLoading = true;
        setInterval(() => {
			this.isLoading = false;
		}, 5000);
    }

}
