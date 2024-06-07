import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { Table10kRowsComponent } from './table-10k-rows.component';

describe('Table10kRowsComponent', () => {
  let component: Table10kRowsComponent;
  let fixture: ComponentFixture<Table10kRowsComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ Table10kRowsComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(Table10kRowsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
