function printError(inpId, elemId, msg) {
	document.getElementById(elemId).innerHTML = msg;
	if (msg == "") {
		document.getElementById(inpId).classList.remove("error");
		document.getElementById(inpId).classList.add("success");
	}
	else {
		document.getElementById(inpId).classList.remove("success");
		document.getElementById(inpId).classList.add("error");
	}
}

function validate_form() {
	var name = document.getElementById("name").value.trim();
	var phone_no = document.getElementById("phone_no").value.trim();
	var email = document.getElementById("email").value.trim();
	var password = document.getElementById("password").value.trim();
	var confirm_password = document.getElementById("confirm_password").value.trim();

	var name_err = phone_err = email_err = password_err = confirm_password_err = true;

	// Validate name
	var regex = /^[a-zA-Z\s]+$/;

	if (regex.test(name) === false) {
		printError("name", "name_err", "Please enter a valid name");
	}
	else {
		printError("name", "name_err", "");
		name_err = false;
	}

	// Validate phone number
	regex = /^[1-9]\d{9}$/;

	if (regex.test(phone_no) === false) {
		printError("phone_no", "phone_err", "Please enter a valid 10 digit phone number");
	}
	else {
		printError("phone_no", "phone_err", "");
		phone_err = false;
	}

	// Validate email
	regex = /^\S+@\S+\.\S+$/;

	if (regex.test(email) === false) {
		printError("email", "email_err", "Please enter a valid Email ID");
	}
	else {
		printError("email", "email_err", "");
		email_err = false;
	}

	// Validate password
	if (!(password.length >= 8 && password.length <= 15)) {
		printError("password", "password_err", "Password should contain 8-15 characters");
	}
	else {
		printError("password", "password_err", "");
		password_err = false;
	}

	// Validate confirm password
	if (password != confirm_password) {
		printError("confirm_password", "confirm_password_err", "Password did not match");
	}
	else {
		printError("confirm_password", "confirm_password_err", "");
		confirm_password_err = false;
	}

	// Check errors
	if (name_err || phone_err || email_err || password_err || confirm_password_err) {
		return false;
	}
	else {
		return true;
	}

}