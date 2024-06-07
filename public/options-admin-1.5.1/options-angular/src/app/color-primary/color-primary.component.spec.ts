import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ColorPrimaryComponent } from './color-primary.component';

describe('ColorPrimaryComponent', () => {
  let component: ColorPrimaryComponent;
  let fixture: ComponentFixture<ColorPrimaryComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ColorPrimaryComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ColorPrimaryComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
