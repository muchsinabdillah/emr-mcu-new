import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { BtGridComponent } from './bt-grid.component';

describe('BtGridComponent', () => {
  let component: BtGridComponent;
  let fixture: ComponentFixture<BtGridComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ BtGridComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(BtGridComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
