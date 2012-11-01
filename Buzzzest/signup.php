<html>
<head>
<link href="css/home.css" type="text/css" rel="stylesheet" />
<link href="css/form.css" rel="stylesheet"  type="text/css" >
<script src="js/jquery-1.8.2.js" type="application/javascript" >
</script>
<script src="js/signup.js" type="application/javascript" >
</script>

<!-- ==============================================
		 JavaScript below! 															-->

<!-- jQuery via Google + local fallback, see h5bp.com -->
<script src="js/jquery-1.7.1.min.js"></script>

<!-- Validate plugin -->
<script src="js/jquery.validate.min.js"></script>
    
<!-- Scripts specific to this page -->
<script src="js/script.js"></script>


<script type="application/javascript" >
$(document).ready(function() {
   $('#div2').hide("");	
   $('#div3').hide("");	
   $("#div2").css({"dispaly":"none"});
   $("#div3").css({"dispaly":"none"});     
 });
 
 function fnselchange()
 {	 
 	 var a=document.getElementById("account").value;
	 $("#div1").css("display","none");
	 $("#div2").css("display","none");
	 $("#div3").css("display","none");
	 $("#div"+a).css("display","block");
 }
</script>
</head>
  <body>
  
  <div style="float:right"><a href="index.php" >Home</a> </div>
Buzzzest <br />
Lets Buzz & Zest Your World 

</div>
<br />
    <div class="page-header">	 
			  
		    </div>
            <br />
            
				<div class="row">
				<div class="span8">
					<form action="saveaccount.php" method="post" id="contact-form" class="form-horizontal">
					  <fieldset>
                       <div class="control-group">
					      <label class="control-label" for="name">Account</label>
                      <div class="controls">
                        <select name="account" id="account" onChange="fnselchange()" >
                            <option value="1" >Individual</option>
                            <option value="2" >Organization</option>    
                            <option value="3" >Groups</option>    
        				</select>
                      </div>
                      </div>
                      
                      <div id="div1">
					    <div class="control-group">
					      <label class="control-label" for="name">Full Name</label>
					      <div class="controls">
					        <input type="text" class="input-xlarge" name="fullname" id="fullname">
					      </div>
					    </div>
                        
                         <div class="control-group">
					      <label class="control-label" for="name">Username</label>
					      <div class="controls">
					        <input type="text" class="input-xlarge" name="username" id="username">
					      </div>
					    </div>
					    <div class="control-group">
					      <label class="control-label" for="email">Email Address</label>
					      <div class="controls">
					        <input type="email" class="input-xlarge" name="email" id="email">
					      </div>
					    </div>
					    <div class="control-group">
					      <label class="control-label" for="subject">Password</label>
					      <div class="controls">
					        <input type="password" class="input-xlarge" name="password" id="password">
					      </div>
					    </div>
                       
                         <div class="control-group">
					      <label class="control-label" for="subject">Gender</label>
					      <div class="controls">
                              <select name="gender" id="gender" > 
                                <option value="" >Select</option>
                                <option value="1" >Male</option>
                                <option value="2" >Female</option>    
                             </select>
					      </div>                          
					    </div>
                        
                        <div class="control-group">
					      <label class="control-label" for="subject">  Date of Birth</label>
					      <div class="controls">
                              <select name="bird"  >
                                <option value="">dd</option>
                                    <?php
                                        for($i=1;$i<=31;$i++)
                                        {
                                            echo "<option value='".$i."'>".$i."</option>";
                                        }						
                                        ?>
                                </select>/
                                <select  name="birm">
                                <option value="">mm</option>
                                    <?php
                                        for($i=1;$i<=12;$i++)
                                        {
                                            echo "<option value='".$i."'>".$i."</option>";
                                        }						
                                        ?>
                                </select>/
                                <select  name="biry">
                                <option value="">yyyy</option>
                                        <?php
                                        $year=Date("Y");
                                        $i=$year-50;
                                        for($i=$year-45;$i<=($year-10);$i++)
                                        {
                                            echo "<option value='".$i."'>".$i."</option>";
                                        }						
                                        ?>
                                </select>
					      </div>                          
					    </div>
                        
                         <div class="control-group">
					      <label class="control-label" for="subject">Place</label>
					      <div class="controls">
					        <input type="text" class="input-xlarge" name="place" id="place">
					      </div>
					    </div>
                        
                         <div class="control-group">
					      <label class="control-label" for="subject">Interests</label>
					      <div class="controls">
					        <input type="text" class="input-xlarge" name="interests" id="interests">
					      </div>
					    </div>
                        
                        <div class="control-group">
					      <label class="control-label" for="subject">Occupation</label>
					      <div class="controls">
					        <input type="text" class="input-xlarge" name="occupation" id="occupation">
					      </div>
					    </div>
                        
                        <div class="control-group">
					      <label class="control-label" for="subject">Industry</label>
					      <div class="controls">
					        <input type="text" class="input-xlarge" name="industry" id="industry">
					      </div>
					    </div>
                        
                         <div class="control-group">
					      <label class="control-label" for="subject">Bio</label>
					      <div class="controls">
					        <textarea class="input-xxxlarge" name="bio" id="bio" rows="3"></textarea>
					      </div>
					    </div>
                        
                         <div class="control-group">
					      <label class="control-label" for="subject">Website</label>
					      <div class="controls">
					        <input type="url" class="input-xlarge" name="url" id="url">
					      </div>
					    </div>                        
                              
                         <div class="control-group">
					      <label class="control-label" for="subject">I agree to the terms of Services</label>
					      <div class="controls">
					        <input type="checkbox" class="input-xlarge" name="terms" id="terms" checked="checked">
					      </div>
					    </div>
                     
                        </div> <!-- end of div1-->
                        
                        
                         <!-- div2  -->
                      <div id="div2">
					    <div class="control-group">
					      <label class="control-label" for="name">Name</label>
					      <div class="controls">
					        <input type="text" class="input-xlarge" name="fullnme" id="fullnme">
					      </div>
					    </div>
                        
                          <div class="control-group">
					      <label class="control-label" for="name">Username</label>
					      <div class="controls">
					        <input type="text" class="input-xlarge" name="usrname" id="usrname">
					      </div>
					    </div>
                        
                        
					    <div class="control-group">
					      <label class="control-label" for="email">Email Address</label>
					      <div class="controls">
					        <input type="email" class="input-xlarge" name="email1" id="email1">
					      </div>
					    </div>
					    <div class="control-group">
					      <label class="control-label" for="subject">Password</label>
					      <div class="controls">
					        <input type="password" class="input-xlarge" name="passwrd" id="passwrd">
					      </div>
					    </div>
					    <div class="control-group">
					      <label class="control-label" for="message">Description</label>
					      <div class="controls">
					        <textarea class="input-xxxlarge" name="description" id="description" rows="3"></textarea>
					      </div>
					    </div>
                         <div class="control-group">
					      <label class="control-label" for="subject">Website</label>
					      <div class="controls">
					        <input type="url" class="input-xlarge" name="url1" id="url1">
					      </div>
					    </div>    
                         <div class="control-group">
					      <label class="control-label" for="subject">I agree to the terms of Services</label>
					      <div class="controls">
					        <input type="checkbox" class="input-xlarge" name="terms1" id="terms1" checked="checked">
					      </div>
					    </div>
                     
                        </div><!--end of div2 -->                        
                         
                      <div id="div3">
					    <div class="control-group">
					      <label class="control-label" for="name">Full Name</label>
					      <div class="controls">
					        <input type="text" class="input-xlarge" name="name" id="name">
					      </div>
					    </div>
                        
                        <div class="control-group">
					      <label class="control-label" for="name">Username</label>
					      <div class="controls">
					        <input type="text" class="input-xlarge" name="uname" id="uname">
					      </div>
					    </div>
                        
					    <div class="control-group">
					      <label class="control-label" for="email">Email Address</label>
					      <div class="controls">
					        <input type="email" class="input-xlarge" name="email2" id="email2">
					      </div>
					    </div>
                        
                        <div class="control-group">
					      <label class="control-label" for="subject">Password</label>
					      <div class="controls">
					        <input type="password" class="input-xlarge" name="pssword" id="pssword">
					      </div>
					    </div>
					    <div class="control-group">
					      <label class="control-label" for="subject">Founded</label>
					      <div class="controls"> <input type="text" class="input-xlarge" name="founded" id="founded">
                          </div>
					    </div>
                          <div class="control-group">
					      <label class="control-label" for="subject">Tagline </label>
					      <div class="controls"> <input type="text" class="input-xlarge" name="tagline" id="tagline">
                          </div>
					    </div>
                         <div class="control-group">
					      <label class="control-label" for="subject">Type </label>
					      <div class="controls"> <input type="text" class="input-xlarge" name="type" id="type">
                          </div>
					    </div>
                    
					    <div class="control-group">
					      <label class="control-label" for="message">Mission</label>
					      <div class="controls">
					        <textarea class="input-xxxlarge" name="mission" id="mission" rows="3"></textarea>
					      </div>
					    </div>
                          <div class="control-group">
					      <label class="control-label" for="subject">Industry </label>
					      <div class="controls"> <input type="text" class="input-xlarge" name="indtry" id="indtry">
                          </div>
					    </div>
                         <div class="control-group">
					      <label class="control-label" for="subject">Specialities </label>
					      <div class="controls"> <textarea class="input-xxxlarge" name="specialities" 
                          id="specialities"></textarea>
                          </div>
					    </div>
                           <div class="control-group">
					      <label class="control-label" for="subject">Employee Count </label>
					      <div class="controls"> <input type="text" class="input-xlarge" name="empcount" id="empcount">
                          </div>
					    </div>
                        <div class="control-group">
					      <label class="control-label" for="subject">Location</label>
					      <div class="controls"> <input type="text" class="input-xlarge" name="location" id="location">
                          </div>
					    </div>
                        
                         <div class="control-group">
					      <label class="control-label" for="subject">Website</label>
					      <div class="controls">
					        <input type="url" class="input-xlarge" name="url2" id="url2">
					      </div>
					    </div>    
                         <div class="control-group">
					      <label class="control-label" for="subject">I agree to the terms of Services</label>
					      <div class="controls">
					        <input type="checkbox" class="input-xlarge" name="terms2" id="terms2" checked="checked">
					      </div>
					    </div>
                        
                        </div>
                        
                        
                        
              <div class="form-actions">
		            <button type="submit" class="btn btn-primary btn-large">Submit</button>
    			      <button class="btn">Cancel</button>
        			</div>
					  </fieldset>
					</form>
				</div><!-- .span -->
	
		</div>

  </body>
</html>

