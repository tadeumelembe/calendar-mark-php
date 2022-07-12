<?php
session_start();
//Get message after submiting form
$message = $_SESSION['message'];
$messageType = $_SESSION['messageType'];
session_destroy();

$dbFile = './db/database.txt';
chmod($dbFile, 0664);
require_once('./Controller/getFile.php');

?>

<!DOCTYPE html>
<html>

<head>
    <title>Edudigital - Calendar APP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="./assets/css/all.css" rel="stylesheet">
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">
    <script src="./assets/js/jquery.min.js"></script>

</head>

<body>

    <!-- Success toast message! -->
    <div class="toast-container position-absolute top-0 end-0 p-3">
        <div id="success-toast" class="toast align-items-center text-white bg-success border-0 mt-4" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <?php echo $message; ?>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
    <!-- END Success toast message! -->

    <!-- Error toast message! -->
    <div class="toast-container position-absolute top-0 end-0 p-3">
        <div id="error-toast" class="toast align-items-center text-white bg-danger border-0 mt-4" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <?php echo $message; ?>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
    <!-- END error toast message! -->


    <div class="container">

        <div class="card mx-auto my-auto" style="width: 500px;height:500px">
            <div class="card-body p-0">
                <div class="title-section mb-2">
                    <h3 class="card-title text-center">Março-2022</h3>
                </div>

                <div class="weekdays">
                    <div class="">Dom</div>
                    <div class="">Seg</div>
                    <div class="">Ter</div>
                    <div class="">Qua</div>
                    <div class="">Qui</div>
                    <div class="">Sex</div>
                    <div class="">Sáb</div>

                    <div class="text-muted day-week"></div>
                    <div class="text-muted day-week"></div>

                    <?php
                    for ($i = 1; $i <= 31; $i++) {

                        //Check if day is marked/
                        if (in_array($i, $days)) {

                    ?>
                            <div style="background-color: #5858ff;color:#fff">
                                <a id="he" is_marked="1" mark_date="<?php echo $markData[$i][3] ?>" mark_note="<?php echo $markData[$i][1] ?>" mark_id="<?php echo $markData[$i][0] ?>" style="color:#fff!important" href="javascript:void(0)"><?php echo $i ?></a>
                            </div>

                        <?php
                        } else {
                        ?>
                            <div>
                                <a id="he" href="javascript:void(0)"><?php echo $i ?></a>
                            </div>

                    <?php
                        }
                    }
                    ?>

                    <div class="text-muted day-week"></div>
                    <div class="text-muted day-week"></div>
                </div>

            </div>
        </div>


        <!--Mark form modal-->
        <div class="modal modal-form" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title form-modal-title">Marcar dia</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="mark-day-form" method="post" action="./Controller/mark.php">
                            <div class="mb-3">
                                <label for="note" class="form-label">Nota</label>
                                <input required type="text" class="form-control" name="note" placeholder="Insira uma nota" id="note">
                                <input type="hidden" class="form-control" name="day" placeholder="Insira uma nota" id="day-input">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" form="mark-day-form" class="btn btn-primary">Submeter</button>
                    </div>
                </div>
            </div>
        </div>
        <!--End Mark form modal-->

        <!--Details modal-->

        <div class="modal mark-details" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detalhes</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p id="details-day">Dia marcado:</p>
                        <p id="details-note">Dia marcado:</p>
                        <p id="details-date">Dia marcado:</p>
                        <button type="button" id="delete-mark-button" class="btn btn-danger">Remover</button>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
        <!--End Details modal-->

    </div>

    <!--Delete mark form-->
    <form id="mark-delete-form" style="display: none;" method="post" action="./Controller/deleteMark.php">
        <input type="hidden" class="form-control" name="day" placeholder="Insira uma nota" id="day-delete-input">
    </form>
    <!--End delete mark form-->


    <script src="./assets/js/script.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>

    <script type="text/javascript">
        const message = '<?php echo $message; ?>';
        const messageType = '<?php echo $messageType; ?>';

        if (message) {
            if (messageType == 'success') {
                var toastTrigger = document.getElementById('success-toast')
                var toast = new bootstrap.Toast(toastTrigger)

                toast.show()
            } else {
                var toastTrigger = document.getElementById('error-toast')
                var toast = new bootstrap.Toast(toastTrigger)

                toast.show()
            }


        }
    </script>
</body>

</html>