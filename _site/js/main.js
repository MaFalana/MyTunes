// JavaScript Document

$('.button').click(function() 
{
  $.ajax({
    type: "POST",
    url: "some.php",
    data: { name: "John" }
  }).done(function( msg ) {
    alert( "Data Saved: " + msg );
  });
});


	function likeSong()
	{
    		$.ajax(
		{
			url:"library.class.php", 
			success:function(result)
			{
   				$("div").text(result);
			}
		})
	} 