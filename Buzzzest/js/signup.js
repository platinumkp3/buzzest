// JavaScript Document
	 var i=0;
	 function valOther()
	 {		
	 	if (document.getElementById('account').value == 1) /* Individual*/
		{			
			if(document.getElementById('fullname').value == "" )
			{
				document.getElementById('errorfullname').innerHTML ="Please Enter fullname";
				return false;
			}
			
			else if(document.getElementById('user_name').value == "" )
			{
				document.getElementById('erroruser_name').innerHTML ="Please Enter username";
				return false;
			}
			
			else if(document.getElementById('email').value == "")
			{
				document.getElementById('erroremail').innerHTML ="Please Enter email";
				return false;
			}
			
			else if(frmaccount.password.value.length =="")
			{
				document.getElementById('errorpassword').innerHTML ="Please Enter password";
				return false;
			}			
			
			else if( frmaccount.gender.value == "0" )
			{
				document.getElementById('errorgender').innerHTML ="Please Select gender";
				return false;
			}
			
			else if( frmaccount.bird.selectedIndex == 0 || frmaccount.birm.selectedIndex == 0 
						|| frmaccount.biry.selectedIndex == 0  )
			{
				var d=valDate();
				
				if (d == 1)
				{
					document.getElementById('errordob').innerHTML ="Please Select a date";
					 return false;
				}
				else if (d == 2)
				{
					document.getElementById('errordob').innerHTML ="Please Select a month";
					 return false;
				}
				else if (d == 3)
				{
					document.getElementById('errordob').innerHTML ="Please Select a year";
					 return false;
				}
			}
			
			else if(document.getElementById('place').value == "")
			{
				document.getElementById('errorplace').innerHTML ="Please Enter place";
				return false;
			}
			
			else if(document.getElementById('interest').value == "")
			{
				document.getElementById('errorinterest').innerHTML ="Please Enter interest";
				return false;
			}
			
			else if(document.getElementById('occupation').value == "")
			{
				document.getElementById('erroroccupation').innerHTML ="Please Enter occupation";
				return false;
			}
			
			else if(document.getElementById('industry').value == "")
			{
				document.getElementById('errorindustry').innerHTML ="Please Enter industry";
				return false;
			}
			
			else if(document.getElementById('bio').value == "")
			{
				document.getElementById('errorbio').innerHTML ="Please Enter Bio";
				return false;
			}
			
			else if(document.getElementById('website').value == "")
			{
				document.getElementById('errorwebsite').innerHTML ="Please Enter website";
				return false;
			}
			
			else if(frmaccount.terms.checked  == false)
			{
				alert ("Please check the terms and conditions");
				return false;
			}
			
			else 
			{
				return false;
			}	
		}
		else  if (document.getElementById('account').value == 2) /* Organization*/
		{
			if(document.getElementById('fullname').value=="")
			{
			}
			
			else if(document.getElementById('fullname').value=="")
			{
			}
			
			else if(document.getElementById('fullname').value=="")
			{
			}
			
			else if(document.getElementById('fullname').value=="")
			{
			}
			
			else if(document.getElementById('fullname').value=="")
			{
			}
			
			else if(document.getElementById('fullname').value=="")
			{
			}
			
			else if(document.getElementById('fullname').value=="")
			{
			}
			name
			user_name
			email
			password
			description
			website
			terms
		}
		else  if (document.getElementById('account').value == 3) /* Groups*/
		{
			if(document.getElementById('fullname').value=="")
			{
			}
			
			else if(document.getElementById('fullname').value=="")
			{
			}
			
			else if(document.getElementById('fullname').value=="")
			{
			}
			
			else if(document.getElementById('fullname').value=="")
			{
			}
			
			else if(document.getElementById('fullname').value=="")
			{
			}
			
			else if(document.getElementById('fullname').value=="")
			{
			}
			
			else if(document.getElementById('fullname').value=="")
			{
			}
			
			else if(document.getElementById('fullname').value=="")
			{
			}
			
			else if(document.getElementById('fullname').value=="")
			{
			}
			name
			user_name
			email
			password
			founded
			overview
			tagline
			type_val
			mission
			industry
			specialities
			empcount
			location
			website
			terms
		}
		else 
		{
			return false;
		}
	 }
	
	 function valSave()
	 {
		var xmlhttp;
		if (window.XMLHttpRequest)
		{
			xmlhttp=new XMLHttpRequest();
		}
		else
		{
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				document.getElementById("results").innerHTML=xmlhttp.responseText;
				//alert(xmlhttp.responseText);
			}
		} 
		var fnm = document.getElementById("fnm").value; 
		if(fnm.split(" ").length==1)
		{
			var lnm = document.getElementById("lnm").value; 
			var pwd = frmRegs.pwd.value; 
			//var dob = document.getElementById("dob").value; 
			var dobd = frmRegs.bird.value; 
			var dobm = frmRegs.birm.value; 
			var doby = frmRegs.biry.value; 
			//var dobs=dob.split(" ");
			var dob=doby+"-"+dobm+"-"+dobd;
			var email = document.getElementById("email").value; 
			var gen = "";
			var gen1 =document.frmRegs.gen;
			
			for (i=0; i<gen1.length; i++)
			{
				if (gen1[i].checked == true)
					gen = gen1[i].value;
			}
			
			if(gen == 1)
				gen="female";
			else
				gen="male";
							
			var params = "fnm=" + fnm + "&lnm=" + lnm + "&pwd=" + pwd + "&dob=" + dob + "&email=" + email + "&gen=" + gen;
			//&bird=" + bird + "&birm=" + birm + "&biry=" + biry + "
			xmlhttp.open("GET","signup.php",true);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.send(params); 
			
			window.location = "signup.php";
	
			document.getElementById("fnm").value="";
			document.getElementById("lnm").value="";
			frmRegs.pwd.value="";
			frmRegs.rpwd.value="";
			document.getElementById("email").value="";
			document.getElementById("remail").value="";
			document.getElementById("dob").value = "";
			document.getElementById("gen").checked=false;
			frmRegs.bird.value="dd";
			frmRegs.birm.value="mm";
			frmRegs.biry.value="yyyy";	}
		
		
	 }
	 
	 function chkLogin()
	 {		
		if(document.getElementById("unm").value=="")
		{			
			alert("Enter e-mail address");
			return false;
		}
		else if(frmlogin.pwd.value =="")
		{
			alert("Enter Pasword");
			return false;
			
		}
		else if ( document.getElementById("unm").value !="" && frmlogin.pwd.value !="")
		{
			var x=frmlogin.unm.value;
			var atpos=x.indexOf("@");
			var dotpos=x.lastIndexOf(".");
			if ((atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length))
			{	
				alert("Please enter a valid email id");
				return false;
			}
			else 
			{
				return true;
			}
		}
		else if(document.getElementById("unm").value !="" && frmlogin.pwd.value.length !="")
		{
			return true;
		}
		
	 }
	 
	 function valDate()
	 {
			var dobd = frmRegs.bird.value; 
			var dobm = frmRegs.birm.value; 
			var doby = frmRegs.biry.value; 
			var dob=doby+"-"+dobm+"-"+dobd;
			var i=0;
			if(frmRegs.biry.value == 'yyyy')
			{
				i= 3;
			}
			if(frmRegs.birm.value == 'mm')
			{
				i=2;				
			}
			if(frmRegs.bird.value  == "dd")
			{
				i= 1;							
			}
			
			return i;
	 }
	 
	function valEmail()
	 {
	 	var email1=document.getElementById('email').value;
		if(email1 == "" )
		{
			i=0;
			if(email1 == "")
			{
				document.getElementById('email').focus();
	 			document.getElementById('eemail').innerHTML="*";
			}			
		}		
		else
		{
			i=1;
		}
	 }
	 
	 function clkDate()
	 {
		var dob=document.getElementById('dob').value;
		var splitDate = dob.split("-");
		if(splitDate[0] == 'dd' && splitDate[1] == 'mm' && splitDate[2] == 'yyyy')
		{
			i=0;
			document.getElementById('dob').value="";
		}
	 }
	 

	
	function validatePassword (pw, options) {
		// default options (allows any password)
		var o = {
		lower:    0,
		upper:    0,
		alpha:    0, /* lower + upper */
		numeric:  1,
		special:  0,
		length:   [1, Infinity],
		custom:   [ /* regexes and/or functions */ ],
		badWords: [],
		badSequenceLength: 0,
		noQwertySequences: false,
		noSequential:      false
		};
	
		for (var property in options)
			o[property] = options[property];
	
		var	re = {
				lower:   /[a-z]/g,
				upper:   /[A-Z]/g,
				alpha:   /[A-Z]/gi,
				numeric: /[0-9]/g,
				special: /[\W_]/g
			},
			rule, i;
	
		// enforce min/max length
		if (pw.length < o.length[0] || pw.length > o.length[1])
			return "Please enter a value greater than "+o.length[0];
	
		// enforce lower/upper/alpha/numeric/special rules
		for (rule in re) {
			if ((pw.match(re[rule]) || []).length < o[rule])
				return "Password should contain 1 numeric value";
		}
	
		// enforce word ban (case insensitive)
		for (i = 0; i < o.badWords.length; i++) {
			if (pw.toLowerCase().indexOf(o.badWords[i].toLowerCase()) > -1)
				return false;
		}
	
		// enforce the no sequential, identical characters rule
		if (o.noSequential && /([\S\s])\1/.test(pw))
			return false;
	
		// enforce alphanumeric/qwerty sequence ban rules
		if (o.badSequenceLength) {
			var	lower   = "abcdefghijklmnopqrstuvwxyz",
				upper   = lower.toUpperCase(),
				numbers = "0123456789",
				qwerty  = "qwertyuiopasdfghjklzxcvbnm",
				start   = o.badSequenceLength - 1,
				seq     = "_" + pw.slice(0, start);
			for (i = start; i < pw.length; i++) {
				seq = seq.slice(1) + pw.charAt(i);
				if (
					lower.indexOf(seq)   > -1 ||
					upper.indexOf(seq)   > -1 ||
					numbers.indexOf(seq) > -1 ||
					(o.noQwertySequences && qwerty.indexOf(seq) > -1)
				) {
					return false;
				}
			}
		}
	
		// enforce custom regex/function rules
		for (i = 0; i < o.custom.length; i++) {
			rule = o.custom[i];
			if (rule instanceof RegExp) {
				if (!rule.test(pw))
					return false;
			} else if (rule instanceof Function) {
				if (!rule(pw))
					return false;
			}
		}
	
		// great success!
		return true;
}