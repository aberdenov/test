var order_id = 0;

function play() {
	$.post(
		'./../ajax.php', {
			type: "html-request",
			action: 1
	  	},
	  	onPlay
	);
}

function onPlay(data) {
	var info = data.split("#");

	$('div[id^="btn_"]').hide();
	$("#result").html(info[1]);
	$("#btn_"+ info[0]).show();

	order_id = info[2];
}

function send() {
	$.post(
		'./../ajax.php', {
			type: "html-request",
			action: 2,
			order_id: order_id
	  	},
	  	onSend
	);
}

function onSend(data) {

}

function convert() {
	$.post(
		'./../ajax.php', {
			type: "html-request",
			action: 3,
			order_id: order_id
	  	},
	  	onConvert
	);
}

function onConvert(data) {
	$("#result").html(data);
}

function cancel() {
	$.post(
		'./../ajax.php', {
			type: "html-request",
			action: 4,
			order_id: order_id
	  	},
	  	onCancel
	);
}

function onCancel(data) {

}