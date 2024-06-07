import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { BtCollapseComponent } from './bt-collapse.component';

describe('BtCollapseComponent', () => {
  let component: BtCollapseComponent;
  let fixture: ComponentFixture<BtCollapseComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ BtCollapseComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(BtCollapseComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
