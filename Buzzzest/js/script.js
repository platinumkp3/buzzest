// 
//	jQuery Validate example script
//
//	Prepared by David Cochran
//	
//	Free for your use -- No warranties, no guarantees!
//

$(document).ready(function(){

	jQuery.validator.addMethod(
        'ContainsAtLeastOneDigit',
        function (value) { 
            return /[0-9]/.test(value); 
        },  
        'Your password must contain at least one digit.'
    );  
 
    jQuery.validator.addMethod(
        'ContainsAtLeastOneCapitalLetter',
        function (value) { 
            return /[A-Z]/.test(value); 
        },  
        'Your password must contain at least one capital letter.'
    );
	
	// Validate
	// http://bassistance.de/jquery-plugins/jquery-plugin-validation/
	// http://docs.jquery.com/Plugins/Validation/
	// http://docs.jquery.com/Plugins/Validation/validate#toptions
	
		$('#contact-form').validate({
	    rules: {			
			
			account:{			
			 required: true
			},
			
			fullname:{
			 minlength: 4,
			 required: true
			},
			
			fullnme:{
			 minlength: 4,
			 required: true
			},
			
			username:{
			 minlength: 4,
			 required: true
			},
			
			usrname:{
			 minlength: 4,
			 required: true
			},
			uname:{
				minlength: 4,
			 required: true
			},
			name:{
			 minlength: 4,
			 required: true
			},
			
			email: {
	         required: true,
	         email: true
	      },
		  
		  description:{
			  required: true,
		  },
		  
		  email1: {
	         required: true,
	         email: true
	      },
		  
		  email2:{
			  required: true,
	         email: true
		  },
		  
			password:{
				required: true,
				ContainsAtLeastOneDigit: true,
                ContainsAtLeastOneCapitalLetter: true               
			
			},
			
			pssword:{
				required: true,
				ContainsAtLeastOneDigit: true,
                ContainsAtLeastOneCapitalLetter: true              
			},
			
			passwrd:{
				required: true,
				ContainsAtLeastOneDigit: true,
                ContainsAtLeastOneCapitalLetter: true               
			
			},
			founded:{
				digits:true,
				required: true
			},
			
	      gender: {
	       required: true
	      },
		  
		  type:{
			required: true
		  },
		  
		  tagline:{
			required: true
		  },
	     
	      bird: {	      	
	        required: true
	      },
		  birm: {	      	
	        required: true
	      },
		  biry: {	      	
	        required: true
	      },
		  place: {	      	
	        required: true
	      },
		   interests: {	      	
	        required: true
	      },
		   occupation: {	      	
	        required: true
	      },
		  mission:{
			required: true
		  },
		  industry: {	      	
	        required: true
	      },
	      bio: {
	        minlength: 2,
	        required: true
	      },
		  location:{
			   required: true
		  },
		  specialities:{
		   required: true
		  },
		  
		  empcount:{
			  digits:true,
			 required: true
		  },
		  url:{
			required:true
		},
		 url1:{
			required:true
		},
		url2:{
			required:true
		},
		  
	  terms: {			
		required: true 
	  },
	  terms1: {			
		required: true 
	  },
	  terms2: {			
		required: true 
	  }
	    },
	    highlight: function(label) {
	    	$(label).closest('.control-group').addClass('error');
	    },
	    success: function(label) {
	    	label
	    		.text('OK!').addClass('valid')
	    		.closest('.control-group').addClass('success');
	    }
	  });
	  
}); // end document.ready