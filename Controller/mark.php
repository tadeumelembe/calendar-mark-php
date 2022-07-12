<?php
session_start();



function redirect_to($location = NULL)
{
    if ($location != NULL) {
        header("Location: {$location}");
        exit;
    }
}

if (isset($_POST['note']) && isset($_POST['day'])) {

    //Get form values
    $note = $_POST["note"];
    $day = $_POST["day"];
    $date_created = date('Y-m-d, H:i:s');

    //Get file data
    $dbFile = '../db/database.txt';
    require_once('./getFile.php');

    //Verify if data is marked
    if (in_array($day, $days)) {
        $_SESSION['messageType'] = 'error';
        $_SESSION['message'] = 'A data ja foi marcada';
        redirect_to('../index.php');
    }

    //Get last id
    $last_element = $markedDays[array_key_last($markedDays)];
    $last_id = explode("|-|", $last_element);
    $new_id = $last_id[0] + 1;

    

    //Line to be added and check if it needs to break line in case the file is empty
    if ($new_id == 1) {
        $data_to_save = $new_id . "|-|" . $note . "|-|" . $day . "|-|" . $date_created;
    } else {
        $data_to_save = PHP_EOL . $new_id . "|-|" . $note . "|-|" . $day . "|-|" . $date_created;
    }


    //Add data to the file and redirect with message of success or failure
    if (file_put_contents($dbFile, $data_to_save, FILE_APPEND)) {
        $_SESSION['messageType'] = 'success';
        $_SESSION['message'] = 'Data marcada com sucesso';
        redirect_to('../index.php');
    } else {
        $_SESSION['messageType'] = 'error';
        $_SESSION['message'] = 'Ococorreu um erro ao marcar a data, tente novamente';
        redirect_to('../index.php');
    }
} else {
    $_SESSION['messageType'] = 'error';
    $_SESSION['message'] = 'Preencha todos campos';
    redirect_to('../index.php');
}
