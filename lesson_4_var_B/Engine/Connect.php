<?php

namespace lesson_4\Engine;
class Connect
{
    private static $connectBase = null;
    static private $limit = 0;

    const DBHOST = 'localhost';
    const DBUSER = 'root';
    const DBPASS = '';
    const DBNAME = 'lessonphp2_fourth';
    const STEP = 3;

    public function __construct()
    {}

    public static function getConnectBase()
    {
        if (empty(self::$connectBase)) {
            self::$connectBase = new self();
        }
        return self::$connectBase;
    }

    public function getConnectDB()
    {
        return mysqli_connect(self::DBHOST, self::DBUSER, self::DBPASS, self::DBNAME);
    }

    private function upLimit()
    {
       return Connect::$limit += Connect::STEP;
    }

    public function dataPage($sqlRequest)
    {
        $this->upLimit();
        $connectDB = $this->getConnectDB();
        $finSQLRequest = $sqlRequest . ' ' . Connect::$limit;
        $resultPage = mysqli_query($connectDB, $finSQLRequest);
        $arrayDataPage = array();
        while ($row = mysqli_fetch_assoc($resultPage)) {
            $arrayDataPage[] = $row;
        };
        return $arrayDataPage;
    }


}

