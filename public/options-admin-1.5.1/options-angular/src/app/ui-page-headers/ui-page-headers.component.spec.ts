import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { UiPageHeadersComponent } from './ui-page-headers.component';

describe('UiPageHeadersComponent', () => {
  let component: UiPageHeadersComponent;
  let fixture: ComponentFixture<UiPageHeadersComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ UiPageHeadersComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(UiPageHeadersComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
