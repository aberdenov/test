<script language="JavaScript" type="text/javascript">
	function checkFields(user_form, msg) {
		for (var i = 0; i < user_form.length; i++) {
			if (user_form[i].type == "text") user_form[i].style.background = '#FFFFFF';
		}
		
		for (var i = 0; i < user_form.length; i++) {
			if (user_form[i].type == "text" || user_form[i].type == "textarea" || user_form[i].type == "password") {
				if (user_form[i].id == 1 && user_form[i].value == '') {
					if (msg != '') alert(msg);
					user_form[i].style.background = '#FFF9DF';
					user_form[i].focus();
					return false;
				}
			}
		}
		
		return true;
	}
</script>

<form method="post" action="" onsubmit="return checkFields(this, 'Введите логин и пароль!')">
<div class="title">Вход в систему</div>

{MSG}

<div class="form_container">
	<div class="form_label1">Логин:</div><!-- 
	 --><div class="form_label2"><input type="text" class="textbox" name="login" maxlength="15" value="{USR_LOGIN}" accesskey="L"></div>

	<div class="form_label1">Пароль:</div><!-- 
	 --><div class="form_label2"><input type="password" class="textbox" name="password" maxlength="30" value="{USR_PASSW}" accesskey="P"></div>
	
	<div class="form_label1"></div><!-- 
	 --><div class="form_label2"><input type="checkbox" name="chk_save" id="chk_save" value="checkbox" accesskey="S" {SAVE}>&nbsp;<label for="chk_save">запомнить</label></div>

	<div class="center"><input type="submit" class="button" value="Войти" accesskey="E"></div>
</div>
</form>
