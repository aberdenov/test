<?php
	namespace app\models;

	use yii\base\Model;

	class EntryForm extends Model
	{
	    public $name;
	    public $password;
	    public $money_min = 100;                       // минимальная сумма денежного приза
	    public $money_max = 10000;                     // максимальная сумма денежного приза

	    public $bonus_min = 100;                       // минимальная сумма бонуса
	    public $bonus_max = 10000;                     // максимальная сумма бонуса

	    public function rules()
	    {
	        return [
	            [['name', 'password'], 'required'],
	        ];
	    }

	    public function getPrice() 
	    {
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
	    }
	}
?>