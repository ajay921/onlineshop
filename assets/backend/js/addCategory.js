

$(document).ready(function(){
	
	var categoryForm = $("#addCategory");
	
	var validator = categoryForm.validate({
		
		rules:{
			category :{ 
				required : true
			},
		},
		messages:{
			category :{ required : "This field is required" },
		}
	});
});
