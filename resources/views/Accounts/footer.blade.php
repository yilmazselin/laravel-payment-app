<script src="{{config('app.url')}}assets/js/app.js"></script>
<script>
 $(".delete-account").on("click",function () {
        var id = $(this).data("id");
        if(confirm("Silme işlemini onaylıyor musunuz ?")){
            window.location.href = "{{url('account/delete')}}/"+id;
        }
    })
</script>