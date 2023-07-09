<?php
class Notification{
   /**
    * Popup an notification to the screen.
    */
   public static function echoToScreen(string $value) 
   {
      echo "<script>alert('$value');</script>";
   }
}