<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="<?= BASE_URL ?>/public/content/images/logo/logo_v-shop.jpg">

    <!-- <?= BASE_URL ?>/public/content/css/style.css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <!-- lib jquery -->
    <script src="<?= BASE_URL ?>/node_modules/jquery/dist/jquery.min.js"></script>
    <!-- lib wow js -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/node_modules/wowjs/css/libs/animate.css">
    <script src="<?= BASE_URL ?>/node_modules/wowjs/dist/wow.min.js"></script>

    <!-- lib slick js -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/node_modules/slick-1.8.1/slick/slick.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/node_modules/slick-1.8.1/slick/slick-theme.css">


    <!-- reset css -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/node_modules/reset-css/reset.css" />
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <!-- programmer css -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/css/style.css ">
    <style>
        .z__index {
            z-index: 999;
            margin-top: 0.5rem;
        }

        .z__index ul {
            width: 100%;
            padding-top: 1rem;
        }
    </style>
</head>

<body>

    <div class="wrapper">
        <?php
        require_once 'header.php';
        ?>

        <!-- view -->
        <div class="container">
            <?php require_once $view_name = APP_PATH . '/view/' . $module . '/' . $view_name; ?>
            <?php require_once $file_controller = APP_PATH . '/controller/' . $module . '/' . $controller . '.php'; ?>
        </div>
        <!-- =======end view==== -->
        <?php

        require_once 'footer.php';
        ?>
    </div>
    <button class="btn-backtotop" id="btn-btt" onclick="scrollToTop();return false"><i class="fas fa-angle-up"></i></button>
    <!-- jquery -->

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <!-- slick -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="<?= BASE_URL ?>/node_modules/slick-1.8.1/slick/slick.min.js"></script>
    <script src="<?= BASE_URL ?>/public/js/main.js"></script>
    <script>
        $('.slick').slick({
            infinite: true,
            slidesToShow: 4,
            slidesToScroll: 1
        });
        $('.slick_slide').slick({
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 1
        });
        $(document).ready(function() {
            $("#search").keyup(function() {
                var searchText = $(this).val();
                if (searchText != '') {
                    $.ajax({
                        url: '<?= BASE_URL ?>/controller/frontend/action.php',
                        method: 'post',
                        data: {
                            query: searchText
                        },
                        success: function(respose) {
                            $("#show-list").html(respose);
                        }
                    });
                } else {
                    $("#show-list").html('');
                }
            });
            $(document).on('click', 'a', function() {
                $("#search").val($(this).text());
                $("#show-list").html('');
            });
        });
    </script>
</body>

</html>