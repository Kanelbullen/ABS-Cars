let bool = false;

function passError() {
   const error = document.getElementById("error");
   error.style.display = "block";
}
function errorEmail(){
   const error = document.getElementById("errorEmail");
   error.style.display = "block";
}
function errorUsername(){
   const error = document.getElementById("errorUsername");
   error.style.display = "block";
}
function passMatchError(){
   const error = document.getElementById("passMatchError");
   error.style.display = "block";
}
function showPassword() {   
   var x = document.getElementById("password");
   var y = document.getElementById("password1");

   if (x.type == "password" || y.type == 'password') {
     x.type = "text";
     y.type = "text";
   } else { 
     x.type = "password";
     y.type = "password";
   }
}
function showPass() {   
   var x = document.getElementById("password");

   if (x.type == "password") {
     x.type = "text";
   } else { 
     x.type = "password";
   }
}

function edit_profile(){
   const profile_img = document.getElementById("profile_img");
   profile_img.style.display = "none";
   const edit_pro_img = document.getElementById("edit_profile_img");
   edit_pro_img.style.display = "inline";
}

function image_click(){
   const file = document.getElementById("file");
   const img_sub = document.getElementById("img_sub");
   file.click();
}