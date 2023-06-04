
<script>
    function loading() {
        $("#form-login").on('submit', function() {
            $(".btn .btn-login").show();
            $(".btn .btn-text").html("Loading");
            $("#submit").attr("disabled", "disabled");
        });
    }

    $(document).ready(function () {
		$(".alert-danger").fadeOut(5000);
	});
</script>