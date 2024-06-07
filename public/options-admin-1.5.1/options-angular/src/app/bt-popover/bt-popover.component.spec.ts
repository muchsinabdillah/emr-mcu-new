import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { BtPopoverComponent } from './bt-popover.component';

describe('BtPopoverComponent', () => {
  let component: BtPopoverComponent;
  let fixture: ComponentFixture<BtPopoverComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ BtPopoverComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(BtPopoverComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
