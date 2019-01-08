function validateEmail(email) {
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-z A-Z\-0-9]+\.)+[a-z A-Z]{2,}))$/;
  return re.test(email);
}

function validatePseudo(pseudo) {
  var re = /^[a-z A-Z0-9_.-]{6,32}$/g
  return re.test(pseudo);
}

function validatePwd(pwd) {
  var re = /^[a-zA-Z0-9!@#\$%\^\&*+=_-]{6,32}$/g
  return re.test(pwd);
}

// Validate data from new user creation
function validateRegisterForm() {
  var form = document.forms["register"];
  var mail = form["mail"].value;
  var name = form["pseudo"].value;
  var pwd = form["password"].value;
  var conf_pwd = form["conf_password"].value;
  if (mail == "" || name == "" || pwd == "" || conf_pwd == "") {
    alert("Tous les champs sont obligatoires !");
  	return false;
  }
  if (!validateEmail(mail)) {
    alert("L'email est invalide");
  	return false;
  }
  if (!validatePseudo(name)) {
    alert("Le pseudonyme doit faire entre 6 et 32 caractères et ne peut comporter que des lettres, des chiffres, des espaces et _.-");
  	return false;
  }
  if (!validatePwd(pwd)) {
    alert("Le mot de passe doit faire entre 6 et 32 caractères et ne comporter que les caractères suivant: lettres, chiffres, !@#$%^&*+-_=");
  	return false;
  }
  if (pwd != conf_pwd) {
	  alert("Les mots de passe ne sont pas identiques")
	  return false
  }
}