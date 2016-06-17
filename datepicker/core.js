$(document).ready(function() {

    $('#datepicker').Zebra_DatePicker();

    $('#datedebut').Zebra_DatePicker({
        pair: $('#datefin')
    });

    $('#datefin').Zebra_DatePicker({
        direction: 1
    });

});