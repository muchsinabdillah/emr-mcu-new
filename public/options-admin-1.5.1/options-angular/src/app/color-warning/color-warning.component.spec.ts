import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ColorWarningComponent } from './color-warning.component';

describe('ColorWarningComponent', () => {
  let component: ColorWarningComponent;
  let fixture: ComponentFixture<ColorWarningComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ColorWarningComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ColorWarningComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
