import { Component, OnInit } from '@angular/core';

export class Account {
    name: string;
    unsername: string;
    email: string;
    contact: number;
    password: string;
    confirm: string;
    accept: boolean;
}

@Component({
	selector: 'app-form-validations',
	templateUrl: './form-validations.component.html',
	styleUrls: ['./form-validations.component.scss']
})
export class FormValidationsComponent implements OnInit {

    account = new Account();

	constructor() { }

	ngOnInit() {
	}

}
