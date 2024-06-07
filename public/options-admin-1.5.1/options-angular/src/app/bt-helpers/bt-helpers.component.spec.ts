import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { BtHelpersComponent } from './bt-helpers.component';

describe('BtHelpersComponent', () => {
  let component: BtHelpersComponent;
  let fixture: ComponentFixture<BtHelpersComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ BtHelpersComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(BtHelpersComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
