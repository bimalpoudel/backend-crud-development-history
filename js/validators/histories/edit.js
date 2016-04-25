// Validate EDIT form - histories
var v = new Validator('histories-edit-form');
v.EnableMsgsTogether();

v.addValidation('histories[history_title]', 'required', 'Title - please enter data');
v.addValidation('histories[history_text]', 'required', 'Text - please enter data');

document.forms['histories-edit-form'].elements[0].focus();