function acstudent(name, id) {
  var reply = confirm('Are you sure you want to accept '+name+' as a student of CMI?');
  if (reply) {
    window.location.href = 'accept-student.php?reg_no='+id;
  }
}

function dcstudent(name, id) {
  var reply = confirm('Are you sure you want to reject '+name+' application?');
  if (reply) {
    window.location.href = 'decline-student.php?reg_no='+id;
  }
}

function removestaff(name, id) {
  var reply = confirm('Are you sure you want to remove '+name+' from CMI list of staffs?');
  if (reply) {
    window.location.href = 'remove-staff.php?id='+id;
  }
}
