import { RouterModule, Routes } from '@angular/router';

// Components
import { DashboardComponent } from './dashboard/dashboard.component';
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

// Routes
export const routes: Routes = [
    { path: 'dashboard', component: DashboardComponent },
    { path: 'dashboard-2', component: Dashboard2Component },
    { path: 'color-primary', component: ColorPrimaryComponent },
    { path: 'color-danger', component: ColorDangerComponent },
    { path: 'color-success', component: ColorSuccessComponent },
    { path: 'color-warning', component: ColorWarningComponent },
    { path: 'color-info', component: ColorInfoComponent },
    { path: 'color-black', component: ColorBlackComponent },
    { path: 'color-gray', component: ColorGrayComponent },
    { path: 'ui-buttons', component: UiButtonsComponent },
    { path: 'ui-panels', component: UiPanelsComponent },
    { path: 'ui-modals', component: UiModalsComponent },
    { path: 'ui-page-headers', component: UiPageHeadersComponent },
    { path: 'ui-confirmation', component: UiConfirmationComponent },
    { path: 'ui-dropdown-menu', component: UiDropdownMenuComponent },
    { path: 'ui-media-objects', component: UiMediaObjectsComponent },
    { path: 'bt-accordions', component: BtAccordionsComponent },
    { path: 'bt-alerts', component: BtAlertsComponent },
    { path: 'bt-button-dropdown', component: BtButtonDropdownComponent },
    { path: 'bt-button-groups', component: BtButtonGroupsComponent },
    { path: 'bt-buttons', component: BtButtonsComponent },
    { path: 'bt-carousel', component: BtCarouselComponent },
    { path: 'bt-code', component: BtCodeComponent },
    { path: 'bt-collapse', component: BtCollapseComponent },
    { path: 'bt-dropdowns', component: BtDropdownsComponent },
    { path: 'bt-grid', component: BtGridComponent },
    { path: 'bt-helpers', component: BtHelpersComponent },
    { path: 'bt-labels-badges', component: BtLabelsBadgesComponent },
    { path: 'bt-pagination', component: BtPaginationComponent },
    { path: 'bt-popover', component: BtPopoverComponent },
    { path: 'bt-tabs', component: BtTabsComponent },
    { path: 'bt-tooltips', component: BtTooltipsComponent },
    { path: 'bt-typography', component: BtTypographyComponent },
    { path: 'table-basic', component: TableBasicComponent },
    { path: 'table-10k-rows', component: Table10kRowsComponent },
    { path: 'table-inline-edit', component: TableInlineEditComponent },
    { path: 'table-filter', component: TableFilterComponent },
    { path: 'chart-column-bar', component: ChartColumnBarComponent },
    { path: 'chart-line-area', component: ChartLineAreaComponent },
    { path: 'chart-pie-chart', component: ChartPieChartComponent },
    { path: 'chart-funnel', component: ChartFunnelComponent },
    { path: 'chart-others', component: ChartOthersComponent },
    { path: 'error-404', component: Error404Component },
    { path: 'error-500', component: Error500Component },
    { path: 'pages-pricing', component: PagesPricingComponent },
    { path: 'pages-profile', component: PagesProfileComponent },
    { path: 'form-basic', component: FormBasicComponent },
    { path: 'form-layouts', component: FormLayoutsComponent },
    { path: 'form-validations', component: FormValidationsComponent },
    {
		path: '',
		redirectTo: '/dashboard',
		pathMatch: 'full'
	},
	{ path: '**', redirectTo: '/dashboard' }
];
