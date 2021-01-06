<script>
  //variables needed
  var bl_poulia=0;//value used to generate black
  var wh_poulia=0;//value used to generate white

  //array that holds the white poulia
  var wpoulia = ["./Images/white_piece.png", "./Images/white_piece.png", "./Images/white_piece.png", 
  "./Images/white_piece.png", "./Images/white_piece.png", "./Images/white_piece.png", "./Images/white_piece.png",
  "./Images/white_piece.png", "./Images/white_piece.png", "./Images/white_piece.png", "./Images/white_piece.png",
  "./Images/white_piece.png", "./Images/white_piece.png", "./Images/white_piece.png", "./Images/white_piece.png"];
   //array that holds the black poulia
   var bpoulia = ["./Images/black_piece.png", "./Images/black_piece.png", "./Images/black_piece.png", 
  "./Images/black_piece.png", "./Images/black_piece.png", "./Images/black_piece.png", "./Images/black_piece.png", 
  "./Images/black_piece.png", "./Images/black_piece.png", "./Images/black_piece.png", "./Images/black_piece.png", 
  "./Images/black_piece.png", "./Images/black_piece.png", "./Images/black_piece.png", "./Images/black_piece.png"]
  //array that holds the beatean poulia
  var p_poulia = [];
  //array that holds the black dices
  var b_dice = ["./Images/bdice_one.png", "./Images/bdice_two.png", "./Images/bdice_three.png", "./Images/bdice_four.png", "./Images/bdice_five.png", "./Images/bdice_six.png"];
  //array that holds the white dices
  var w_dice = ["./Images/wdice_one.png", "./Images/wdice_two.png", "./Images/wdice_three.png", "./Images/wdice_four.png", "./Images/wdice_five.png", "./Images/wdice_six.png"];


  $(document).ready(function(){
    $("#dices").attr("disabled", "disabled");
    $("#move").attr("disabled", "disabled");
    document.getElementById('dices').disabled = true;
    document.getElementById('move').disabled = true;
    
  });

  //function that generates a random card for the given player
  function display() {
    var img = document.getElementById('./Images/bdice_one.png');
   img.style.visibility = 'visible';
}

function dices() {


}

function move() {


}

function gamestart() {
 

}

</script>

<?php
    if( $stmt = $mysqli->prepare($sql) ) {
      $stmt->bind_param("s", $_SESSION['username']);
      $stmt->execute();
      $result = $stmt->get_result();
      $row = $result->fetch_assoc();
   }

 ?>

<!-- User Interface -->

<!--Board Image -->
<div class="d-flex justify-content-center" >
  <img src="./Images/tavli_board.png" class="img-fluid" width="500"> 
  

</div>

<br> <br>

<div class="d-flex justify-content-center"  >
  <div class="btn-group  btn-block col-md-4 ">
    <button onclick="dices()" type="button" id="draw" class="btn btn-danger ">Ρίξε τα Ζάρια</button>
    <button onclick="move()" type="button" id="check" class="btn btn-danger">Μετακίνησε</button>
    <button onclick="gamestart()" type="button" class="btn btn-danger col-xs-4" id="bet_button">Εναρξη</button>
  
  
  </div>
</div>

<br> <br>
<!-- Exit Button -->
<div class="d-flex justify-content-right ">
  <div class="btn-group  btn-block col-md-4" >
    <a href="index.php?ctd=show_main" type="button" id="exit" class="btn btn-danger btn-block col-md-1" >Exit</a>
  </div>
</div>
