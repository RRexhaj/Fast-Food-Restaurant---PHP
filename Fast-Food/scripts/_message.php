<?php if(isset($_SESSION["message"])){ ?>
        <div class="alert alert-success" role="alert">
          <?php  
            echo $_SESSION["message"];
            unset($_SESSION["message"]);
          ?>
        </div>
      <?php } ?>