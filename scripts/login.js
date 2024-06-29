function validateForm() {
  console.log("validateForm function called"); // Check if the function is being called
  var email = document.forms["loginForm"]["email"].value;
  var password = document.forms["loginForm"]["password"].value;
  var rememberme = document.forms["loginForm"]["remember"].checked;
  if (email === "" || password === "") { // Use === instead of =
      alert("Email or Password must be filled out");
      document.forms["loginForm"]['remember'].checked = false; // Use ['remember'] instead of ['rememberme']
      return false;
  } else { // Add else block here
      alert("Login Successful and Credentials Saved"); 
      setCookies("email", email, 0);
      setCookies("password", password, 0);
      setCookies("rememberme", rememberme ? "true" : "false", 0);

  }
}


function setCookies(cookiename,cookiedata,exdays){
    console.log("setCookies function called"); // Check if the function is being called
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cookiename + "=" + cookiedata + ";" + expires + ";path=/";
}

function loadCookies(){
    console.log("loadCookies function called"); // Check if the function is being called
    var email = getCookie("email");
    var password = getCookie("password");
    var rememberme = getCookie("rememberme");
    if (email != "" && password != "") {
      document.getElementById("email").value = email;
      document.getElementById("password").value = password;
      document.getElementById("remember").checked = rememberme;
      document.forms["loginForm"]["email"].value = email;
      document.forms["loginForm"]["password"].value = password;
    }
}

function getCookie(cookiename){
    console.log("getCookie function called"); // Check if the function is being called
    var name = cookiename + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
}


