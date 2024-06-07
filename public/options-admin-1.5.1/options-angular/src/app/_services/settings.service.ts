import { Injectable } from '@angular/core';

@Injectable()
export class SettingsService {

    private fixedSidebar: boolean = true;

	constructor() { }

    setFixedSidebar(fixedSidebar) {
        this.fixedSidebar = fixedSidebar;
    }

    getFixedSidebar() {
        return this.fixedSidebar;
    }

}
