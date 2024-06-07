import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { BtAlertsComponent } from './bt-alerts.component';

describe('BtAlertsComponent', () => {
  let component: BtAlertsComponent;
  let fixture: ComponentFixture<BtAlertsComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ BtAlertsComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(BtAlertsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
