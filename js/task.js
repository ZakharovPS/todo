window.onload = function () {
	let comments = $('.comments')
	let id = $('.card').data('id');
	$.ajax({
		type: 'get',
		url: 'https://jsonplaceholder.typicode.com/comments?postId=' + id,
		success: function (data) {
			data.forEach(function (elem) {
				let card = document.createElement('div');
				card.className = 'card p-3 mb-3';

				let comment = document.createElement('p');
				comment.className = 'card-text';
				comment.textContent = elem.body;

				comments.after(card);
				card.append(comment);
			});
		}
	});
}

$('.editButton').click(function () {
	$('.form-add').removeClass("d-none");
	let id = $('.card').data('id');
	$('.confirmButton').click(function () {
		let name = $('#newName').val().trim();
		let description = $('#newDescription').val().trim();
		if (name == "") {
			$('#error').text("Введите название задачи");
		} else if (description == "") {
			$('#error').text("Введите описание задачи");
		} else
			$.ajax({
				url: "php/edit.php",
				type: "POST",
				data: ({ id: id, name: name, description: description }),
				dataType: "html",
				success: function (data) {
					$('#error').text("");
					$('.form-add').addClass("d-none");
					$('#name').text(name);
					$('#description').text(description);
				}
			});
	})
})