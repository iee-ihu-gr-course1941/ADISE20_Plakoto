<script>
  //variables needed
  var is_used=0;//flag:if it is 1, a new random card is generated
  var bet=0;//ammount of money bet
  var rng1=0;//value used to generate random cards
  var rng2=0;//value used to generate random cards
  var u_score=0;//total user Score
  var d_score=0;//total dealer Score
  var temp_value=0;//holds the value of the current card
  var u_ace=0;//1 if the user has one ace
  var d_ace=0;//1 if the dealer has one ace
  var u2_ace=0;//1 if the user already has one ace
  var d2_ace=0;//1 if the dealer already has one ace

  //array that holds the two poulia
  var poulia = ["./Images/black_piece.png", "./Images/white_piece.png"];
  //array that holds the beatean poulia
  var p_poulia = [];
  //array that holds the black dices
  var b_dice = ["./Images/bdice_one.png", "./Images/bdice_two.png", "./Images/bdice_three.png", "./Images/bdice_four.png", "./Images/bdice_five.png", "./Images/bdice_six.png"];
  //array that holds the white dices
  var w_dice = ["./Images/wdice_one.png", "./Images/wdice_two.png", "./Images/wdice_three.png", "./Images/wdice_four.png", "./Images/wdice_five.png", "./Images/wdice_six.png"];

  var used_cards = [];//array that holds the already used cards
  var card_temp=cards[0][0];//variable that holds the current drawn card
  var dealer_first_card="./cards/cardClubsA.png";//the first card the dealer draws

  //initialization of the board
  $(document).ready(function(){
    $("#draw").attr("disabled", "disabled");
    $("#check").attr("disabled", "disabled");
    $('#dealer_cards').html('<img src="./cards/cardBack_red5.png" alt="cards" id="cardback" width="125" height="125" hspace="20">');
    dealer_first_card=generate_card("dealer");
    d_score=calculate_score("dealer");
    card_temp=generate_card("user");
    $('#user_cards').html('<img src="'+card_temp+'" alt="cards"  width="125" height="125" hspace="20">');

  });

  //function that generates a random card for the given player
  function generate_card(person){
    do{
      rng1=Math.floor(Math.random() * 4);
      rng2=Math.floor(Math.random() * 13);
      card_temp=cards[rng1][rng2];
      if(rng2==0&&person=="dealer"){
        if(d_ace==0){
          d_ace=1;
          d2_ace=0;
        }
        else if(d_ace==1){
          d2_ace=1;
        }
      }
      else if (rng2==0&&person=="user") {
        if(u_ace==0){
          u_ace=1;
          u2_ace=0;
        }
        else if(u_ace==1){
          u2_ace=1;
        }
      }
      temp_value=rng2;
      is_used=check();
      if(is_used==0){
        used_cards.push([card_temp]);
      }
    }while (is_used==1)
    return card_temp;
  }

  //function that checks if a card has already been used
  function check(){
    is_used=0;
    for(var i=0;i<used_cards.length;i++){
      if(used_cards[i]==card_temp){
        is_used=1;
      }
    }
    return is_used;
  }

  //function that calculates the given players score
  function calculate_score(person){
      if(temp_value==0){
        if(person=="dealer"){
          if(d2_ace==0){
            temp_value=11;
          }
          else if(d2_ace==1){
            if(d_score==11){
              temp_value=10;
            }else{
              temp_value=1;
            }
          }
        }
        else if (person=="user") {
          if(u2_ace==0){
            temp_value=11;
          }
          else if(u2_ace==1){
            if(u_score==11){
              temp_value=10;
            }else{
              temp_value=1;
            }
          }
        }
      }
      else if (temp_value>9){
        temp_value=10;
      }
      else{
          temp_value=temp_value+1;
      }

      if(person=="dealer"){
        d_score=d_score+temp_value;
        return d_score;
      }
      else if(person=="user") {
        u_score=u_score+temp_value;
        return u_score;
      }
  }

  //when the users places a bet, this function is called
  function gamestart() {
    bet = document.getElementById("bet").value;
    document.getElementById('draw').disabled = false;
    document.getElementById('check').disabled = false;
    u_score=calculate_score("user");
    $('#status_div').html('<h5>Money bet: '+ bet + '$<h5>&nbsp');
    $('#status_div').append('<h5 id="score">Current Score: '+ u_score + '<h5>');
  }

  //function is called when the user draws a card
  function draw(){
    card_temp=generate_card("user");
    $('#user_cards').append('<img src="'+card_temp+'" alt="cards"  width="125" height="125" hspace="20">');
    u_score=calculate_score("user");
    $('#score').remove();
    $('#status_div').append('<h5 id="score">Current Score: '+ u_score + '<h5>');

    if(u_score==21){
      $('#status_div').html('<h5>You Win!<h5>&nbsp');
      endgame("win");
    }
    else if(u_score>21){
      $('#status_div').html('<h5>You Lose!<h5>&nbsp');
      endgame("loss");
    }
  }

  //if the users checks, this function is called
  function ucheck(){
    $('#cardback').remove();
    $('#dealer_cards').append('<img src="'+dealer_first_card+'" alt="cards"  width="125" height="125" hspace="20">');
    while(d_score<17){
      card_temp=generate_card("dealer");
      $('#dealer_cards').append('<img src="'+card_temp+'" alt="cards"  width="125" height="125" hspace="20">');
      d_score=calculate_score("dealer");
    }

    //$('#status_div').append('<h5 id="score">Current Score: '+ d_score + '<h5>');

    if(d_score>21){
      $('#status_div').html('<h5>You Win!<h5>&nbsp');
      endgame("win");
    }
    else if(d_score==21){
      $('#status_div').html('<h5>Dealer Wins!<h5>&nbsp');
      endgame("loss");
    }
    else{
      if(d_score>=u_score){
        $('#status_div').html('<h5>Dealer Wins!<h5>&nbsp');
        endgame("loss");
      }
       else{
          $('#status_div').html('<h5>You Win!<h5>&nbsp');
          endgame("win");
        }
    }
  }

  function endgame(state){
    $('#status_div').append('<button onclick="replay()" type="button" class="btn btn-danger col-xs-4" id="bet_button">Play Again</button>');
    $("#draw").attr("disabled", "disabled");
    $("#check").attr("disabled", "disabled");


      var cash = <?php echo $_SESSION['cash']?>;
      var args = {bet: bet, state: state, cash: cash, usrname: '<?php echo $_SESSION['username']?>'};
      var a = JSON.stringify(args);

      $.ajax("calculate_cash.php", {method: 'PUT',
       data : a,
       headers: { "Content-Type": "application/json"},
     });
  }

  function replay(){
    bet=0;
    u_score=0;
    d_score=0;
    temp_value=0;
    u_ace=0;
    d_ace=0;
    u2_ace=0;
    d2_ace=0;
    dealer_first_card="./cards/cardClubsA.png";
    $('#status_div').html('<input class="col-sm-3" type="number" placeholder="Amount of money to bet" id="bet">');
    $('#status_div').append('<button onclick="gamestart()" type="button" class="btn btn-danger col-xs-4" id="bet_button">Bet</button>');

    $("#draw").attr("disabled", "disabled");
    $("#check").attr("disabled", "disabled");
    $('#dealer_cards').html('<img src="./cards/cardBack_red5.png" alt="cards" id="cardback" width="125" height="125" hspace="20">');
    dealer_first_card=generate_card("dealer");
    d_score=calculate_score("dealer");
    card_temp=generate_card("user");
    $('#user_cards').html('<img src="'+card_temp+'" alt="cards"  width="125" height="125" hspace="20">');
    <?php
        $sql = "SELECT cash FROM users WHERE uname=?";
       if( $stmt = $mysqli->prepare($sql) ) {
         $stmt->bind_param("s", $_SESSION['username']);
         $stmt->execute();
         $result = $stmt->get_result();
         $row = $result->fetch_assoc();
      }

      $_SESSION['cash']=$row['cash'];
     ?>

     $('#acash').html('<h3 id="acash">Available cash: <?php echo $row['cash'] ?>$</h3>');


  }
</script>
<?php
    $sql = "SELECT cash FROM users WHERE uname=?";
   if( $stmt = $mysqli->prepare($sql) ) {
     $stmt->bind_param("s", $_SESSION['username']);
     $stmt->execute();
     $result = $stmt->get_result();
     $row = $result->fetch_assoc();
  }

 ?>



<div class="d-flex justify-content-center" >
<img src="./Images/tavli_board.png" class="img-fluid" width="600"> 


</div>

<br> <br>
<!-- exit button -->
<div class="d-flex justify-content-left  ">
  <div class="btn-group  btn-block col-md-4" >
    <a href="index.php?ctd=show_main" type="button" id="exit" class="btn btn-danger btn-block col-md-1" >Exit</a>
  </div>
</div>
