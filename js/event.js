/**
 * event.js
 * On mouse/keyboard events, perform specific tasks
 * Author: buma
 **/
$(document).ready( function() {
	/*	Clicking on other category, will appear the textfield to fill with the new category	*/
	$('#category').change( function() {
		var sel = $(this).val();
		if(sel == "other") {
			$('#new_category').show();
			$('#otherLabel').show();
		} else {
			$('#new_category').hide();	
			$('#otherLabel').hide();
		}
	});
	
	/* Scroll to end of page */
	$('#my_wish').click( function() {
		$("html, body").animate({ scrollTop: $(document).height() }, 1000);
	});
	
	$('.edit').click( function() {
		$("html, body").animate({ scrollTop: $(document).height() }, 1000);
	});
	
	$('.btn_add_wish').click( function() {
		$('#new_wish').hide();
	});
	
	if ($("#add_budget_form select[name='category']").val() == "other") {
		$('#new_category').show();
		$('#otherLabel').show();
	}

	/*	Ajax for add_budget form	*/
	$('#btn_add_budget_form').click(function(){
		var form_data = $("#add_budget_form").serialize(),
			budget_id = $("#add_budget_form input[name='budget_id']").val(),
			amount = $("#add_budget_form input[name='amount']").val(),
			category = $("#add_budget_form select[name='category_id']").val(),
			new_category = $("#add_budget_form input[name='new_category']").val(),
			message = $("#add_budget_form .alert"),
			add_category = false;
			message.hide().removeClass("alert-success");
		
		if (amount == "undefined" || amount == "" || amount == 0 || (!amount.match(/^\$?[0-9]+(\.[0-9][0-9])?$/))) {
			message.show().html("Fill the AMOUNT field correctly.");
			message.addClass("alert-failure");
		}
		else if (category == "undefined" || category == "") {
			message.show().html("Fill the CATEGORY field correctly.");
			message.addClass("alert-failure");
		}			
		else if (category == "other" && (new_category == "undefined" || new_category == "")) {
			message.show().html("Fill the OTHER field correctly.");
			message.addClass("alert-failure");
		}
		else {
			$.ajax({
				type: "POST",
				url: "/group11/buma/add_budget_post.php",
				data: form_data + (budget_id > 0 ? "&action=edit" : ""),
				success: function(result) {
					message.show().html(result);
					if (result == "Budget added.") {
						message.addClass("alert-success");
						$("#add_budget_form input[name='amount']").val('');
						//$("#add_budget_form select[name='category_id'] option:first").attr('selected','selected');
						$("#add_budget_form input[name='new_category']").val('');
					} else if (result == "Budget edited.") 
						message.addClass("alert-success");
				}
			});
		}
	});

	/* Edit wish */
	$(".edit").click( function() {
		$("#edit-wish").show();
		$(".remove-wish").hide();
		$(".complete-wish").hide();
		$("#new_wish").hide();
	});	
	
	/* Remove wish */
	$(".remove").click( function() {
		//$(".remove-wish").show();
		$(".complete-wish").hide();
		$("#edit-wish").hide();
		$("#new_wish").hide();
	});	
	
	/* Complete wish */
	$(".complete").click( function() {
		//$(".complete-wish").show();
		$(".remove-wish").hide();
		$("#edit-wish").hide();
		$("#new_wish").hide();
	});	
	
	/* Create new wish */
	$("#my_wish").click( function() {
		$("#new_wish").show();
		$(".remove-wish").hide();
		$("#edit-wish").hide();
		$(".complete-wish").hide();
	});
	
	/*	Ajax for add new wish	*/
	$('#wish_list_form .btn_add_wish').click(function(){
		var form_data = $("#wish_list_form").serialize(),
			wish_id = $("#wish_list_form input[name='wish_id']").val(),
			description = $("#wish_list_form input[name='description']").val(),
			amount = $("#wish_list_form input[name='amount']").val(),
			message = $("#wish_list_form .alert.my_alert");

		message.hide().removeClass("alert-success");
		if (description == "undefined" || description == "") message.show().html("Fill the ITEM field correctly.");
		else if (amount == "undefined" || amount == "" || amount == 0 || (!amount.match(/^\$?[0-9]+(\.[0-9][0-9])?$/))) message.show().html("Fill the VALUE field correctly.");
		else {
			$.ajax({
				type: "POST",
				url: "/group11/buma/wish_list_post.php",
				data: form_data + (wish_id > 0 ? "&action=edit" : ""),
				success: function(result) {
					if (result == "Wish added.") {
						message.addClass("alert-success");
						window.location.replace("/group11/buma/wish_list");
					} else if (result == "Wish edited.") 
						window.location.replace("/group11/buma/wish_list");
						message.addClass("alert-success");
					message.show().html(result);
				}
			});
		}
		return false;
	});
	
	/*	Ajax for login form	*/
	$('#btn_login_form').click(function(){
		var form_data = $("#login_form").serialize(),
			email = $("#login_form input[name='email']").val(),
			password = $("#login_form input[name='password']").val(),
			message = $("#login_form .alert");

		message.hide().removeClass("alert-success");
		if (email == "undefined" || email == "") message.show().html("Fill the EMAIL field correctly.");
		else if (password == "undefined" || password == "") message.show().html("Fill the PASSWORD field correctly.");
		else {
			if ($("#login_form input[name='remember_me']").is(':checked')) {
				$.ajax({
					type:"POST",
					url: "/group11/buma/remember_post.php",
					data: form_data,
					success: function(result) {}
				});
			}
			$.ajax({
				type: "POST",
				url: "/group11/buma/login_post.php",
				data: form_data,
				success: function(result) {
					if (result == "Logged in.") {
						message.addClass("alert-success");
						window.location.replace("home");
					}
					message.show().html(result);
				}
			});
		}
		return false;
	});
			
	/*	Ajax for delete budget home	*/
	$('.budgets_home .btn_delete').click(function(){
		var budget_id = $(this).prev().html();
		$.ajax({
			type: "POST",
			url: "/group11/buma/add_budget_post.php",
			data: "budget_id=" + budget_id + "&action=delete" ,
			success: function(result) {
				if (result == "Budget deleted.") {
					window.location.replace("home");
				}
			}
		});
		return false;
	});
	
	/*	Ajax for delete wish	*/
	$('.remove.btn_wish_list').click(function(){
		var wish_id = $(this).prev().html();
		$.ajax({
			type: "POST",
			url: "/group11/buma/wish_list_post.php",
			data: "wish_id=" + wish_id + "&action=delete" ,
			success: function(result) {
				if (result == "Wish deleted.") {
					window.location.replace("/group11/buma/wish_list");
				}
			}
		});
		return false;
	});

	/*	Ajax for delete expense home	*/
	$('.budgets_home .delete_expense.btn_delete').click(function(){
		var expense_id = $(this).prev().html();
		$.ajax({
			type: "POST",
			url: "/group11/buma/add_expense_post.php",
			data: "expense_id=" + expense_id + "&action=delete" ,
			success: function(result) {
				if (result == "Expense deleted.") {
					window.location.replace("home");
				}
			}
		});
		return false;
	});
	
	/*	Ajax for complete wish	*/
	$('.complete.btn_wish_list').click(function(){
		var wish_id = $(this).prev().prev().prev().html();
		$.ajax({
			type: "POST",
			url: "/group11/buma/wish_list_post.php",
			data: "wish_id=" + wish_id + "&action=complete" ,
			success: function(result) {
				if (result == "Wish completed.") {
					window.location.replace("/group11/buma/wish_list");
				}
			}
		});
		return false;
	});

	/* Ajax for register form */
	$('#register_form_buttom').click(function(){ 
		var form_data = $("#register_form").serialize(),
			email  	  = $("#register_form input[name='email']").val(),
			password  = $("#register_form input[name='password']").val(),
			username  = $("#register_form input[name='username']").val(),
			repass	  = $("#register_form input[name='repass']").val(),
			message = $("#register_form .alert");
			message.hide().removeClass("alert-success");

		if (email == "undefined" || email == "" || (!email.match(/^(\w)+(\.\w+)*@(\w)+((\.\w+)+)$/))) {
			message.show().html("Fill email field correctly.");
			message.addClass("alert-failure");
		}	
		else if (password == "undefined" || password == ""|| password.lenth <6 || (!password.match(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/))) {
			message.show().html("Password should be 6-16 digits contain at least one lowercase letter, one uppercase letter, one numeric digit");
			message.addClass("alert-failure");
		}			
		else if (username == "undefined" || username == ""|| username.lenth <6) {
			message.show().html("Account username is empty or less than 6");
			message.addClass("alert-failure");
		}
		else if ((!repass.match(password))){
			message.show().html("password not match!");
			message.addClass("alert-failure");
		}
		else { 
			$.ajax({
				type: "POST",
				url: "/group11/buma/register_post.php",
				data: form_data,
				success: function(result) { 
				message.show().html(result);
					if (result == "Register successfully.") {
						$("#register_form input[name='email']").val('');				
						$("#register_form input[name='password']").val('');
						$("#register_form input[name='username']").val('');	
						//$("#register_form input[name='userid']").val('');	
						message.addClass("alert-success");
						window.location.replace("login");
					}
					
				}
			});
		}	return false;
	});
	
	/*Ajax for forgot form*/		
	$('#forgot_form_buttom').click(function(){
		var form_data =$("#forgot_form").serialize(),
			email = $("#forgot_form input[name='email']").val(),
			message = $("#forgot_form .alert");
 			message.hide().removeClass("alert-success");
		if (email == "undefined" || email == "") message.show().html("Fill the EMAIL field correctly.")
		else { 
			$.ajax({ 
				type: "POST",
				url: "/group11/buma/forgot_post.php",
				data: form_data,
				success: function(result) {
					if (result == "Retrieve your password in your email") { 
						message.addClass("alert-success");
					}
					message.show().html(result);
				}
			});
		} 
		return false;
	});

	// Add expense accordion (to save spave for vieing list items)
	
	/*	Ajax for add_expense form	*/
	$('#btn_add_expense_form').click(function() {
		var form_data = $("#add_expense_form").serialize(),
			amount = $("#add_expense_form input[name='amount']").val(),
			description = $("#add_expense_form input[name='description']").val(),
			budget_id = $("#add_expense_form input[name='budget_id']").val(),
			expense_id = $("#add_expense_form input[name='expense_id']").val(),
			message = $("#add_expense_form .alert");
		message.hide().removeClass("alert-success");

		if (description == "undefined" || description == "") {
			message.show().html("Fill the DESCRIPTION correctly.");
			message.addClass("alert-failure");
		}
		else if (amount == "undefined" || amount == "" || amount == 0 || (!amount.match(/^\$?[0-9]+(\.[0-9][0-9])?$/))) {
			message.show().html("Fill the AMOUNT field correctly.");
			message.addClass("alert-failure");
		}
		else if (budget_id == "undefined" || budget_id == "") {
			message.show().html("Select a BUDGET correctly.");
			message.addClass("alert-failure");
		}
		else {
			$.ajax({
				type: "POST",
				url: "/group11/buma/add_expense_post.php",
				data: form_data + (expense_id > 0 ? "&action=edit" : ""),
				success: function(result) {
					message.show().html(result);
					if (result == "Expense added.") {
						message.addClass("alert-success");
						$("#add_expense_form input[name='amount']").val('');
						$("#add_expense_form input[name='description']").val('');
					}
				}
			});
		}
	});
});
