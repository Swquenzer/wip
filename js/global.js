//Validate Forms
window.onload = function() {
	newPortProj();
};

function guestLink() {
	var login = document.getElementById('loginLinkA');
	login.innerHTML="Login<br><h6>(guest)</h6>";
}

function memberLink(username, root) {
	var login = document.getElementById('loginLinkA');
	login.innerHTML="Welcome, <br><h6>" + username + "</h6>";
	login.href= root + "members/" + username + "/workstation.php";
}

function validAsterisk(i) {
	if(typeof(i)==='undefined') i=0; //If no argument is passed for i, i=0 by default
	var label = document.getElementsByTagName('label')[i].innerHTML;
	var isAsterisk = label.indexOf('*');
	//if an asterisk doesn't exist yet, create one and append to label
	if (isAsterisk == -1) {
		var validAsterisk = document.createElement('span');
		validAsterisk.setAttribute("class","validAsterisk");
		validAsterisk.innerHTML="*";
		document.getElementsByTagName('label')[i].appendChild(validAsterisk);
	}
}

function validateForm() {
	/* If any inputs have not been filled out ********************************************************/
	var inputs = document.getElementsByTagName('input');
	var numInput = inputs.length; //number of 'inputs' in forms
	var filled = true;
	for (var i=0; i<numInput; i++) {
		if(inputs[i].value=="" || inputs[i].value==null) {
		validAsterisk(i);
		filled =false;
		}
	}
	if (!filled) alert('You have not filled out all form inputs, try again');
	
	/* Check for proper email address ********************************************************/
	var email = document.forms["register"]["email"].value; //User value of email input
	var posAt = email.indexOf("@"); //position of "@" sign
	var posPeriod = email.indexOf("."); // position of period
	/* CHECK USERNAME TO SEE IF PROPER EMAIL ADDRESS FORMAT */
	//must be (at least) 1 period, 1 @ sign
	//last period must come after @ sign, with at least two characters after the period
	if (posAt<1 || posPeriod<posAt || posPeriod+2>=email.length) {
		validAsterisk(1);
		return false;
	}
	return true;
}

function newPortProj() {
	var portSubmit = document.getElementById("portSubmit");
	$("#newProjectCheck").change(function() {
		if(this.checked) {
			$("#newProj").load("newproject.html", function() {
				portSubmit.value="Create Portfolio and Project";
			});
		} else {
			$("#newProj").empty();
			portSubmit.value="Create Portfolio";
		}
	});
}