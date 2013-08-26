
//Validate Forms
function validAsterisk(i) {
	if(typeof(i)==='undefined') i=0; //If no argument is passed for i, i=0 by default
	var validAsterisk = document.createElement('span');
		validAsterisk.setAttribute("class","validAsterisk");
		validAsterisk.innerHTML="*";
		document.getElementsByTagName('label')[i].appendChild(validAsterisk);
}
function validateForm() {
	alert('You haven\'t filled out all inputs');
	var email = document.forms["register"]["username"].value;
	var pass = document.forms["register"]["pass"].value;
	var pass2 = document.forms["register"]["pass2"].value;
	alert('You haven\'t filled out all inputs');
	if(email==null || email == "" || pass == null || pass == "" || pass2==null || pass2=="") {
	var numInput = document.getElementsByTagName('input').length; //number of 'inputs' in form
		for(var i=0, i<numInputs, i++) {
			alert(i);
		}
	}
	var posAt = email.indexOf("@");
	var posPeriod = email.indexOf(".");
	//must be (at least) 1 period, 1 @ sign
	//last period must come after @ sign, with at least two characters after the period
	if (posAt<1 || posPeriod<posAt || posPeriod+2>=email.length) {
		//If an asterisk has not been added yet
		if(document.getElementsByTagName('label')[0].innerHTML == "Username:") {
			validAsterisk(0);
		}
		return false;
	}
	return true;
}








//Validate Forms
function validAsterisk(i) {
	if(typeof(i)==='undefined') i=0; //If no argument is passed for i, i=0 by default
	var validAsterisk = document.createElement('span');
		validAsterisk.setAttribute("class","validAsterisk");
		validAsterisk.innerHTML="*";
		document.getElementsByTagName('label')[i].appendChild(validAsterisk);
}
function validateForm() {
	var email = document.forms["register"]["username"].value;
	var pass = document.forms["register"]["pass"].value;
	var pass2 = document.forms["register"]["pass2"].value;
	if(email==null || email == "" || pass == null || pass == "" || pass2==null || pass2=="") {
		var numInput = document.getElementsByTagName('input').length; //number of 'inputs' in form
		alert(numInput);
		for(var i=0; i<numInputs; i++) {
			alert(i);
		}
	}
	var posAt = email.indexOf("@");
	var posPeriod = email.indexOf(".");
	//must be (at least) 1 period, 1 @ sign
	//last period must come after @ sign, with at least two characters after the period
	if (posAt<1 || posPeriod<posAt || posPeriod+2>=email.length) {
		//If an asterisk has not been added yet
		if(document.getElementsByTagName('label')[0].innerHTML == "Username:") {
			validAsterisk(0);
		}
		return false;
	}
	return true;
}
