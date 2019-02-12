function textboxOnFocus(key){
    $("#notes_message").attr("style", "display:none;");
    $('#'+key).show();
	//$('#'+key).fadeIn('slow');
}

function textboxOnBlur(key){
    $("#"+key).attr("style", "display:none;");
}

function setFocus(key){
	$("#"+key).focus();
}

function testDatabaseConnection(){    
	
	$('.loading_img').show();
	$('#notes_message').attr("style", "display:none;");
	buttonDisable();
	
	var database_host = $("#database_host").val();
	var database_name = $("#database_name").val();
	var database_username = $("#database_username").val();
	var database_password = $("#database_password").val();
	
	$.ajax({
		url: "ajax/handler.ajax.php",
		global: false,
		type: "POST",
		data: ({db_host:database_host,
			    db_name:database_name,
				db_username:database_username,
				db_password:database_password,
				check_key : "apphpei"
		}),
		dataType: "html",
		async:false,
		error: function(html){
			$('.loading_img').hide();
            $("#notes_message").html(EasyInstaller._MSG["ajax_connection_error"]);
		},
		success: function(html){
			var obj = jQuery.parseJSON(html);
			if(obj.status == "1"){
				if(obj.db_connection_status == "1"){
					$("#notes_message").html("<h4 class='success'>"+EasyInstaller._MSG["success"]+"</h4><p>"+EasyInstaller._MSG["db_version"]+": "+obj.db_version+"</p><p>"+EasyInstaller._MSG["connection_was_established"]+"</p>");	
				}else{
					$("#notes_message").html("<h4>"+EasyInstaller._MSG["error"]+"</h4><p>"+obj.db_error+"</p>");	
				}                
			}else{
                $("#notes_message").html("<span class='msg_error'>"+EasyInstaller._MSG["connection_error"]+"</span>");
			}			
		}
	});
	$('.loading_img').hide();
	$('#notes_message').fadeIn();
	buttonEnable();
}

function buttonDisable(){	
	$("#button_test").attr("style", "cursor:default;");	
}

function buttonEnable(){
	$("#button_test").attr("style", "cursor:pointer;");
}

function installTypeOnClick(val){
	if(val == "un-install"){
		$("#line_admin_info").hide("fast");
		$("#line_admin_login").hide("fast");
		$("#line_admin_password").hide("fast");
		$("#line_password_encryption").hide("fast");
	}else{
		$("#line_admin_info").show("fast");
		$("#line_admin_login").show("fast");
		$("#line_admin_password").show("fast");
		$("#line_password_encryption").show("fast");	
	}
}

/**
 *   Change location 
 */
function goTo(page){
    window.location.href = page;
}
