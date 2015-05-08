$(document).ready(function (){
//双击将选中的option追加至select2中
$("#select_main1").dblclick(function (){

$("#select_main1 option:selected").prependTo("#select_main2");
var selectval = $('#select_main1').val();
});

//双击将选中的option追加至select1中
$("#select_main2").dblclick(function (){

$("#select_main2 option:selected").prependTo("#select_main1");
var selectval = $('#select_main2').val();
});
});

$(document).ready(function (){

$("#select_main3").dblclick(function (){

$("#select_main3 option:selected").prependTo("#select_main4");
var selectval = $('#select_main3').val();
});

$("#select_main4").dblclick(function (){

$("#select_main4 option:selected").prependTo("#select_main3");
var selectval = $('#select_main4').val();
});
});

