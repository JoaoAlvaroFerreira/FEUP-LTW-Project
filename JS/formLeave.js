

var containerreg = document.getElementById('register');
var containerlog = document.getElementById('login');     
var containereditprofile = document.getElementById('editprofile');
var containerdelpost = document.getElementById('deletePost');
var containerdelcomment = document.getElementById('deleteComment'); 


window.onclick = function(event) {
    
    if (event.target == containerreg || event.target == containerlog) {
        containerreg.style.display = "none";
        containerlog.style.display = "none";
        
    }
    
    if (event.target == containereditprofile) {
      
        containereditprofile.style.display = "none";
        
    }
    
     else if(event.target == containerdelpost || event.target == containerdelcomment){
      containerdelpost.style.display = "none";
        containerdelcomment.style.display = "none";
    }
    
}

