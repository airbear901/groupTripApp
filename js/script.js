
      $(function() {
    $( "#from" ).datepicker({
      defaultDate: "+1d",
      changeMonth: true,
      numberOfMonths: 2,
      dateFormat: 'yy-mm-dd',
      onClose: function( selectedDate ) {
        $( "#from" ).datepicker( "option", "minDate", selectedDate );
      }
    });
    $( "#to" ).datepicker({
      defaultDate: "+1d",
      changeMonth: true,
      numberOfMonths: 2,
      dateFormat: 'yy-mm-dd',
      onClose: function( selectedDate ) {
        $( "#to" ).datepicker( "option", "maxDate", selectedDate );
      }
    });
  });
