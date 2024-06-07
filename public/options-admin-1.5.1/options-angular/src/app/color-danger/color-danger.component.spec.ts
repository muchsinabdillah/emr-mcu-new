import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ColorDangerComponent } from './color-danger.component';

describe('ColorDangerComponent', () => {
  let component: ColorDangerComponent;
  let fixture: ComponentFixture<ColorDangerComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ColorDangerComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ColorDangerComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
