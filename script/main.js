//---------------------------login errorhanlders---------------------------------------------------------
$(document).ready(function() {
    if (window.location.href.indexOf("error=Empty") > -1) {

        document.getElementById("a1").innerHTML = "Please <strong>fill</strong> up <strong>Empty</strong> Fields";
        document.getElementById("a1").style.display = "none";
     
        document.getElementById("a1").style.color = "#B50909"
        
        $("#a1").fadeIn();
        $("#a1").fadeOut(2600);

    }
});
$(document).ready(function() {
    if (window.location.href.indexOf("error=NoUserFound") > -1) {

        document.getElementById("a1").innerHTML = "Wrong <strong>Password</strong> Or <strong>Username</strong>";
        document.getElementById("a1").style.display = "none";
        document.getElementById("a1").style.color = "#B50909"
        $("#a1").fadeIn();
        $("#a1").fadeOut(2600);

    }
});
$(document).ready(function() {
    if (window.location.href.indexOf("error=WrongPassword") > -1) {

        document.getElementById("a1").innerHTML = "Wrong <strong>Password</strong> Or <strong>Username</strong>";
        document.getElementById("a1").style.display = "none";
        document.getElementById("a1").style.color = "#B50909"
        $("#a1").fadeIn();
        $("#a1").fadeOut(2600);

    }
});
$(document).ready(function() {
    if (window.location.href.indexOf("error=SQLinjectionattempt") > -1) {

        document.getElementById("a1").innerHTML = "<strong>SQL Injection</strong> Detected! <strong>Self-Destruct in</strong>...";
        document.getElementById("a1").style.display = "none";
        document.getElementById("a1").style.color = "#B50909"

        document.getElementById("countdown").innerHTML = "10";
        document.getElementById("countdown").style.color = "#B50909"
        $("#a1").fadeIn();
        document.getElementById("log-button").classList.add("fa-bounce");
        document.getElementById("loginh").classList.add("fa-bounce");
        document.getElementById("loginp").classList.add("fa-bounce");
        document.getElementById("showbtn").classList.add("fa-beat");
        var counter = 10;
      
        setInterval(function(){
           
            counter--;
            if(counter >= 0)
            { 
                   
                document.getElementById("countdown").innerHTML = counter;
                
            }
            if(counter < 0)
            {   
               
                document.getElementById("quote1").classList.add("fa-spin");
                document.getElementById("blur").classList.add("fa-spin");
                setInterval(function(){
                    window.location.href = "index.php";
                },5000) 
            }

        },1000)

    }
});



//---------------register form error handlers-------------------------------
$(document).ready(function() {
    if (window.location.href.indexOf("error=regUsernameEmailTaken") > -1) {   
        window.onload = function() {
            showregCon2();
        }
        document.getElementById("a2").innerHTML = "<strong>Username</strong> Already Taken";
        $("#a2").fadeIn();
        $("#a2").fadeOut(2600);

    }
});

$(document).ready(function() {
    if (window.location.href.indexOf("error=regEmpty") > -1) {   

        window.onload = function() {
            showregCon2();
        }
        document.getElementById("a2").innerHTML = "Please <strong>fill</strong> up <strong>Empty</strong> Fields";
        $("#a2").fadeIn();
        $("#a2").fadeOut(2600);
    }
});
$(document).ready(function() {
    if (window.location.href.indexOf("error=regUnmatchedPassword") > -1) {   

        window.onload = function() {
            showregCon2();
        }
        document.getElementById("a2").innerHTML = "<strong>Password</strong> Do not <strong>match</strong>";
        $("#a2").fadeIn();
        $("#a2").fadeOut(2600);
    }
});

$(document).ready(function() {
    if (window.location.href.indexOf("error=regEmailTaken") > -1) {   

        window.onload = function() {
            showregCon2();
        }
        document.getElementById("a2").innerHTML = "<strong>Email</strong> Already <strong>Taken</strong>";
        $("#a2").fadeIn();
        $("#a2").fadeOut(2600);
    }
});
$(document).ready(function() {
    if (window.location.href.indexOf("error=regInvalidUsername") > -1) {   

        window.onload = function() {
            showregCon2();
        }
        document.getElementById("a2").innerHTML = "<strong>Invalid</strong> Username format";
        $("#a2").fadeIn();
        $("#a2").fadeOut(2600);
    }
});
$(document).ready(function() {
    if (window.location.href.indexOf("error=regInvalidEmail") > -1) {   

        window.onload = function() {
            showregCon2();
        }
        document.getElementById("a2").innerHTML = "<strong>Invalid</strong> email format ";
        $("#a2").fadeIn();
        $("#a2").fadeOut(2600);
    }
});
$(document).ready(function() {
    if (window.location.href.indexOf("error=passwordStrengthValidation") > -1) {   

        window.onload = function() {
            showregCon2();
        }
        document.getElementById("a2").innerHTML = "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character. ";
        $("#a2").fadeIn();
        $("#a2").fadeOut(15000);
    }
});



var ignoreClickOnMeElement = document.getElementById('signupCon');

document.addEventListener('click', function(event) {
    var isClickInsideElement = ignoreClickOnMeElement.contains(event.target);
    if (!isClickInsideElement) {
        window.location.href = "index.php";
    }
});

















//-----------------------------------Functions----------------------------------------------------
function autoRefresh() {
    window.location = window.location.href;
}
function showregCon()
{
    document.getElementById("showbtn").style.pointerEvents="none";
    document.getElementById("showbtn").style.background = "#e49a56";
    setTimeout(function() {
        toggle();
        document.getElementById("signupCon").style.display = "block";
    }, 1500); 
}
function showregCon2()
{
    document.getElementById("showbtn").style.pointerEvents="none";
    document.getElementById("showbtn").style.background = "#e49a56";
    setTimeout(function() {
        toggle();
        document.getElementById("signupCon").style.display = "block";
    }, 0);
  
}
function exitregCon()
{
    
    document.getElementById("signupCon").style.display = "none";
    window.location.href = "index.php";
    setInterval('autoRefresh()', 250);
}
function toggle() {
    var blur = document.getElementById("blur");
    blur.classList.toggle("active");
}
   




