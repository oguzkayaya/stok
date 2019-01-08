$(function() {

    $.validator.addMethod('strongName', function(value, element){
        return this.optional(element) || value.length >= 2;
    }, 'Your name must be at least 2 characters long');
  
   
    $("#addSupplierForm").validate({
      rules: {
        email: {
          required: true,
          email: true
            
        },
        name: {
            required: true,
            strongName: true
        },
        telephone: {
            required: true
        },
        address: {
            required: true
        }
    }
    });
  
  });