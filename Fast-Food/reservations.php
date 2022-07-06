<?php

session_start();

if(!isset($_SESSION["user"])){
  header("Location: login.php");
  exit();
}
else{
  if($_SESSION['user']['role'] == 'admin'){
    header("Location: admin");
    exit();
  }
}

include("scripts/getFillings.php");
include("scripts/getReservations.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UT-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">


  <link rel="stylesheet" href="style.css" type="text/css">
  <title>Document</title>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php">Fast-Food</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a  class="nav-link dropdown-toggle" href="#" id="burgersDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Burgers <span class="sr-only">(current)</span></a>
        <div class="dropdown-menu" aria-labelledby="burgersDropdown">
          <?php 
            foreach($categories["burgers"] as $option) { 
          ?>
            <a class="dropdown-item" href="complete-filling.php?category=burger&selection=<?php echo $option ?>"><?php echo ucfirst($option) ?></a>
          <?php
            }
          ?>
        </div>
      </li>
      <li class="nav-item">
        <a  class="nav-link dropdown-toggle" href="#" id="pizzaDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pizza</a>
        <div class="dropdown-menu" aria-labelledby="pizzaDropdown">
          <?php 
            foreach($categories["pizzas"] as $option) { 
          ?>
            <a class="dropdown-item" href="complete-filling.php?category=pizza&selection=<?php echo $option ?>"><?php echo ucfirst($option) ?></a>
          <?php
            }
          ?>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="kebabDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Kebab
        </a>
        <div class="dropdown-menu" aria-labelledby="kebabDropdown">
          <?php 
            foreach($categories["kebabs"] as $option) { 
          ?>
            <a class="dropdown-item" href="complete-filling.php?category=kebab&selection=<?php echo $option ?>"><?php echo ucfirst($option) ?></a>
          <?php
            }
          ?>
        </div>
      </li>
    </ul>
      <a href="reservations.php" class="btn btn-primary my-2 mx-2 my-sm-0" type="submit">Your Reservations</a>
      <a href="scripts/logoutHandler.php" class="btn btn-danger my-2 my-sm-0" type="submit">Logout</a>
  </div>
</nav>
<div class="container py-3">

<?php include("scripts/_message.php") ?>

<!-- ADD the user who has made the reservation next time -->

<?php if(count($reservations["burger_reservations"]) > 0) { ?>
    <h3>Burgers</h3>
  <table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Cheese</th>
        <th scope="col">Bread</th>
        <th scope="col">With Salad</th>
        <th scope="col">Delivery</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php $i = 0; ?>
      <?php foreach($reservations["burger_reservations"] as $r){ ?>
        <?php $i++; ?>
        <tr>
          <td><?php echo $i ?></td>
          <td><?php echo ucwords(str_replace("-", " ", $r["cheese"])) ?></td>
          <td><?php echo ucwords(str_replace("-", " ", $r["bread"])) ?></td>
          <td><?php echo ($r["incSalad"] == 0 ? "No" : "Yes") ?></td>
          <td><?php echo ($r["delivery"] == 0 ? "No" : "Yes") ?></td>
          <td>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editBurgerModal" data-delivery="<?php echo $r["delivery"] ?>" data-inc-salad="<?php echo $r["incSalad"] ?>" data-bread="<?php echo $r["bread"] ?>" data-cheese="<?php echo $r["cheese"] ?>" data-reservation="burger" data-id="<?php echo $r["id"] ?>">Edit</button>
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" data-reservation="burger" data-id="<?php echo  $r["id"] ?>">Delete</button>


          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
<?php } ?>

<?php if(count($reservations["pizza_reservations"]) > 0) { ?>
  <h3>Pizzas</h3>
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Cheese</th>
      <th scope="col">Crust</th>
      <th scope="col">Delivery</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php $i = 0; ?>
    <?php foreach($reservations["pizza_reservations"] as $r){ ?>
      <?php $i++; ?>
      <tr>
        <td><?php echo $i ?></td>
        <td><?php echo ucwords(str_replace("-", " ", $r["cheese"])) ?></td>
        <td><?php echo ucwords(str_replace("-", " ", $r["crust"])) ?></td>
        <td><?php echo ($r["delivery"] == 0 ? "No" : "Yes") ?></td>
        <td>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editPizzaModal" data-crust="<?php echo $r["crust"] ?>" data-delivery="<?php echo $r["delivery"] ?>" data-cheese="<?php echo $r["cheese"] ?>" data-reservation="pizza" data-id="<?php echo $r["id"] ?>">Edit</button>
          <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" data-reservation="pizza" data-id="<?php echo $r["id"] ?>">Delete</button>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>
<?php } ?>
<?php if(count($reservations["kebab_reservations"]) > 0) { ?>
  <h3>Kebab</h3>
  <table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Rice</th>
        <th scope="col">Cuscus</th>
        <th scope="col">Colcow</th>
        <th scope="col">Shepherd Salad</th>
        <th scope="col">Delivery</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php $i = 0; ?>
      <?php foreach($reservations["kebab_reservations"] as $r){ ?>
        <?php $i++; ?>
        <tr>
          <td><?php echo $i ?></td>
          <td><?php echo ($r["incCuscus"] == 0 ? "No" : "Yes") ?></td>
          <td><?php echo ($r["incRice"] == 0 ? "No" : "Yes") ?></td>
          <td><?php echo ($r["incCoslow"] == 0 ? "No" : "Yes") ?></td>
          <td><?php echo ($r["incSalad"] == 0 ? "No" : "Yes") ?></td>
          <td><?php echo ($r["delivery"] == 0 ? "No" : "Yes") ?></td>
          <td>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editKebabModal" data-inc-salad="<?php echo $r["incSalad"] ?>" data-inc-coslow="<?php echo $r["incCoslow"] ?>" data-inc-rice="<?php echo $r["incRice"] ?>" data-inc-cuscus="<?php echo $r["incCuscus"] ?>" data-delivery="<?php echo $r["delivery"] ?>" data-reservation="kebab" data-id="<?php echo $r["id"] ?>">Edit</button>
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" data-reservation="kebab" data-id="<?php echo  $r["id"] ?>">Delete</button>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
<?php } ?>
</div>


<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Note</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Are you sure? The reservation will be gone forever.</p>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <form action="scripts/deleteReservationHandler.php" method="POST">
          <input type="hidden" name="id" class="reservation-id">
          <input type="hidden" name="category" class="reservation-category">
          <button type="submit" name="delete-reservation" class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="editPizzaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Note</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form action="scripts/editReservationHandler.php" method="POST">

      <div class="modal-body">
        
          <div class="form-group col-md-4">
            <label for="cheese">Cheese</label>
            <select id="cheese" name="cheese" class="form-control" required>
              <option value="no-cheese">No Cheese</option>
              <option value="mozzarella">Mozzarella</option>
              <option value="cheddar">Cheddar</option>
              <option value="philadelphia">Philadelphia</option>
            </select>
          </div>
            <div class="form-group col-md-4">
            <label for="crust">Crust</label>
            <select id="crust" name="crust" class="form-control">
              <option value="thin">Thin Crust</option>
              <option value="thick">Thick Crust</option>
            </select>
          </div>
          <fieldset class="form-group">
          <div class="row">
            <legend class="col-form-label col-sm-2 pt-0">Delivery</legend>
            <div class="col-sm-10">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="delivery" id="gridRadios1" value="1" checked>
                <label class="form-check-label" for="gridRadios1">
                  Yes
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="delivery" id="gridRadios2" value="0">
                <label class="form-check-label" for="gridRadios2">
                  No
                </label>
              </div>
            </div>
          </div>
        </fieldset>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <input type="hidden" name="id" class="reservation-id">
          <input type="hidden" name="category" class="reservation-category">
          <button type="submit" name="edit-pizza-reservation" class="btn btn-primary">Save</button>
      </div>
        </form>

    </div>
  </div>
</div>



<div class="modal fade" id="editBurgerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Note</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form action="scripts/editReservationHandler.php" method="POST">

      <div class="modal-body">
        
    <div class="form-group col-md-4">
        <label for="cheese">Cheese</label>
        <select id="cheese" name="cheese" class="form-control" required>
          <option value="no-cheese">No Cheese</option>  
          <option value="mozzarella">Mozzarella</option>
          <option value="cheddar">Cheddar</option>
          <option value="philadelphia">Philadelphia</option>
        </select>
      </div>
        <div class="form-group col-md-4">
        <label for="bread">Bread</label>
        <select id="bread" name="bread" class="form-control" required>
          <option value="ciabatta"> Ciabatta</option>
          <option value="english muffin">English Muffin</option>
        </select>
      </div>
      <div class="form-check">
        <input type="checkbox" class="form-check-input" name="includeSalad" id="includeSalad" >
        <label class="form-check-label" for="includeSalad" >Include Salad?</label>
      </div>
      <fieldset class="form-group">
      <div class="row">
        <legend class="col-form-label col-sm-2 pt-0">Delivery</legend>
        <div class="col-sm-10">
          <div class="form-check">
            <input class="form-check-input" type="radio" name="delivery" id="delivery1" value="1" checked>
            <label class="form-check-label" for="delivery1">
              Yes
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="delivery" id="delivery2" value="0">
            <label class="form-check-label" for="delivery2">
              No
            </label>
          </div>
        </div>
      </div>
    </fieldset>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <input type="hidden" name="id" class="reservation-id">
          <input type="hidden" name="category" class="reservation-category">
          <button type="submit" name="edit-burger-reservation" class="btn btn-primary">Save</button>
      </div>
        </form>

    </div>
  </div>
</div>




<div class="modal fade" id="editKebabModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Note</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form action="scripts/editReservationHandler.php" method="POST">

      <div class="modal-body">
        
    <div class="form-check">
        <input type="checkbox" class="form-check-input" name="includeRice" id="includeSalad">
        <label class="form-check-label" for="includeRice" >Rice</label>
      </div>
      <div class="form-check">
        <input type="checkbox" class="form-check-input" name="includeCuscus" id="includeCuscus">
        <label class="form-check-label" for="includeCuscus" >cuscus</label>
      </div>
      <div class="form-check">
        <input type="checkbox" class="form-check-input" name="includeCoslow" id="includeCoslow">
        <label class="form-check-label" for="includeCoslow" >coslow</label>
      </div>
      <div class="form-check">
        <input type="checkbox" class="form-check-input" name="includeShepherdSalad" id="includeShepherdSalad">
        <label class="form-check-label" for="includeShepherdSalad" >shepherd salad</label>
      </div>
      <fieldset class="form-group">
      <div class="row">
        <legend class="col-form-label col-sm-2 pt-0">Delivery</legend>
        <div class="col-sm-10">
          <div class="form-check">
            <input class="form-check-input" type="radio" name="delivery" id="gridRadios1" value="1" checked>
            <label class="form-check-label" for="gridRadios1">
              Yes
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="delivery" id="gridRadios2" value="0">
            <label class="form-check-label" for="gridRadios2">
              No
            </label>
          </div>
        </div>
      </div>
    </fieldset>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <input type="hidden" name="id" class="reservation-id">
          <input type="hidden" name="category" class="reservation-category">
          <button type="submit" name="edit-kebab-reservation" class="btn btn-primary">Save</button>
      </div>
        </form>

    </div>
  </div>
</div>


  </body>
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // ** DELETE window **
  // deletion confirmation modal
  $('#deleteModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var id = button.data('id')
    var reservation = button.data('reservation')
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this)
    modal.find('.reservation-id').val(id)
    modal.find('.reservation-category').val(reservation)
  })

  // ** EDIT windows **
  // opens the edit modal for this pizza reservation
  $('#editPizzaModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var id = button.data('id')
    var reservation = button.data('reservation')
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this)
    modal.find('.reservation-id').val(id)
    modal.find('.reservation-category').val(reservation)
  })

  // opens the edit modal for this burger reservation
  $('#editBurgerModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var id = button.data('id')
    var reservation = button.data('reservation')
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this)
    modal.find('.reservation-id').val(id)
    modal.find('.reservation-category').val(reservation)
  })

  // opens the edit modal for this kebak reservation
  $('#editKebabModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var id = button.data('id')
    var reservation = button.data('reservation')
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this)
    modal.find('.reservation-id').val(id)
    modal.find('.reservation-category').val(reservation)
  })
</script>
</html>

