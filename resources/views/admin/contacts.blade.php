<div id="contactsData"></div>
<script>
	$(document).ready(function(){
		$.ajax({
			url:"/Admin/Contacts/Fetch?Page=1",
			success:function(data)
			{
				$('#contactsData').html(data);
			}
		})
		// Ajax for pages
		$(document).on('click', '.page-link', function(event){
			event.preventDefault();
			var page = $(this).attr('href').split('Page=')[1];
			fetch_page(page);
		})
		function fetch_page(page)
		{
			$("#contactsData").html('<div class="d-flex justify-content-center"> <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status"> <span class="visually-hidden">Loading...</span> </div> </div>');
			$.ajax({
				url:"/Admin/Contacts/Fetch?Page=" + page,
				success:function(data)
				{
					$('#contactsData').html(data);
				}
			})
		}
	});
</script>