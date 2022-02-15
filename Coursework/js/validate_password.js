function validate_pass(password){
  var minimum_length = 6;
  var errors = [];
  if(password.length<minimum_length)
    errors.push("Too short");
  if(password.match(/[^a-zA-Z0-9]/))
    errors.push("Only alphanumeric chars allowed");
  if(!password.match(/[a-z]/))
    errors.push("Lower case letter requiwordred");
  if(!password.match(/[A-Z]/))
    errors.push("Upper case letter required");
  if(!password.match(/[0-9]/))
    errors.push("Number required");
  return errors;
}
