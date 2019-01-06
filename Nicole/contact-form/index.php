<?php

    // Message Vars
$msg = '';
$msgClass = '';

    // CHECK FOR SUBMIT

    if(filter_has_var(INPUT_POST, 'submit')){
        // Get Form Data
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $message = htmlspecialchars($_POST['message']);

        // Check required fields
        if(!empty($email) && !empty($name) && !empty($message)){
            // Passed
            // Check Email
            if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
            //Failed
            $msg = 'Please use a valid email';
            $msgClass = 'alert-danger';
            } else {
                // Passed
                // Recipient Email
                $toEmail = 'nicostar26@yahoo.com';
                $subject = 'Contact Request From '.$name;
                $body = '<h2>Contact Request</h2>
                <h4>Name</h4><p> '.$name.'</p>
                <h4>Email</h4><p> '.$email.'</p>
                <h4>Message</h4><p> '.$message.'</p>
                ';

                // Email Header
                $headers = "MIME-Version: 1.0" ."\r\n";
                $headers .="Content-Type:text/html;charset=UTF-8" . "\r\n";

                //Additional Headers
                $headers .= "From: " .$name. "<".$email.">". "\r\n";

                if(mail($toEmail, $subject, $body, $headers)){
                    $msg = 'Your mail has been sent';
                    $msgClass= "alert-success";
                }else{
                    $msg = 'Your mail was not sent';
                    $msgClass="alert-danger";
                }
            }
        }else{
            // Failed
            $msg = 'Please fill in all fields';
            $msgClass = 'alert-danger';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
    <title>Contact Form</title>
</head>
<body>

<nav class="navbar navbar-default">
<div class="container">
    <div class="navbar-header">
        <a href="index.php" class="navbar-brand">My Website</a>
    </div>
</div>
</nav>

<div class="container">
    <?php if($msg != ''): ?>
        <div class="alert <?php echo $msgClass; ?>"><?php echo $msg; ?></div>
    <?php endif; ?>
    <form action="<? echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="<?php echo isset($_POST['name']) ? $name : ''; ?> ">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="text" name="email" class="form-control" value="<?php echo isset($_POST['email']) ? $email : ''; ?>">
        </div>
        <div class="form-group">
            <label>Message</label>
            <textarea name="message" class="form-control"><?php echo isset($_POST['message']) ? $message : ''; ?></textarea>
        </div>
        <br>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</div>



</form>
</div>










<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>