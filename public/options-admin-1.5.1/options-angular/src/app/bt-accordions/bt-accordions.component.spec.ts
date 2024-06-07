import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { BtAccordionsComponent } from './bt-accordions.component';

describe('BtAccordionsComponent', () => {
  let component: BtAccordionsComponent;
  let fixture: ComponentFixture<BtAccordionsComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ BtAccordionsComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(BtAccordionsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
