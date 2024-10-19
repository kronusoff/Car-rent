function googleTranslateElementInit() {
   new google.translate.TranslateElement({
     pageLanguage: 'ru', 
     includedLanguages: 'en,ru', 
     layout: google.translate.TranslateElement.InlineLayout.SIMPLE
   }, 'google_translate_element');
 }