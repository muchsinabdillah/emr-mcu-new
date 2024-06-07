import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { UiMediaObjectsComponent } from './ui-media-objects.component';

describe('UiMediaObjectsComponent', () => {
  let component: UiMediaObjectsComponent;
  let fixture: ComponentFixture<UiMediaObjectsComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ UiMediaObjectsComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(UiMediaObjectsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
