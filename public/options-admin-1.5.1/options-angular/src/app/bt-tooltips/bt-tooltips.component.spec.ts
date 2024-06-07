import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { BtTooltipsComponent } from './bt-tooltips.component';

describe('BtTooltipsComponent', () => {
  let component: BtTooltipsComponent;
  let fixture: ComponentFixture<BtTooltipsComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ BtTooltipsComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(BtTooltipsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
