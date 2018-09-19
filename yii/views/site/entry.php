<?php
	use yii\helpers\Html;
	use yii\widgets\ActiveForm;
?>
<?php $form = ActiveForm::begin(); ?>
	
	<?= $form->field($model, 'name') ?>

   	<?= $form->field($model, 'password')->input('password'); ?>

    <div class="form-group">
        <?= Html::submitButton('Получить', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>