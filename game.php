<script>
  //variables needed


  //array that holds the two poulia
  var poulia = ["./Images/black_piece.png", "./Images/white_piece.png"];
  //array that holds the beatean poulia
  var p_poulia = [];
  //array that holds the black dices
  var b_dice = ["./Images/bdice_one.png", "./Images/bdice_two.png", "./Images/bdice_three.png", "./Images/bdice_four.png", "./Images/bdice_five.png", "./Images/bdice_six.png"];
  //array that holds the white dices
  var w_dice = ["./Images/wdice_one.png", "./Images/wdice_two.png", "./Images/wdice_three.png", "./Images/wdice_four.png", "./Images/wdice_five.png", "./Images/wdice_six.png"];

  //function that generates a random card for the given player
  
</script>

<?php
 

 ?>

<!-- User Interface -->

<!--Board Image -->
<div class="d-flex justify-content-center" >
  <img src="./Images/tavli_board.png" class="img-fluid" width="500"> 


</div>

<br> <br>

<div class="d-flex justify-content-center"  >
  <div class="btn-group  btn-block col-md-4 ">
    <button onclick="draw()" type="button" id="draw" class="btn btn-danger ">Draw</button>
    <button onclick="ucheck()" type="button" id="check" class="btn btn-danger">Check</button>
  </div>
</div>

<br> <br>
<!-- Exit Button -->
<div class="d-flex justify-content-right ">
  <div class="btn-group  btn-block col-md-4" >
    <a href="index.php?ctd=show_main" type="button" id="exit" class="btn btn-danger btn-block col-md-1" >Exit</a>
  </div>
</div>
