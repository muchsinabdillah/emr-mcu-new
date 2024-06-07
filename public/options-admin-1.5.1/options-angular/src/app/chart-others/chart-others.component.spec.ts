import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ChartOthersComponent } from './chart-others.component';

describe('ChartOthersComponent', () => {
  let component: ChartOthersComponent;
  let fixture: ComponentFixture<ChartOthersComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ChartOthersComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ChartOthersComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
