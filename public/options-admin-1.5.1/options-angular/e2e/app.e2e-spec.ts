import { OptionsAngularPage } from './app.po';

describe('options-angular App', () => {
  let page: OptionsAngularPage;

  beforeEach(() => {
    page = new OptionsAngularPage();
  });

  it('should display message saying app works', () => {
    page.navigateTo();
    expect(page.getParagraphText()).toEqual('app works!');
  });
});
