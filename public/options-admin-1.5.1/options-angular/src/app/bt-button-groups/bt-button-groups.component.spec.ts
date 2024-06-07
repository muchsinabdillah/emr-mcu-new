import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { BtButtonGroupsComponent } from './bt-button-groups.component';

describe('BtButtonGroupsComponent', () => {
  let component: BtButtonGroupsComponent;
  let fixture: ComponentFixture<BtButtonGroupsComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ BtButtonGroupsComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(BtButtonGroupsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
