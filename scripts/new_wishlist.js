// Add fields during wishlist creation
$(function() {
  var addDiv = $('#addinput');
  var i = $('#addinput p').size() + 1;

  $('#addNew').click(function() {
    $('<p>Souhait n°' + i + ' :<input type="text" class="p_new" name="wish_' + i +'" /></p>').appendTo(addDiv);
    i++;
    return false;
  });
});

function validateName(name) {
  var re = /^[a-z A-Z0-9_.-]{2,128}$/g
  return re.test(name);
}

// Validate data for new wishlist creation
function validateRegisterForm() {
  var form = document.forms["new_wishlist"];
  var name = form["name"].value;
  if (name == "") {
    alert("Le nom est obligatoire !");
  	return false;
  }
  if (!validateName(name)) {
    alert("Le nom doit faire entre 2 et 32 caractères et ne comporter que des lettres, espaces, chiffres et _.-");
  	return false;
  }
}