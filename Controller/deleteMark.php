<?php
session_start();



function redirect_to($location = NULL)
{
    if ($location != NULL) {
        header("Location: {$location}");
        exit;
    }
}

if (isset($_POST['day'])) {
    $day = $_POST['day'];

    //Get file data
    $dbFile = '../db/database.txt';
    require_once('./getFile.php');

    //remove the line that contains the day
    unset($markData[$day]);

    //pass new array with new data and convert to string
    $newData = array();
    foreach ($markData as $key) {
        array_push($newData, implode("|-|", $key));
        //add line break
        array_push($newData, PHP_EOL);
    }

    //remove line break on the last position
    unset($newData[array_key_last($newData)]);

    //Delete data on the file and redirect with message of success or failure
    if (file_put_contents($dbFile, implode("", $newData))) {
        $_SESSION['messageType'] = 'success';
        $_SESSION['message'] = 'Removido com sucesso';
        redirect_to('../index.php');
    } else {
        $_SESSION['messageType'] = 'error';
        $_SESSION['message'] = 'Ococorreu um erro ao remover a data, tente novamente';
        redirect_to('../index.php');
    }
} else {
    $_SESSION['messageType'] = 'error';
    $_SESSION['message'] = 'Preencha todos campos';
    redirect_to('../index.php');
}
