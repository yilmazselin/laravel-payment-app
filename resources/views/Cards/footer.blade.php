<script src="{{config('app.url')}}assets/js/app.js"></script>
<script>
 $(".delete-card").on("click",function () {
        var id = $(this).data("id");
        if(confirm("Silme işlemini onaylıyor musunuz ?")){
            window.location.href = "{{url('card/delete')}}/"+id;
        }
    })
</script>