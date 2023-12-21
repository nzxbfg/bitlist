<?php 
   session_start();
   if(!empty($_SESSION["login"])) :
   else: header('Location: functions/login.php');
   endif;
   
   require_once 'functions/connect.php';
   $new = $pdo -> prepare("SELECT * FROM `admin`");
   $new -> execute();
   $base = $new->fetchAll(PDO::FETCH_OBJ);
   ?> 
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Admin - <?php echo $_SESSION["login"];?></title>
      <link rel="shortcut icon" href="../images/favicons/favicon.ico"/>
      <link rel="apple-touch-icon" sizes="180x180" href="../images/favicons/apple-touch-icon.png">
      <link rel="icon" type="image/png" sizes="32x32" href="../images/favicons/favicon-32x32.png">
      <link rel="icon" type="image/png" sizes="16x16" href="../images/favicons/favicon-16x16.png">
      <link rel="stylesheet" href="../css/main.css">
   </head>
   <body class="panel-body">
      <header class="header-panel">
         <a href="../" class="">
            <h2><?php echo $_SESSION["login"];?></h2>
         </a>
         <a href="functions/logout.php">Logout</a>
      </header>
      <div class="coin-title">
         <h2>Сoin list</h2>
      </div>
      <div class="coins-back">
         <div class="coins">
            <?php 
               $all = $pdo -> prepare("SELECT * FROM `coins`");
               $all -> execute();
               while($coins = $all->fetch(PDO::FETCH_OBJ)):?>
            <table class="coin-list">
               <tbody class="tbody-add">
                  <form action="functions/items.php" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="id" value="<?php echo $coins->id?>">
                     <tr class="table-coin-add">
                        <td>
                           <span>
                              <img src="../images/icons/<?php echo $coins->icon?>">
                              <input type="file" name="icon" id="icon" value="<?php echo $coins->icon?>">
                           </span>
                           <span>
                              <label for="full_name">Full name:</label>
                              <input class="modal-input coin-name-input" type="text" name="full_name" id="full_name" value="<?php echo $coins->full_name?>">
                           </span>
                           <span>
                              <label for="short_name">Short name:</label>
                              <input class="modal-input coin-name-input" type="text" name="short_name" id="short_name" value="<?php echo $coins->short_name?>">
                           </span>
                           <span>
                              <button class="button-light" name="save">Save</button>
                              <button class="button-dark" name="delete">Delete</button>
                           </span>
                        </td>
                     </tr>
                  </form>
               </tbody>
            </table>
            <?php endwhile?>
            <button class="button-dark button-table js-open-modal" data-modal="add-new">Add new</button>
         </div>
      </div>

      <div class="coin-title">
         <h2>Users</h2>
      </div>
      <div class="coins-back">
         <div class="coins">
            <?php 
               $usr = $pdo -> prepare("SELECT * FROM `user`");
               $usr -> execute();
               while($user = $usr->fetch(PDO::FETCH_OBJ)):?>
            <table class="coin-list">
               <tbody class="tbody-add">
                  <form action="functions/delete_user.php" method="post" enctype="multipart/form-data">
                     <input type="hidden" name="id" value="<?php echo $user->id?>">
                     <tr class="table-coin-add">
                        <td>
                           <span>
                              ID: <?php echo $user->id?>
                           </span>
                           <span>
                              <label for="user_login">Login:</label>
                              <input type="text" name="user_login" id="user_login" value="<?php echo $user->login?>" readonly>
                           </span>
                           <span>
                              <label for="user_login">Email:</label>
                              <input type="text" name="user_email" id="user_email" value="<?php echo $user->email?>" readonly>
                           </span>
                              <button class="button-dark" type="submit" name="delete">Delete</button>
                           </span>
                        </td>
                     </tr>
                  </form>
               </tbody>
            </table>
            <?php endwhile?>
         </div>
      </div>

      <div class="modal" data-modal="add-new">
         <svg class="modal__cross js-modal-close" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path d="M 4.9902344 3.9902344 A 1.0001 1.0001 0 0 0 4.2929688 5.7070312 L 10.585938 12 L 4.2929688 18.292969 A 1.0001 1.0001 0 1 0 5.7070312 19.707031 L 12 13.414062 L 18.292969 19.707031 A 1.0001 1.0001 0 1 0 19.707031 18.292969 L 13.414062 12 L 19.707031 5.7070312 A 1.0001 1.0001 0 0 0 18.980469 3.9902344 A 1.0001 1.0001 0 0 0 18.292969 4.2929688 L 12 10.585938 L 5.7070312 4.2929688 A 1.0001 1.0001 0 0 0 4.9902344 3.9902344 z"/>
         </svg>
         <form class="modal-body" method="post" action="functions/create.php" enctype="multipart/form-data">
            <h2 class="modal-title">New coin</h2>
            <div class="modal-input login-container">
               <input type="text" name="add_full_name" id="add_full_name" placeholder="full_name" autocomplete="off" required autofocus>
            </div>
            <div class="modal-input pass-container">
               <input type="text" name="add_short_name" id="add_short_name" placeholder="short_name" autocomplete="off" required>
            </div>
            <div class="modal-input pass-container">
               <input class="input_file" type="file" name="add_icon" id="add_icon" placeholder="icon" autocomplete="off" required>
            </div>
            <button class="button-light" type="submit" id="add" name="add">Add</button>
         </form>
      </div>
      <div class="overlay js-overlay-modal"></div>
      <script src="../js/jquery-3.7.1.min.js"></script>
      <script src="../js/app.js"></script>
   </body>
</html>