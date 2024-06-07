import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { BtCodeComponent } from './bt-code.component';

describe('BtCodeComponent', () => {
  let component: BtCodeComponent;
  let fixture: ComponentFixture<BtCodeComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ BtCodeComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(BtCodeComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
