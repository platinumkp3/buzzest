/*** Script from http://coursesweb.net/ajax ***/

// gets data from the form and sumbit it
function uploadimg(theform){
 	if ( $('#myfile').val() != "")
	{
		theform.submit();
		// calls the function to display Status loading
		setStatus("", "showimg");
	}
	else 
	{
		alert ("Please choose a file to upload");
	}
	 return false;
}

// this function is called from the iframe when the php return the result
function doneloading(rezultat) {
  // decode (urldecode) the parameter wich is encoded in PHP with 'urlencode'
  //rezultat = decodeURIComponent(rezultat.replace(/\+/g,  " "));
	
  
  // add the value of the parameter inside tag with 'id=showimg'
 // document.getElementById('showimg').innerHTML = rezultat;
}

// displays status loading
function setStatus(theStatus, theloc) {
	alert ("Uploaded Successfully!!!");
  var tag = document.getElementById(theloc);

  // if there is "tag"
  if (tag) {
    // adds 'theStatus' inside it
    tag.innerHTML = '<b>'+ theStatus + "</b>";
		
  }
  $('#gallery').load('gallery.php');
  $('#upphoto').load('profile.php #upphoto');
}
