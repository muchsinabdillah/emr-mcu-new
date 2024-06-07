import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { BtButtonDropdownComponent } from './bt-button-dropdown.component';

describe('BtButtonDropdownComponent', () => {
  let component: BtButtonDropdownComponent;
  let fixture: ComponentFixture<BtButtonDropdownComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ BtButtonDropdownComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(BtButtonDropdownComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
