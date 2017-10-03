<?php

class CryptoCheck {

  public $coin;
  public $price;

  public function __construct($req){
    $this->coin = strtolower($req);
    $this->price = $this->get_current_price();
  }

  private function get_raw($coin){
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_RETURNTRANSFER => 1,
      CURLOPT_URL => 'https://api.cryptonator.com/api/ticker/' . $coin . '-usd'
    ));
    $result = curl_exec($curl);
    return $result;
  }

  private function get_current_price(){

    $result = $this->get_raw($this->coin);
    $json = json_decode($result, true);
    return $json['ticker']['price'];
  }

}
?>
