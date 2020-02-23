# cms

## notes
[fix] - posts shows all posts, but click on trash will show all posts not trashed-posts
[no joy] - syntastic vim plugin
[sorted] - image not showing '{{ asset($post->image) }}'
    . the image url is wrong, shows as http://localhost:8000/posts/N08dJ....jpeg
    . how to fix that url?
        . <img src="{{ asset('/storage/' . $post->image) }}" alt="" style="width: 100%">
