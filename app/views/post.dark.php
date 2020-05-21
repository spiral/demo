<extends:layout.base title="Posts"/>

<define:body>
  <div class="post">
    <div class="title">{{$post->title}}</div>
    <div class="author">{{$post->author->name}}</div>
  </div>
  <div class="comments">
    @foreach($post->comments as $comment)
      <div class="comment">
        <div class="message">{{$comment->message}}</div>
        <div class="author">{{$comment->author->name}}</div>
      </div>
    @endforeach
  </div>
</define:body>
