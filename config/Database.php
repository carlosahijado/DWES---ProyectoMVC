<?php
namespace config;

use PDOException;
use PDO;

class Database
{
    protected static  $dbhost = 'localhost';
    protected static  $dbuser = 'root';
    protected static $dbpassword = '';
    protected static $dbname = 'forolibros';
    
    public function __construct($dbhost='',$dbuser='',$dbpassword='',$dbname='')
    {
        if(strcmp($dbhost,''))
        {
            self::$dbhost;
        }
        if(strcmp($dbuser,''))
        {
            self::$dbuser = $dbuser;
        }
        if(strcmp($dbpassword,''))
        {
            self::$dbpassword = $dbpassword;
        }
        if(strcmp($dbname,''))
        {
            self::$dbname = $dbname;
        }
    }
    
    
    function __destruct()
    {
        
    }
public static function conectar()
{
    $conexion = null;
    $dbhost = self::$dbhost;
    $dbname = self::$dbname;
    $dbuser = self::$dbuser;
    $dbpassword = self::$dbpassword;    
    $datosPDOMYSQL= "mysql:host=$dbhost;dbname=$dbname;charset=utf8";
    try {
        $conexion = new PDO($datosPDOMYSQL, $dbuser, $dbpassword);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
    {
        echo "<br>Conexion falló<br>". $e->getMessage()."<br>";
    }
    return $conexion;
}
}


