<?php
	
require_once("../Model/memberhandler.php");
require_once("../DBconfig.php");


	
	
	 public static function test(DBConfig $dbConfig) {
                $db = new Database();
               
                if ($db->Connect($dbConfig) == false) {
                        echo "Database Connect failed";
                        return false;
                }
               
                $numberOfPostBefore = $db->SelectOne("SELECT COUNT(*) FROM InsertTable");
               
                $stmt = $db->Prepare("INSERT INTO InsertTable VALUES (1)");
                $db->RunInsertQuery($stmt);
               
                $numberOfPostAfter = $db->SelectOne("SELECT COUNT(*) FROM InsertTable");
               
                if ($numberOfPostBefore +1 != $numberOfPostAfter) {
                        echo "Prepare or RunInsertQuery failed";
                        return false;
                }
               
                if ($db->SelectOne("SELECT COUNT(*) FROM NotEmpty") != 2) {
                        echo "Database SelectOne failed";
                        return false;
                }
               
                if ($db->Close() == false) {
                        echo "Database Close failed";
                        return false;
                }
               
               
                return true;
        }       


