function resetImage(input) {
  input.value = '';
  input.onchange();
}
function readImage(input) {
  var receiver = input.nextElementSibling.nextElementSibling;
  input.setAttribute('title', input.value.replace(/^.*[\\/]/, ''));
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      receiver.style.backgroundImage = 'url(' + e.target.result + ')';
    };
    reader.readAsDataURL(input.files[0]);
  }
  else receiver.style.backgroundImage = 'none';
}