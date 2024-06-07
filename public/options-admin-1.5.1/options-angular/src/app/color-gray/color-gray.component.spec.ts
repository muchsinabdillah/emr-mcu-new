import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ColorGrayComponent } from './color-gray.component';

describe('ColorGrayComponent', () => {
  let component: ColorGrayComponent;
  let fixture: ComponentFixture<ColorGrayComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ColorGrayComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ColorGrayComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
