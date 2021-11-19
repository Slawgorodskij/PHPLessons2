<?php

namespace lesson_4\Engine;
class Connect
{
    private static $connectBase = null;

    const DBHOST = 'localhost';
    const DBUSER = 'root';
    const DBPASS = '';
    const DBNAME = 'lessonphp2_fourth';

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

    public function dataPage($sqlRequest)
    {
        $connectDB = $this->getConnectDB();
        $resultPage = mysqli_query($connectDB, $sqlRequest);
        $arrayDataPage = array();
        while ($row = mysqli_fetch_assoc($resultPage)) {
            $arrayDataPage[] = $row;
        };
        return $arrayDataPage;
    }


}

