import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { BtTabsComponent } from './bt-tabs.component';

describe('BtTabsComponent', () => {
  let component: BtTabsComponent;
  let fixture: ComponentFixture<BtTabsComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ BtTabsComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(BtTabsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
