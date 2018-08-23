function condel(id) {
  var reply = confirm('Are you sure you want to remove this student?');
  if (reply) {
    window.location.href = 'remove-student.php?studentid='+id;
  }
}
