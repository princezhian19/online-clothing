<?php
session_start();
if (!isset($_SESSION["userid"])) {
    header("Location: index.php");
}
if ($_SESSION["verifiedAt"] !== null) {
    header("Location: customerPage.php");
    exit();
}




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles/verificationstyle.css">
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="script/verification.js"></script>
    <link rel="icon" href="assets/logo.png" type="image/ico">


</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light" id="navbar">
        
        <a class="navbar-brand" href="#">GraphiteeShirt</a>
        <i class="fas fa-tshirt fa-bounce"></i>
        
    </nav>
    <div class="container" id="container">
        <div class="col-md-6">
            <form action="includes/verificationInclude.php" method="POST">
                <h4>Verification</h4>
                <hr>
                <a>Enter the code in the email sent to <strong><?php echo $_SESSION["usermail"] ?></strong> </a>
                <input type=hidden name="email" value="<?php echo $_SESSION["usermail"] ?>">
                <div class="ph" data-placeholder="GS-">
                    <input class="form-control" type=text name="verificationc" id="verific" onkeyup="success()">
                </div>
                <a id="vererror"><strong>Verification</strong> code incorrect</a>

                <hr>
                <input class="verbutton" type=submit name="submit" id="verbutton" value="Verify" class="verbutton" disabled>
                </from>


        </div>
    </div>

</body>

</html>


    <script src=
"https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js">
    </script>
  
    <!-- Including Bootstrap JS -->
    <script src=
"https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js">
    </script>
    <script>
        "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-growl/1.0.0/jquery.bootstrap-growl.min.js"
    </script>

