function editEmail(emailClass){
    let emailVal = $("."+emailClass).val();

    $.post("includes/apis/ajax/ajax-edit-email.php", { email: emailVal, username: username})
	.done(function(response) {
		$("." + emailClass).nextAll(".message").text(response);
	})
}

function editPassword(oldPassClass,newPassClass1,newPassClass2){
    let oldPass = $("."+oldPassClass).val();
    let newPass1 = $("."+newPassClass1).val();
    let newPass2 = $("."+newPassClass2).val();

    $.post("includes/apis/ajax/ajax-edit-password.php", 
    { oldPass: oldPass, 
      newPass1: newPass1,
      newPass2: newPass2,
      username: username})
	.done(function(response) {
		$("." + oldPassClass).nextAll(".message").text(response);
	})
}


