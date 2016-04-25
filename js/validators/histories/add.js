// Validate ADD form - histories
var v = new Validator('histories-add-form');
v.EnableMsgsTogether();

v.addValidation('histories[history_title]', 'required', 'Title - please enter data');
v.addValidation('histories[history_text]', 'required', 'Text - please enter data');

/**
 * Extra validations - like Agreement
 */
function agreement()
{
	var success = false;
	// checked
	success = true;

	return(success);
}
//v.setAddnlValidationFunction(agreement);

// If jQuery validator is used
// $(document).ready(function(){ $("#histories-add-form").validate(); });

document.forms['histories-add-form'].elements[0].focus();