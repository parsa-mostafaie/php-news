function form_unselect_all($name) {
  var ele = document.getElementsByName($name)[0].children;
  for (var i = 0; i < ele.length; i++) ele[i].selected = false;
}

function form_uncheck_all($name) {
  var ele = document.getElementsByName($name);
  for (var i = 0; i < ele.length; i++) ele[i].checked = false;
}
