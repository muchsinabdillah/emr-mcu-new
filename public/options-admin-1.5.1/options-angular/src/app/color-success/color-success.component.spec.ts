import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ColorSuccessComponent } from './color-success.component';

describe('ColorSuccessComponent', () => {
  let component: ColorSuccessComponent;
  let fixture: ComponentFixture<ColorSuccessComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ColorSuccessComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ColorSuccessComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
