import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { HttpModule } from '@angular/http';
import { RouterModule, Routes } from '@angular/router';
import { ReactiveFormsModule } from '@angular/forms';

// Import Plugins
import { BsDropdownModule } from 'ngx-bootstrap/dropdown';
import { CollapseModule } from 'ngx-bootstrap/collapse';
import { AccordionModule } from 'ngx-bootstrap/accordion';
import { ButtonsModule } from 'ngx-bootstrap/buttons';
import { ModalModule } from 'ngx-bootstrap/modal';
import { CarouselModule } from 'ngx-bootstrap/carousel';
import { PopoverModule } from 'ngx-bootstrap/popover';
import { TabsModule } from 'ngx-bootstrap/tabs';
import { TooltipModule } from 'ngx-bootstrap/tooltip';
import { AmChartsModule } from "amcharts3-angular2";
import { UiSwitchModule } from 'ngx-ui-switch/src';
import { LaddaModule } from 'angular2-ladda';
import { SortablejsModule } from 'angular-sortablejs';
import { SweetAlert2Module } from '@toverux/ngsweetalert2';
import { ConfirmationPopoverModule } from 'angular-confirmation-popover';
import { NgxDatatableModule } from '@swimlane/ngx-datatable';
import { CustomFormsModule } from 'ng2-validation';

// Import routes
import { routes } from './app.routes';

// Import Services
import { SettingsService } from './_services/settings.service';

// Components
import { AppComponent } from './app.component';
import { DashboardComponent } from './dashboard/dashboard.component';
import { SettingsComponent } from './settings/settings.component';
import { TopNavbarComponent } from './top-navbar/top-navbar.component';
import { Dashboard2Component } from './dashboard-2/dashboard-2.component';
import { ColorPrimaryComponent } from './color-primary/color-primary.component';
import { ColorDangerComponent } from './color-danger/color-danger.component';
import { ColorSuccessComponent } from './color-success/color-success.component';
import { ColorWarningComponent } from './color-warning/color-warning.component';
import { ColorInfoComponent } from './color-info/color-info.component';
import { ColorBlackComponent } from './color-black/color-black.component';
import { ColorGrayComponent } from './color-gray/color-gray.component';
import { UiButtonsComponent } from './ui-buttons/ui-buttons.component';
import { UiPanelsComponent } from './ui-panels/ui-panels.component';
import { UiModalsComponent } from './ui-modals/ui-modals.component';
import { UiPageHeadersComponent } from './ui-page-headers/ui-page-headers.component';
import { UiConfirmationComponent } from './ui-confirmation/ui-confirmation.component';
import { UiDropdownMenuComponent } from './ui-dropdown-menu/ui-dropdown-menu.component';
import { UiMediaObjectsComponent } from './ui-media-objects/ui-media-objects.component';
import { BtAccordionsComponent } from './bt-accordions/bt-accordions.component';
import { BtAlertsComponent } from './bt-alerts/bt-alerts.component';
import { BtButtonDropdownComponent } from './bt-button-dropdown/bt-button-dropdown.component';
import { BtButtonGroupsComponent } from './bt-button-groups/bt-button-groups.component';
import { BtButtonsComponent } from './bt-buttons/bt-buttons.component';
import { BtCarouselComponent } from './bt-carousel/bt-carousel.component';
import { BtCodeComponent } from './bt-code/bt-code.component';
import { BtCollapseComponent } from './bt-collapse/bt-collapse.component';
import { BtDropdownsComponent } from './bt-dropdowns/bt-dropdowns.component';
import { BtGridComponent } from './bt-grid/bt-grid.component';
import { BtHelpersComponent } from './bt-helpers/bt-helpers.component';
import { BtLabelsBadgesComponent } from './bt-labels-badges/bt-labels-badges.component';
import { BtPaginationComponent } from './bt-pagination/bt-pagination.component';
import { BtPopoverComponent } from './bt-popover/bt-popover.component';
import { BtTabsComponent } from './bt-tabs/bt-tabs.component';
import { BtTooltipsComponent } from './bt-tooltips/bt-tooltips.component';
import { BtTypographyComponent } from './bt-typography/bt-typography.component';
import { TableBasicComponent } from './table-basic/table-basic.component';
import { Table10kRowsComponent } from './table-10k-rows/table-10k-rows.component';
import { TableInlineEditComponent } from './table-inline-edit/table-inline-edit.component';
import { TableFilterComponent } from './table-filter/table-filter.component';
import { ChartColumnBarComponent } from './chart-column-bar/chart-column-bar.component';
import { ChartLineAreaComponent } from './chart-line-area/chart-line-area.component';
import { ChartPieChartComponent } from './chart-pie-chart/chart-pie-chart.component';
import { ChartFunnelComponent } from './chart-funnel/chart-funnel.component';
import { ChartOthersComponent } from './chart-others/chart-others.component';
import { Error404Component } from './error-404/error-404.component';
import { Error500Component } from './error-500/error-500.component';
import { FormBasicComponent } from './form-basic/form-basic.component';
import { FormLayoutsComponent } from './form-layouts/form-layouts.component';
import { FormValidationsComponent } from './form-validations/form-validations.component';
import { PagesPricingComponent } from './pages-pricing/pages-pricing.component';
import { PagesProfileComponent } from './pages-profile/pages-profile.component';

@NgModule({
	declarations: [
		AppComponent,
		DashboardComponent,
		SettingsComponent,
		TopNavbarComponent,
		Dashboard2Component,
		ColorPrimaryComponent,
		ColorDangerComponent,
		ColorSuccessComponent,
		ColorWarningComponent,
		ColorInfoComponent,
		ColorBlackComponent,
		ColorGrayComponent,
		UiButtonsComponent,
		UiPanelsComponent,
		UiModalsComponent,
		UiPageHeadersComponent,
		UiConfirmationComponent,
		UiDropdownMenuComponent,
		UiMediaObjectsComponent,
		BtAccordionsComponent,
		BtAlertsComponent,
		BtButtonDropdownComponent,
		BtButtonGroupsComponent,
		BtButtonsComponent,
		BtCarouselComponent,
		BtCodeComponent,
		BtCollapseComponent,
		BtDropdownsComponent,
		BtGridComponent,
		BtHelpersComponent,
		BtLabelsBadgesComponent,
		BtPaginationComponent,
		BtPopoverComponent,
		BtTabsComponent,
		BtTooltipsComponent,
		BtTypographyComponent,
		TableBasicComponent,
		Table10kRowsComponent,
		TableInlineEditComponent,
		TableFilterComponent,
		ChartColumnBarComponent,
		ChartLineAreaComponent,
		ChartPieChartComponent,
		ChartFunnelComponent,
		ChartOthersComponent,
		Error404Component,
		Error500Component,
		FormBasicComponent,
		FormLayoutsComponent,
		FormValidationsComponent,
		PagesPricingComponent,
		PagesProfileComponent,
	],
	imports: [
		BrowserModule,
		FormsModule,
		HttpModule,
        RouterModule.forRoot(routes),
        BsDropdownModule.forRoot(),
        CollapseModule.forRoot(),
        AccordionModule.forRoot(),
		ButtonsModule.forRoot(),
		ModalModule.forRoot(),
		CarouselModule.forRoot(),
		PopoverModule.forRoot(),
		TabsModule.forRoot(),
		TooltipModule.forRoot(),
        AmChartsModule,
		UiSwitchModule,
		LaddaModule,
		SortablejsModule,
		SweetAlert2Module,
		ConfirmationPopoverModule.forRoot({
	      confirmButtonType: 'danger' // set defaults here
	    }),
	    NgxDatatableModule,
		ReactiveFormsModule,
		CustomFormsModule
	],
	providers: [
        SettingsService
    ],
	bootstrap: [
        AppComponent
    ]
})
export class AppModule { }
