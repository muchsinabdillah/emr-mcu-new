import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ColorBlackComponent } from './color-black.component';

describe('ColorBlackComponent', () => {
  let component: ColorBlackComponent;
  let fixture: ComponentFixture<ColorBlackComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ColorBlackComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ColorBlackComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
