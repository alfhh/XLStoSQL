<?php
/**
 * Created by PhpStorm.
 * User: enriqueohernandez
 * Date: 5/2/15
 * Time: 12:28 PM
 */
// Obtener valores introducidos
include 'SpreadsheetReader.php';

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
    }

}catch (Exception $E)
{
    echo $E -> getMessage();
}



?>
