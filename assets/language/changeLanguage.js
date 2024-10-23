function googleTranslateElementInit() {
  new google.translate.TranslateElement({
      pageLanguage: 'ru',
      includedLanguages: 'en,ru',
      layout: google.translate.TranslateElement.InlineLayout.SIMPLE
  }, 'google_translate_element');
}
function translatePage(language) {
  var select = document.querySelector("select.goog-te-combo");
  if (select) {
      select.value = language;
      select.dispatchEvent(new Event("change"));
  }
}