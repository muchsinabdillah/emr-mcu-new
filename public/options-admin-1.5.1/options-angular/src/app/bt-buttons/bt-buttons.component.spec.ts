import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { BtButtonsComponent } from './bt-buttons.component';

describe('BtButtonsComponent', () => {
  let component: BtButtonsComponent;
  let fixture: ComponentFixture<BtButtonsComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ BtButtonsComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(BtButtonsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
