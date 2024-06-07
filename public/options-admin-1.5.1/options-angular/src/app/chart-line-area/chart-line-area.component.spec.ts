import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ChartLineAreaComponent } from './chart-line-area.component';

describe('ChartLineAreaComponent', () => {
  let component: ChartLineAreaComponent;
  let fixture: ComponentFixture<ChartLineAreaComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ChartLineAreaComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ChartLineAreaComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
