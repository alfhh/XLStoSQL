<?php
/**
 * Created by PhpStorm.
 * User: enriqueohernandez
 * Date: 5/2/15
 * Time: 12:28 PM
 */
// Obtener valores introducidos

include 'SpreadsheetReader.php';
header('Content-Type: text/plain');
require('php-excel-reader/excel_reader2.php');

$nombreDirectorio = "xls/";

$nombreArchivo = $_FILES['file']['name'];

if (is_file($nombreArchivo)){
    $idUnico = time();
    $nombreArchivo = $idUnico . "-" . $nombreArchivo;
}

else if ($_FILES['file']['name'] == "")
    $nombreArchivo = '';



    // Insertar el anuncio en la Base de Datos


    // Mover archivo de imagen a su ubicaciÛn definitiva
    move_uploaded_file($_FILES['file']['tmp_name'], $nombreDirectorio . $nombreArchivo);
    // Mostrar datos introducidos
    $Filepath = $nombreDirectorio . $nombreArchivo;

    //echo "no";
try
{
    $Spreadsheet = new SpreadsheetReader($Filepath);
    $BaseMem = memory_get_usage();

    $Sheets = $Spreadsheet -> Sheets();

    $tableName;
    //$nombres = "";
    $nombres = array();
    /*
     *
     * $stack = array("orange", "banana");
array_push($stack, "apple", "raspberry");
print_r($stack);
     */

    foreach ($Sheets as $Index => $Name) {

        $Spreadsheet -> ChangeSheet($Index);
        $count = 0;
        $aux = 1;

        foreach ($Spreadsheet as $Key => $Row) {

            if($count == 0){
                echo "Create Table ".$Row[0]."(";
                $tableName = $Row[0];
            }
            else if ($count == 1){

                //implode("|", $Row[1]);

                foreach ($Row as $Key => $Row1){
                    $myArray = explode(',', $Row1);
                    echo $myArray[0]." ";
                    if($myArray[1]=="varchar"){
                        echo "varchar(".$myArray[2].")";
                       // $nombres+="varchar,";
                        array_push($nombres, "varchar");

                    }
                    else if($myArray[1]=="int"){
                        echo "int";
                        array_push($nombres, "int");

                    }
                    else if($myArray[1]=="char"){
                        echo "char";
                        array_push($nombres, "char");

                    }
                    $aux++;
                    if($aux <= sizeof($Row)){
                        echo", ";
                    }
                    else{
                        echo");<br> INSERT INTO ".$tableName." <br> VALUES ";
                    }
                }

            }
            else{

                $i = 0;
                echo "(";
                foreach ($Row as $Key => $Row1) {

                        if($nombres[$i]=="varchar"){
                            if(sizeof($nombres)>($i+1))
                                echo "'$Row1', ";
                            else
                                echo "'$Row1'";
                        }

                        else if($nombres[$i]=="int"){
                            if(sizeof($nombres)>($i+1))
                                echo "$Row1, ";
                            else
                                echo "$Row1";
                        }
                        else if($nombres[$i]=="char"){
                            if(sizeof($nombres)>($i+1))
                                echo "'$Row1', ";
                            else
                                echo "'$Row1'";
                        }
                    $i++;
                }
                if(sizeof($Row)>($count))
                    echo "), ";
                else
                    echo ");";


            }
            $count++;
            //echo implode("|", $Row);

        }
    }

/**
 * XLS parsing uses php-excel-reader from http://code.google.com/p/php-excel-reader/
 */


	// Excel reader from http://code.google.com/p/php-excel-reader/

	//require('SpreadsheetReader.php');

    // If you need to parse XLS files, include php-excel-reader
    //$Reader = new SpreadsheetReader('personas.xlsx');
/*
    $i = 0;
    $j = 0;
    $sql = '';
    foreach ($Spreadsheet as $Row)
    {
       // echo $ow;
        //adds the sql for creating the table
        if($j = 0){
            $sql += 'CREATE TABLE ';
            $sql += $Row[0];
            $sql += ' ';
        }
        //adds the sql for creating each of the columns
        else if($j = 1){
            foreach ($Row as $cName){
                //exploding the column name and type into an array
                $cNameArray = explode(',', $cName);
                //adding the column name
                $sql += '(';
                $sql += $cNameArray[0];
                $sql += ' ';
                //adding the column type
                $sql += $cNameArray[1];
                //adding the size restraint
                $sql += '(';
                $sql += $cNameArray[2];
                $sql += '), ';
            }
        }
        $j += 1;
        echo $sql;
    }
*/

/*


    echo '---------------------------------'.PHP_EOL;
    echo 'Spreadsheets:'.PHP_EOL;
    print_r($Sheets);
    echo '---------------------------------'.PHP_EOL;
    echo '---------------------------------'.PHP_EOL;

    foreach ($Sheets as $Index => $Name)
    {
        echo '---------------------------------'.PHP_EOL;
        echo '*** Sheet '.$Name.' ***'.PHP_EOL;
        echo '---------------------------------'.PHP_EOL;

        $Time = microtime(true);

        $Spreadsheet -> ChangeSheet($Index);

        foreach ($Spreadsheet as $Key => $Row)
        {
            echo $Key.': ';
            if ($Row)
            {
                print_r($Row);
            }
            else
            {
                var_dump($Row);
            }
            $CurrentMem = memory_get_usage();

            echo 'Memory: '.($CurrentMem - $BaseMem).' current, '.$CurrentMem.' base'.PHP_EOL;
            echo '---------------------------------'.PHP_EOL;

            if ($Key && ($Key % 500 == 0))
            {
                echo '---------------------------------'.PHP_EOL;
                echo 'Time: '.(microtime(true) - $Time);
                echo '---------------------------------'.PHP_EOL;
            }
        }

        echo PHP_EOL.'---------------------------------'.PHP_EOL;
        echo 'Time: '.(microtime(true) - $Time);
        echo PHP_EOL;

        echo '---------------------------------'.PHP_EOL;
        echo '*** End of sheet '.$Name.' ***'.PHP_EOL;
        echo '---------------------------------'.PHP_EOL;


*/

}catch (Exception $E)
{
    echo $E -> getMessage();
}



?>
