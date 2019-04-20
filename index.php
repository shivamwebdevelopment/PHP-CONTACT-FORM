<?php 
$msg = '';
$msgClass = '';

if(filter_has_var(INPUT_POST, 'submit')){
  $name= htmlspecialchars($_POST['name']);
  $email= htmlspecialchars($_POST['email']);
  $message= htmlspecialchars($_POST['message']);

  if(!empty($email) && !empty($name) && !empty($message)){
  // Passed 
  if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
    $msg = 'Please use a valid email';
    $msgClass = 'alert-danger';
  }else{
    // passed 
      $toEmail = 'shivam@gmail.com';
      $subject = 'Contact Request From '.$name;
      $body = '<h2>Contact Request</h2>
               <h4>Name</h4><p>'.$name.'</p>
               <h4>Email</h4><p>'.$email.'<p>
               <h4>Message</h4><p>'.$message.'</p>
       ';

      //  Email Headers 
      $headers = "MIME-Version: 1.0" ."\r\n";
      $headers .= "Content-Type:text/html;charset=UTF-8" ."\r\n";

      // Additional Headers 
      $headers .= "From: " .$name. "<".$email.">". "\r\n";

      if(mail($toEmail, $subject, $body, $headers)){
       $msg = 'Your email has been sent';
       $msgClass = 'alert-danger';
      }else{
         $msg = 'Your email has been not sent';
         $msgClass ='alert-danger';
      }

  };
  }else{
  // fail
  $msg = 'Please fill in all fields';
  $msgClass = 'alert-danger';
  };
};
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://bootswatch.com/4/cosmo/bootstrap.min.css">
  <title>Document</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor01">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Features</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Pricing</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">About</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="text" placeholder="Search">
      <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>
<!-- Form -->
<div class="container my-5">
   <?php if($msg != ''): ?>
<div class="alert <?php echo $msgClass; ?>"><?php echo $msg; ?></div>
<?php endif; ?>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <div class="form-group">
      <label>Name</label>
      <input type="text" name="name" class="form-control" value="<?php echo isset($_POST['name']) ? $name : ''; ?>">
    </div>
    <div class="form-group">
      <label>Email</label>
      <input type="email" name="email" class="form-control" value="<?php echo isset($_POST['email']) ? $email : ''; ?>">
    </div>
    <div class="form-group">
      <label>Message</label>
      <textarea name="message" class="form-control"><?php echo isset($_POST['message']) ? $message : ''; ?></textarea> <br>
      <button class="btn btn-primary" type="submit" name="submit">Submit</button>
    </div>
  </form>
</div>
</body>
</html>