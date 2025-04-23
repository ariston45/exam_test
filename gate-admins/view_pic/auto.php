
	 <script type="text/javascript" src="../assets/js/jquery-1.12.0.min.js"></script>
    <script type="text/javascript" src="../assets/js/autocomplate/typeahead.js"></script>

		<input type="text" name="txtCountry" id="txtCountry" class="typeahead">

<script>
    $(document).ready(function () {
        $('#txtCountry').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "view_admin/server.php",
					data: 'query=' + query,            
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
						result($.map(data, function (item) {
							return item;
                        }));
                    }
                });
            }
        });
    });
</script>