import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { BtDropdownsComponent } from './bt-dropdowns.component';

describe('BtDropdownsComponent', () => {
  let component: BtDropdownsComponent;
  let fixture: ComponentFixture<BtDropdownsComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ BtDropdownsComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(BtDropdownsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
