<?php

/**
 * DbService short summary.
 *
 * DbService description.
 *
 * @version 1.0
 * @author Dante
 */
class DbService
{
    private static $host="localhost";
    private static $user="root";
    private static $password="root";
    private static $defaultDb = 'MyPhpPicFor';

    private $conn;

    private $lasterror;

    public function GetLastError(){
        if($this->conn)
            return $this->conn->error;
        else
            return "Not connected";
    }

    public function Connect(){

        $conn=new mysqli(self::$host, self::$user, self::$password
            , self::$defaultDb);

        if(!$conn->connect_error) {
            $this->conn = $conn;

            // echo '<h1>Connected to MySQL</h1>';
            //if connected then Select Database.
        }

        return $conn;
    }

    public function Insert($agent, $xml, $output){

        if(!$this->conn)
            return FALSE;

        $agent = htmlspecialchars( $agent);
        $xml = htmlspecialchars( $xml);

        $output = floatval(str_replace(',', '.', str_replace('.', '', htmlspecialchars( $output))));
        
        $sqlstring = "insert into data_log(browser,parametri,risultato) values('$agent', '$xml', $output);";

        // log
        file_put_contents('logs.txt', (new \DateTime())->format('Y-m-d H:i:s') .  $sqlstring."\n\r" , FILE_APPEND | LOCK_EX);

        return $this->conn->query($sqlstring);

    }

    public function Disconnect(){
       return  $this->conn->close();
    }

}
