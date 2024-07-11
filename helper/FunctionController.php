<?php
class RoomController
{
   private static $allRoomsQuery = 'SELECT * from room where capacity !=0';
   private static $findRoomByID = "SELECT * FROM `room` WHERE id=?";

   public static function getAllRoomsQuery()
   {
      return RoomController::$allRoomsQuery;
   }
   
   /**
    * Return all rooms in database.
    */
   public static function getAllRooms(): PDOStatement
   {
      return Query::execute(RoomController::$allRoomsQuery);
   }

   /**
    * Find a room by ID.
    */
   public static function getRoomByID(string $roomID)
   {
      return Query::execute(RoomController::$findRoomByID, [$roomID]);
   }
}
class EquipmentController
{
   private static $allEquipmentsQuery = "SELECT * from equipment where id!='1'";
   private static $allAvailableEquipmentsQuery = "SELECT * from equipment where id!='1' and usability=1";
   private static $findEquipmentByID = "SELECT * FROM `equipment` WHERE id = ?";
   private static $allEquipmentType = "SELECT DISTINCT `type` FROM `equipment`";

   public static function getAllEquipmentsQuery()
   {
      return EquipmentController::$allEquipmentsQuery;
   }
   
   /**
    * Return all equipments in database.
    */
   public static function getAllEquipments(): PDOStatement
   {
      return Query::execute(EquipmentController::$allEquipmentsQuery);
   }

   /**
    * Return all type of equipments in database.
    */
    public static function getAllTypeEquipments(): PDOStatement
    {
       return Query::execute(EquipmentController::$allEquipmentType);
    }

   /**
    * Return all available equipments
    */
   public static function getAllAvailableEquipments(): PDOStatement
   {
      return Query::execute(EquipmentController::$allAvailableEquipmentsQuery);
   }

   /**
    * Find equipment by ID
    */
   public static function getEquipmentByID(string $equipmentID)
   {
      return Query::execute(EquipmentController::$findEquipmentByID, [$equipmentID]);
   }
}

class UserController
{
   private static $allUserIDQuery = "SELECT SchoolID from tbluser ";
   private static $getUserIDQuery = "SELECT * from tbluser where SchoolID= ?";
   
   /**
    * Return all IDs of users in database.
    */
    public static function getAllUID(): PDOStatement
    {
       return Query::execute(UserController::$allUserIDQuery);
    }

    /**
    * Find specific ID of user in database.
    */
    public static function getUserID(string $userID) : PDOStatement
    {
       return Query::execute(UserController::$getUserIDQuery,[$userID]);
    }
}
