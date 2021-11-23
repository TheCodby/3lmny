<div class='row'>
        <div class="col-md-4">
            <input type="text" name='user' id='value' placeholder='Username/Email' class="form-control">
        </div>
        <label for="basic-url" class="form-label">Choose Method</label>
        <div class="col-md-2">
            <select class="form-select" id='searchMethod' aria-label="All">
                <option value='email' selected>Email</option>
                <option value='username' selected>Username</option>
            </select>
        </div>
        <div class="col-md-2">
            <button type='submit' id='searchUser' class="btn btn-primary">Search</button>
        </div>
</div>
<div id="usersData"></div>
<script>
	$(document).ready(function(){
		$('#keywordsSearch').tagsInput();
		$.ajax({
			url:"/Admin/Users/Fetch?Page=1",
			success:function(data)
			{
				$('#usersData').html(data);
			}
		})
		// Ajax for pages
		$(document).on('click', '.page-link', function(event){
			event.preventDefault();
			var page = $(this).attr('href').split('Page=')[1];
			var url = "/Admin/Users/Fetch?Page="+page
			if(isSearchUser){
				var value = $('#value').val();
                var searchMethod = $('#searchMethod').val();
				url = `/Admin/Users/Filter?method=${searchMethod}&value=${value}`;
			}
			fetch_page(url);
		})
		function fetch_page(url)
		{
			$("#usersData").html('<div class="d-flex justify-content-center"> <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status"> <span class="visually-hidden">Loading...</span> </div> </div>');
			$.ajax({
				url:url,
				success:function(data)
				{
					$('#usersData').html(data);
				}
			})
		}
		// Ajax for search
		$(document).on('click', '#searchUser', function(event){
			event.preventDefault();
			var value = $('#value').val();
            var searchMethod = $('#searchMethod').val();
			var data = `?method=${searchMethod}&value=${value}`
			filter(data);
		})
		function filter(data)
		{
			$("#usersData").html('<div class="d-flex justify-content-center"> <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status"> <span class="visually-hidden">Loading...</span> </div> </div>');
			$.ajax({
				type : 'GET',
				url:"/Admin/Users/Filter"+data,
				success:function(response)
				{
					$('#usersData').html(response);
				}
			})
		}
	});
</script>