import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { UiDropdownMenuComponent } from './ui-dropdown-menu.component';

describe('UiDropdownMenuComponent', () => {
  let component: UiDropdownMenuComponent;
  let fixture: ComponentFixture<UiDropdownMenuComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ UiDropdownMenuComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(UiDropdownMenuComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
