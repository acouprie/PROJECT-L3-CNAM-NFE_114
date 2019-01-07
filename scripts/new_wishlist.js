// Add or remove fields during wishlist creation
$(function() {
  var addDiv = $('#addinput');
  var i = $('#addinput p').size() + 1;

  $('#addNew').click(function() {
    $('<p>Souhait n°' + i + ' :<input type="text" class="p_new" name="wish_' + i +'" /></p>').appendTo(addDiv);
    i++;
    return false;
  });

  $('#remNew').click(function() {
    alert('test');
    $(this).parents('p').remove();
    i--;
    return false;
  });
});

// Validate data for new wishlist creation
function validateRegisterForm() {
  var form = document.forms["new_wislist"]
  var name = form["name"].value;
  var wish = form["wish"].value;
  if (name == "") {
    alert("Le nom est obligatoire !");
  	return false;
  }
  if (name.length > 32 || wish.length > 32) {
    alert("Les champs ne peuvent pas faire plus de 32 caractères");
  	return false;
  }
  if (name.length < 2) {
    alert("Les champs ne peuvent pas faire moins de 2 caractères");
  	return false;
  }
}