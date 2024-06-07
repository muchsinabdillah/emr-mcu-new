import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { UiPanelsComponent } from './ui-panels.component';

describe('UiPanelsComponent', () => {
  let component: UiPanelsComponent;
  let fixture: ComponentFixture<UiPanelsComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ UiPanelsComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(UiPanelsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
