<?php
session_start();
include_once('files/STRINGS.php');
if ( isset($_SESSION['SuperSuperAdmin']) ) {
  header("location:".$WORKPATH."/");
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title></title>
<link href="<?php echo $WORKPATH;?>css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo $WORKPATH;?>css/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo $WORKPATH;?>css/nprogress.css" rel="stylesheet">
<link href="<?php echo $WORKPATH;?>css/custom.min.css" rel="stylesheet">
</head>
<body class="login">
<div>
  <div class="login_wrapper">
    <div class="animate form login_form">
      <section class="login_content">
        <form>
         
          <div class="alert no-display Roboto">
            
          </div>
          <div>
            <input type="text" class="form-control" placeholder="Email" id="Email" required="" />
          </div>
          <div>
            <input type="text" class="form-control" placeholder="Login" id="Login" required="" />
          </div>
          <div>
            <input type="password" class="form-control" placeholder="Mot de Passe" id="Password" required="" />
          </div>
          <div> <a class="btn btn-default submit">Se Connecter</a></div>
          <div class="clearfix"></div>
          <div class="separator">
            <div class="clearfix"></div>
           
          </div>
        </form>
      </section>
    </div>
  </div>
</div>
<script src="<?php echo $WORKPATH;?>js/jquery.min.js"></script>
<script src="<?php echo $WORKPATH;?>js/login.js"></script>
<script>
  HOME = '<?php echo $WORKPATH;?>';
</script>
</body>
</html>
