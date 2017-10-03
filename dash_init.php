#!/usr/local/bin/php
<?php

$config = include('config.php');
$scripts_dir = $config['scripts_dir'];

require_once($scripts_dir .'/lib/cryptocheck.php');
require_once($scripts_dir . '/lib/forecast.php');

$config = include('config.php');

$message = "\e[1m\e[4mDashboard:\e[0m\e[0m \n";
$section_break = "----------------------------------\n";

$message .= "\e[1mCrypto Market prices:\e[0m \n";
foreach( $config['coins'] as $coin){
  $check = new CryptoCheck($coin);
  $message .= "Current " . strtoupper($check->coin) . " Price: $" . number_format(round($check->price, 2), 2) . "\n";
}

$message .= $section_break;

$forecast = new Forecast($config['weather']['key'], $config['weather']['coordinates']);
$message .=
  "\e[1mWeather:\e[0m " . "\n" .
  "Weekly Summary: " . $forecast->get_week_summary() . "\n" .
  "Today's Summary: " . $forecast->get_today_summary() . "\n" .
  "Today's High: " . $forecast->get_today_high() . "°" . "\n" .
  "Today's Low: " . $forecast->get_today_low() . "°" . "\n";

echo $message;


?>
