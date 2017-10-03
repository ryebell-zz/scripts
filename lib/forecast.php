<?php

class Forecast {
  const API_URL = 'https://api.darksky.net/forecast/';
  public $coordinates;
  public $key;
  private $result;

  public function __construct($key, $coordinates){
    $this->result = json_decode($this->get_raw($key, $coordinates), true);
  }

  private function get_raw($key, $coordinates){
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_RETURNTRANSFER => 1,
      CURLOPT_URL => self::API_URL . $key . '/' . $coordinates
    ));
    $result = curl_exec($curl);
    return $result;
  }

  public function get_week_summary(){
    $summary = $this->result['daily']['summary'];
    return $summary;
  }

  public function get_today_summary(){
    $today_summary = $this->result['daily']['data'][0]['summary'];
    return $today_summary;
  }

  public function get_today_high(){
    $today_high = $this->result['daily']['data'][0]['temperatureHigh'];
    return $today_high;
  }

  public function get_today_low(){
    $today_low = $this->result['daily']['data'][0]['temperatureLow'];
    return $today_low;
  }

}
?>
