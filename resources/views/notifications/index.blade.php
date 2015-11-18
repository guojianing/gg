@extends('app')

@section('content')

    @if (count($notifications))
        <div>
              <h2>通知中心
              <div id = 'confirm' class = "pull-right inline-block">
                    {!! Form::open(array('route' => array('notifications.destroy'), 'method' => 'delete')) !!}
                        <button type="submit" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> 清空</button>&nbsp;&nbsp;&nbsp;
                    {!! Form::close() !!} 
              </div></h2>     
             <ul class="list-group row">
              
              @foreach ($notifications as $notification)
                <li class="list-group-item" style="margin-top: 0px;border-left:1px;border-right:1px;">
                @if (count($notification->article))
                <div class="infos">
                    @if (count($notification->from_user_id))
                    <a href="{{ route('users.articles', [$notification->from_user_id]) }}">
                    {{ $notification->fromUser->name }}
                    </a>
                    @else
                    匿名
                    @endif
                {{ $notification->present()->lableUp }}
                <a href="{{ route('articles.show', [$notification->article->photo])}}">
                {{{ str_limit($notification->article->title, '100') }}}
                </a>
                    于{{ $notification->created_at }}
                <div>
                @if ($notification->body)
                评论：{{ $notification->body }}
                @endif
                </div>
                </div>
                @else
                <div class="deleted text-center">Data has been deleted.</div>
                @endif
                </li>
              @endforeach
            </ul>
        </div>
    @else
        <div class="alert alert-info" role="alert">
           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>               
           <strong>您暂时还没有什通知或信息！</strong>
        </div>
    @endif

@stop