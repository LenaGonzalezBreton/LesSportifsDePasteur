<?php     session_start(); ?>
<html>
    <head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-neutral-900">
<?php
include("config/database.php");
if (isset($_SESSION["error"])){
  ?>
  <div class="alert alert-danger" role="alert">
    <?php 
      echo $_SESSION["error"];
      unset($_SESSION["error"]);
    ?>
  </div>

  <?php
}
if (isset($_SESSION["success"])){
    ?>
    <div class="alert alert-success" role="alert">
      <?php 
        echo $_SESSION["success"];
        unset($_SESSION["success"]);
      ?>
    </div>
    <?php
  }
  if(isset($_GET["route"])){
    if($_GET["route"]!="login"){
      include("common/header.php");
    }
  }

  ?>
<div class="container">
  <div class="row">
    <div class="col center">
      <?php
      
    if(isset($_GET["route"])){
               
          switch ($_GET["route"]){
            case "login":
              include("page/auth/login.php");
              break;
            case "store":
            include("page/auth/store.php");
              break;  
            case "logout":
                include("page/auth/logout.php");
                break;                        
            case "welcome":
                include("page/welcome.php");
                break;
            case "mdpoublie":
                include("page/auth/mdpoublie.php");
                break;   
            case "modifprofil":
                include("page/profil/modifprofil.php");
                break;
            case "update_id":
             
                include("page/profil/update_id.php");
                break;  
            case 'addSport':
                include("page/sport/addSport.php");
                break;
            case 'insertSport':
                include("page/sport/insertSport.php");
                break;
            case 'addSeance':
                include("page/seance/addSeance.php");
                break;
            case "insertSeance":
                include("page/seance/insertSeance.php");
                break;
            default : 
            if(isset($_SESSION["login"])){
              echo "ERROR";
            }else{
              include("page/auth/login.php");
            }
          }
        }
        else{
            if(isset($_SESSION["login"])){
              echo "ERROR";
            }else{
              include("page/auth/login.php");
            }
          }
        ?>
    </div>
  </div>
</div>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</body>
</html> 


