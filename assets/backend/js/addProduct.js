

$(document).ready(function(){
	
	var productForm = $("#addProduct");
	
	var validator = productForm.validate({
		
		rules:{
			category_id :{ 
				required : true
			},
			p_name :{ 
				required : true
			},
			// p_image :{ 
			// 	required : true
			// },
			p_desc :{ 
				required : true
			},
		},
		// messages:{
		// 	category :{ required : "This field is required" },
		// }
	});
});
