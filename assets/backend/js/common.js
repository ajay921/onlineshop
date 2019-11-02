jQuery(document).ready(function(){

     jQuery(document).on("click", ".deleteUser", function(){
         var userId = $(this).data("userid");
         var table = $(this).data("tb");
         var column = $(this).data("col");
             hitURL = baseURL + "deleteUser";
             currentRow = $(this);

         var confirmation = confirm("Are you sure to delete this record ?");

         if(confirmation)
         {
             jQuery.ajax({
             type : "POST",
             dataType : "json",
             url : hitURL,
             data : { userId : userId,table:table,column:column }
             }).done(function(data){
                 console.log(data);
                 currentRow.parents('tr').remove();
                 if(data.status = true) { alert("Record has been deleted successfully."); }
                 else if(data.status = false) { alert("Something went wrong"); }
                 else { alert("Access denied..!"); }
             });
         }
     });


     jQuery(document).on("click", ".searchList", function(){

     });

});