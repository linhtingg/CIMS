<?php
class Query
{
   private static $DB_HOST = 'localhost';
   private static $DB_USER = 'root';
   private static $DB_PASS = '';
   private static $DB_NAME = 'class2';
   private static $dbh = null;
   // private static $DB_HOST = 'us-east-1.rds.amazonaws.com';
   // private static $DB_USER = 'a8nhk50ikm8wvmdq';
   // private static $DB_PASS = 'imuwf47fsappj30x';
   // private static $DB_NAME = 'class2';
   /**
    * Execute SQL query and return the query.
    * @param string $sql SQL query
    * @param array $bindParams An array of PHP variables.
    * @return PDOStatement
    */
   public static function execute(string $sql, array $params = [])
   {
      $query = Query::getConnection()->prepare($sql);
      if ($params != []) {
         for ($i = 0; $i < count($params); $i++) {
            $query->bindParam($i + 1, $params[$i]);
         }
      }
      $query->execute();
      return $query;
   }
   /**
    * Return PDO connection between PHP and MySQL server.
    * @return PDO
    */
   private static function getConnection()
   {
      if (Query::$dbh == null) {
         Query::$dbh = new PDO("mysql:host=" . Query::$DB_HOST . ";dbname=" . Query::$DB_NAME, Query::$DB_USER, Query::$DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
      }
      return Query::$dbh;
   }
}
