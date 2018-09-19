<?php
    class ConvertData {
        var $convert = 10;

        public function convert($summ = 30) {
            $bonus_value = round($summ * $convert / 100);

            return $bonus_value;
        }
    }
?>