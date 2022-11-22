
function success() {

    let btn = document.getElementById('verbutton');

    if (document.getElementById('verific').value === "") {
       
        document.getElementById('verbutton').disabled = true;
        document.getElementById("verbutton").style.background = "gray";
       

    } else {

    
        document.getElementById('verbutton').disabled = false;
        document.getElementById("verbutton").style.background = "green";
        btn.addEventListener('mouseenter', () => {
            document.getElementById("verbutton").style.background = "rgb(29, 173, 29)";
        })
        btn.addEventListener('mouseleave', () => {
            document.getElementById("verbutton").style.background = "green";
        })
    }
}
//-----------------------------Error Handlers--------------------------------------------


$(document).ready(function() {
    if (window.location.href.indexOf("error=VerificationCodeNotMatch") > -1) {

        document.getElementById("vererror").innerHTML = "<strong>Verification</strong> code is incorrect";
        document.getElementById("vererror").style.display = "none";
        document.getElementById("vererror").style.color = "#B50909"
        $("#vererror").fadeIn();
        $("#vererror").fadeOut(2600);

    }
});




