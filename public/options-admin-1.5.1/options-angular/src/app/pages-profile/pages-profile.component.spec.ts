import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { PagesProfileComponent } from './pages-profile.component';

describe('PagesProfileComponent', () => {
  let component: PagesProfileComponent;
  let fixture: ComponentFixture<PagesProfileComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ PagesProfileComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(PagesProfileComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
