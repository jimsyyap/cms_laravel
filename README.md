# cms

## notes
[ fix ] - Trying to get property 'id' of non-object (View: /home/jim/builtosell/cmsbahd/resources/views/posts/_posts.blade.php)
            . deleted categories, redirect to somewhere, gets error
[sorted] - posts shows all posts, but click on trash will show all posts not trashed-posts
            . ul>li was us>li
            . bahdcasts repo code is different from tutorial code
                . withTrashed() should be onlyTrashed()
[ test=no joy ] - syntastic vim plugin
[sorted] - image not showing '{{ asset($post->image) }}'
    . the image url is wrong, shows as http://localhost:8000/posts/N08dJ....jpeg
    . how to fix that url?
        . <img src="{{ asset('/storage/' . $post->image) }}" alt="" style="width: 100%">

<!-- repository https://t.ly/AXZMG -->
