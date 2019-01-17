function clicked() {
    alert("Clicked!");
}

function colorChange() {
	var textbox_id = "txtColor";
	var textbox = document.getElementsByClassName(textbox_id);

	var div_class = "t1";
	var div = document.getElementsByClassName(div_class);

	// We should verify values here before we use them...
	var color = textbox.value;
	div.style.backgroundColor = color;
}