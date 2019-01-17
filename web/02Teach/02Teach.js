function clicked() {
    alert("Clicked!");
}

function colorChange() {
    var tb_id = "txtCol";
    var tb = document.getElementById(tb_id);
    var div_id = "t1";
    var div = document.getElementById(div_id);
    var color = textbox.value;
    div.style.backgroundColor = color;
}