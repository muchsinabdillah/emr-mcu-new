import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ChartColumnBarComponent } from './chart-column-bar.component';

describe('ChartColumnBarComponent', () => {
  let component: ChartColumnBarComponent;
  let fixture: ComponentFixture<ChartColumnBarComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ChartColumnBarComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ChartColumnBarComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
