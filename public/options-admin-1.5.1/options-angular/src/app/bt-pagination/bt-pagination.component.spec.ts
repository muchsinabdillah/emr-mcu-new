import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { BtPaginationComponent } from './bt-pagination.component';

describe('BtPaginationComponent', () => {
  let component: BtPaginationComponent;
  let fixture: ComponentFixture<BtPaginationComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ BtPaginationComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(BtPaginationComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
