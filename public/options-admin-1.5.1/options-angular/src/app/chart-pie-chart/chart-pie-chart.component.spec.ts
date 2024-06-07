import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ChartPieChartComponent } from './chart-pie-chart.component';

describe('ChartPieChartComponent', () => {
  let component: ChartPieChartComponent;
  let fixture: ComponentFixture<ChartPieChartComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ChartPieChartComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ChartPieChartComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
