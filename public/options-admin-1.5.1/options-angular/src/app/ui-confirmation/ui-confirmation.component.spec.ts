import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { UiConfirmationComponent } from './ui-confirmation.component';

describe('UiConfirmationComponent', () => {
  let component: UiConfirmationComponent;
  let fixture: ComponentFixture<UiConfirmationComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ UiConfirmationComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(UiConfirmationComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
