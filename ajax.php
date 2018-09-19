<?php
    ini_set('error_reporting', E_ALL);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);

    define("IN_SYSTEM", 1);

    # INCLUDES ##############################################################################
    
    require_once("./includes/common.php");
    require_once("./includes/db_init.php");

    # VARS ##################################################################################

    $money_min = 100;                       // минимальная сумма денежного приза
    $money_max = 10000;                     // максимальная сумма денежного приза

    $bonus_min = 100;                       // минимальная сумма бонуса
    $bonus_max = 10000;                     // максимальная сумма бонуса

    $goods_array = db_get_array("SELECT * FROM goods", "id", "name");

    $convert = 10;                          // коэффициент конвертирования в процентах

    # MAIN ##################################################################################

    define('SESSION_ID', 'SID');
    
    session_name(SESSION_ID);
    session_start('SID');

    if (isset($_POST['type'])) {
        if ($_POST['type'] == "html-request") {
            // получение приза
            if ($_POST['action'] == 1) {
                $result_type = rand(0, 2);
                $result = '';

                switch ($result_type) {
                    case 0:
                        // денежный приз
                        $result = rand($money_min, $money_max);
                        $out = $result_type."#Вы выиграли денежный приз на сумму ".$result." USD";
                        break;

                    case 1:
                        // бонусы
                        $result = rand($bonus_min, $bonus_max);
                        $out = $result_type."#Вы выиграли бонусы на сумму ".$result." USD";
                        break;

                    case 2:
                        // подарок
                        $count = db_table_count("goods") - 1;
                        $result = rand(0, $count);

                        $out = $result_type."#Вы выиграли ".$goods_array[$result];
                        break;
                    
                    default:
                        break;
                }

                $order_id = logAction($result_type, $result, $_SESSION['user_ID']);

                print_r($out."#".$order_id);
            }
        }

        // Отправить на счет в банке
        if ($_POST['action'] == 2) {

        }

        // Конвертировать в бонусы
        if ($_POST['action'] == 3) {
            $order_id = intval($_POST['order_id']);
            $summ = db_get_data("SELECT value FROM log WHERE id = ".$order_id, "value");

            $bonus_value = round($summ * $convert / 100);

            $out = 'Конвертация бонусов прошла успешно, сумма бонусов составляет '.$bonus_value ;
            
            print_r($out);
        }

        // Отказаться от приза
        if ($_POST['action'] == 4) {

        }
    }    
?>
