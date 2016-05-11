var postId = 0;
var postBodyElement = null;

$('.edit-modal-btn').on('click', function(e){
    e.preventDefault();
    postBodyElement = e.target.parentNode.parentNode.childNodes[1];
    var postBody = postBodyElement.textContent;
    postId = e.target.parentNode.parentNode.dataset['postid'];

    $('#post-body').val(postBody);
    $('#edit-modal').modal();
});

$('#modal-save').on('click', function(){
    $.ajax({
        method: 'POST',
        url: urlEdit,
        data: {
            body: $('#post-body').val(),
            postId: postId,
            _token: token
        }
    }).done(function(msg){
        $(postBodyElement).text(msg.new_body);
        $('#edit-modal').modal('hide');
    });
});

$('.like').on('click', function(e){
    e.preventDefault();
    var isLike = event.target.previousElementSibling == null;
    postId = e.target.parentNode.parentNode.dataset['postid'];
    $.ajax({
        method: 'POST',
        url: urlLike,
        data: {
            isLike: isLike,
            postId: postId,
            _token: token
        }
    }).done(function(msg){
        e.target.innerText = isLike ? e.target.innerText == 'Like' ? 'You like this post' : 'Like' : e.target.innerText == 'Dislike' ? 'You don\'t like this post' : 'Dislike';
    });
});
