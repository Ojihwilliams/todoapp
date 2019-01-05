$(function(){
$('.fa-plus').click(function(event) {
	$('.list-input').fadeToggle();
});
$('#container li').click(function(){
	$(this).toggleClass('completed');	
});
$('#container #delete').click(function(e){
	var item_id = $(this).data('item');
	$.post('http://localhost/todolist/core/ajax/delete.php', {item_id:item_id}, function(data){
		location.reload();
	}); 

	e.stopPropagation();
});

$('.list-input').keypress(function(event) {
	if (event.which === 13) {
		var todoText = $(this).val();
		var user_id  = $(this).data('user');

		$(".list").append("<li><span id='delete'><i class='fa fa-trash'></i></span>" + todoText + "</li>");
		$.post('http://localhost/todolist/core/ajax/add.php', {item:todoText, user_id:user_id}, function(data) {
			$(".list").append();
			location.reload();
		});
	}
});
});