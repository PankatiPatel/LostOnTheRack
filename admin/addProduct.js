$(document).ready(function(){ //Make script DOM ready
    $('#productCategory').change(function() { //jQuery Change Function
        var list = document.getElementById("productCategory")
        var val1 = $(list).val(); // Get value from select element
        var txt =  list.options[list.selectedIndex].innerHTML; // Get text from select element 


    


        document.getElementById("size").disabled = false;
        $('#size').empty();


        if ((txt == "Shirt") || (txt == 'Jacket' ))
        {
            
          
            $('#size').append('<option> </option>' + 
                              '<option> XS </option>'+
                              '<option> S </option>'+
                              '<option> M </option>'+
                              '<option> L </option>'+
                              '<option> XL </option>'+
                              '<option> XL </option>'+
                              '<option> XXL </option>'+
                              '<option> XXL </option>' );
        }
        else if (txt == "Shoes")
        {
            
            $('#size').append('<option> </option>'+
                              '<option> M 5.5/W 5 </option>'+
                              '<option> M 6/W5.5 </option>'+
                              '<option> M 6.5/W 6 </option>'+
                              '<option> M 7/W 6.5 </option>'+
                              '<option> M 7.5/W 7 </option>'+
                              '<option> M 8/ W 7.5 </option>'+
                              '<option> M 8.5/W 8 </option>'+
                              '<option> M 10/W 9.5 </option>'+
                              '<option> M 11/W 10.5 </option>'+
                              '<option> M 12/W 11.5 </option>');
        }
        else if (txt == "Pants")
        {
           
           
            $('#size').append('<option> </option>'+
                               '<option> 30 </option>'+
                               '<option> 32 </option>'+
                               '<option> 34 </option>'+
                               '<option> 36 </option>'+
                               '<option> 38 </option>'+
                               '<option> 40 </option>'+
                               '<option> 42 </option>'+
                               '<option> 44 </option>'+
                               '<option> 46 </option>'+
                               '<option> 48 </option>'+
                               '<option> 50 </option>'+
                               '<option> 52 </option>'+
                               '<option> 54 </option>');
                                
            
            
           

          
        }
        else 
        {
            document.getElementById("size").disabled = true
           
        }

   
         
    });
});



s