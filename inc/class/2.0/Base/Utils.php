<?php

namespace Base;

use \UnescapedAbstractedDB,
        \SoapFault;

class Utils
{
    
    protected static $db = [
    'AbstractedDB'          => [ ],
    'UnescapedAbstractedDB' => [ ],
  ];

  public static function isTrue($questionable_boolean)
  {
      $falses = array(
        false=>false,
        'N'=>false,
        'NO'=>false,
        'OFF'=>false,
        '0'=>false,
        0=>false
      );
      return 
      !(isset($falses[$questionable_boolean]) ||
      isset($falses[strtoupper($questionable_boolean)]));
  }
     
  /**
   *
   * @return \AbstractedDB 
   */
  public static function getDb($raw = false, $instance = 'rdn')
  {
    $class = $raw ? 'AbstractedDB' : 'UnescapedAbstractedDB';
    if (!isset(self::$db[$class][$instance]) || !self::$db[$class][$instance]) {
      try {
        if (!class_exists($class)) require_once GLOBAL_RDN_PATH."/lib/{$class}.php";
        self::$db[$class][$instance] = $raw ? $class::getInstance($instance) : new $class($instance);
        self::$db[$class][$instance]->setFetchMode(AbstractedDB::FETCH_ASSOC);
      }
      catch (\Exception $e) {
        throw new SoapFault("DB Exception", $e->getMessage());
      }
    }

    return self::$db[$class][$instance];
  }

  public static function getDateTime($dateTime) {
    if ($dateTime == '0000-00-00 00:00:00' || $dateTime == '0000-00-00' || !$dateTime) {
      return NULL;
    }
    
    if (($timestamp = strtotime($dateTime)) !== false) {
      return new \SoapVar( $timestamp , XSD_DATETIME);
    }
  }
}


