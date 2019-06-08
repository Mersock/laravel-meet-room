$(document).ready(function(){
    $('.datepicker').datepicker({
        language: "th-th",
        autoclose: true,
        todayHighlight: true,
        isBuddhist: true, 
        format: "dd/mm/yyyy",
        orientation: "bottom auto"
    });

    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; 
    var yyyy = today.getFullYear();
    if(dd<10) {
        dd = '0'+dd
    } 
    if(mm<10) {
        mm = '0'+mm
    } 
    today = dd + '/' + mm + '/' + yyyy;
    $('.datepicker-now').datepicker({
        startDate: today,
        language: "th-th",
        autoclose: true,
        todayHighlight: true,
        isBuddhist: true, 
        format: "dd/mm/yyyy",
        orientation: "bottom auto"
    });
});