import { Component, OnInit } from '@angular/core';

@Component({
	selector: 'app-ui-modals',
	templateUrl: './ui-modals.component.html',
	styleUrls: ['./ui-modals.component.scss']
})
export class UiModalsComponent implements OnInit {

	constructor() { }

	ngOnInit() {

	}

    deleteFile() {
        console.log('Sweetalert Delete demo');
    }

}
