$(document).ready(function() {
	$("#send_email").click(function() {
		$("#contactdiv").css("display", "block");
	});
	$("#contact #cancel").click(function() {
		$(this).parent().parent().hide();
	});
	// Email form popup send-button click event.
	$("#send").click(function() {
			var to = $("#to").val();
			var from = $("#from").val();
			var message = $("#message").val();
			if (name == "" || email == "" || contactno == "" || message == ""){
			alert("Please Fill All Fields");
			}else{
			if (validateEmail(email)) {
				$("#contactdiv").css("display", "none");
			}else {
				alert('Invalid Email Address');
			}
				function validateEmail(email) {
					var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
					if (filter.test(email)) {
						return true;
					}else {
						return false;
					}
				}
			}
	});
});