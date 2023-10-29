<?php

function removeSpaces($string) {
  $string = str_replace(' ', '', $string);
  return $string;
}

function removeDots($string) {
  $string = str_replace('.', '', $string);
  return $string;
}

function splitByDot($string) {
  $string = explode('.', $string);
}