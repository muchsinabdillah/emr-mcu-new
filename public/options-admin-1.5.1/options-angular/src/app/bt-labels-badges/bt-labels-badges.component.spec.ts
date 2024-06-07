import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { BtLabelsBadgesComponent } from './bt-labels-badges.component';

describe('BtLabelsBadgesComponent', () => {
  let component: BtLabelsBadgesComponent;
  let fixture: ComponentFixture<BtLabelsBadgesComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ BtLabelsBadgesComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(BtLabelsBadgesComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
