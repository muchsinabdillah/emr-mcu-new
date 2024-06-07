import { Component, OnInit } from '@angular/core';
import * as $ from 'jquery';
import { SettingsService } from './_services/settings.service';
import { Router, NavigationEnd } from '@angular/router';

@Component({
	selector: 'app-root',
	templateUrl: './app.component.html',
	styleUrls: ['./app.component.scss']
})
export class AppComponent implements OnInit {

	fixedSidebar: boolean = false;
	smallSidebar: boolean = false;
	settingsOpen: boolean = false;

	sidebarColor: string = 'bg-black-300';

	colors = ["blue", "default", "gray", "green", "red", "sky-blue", "yellow"];
    sizes = ["mini", "small", "normal", "large"];

    onText = "On";
    offText = "Off";
    onColor = "green";
    offColor = "red";
    size = "normal";

	// For Sidebar BG
	bgBlack300: boolean = true;
	bgPrimary: boolean = false;
	bgLight: boolean = false;
	bgDanger: boolean = false;
	bgSuccess: boolean = false;
	bgWarning: boolean = false;

    innerWidth: any;

    constructor(
		private settingsService: SettingsService,
		private router: Router
	) { }

	ngOnInit() {

		this.fixedSidebar = this.settingsService.getFixedSidebar();

        this.innerWidth = (window.innerWidth);

		this.router.events.subscribe((evt) => {
            if (!(evt instanceof NavigationEnd)) {
                return;
            }
			// console.log(this.innerWidth);
			if (this.innerWidth < 991) {
				$('.left-sidebar').toggle();
			}
            window.scrollTo(0, 0)
        });

        // Toggle user info on sidebar
    	$('.user-info-handle').on('click', function(event){
    		event.preventDefault();
    		$('.user-info').toggleClass('closed');
    	});

        // Toggle small sidebar
    	$('.small-nav-handle').on('click', function(event){
    		event.preventDefault();
    		$('.left-sidebar').toggleClass('small-nav');
    		$('.navbar-header').toggleClass('small-nav-header');
    	});

    	// Toggle Mobile Nav
    	$('.mobile-nav-toggle').on('click', function(event){
    		event.preventDefault();
    		$('.left-sidebar').toggle();
    	})

        // Toggle sidebar dropdown
    	$('.left-sidebar .has-children').not('.open').find('.child-nav').slideUp('100');
    	$('.left-sidebar .has-children>a').on('click', function(event){
    		event.preventDefault();
    		$(this).parent().toggleClass('open');
    		$(this).parent().find('.child-nav').slideToggle('500');
    	});
	}

	setSidebarColor(color) {
		switch(color) {
			case 'primary': {
				this.bgBlack300 = false;
				this.bgPrimary = true;
				this.bgLight = false;
				this.bgDanger = false;
				this.bgSuccess = false;
				this.bgWarning = false;
				break;
			}
			case 'default': {
				this.bgBlack300 = true;
				this.bgPrimary = false;
				this.bgLight = false;
				this.bgDanger = false;
				this.bgSuccess = false;
				this.bgWarning = false;
				break;
			}
			case 'light': {
				this.bgBlack300 = false;
				this.bgPrimary = false;
				this.bgLight = true;
				this.bgDanger = false;
				this.bgSuccess = false;
				this.bgWarning = false;
				break;
			}
			case 'danger': {
				this.bgBlack300 = false;
				this.bgPrimary = false;
				this.bgLight = false;
				this.bgDanger = true;
				this.bgSuccess = false;
				this.bgWarning = false;
				break;
			}
			case 'success': {
				this.bgBlack300 = false;
				this.bgPrimary = false;
				this.bgLight = false;
				this.bgDanger = false;
				this.bgSuccess = true;
				this.bgWarning = false;
				break;
			}
			case 'warning': {
				this.bgBlack300 = false;
				this.bgPrimary = false;
				this.bgLight = false;
				this.bgDanger = false;
				this.bgSuccess = false;
				this.bgWarning = true;
				break;
			}
			default: {
				this.bgBlack300 = true;
				this.bgPrimary = false;
				this.bgLight = false;
				this.bgDanger = false;
				this.bgSuccess = false;
				this.bgWarning = false;
				break;
			}
		}
	}
}
