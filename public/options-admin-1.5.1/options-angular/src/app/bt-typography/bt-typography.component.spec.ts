import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { BtTypographyComponent } from './bt-typography.component';

describe('BtTypographyComponent', () => {
  let component: BtTypographyComponent;
  let fixture: ComponentFixture<BtTypographyComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ BtTypographyComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(BtTypographyComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
