<script src="{{config('app.asset_url')}}js/jquery.inputmask.min.js"></script>
<script>
$(document).ready(function(){
  $("#price").inputmask('decimal', {
    'alias': 'numeric',
      'groupSeparator': '.',
      'digits': 0,
      'radixPoint': ",",
      'digitsOptional': true,
      'allowMinus': false,

  }); 
});
</script>