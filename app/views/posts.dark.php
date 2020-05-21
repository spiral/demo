<extends:layout.base title="Posts"/>

<define:body>
  @foreach($posts as $post)
    <div class="post">
      <div class="title">
        <a href="@route('post.view', ['id' => $post->id])">{{$post->title}}</a>
      </div>
      <div class="author">{{$post->author->name}}</div>
    </div>
  @endforeach
</define:body>
