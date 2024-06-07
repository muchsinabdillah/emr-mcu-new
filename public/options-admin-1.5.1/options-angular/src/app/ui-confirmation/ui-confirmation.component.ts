import { Component, OnInit } from '@angular/core';

@Component({
	selector: 'app-ui-confirmation',
	templateUrl: './ui-confirmation.component.html',
	styleUrls: ['./ui-confirmation.component.scss']
})
export class UiConfirmationComponent implements OnInit {

    public confirmClicked: boolean = false;
    public cancelClicked: boolean = false;

	constructor() { }

	ngOnInit() {
	}

}
