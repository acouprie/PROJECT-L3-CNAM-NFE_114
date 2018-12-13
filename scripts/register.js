function validateEmail(email) {
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}

function validateRegisterForm() {
  var form = document.forms["register"]
  var mail = form["mail"].value;
  var name = form["pseudo"].value;
  var pwd = form["password"].value;
  var conf_pwd = form["conf_password"].value;
  if (mail == "" || name == "" || pwd == "" || conf_pwd == "") {
    alert("Tous les champs sont obligatoires !");
  	return false;
  }
  if (mail.length > 32 || name.length > 32 || pwd.length > 32 || conf_pwd.length > 32) {
    alert("Les champs ne peuvent pas faire plus de 32 caractères");
  	return false;
  }
  if (!validateEmail(mail)) {
    alert("L'email est invalid");
  	return false;
  }
  if (name.length < 6) {
    alert("Le pseudonyme doit faire au moins 6 caractères");
  	return false;
  }
  if (pwd.length < 6 || conf_pwd.length < 6) {
    alert("Le mot de passe doit faire au moins 6 caractères");
  	return false;
  }
  if (pwd != conf_pwd) {
	alert("Les mots de passe ne sont pas identiques")
	return false
  }
}