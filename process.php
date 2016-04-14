<?php
class Card {
  public $value;
  public $suit;
  public function __construct($value, $suit){
    $this->value = $value;
    $this->suit = $suit;
  }
} // end of Card


class Deck{
  public $deck;
  public function __construct(){
    $this->buildDeck();
  }

  public function buildDeck(){
    $this->deck = [];
    //these are local variables to buildDeck;
    $suits = [
      'hearts',
      'diamonds',
      'spades',
      'clubs'
    ];
    $values = [
      'ace',
      '2',
      '3',
      '4',
      '5',
      '6',
      '7',
      '8',
      '9',
      'ten',
      'jack',
      'queen',
      'king'
    ];
    for ($i = 0; $i < count($suits); $i++){
      for ($j=0; $j < count($values); $j++) {
        array_push($this->deck, new Card($values[$j], $suits[$i]));
      }
    }// end of for loops
    return $this;
  } // end of buildDeck function()
  public function shuffleDeck(){
    shuffle($this->deck);
    return $this;
  }
  public function deal(){
    return array_pop($this->deck);
  }

  public function resetDeck(){
    $this->buildDeck();
    $this->shuffleDeck();
    return $this;
  } // end of resetDeck
  public function addCard($card){
    $this->deck[] = $card;
    shuffle($this->deck);
    return $this;
  }
}// end of class deck
// echo "card working?";
// var_dump (new Card("ace", "spades"));
// // echo "deck working? yes";
// $myDeck = new Deck();
// //echo "reset working"
// $myDeck->shuffleDeck()->resetDeck();
// echo "shuffle working? yes";
// echo "deal working";
// expecting 53 cards...check!
// var_dump ($myDeck->addCard(new Card("2", "diamonds")));

// Card class complete

/**
 *
 */
class Player {
  public $name;
  public $hand;
  public function __construct($name){
    $this->name = $name;
    $this->hand = [];
  }

  public function getCard($card){
    $this->hand[] = $card;
    return $this;
  }

  public function playCard($index){
    $temp = $this->hand[$index];
    var_dump($temp);
    $this->removeCard($index);
    return $temp;
  }
  private function removeCard($index){
    for ($i=$index; $i < count($this->hand)-1; $i++) {
      $this->hand[$i] = $this->hand[$i+1];
    }
    array_pop($this->hand);
    return $this;
  }
} // end player
// player working
$myPlayer = new Player('mike');
$myPlayer->getCard(new Card("5", "spades"));
//expecting 5 of spades
var_dump($myPlayer->playCard(0)); //check!
// get  play card working
// var_dump ($myPlayer);
/**
 *
 */
class Game
{
  public $deck;
  public $players;

  function __construct()
  {
    $this->players = [];
    $this->deck = new Deck();
    $this->deck->shuffleDeck();
  }
  function addPlayer($name){
    $this->players[] = new Player($name);
  }
  function dealToPlayer($name){
    for ($i=0; $i < count($this->players); $i++) {
      if ($this->players[$i]->name == $name){
        $this->players[$i]->hand[] = $this->deck->deal();
      }
    }
  }

}

$game = new Game();
$game->addPlayer('Hien');
$game->addPlayer('Paul');
$game->dealToPlayer('Hien');
$game->dealToPlayer('Hien');
$game->dealToPlayer('Hien');
$game->dealToPlayer('Hien');
$game->dealToPlayer('Paul');
var_dump($game->players);



?>
