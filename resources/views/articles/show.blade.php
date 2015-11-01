@extends('app')

@section('content')
    <div class = "col-md-8">
        <div class = "width480">	
            <h2>{{$article->title}}</h2>
            <h3 style="padding-bottom: 10px; margin-top: 0px;"><small><a href="/users/{{$article->user_id}}/articles">作者：{{\App\User::find($article->user_id)->name}}</a>
            @unless ($article->tags->isEmpty())
            标签 |
            @foreach($article->tags as $tag)
            <a href="{{ url('/tags',['name'=>$tag->name]) }}" title="{{ $tag->name }}" target="_blank">{{ $tag->name }}</a>
            @endforeach  
            @endif</small>
            @if($previous)
                <div class = "pull-right">
                    <a href="{{ action('ArticlesController@show', $next)}}">
                    <button  type="button"  
                             class="btn btn-default"><i class="glyphicon glyphicon-chevron-left"></i>          
                    </button>
                    </a>
                    <a href="{{ action('ArticlesController@show', $previous)}}">
                    <button  type="button"  
                             class="btn btn-default"><i class="glyphicon glyphicon-chevron-right"></i>         
                    </button>
                    </a>
                </div>
            @endif</h3>

        <!--article -->
        @if($article->type == '.jpg')
        <img src="/images/catalog/{{$article->photo}}{{$article->type}}" alt="{{$article->title}}">
        @endif

        @if($article->type == '_long.jpg')
        <img src="/images/catalog/{{$article->photo}}_long.jpg" alt="{{$article->title}}">
        @endif

        @if($article->type == '.mp4')
        <div class = "video_wrap">
        <h2 class="video_text">Gif</h2>
        <video  width="480" min-height="300" loop preload="auto">
        <source src="/images/catalog/{{$article->photo}}{{$article->type}}" type="video/mp4">
        Your browser does not support the video tag.
        </video></div>
        @endif
        <h5><strong><span id="b{{$article->photo}}">{{$article->vote_count}}</span>赞
        <span>&nbsp; • &nbsp;</span>{{$article->reply_count}}互动
        <span>&nbsp; • &nbsp;</span>{{$article->view_count}}观摩
        </strong></h5>
        </div><!-- width480 -->

            <div class="width485 btn-vote-reply votebookmark">
                <li><button  type="button"   
                         class="btn btn-default index-upvote"              
                         data-id="{{$article->photo}}"
                         data-toggle="tooltip" data-placement="bottom" title="点赞"><i class="glyphicon glyphicon-thumbs-up"></i>
                </button></li>
                <li><button  type="button"  
                         class="btn btn-default index-bookmark"
                         data-id="{{$article->photo}}"data-title="{{$article->title}}"
                         data-toggle="tooltip" data-placement="bottom" title="书签"><i class="glyphicon glyphicon-bookmark"></i>           
                </button></li>


                @if(Auth::check())
                @if (Auth::user()->can("manage_topics") || Auth::user()->id == $article->user_id) 
                    <li><a href="{{ action('ArticlesController@edit', [$article->photo])}}">
                    &nbsp;&nbsp;<button class="btn btn-warning"><i class="glyphicon glyphicon-edit"></i></button>
                    </a></li>
                    <li style="float: left" id = 'confirm'>
                    {!! Form::open(array('route' => array('articles.destroy', $article->photo), 'method' => 'delete')) !!}
                        <button type="submit" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button>&nbsp;&nbsp;&nbsp;
                    {!! Form::close() !!} 
                    </li>      
                @endif
                @endif
                    <div class="pull-right bdsharebuttonbox" data-tag="share_1">
                    <a class="bds_weixin" data-cmd="weixin" data-photo="{{$article->photo}}" data-type="{{$article->type}}"data-title="{{$article->title}}"data-toggle="tooltip" data-placement="bottom" title="分享微信"></a>
                    <a class="bds_tsina" data-cmd="tsina"data-photo="{{$article->photo}}"data-type="{{$article->type}}"data-title="{{$article->title}}"data-toggle="tooltip" data-placement="bottom" title="分享微博"></a>
                    <a class="bds_qzone" data-cmd="qzone" href="#"da@ta-photo="{{$article->photo}}"data-type="{{$article->type}}"data-title="{{$article->title}}"data-toggle="tooltip" data-placement="bottom" title="分享QQ空间"></a>         
                    </div> 
                    <div class="clearfix"></div>
            </div>
            <hr>

        <!-- Reply -->
        <div class = "reply_list">
            @foreach($article->replies as $reply)
            <span class="anchor" id="{{$reply->id}}"></span>
            <article class="list-item" style="margin-top: 0px;">
                <h4 style="float:left;"><a href="{{ route('users.articles', [$reply->user_id]) }}"> {{\App\User::find($reply->user_id)->name}}</a>
                <small>{{ $reply->created_at }}</small></h4>
                
                <!-- Reply upvote/reply on reply-->
                <ul class = "pull-right btn-vote-reply" style="margin-bottom: 0px;">
                @if(Auth::check())
                @if (Auth::user()->can("manage_topics") || Auth::user()->id == $reply->user_id) 
                <li>{!! Form::open(array('route' => array('replies.destroy', $reply->id), 'method' => 'delete','style'=>"float:left")) !!}
                <button type="submit" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button>
                {!! Form::close() !!}</li>
                @endif
                @endif
                &nbsp;&nbsp;
                <li><span id="br{{$reply->id}}">{{$reply->vote_count}}</span>个赞</li>
                <li><button  type="button"   
                         class="btn btn-default show-upvote"              
                         data-id="{{$reply->id}}"
                         data-toggle="tooltip" data-placement="bottom" title="点赞"><strong><i class="glyphicon glyphicon-thumbs-up"></i></strong>
                </button></li>
                <li><button class="btn btn-warning"  href="javascript:void(0)" onclick="replyOne('{{ $reply->user->name }}');" data-toggle="tooltip" data-placement="bottom" title="@.Ta">@</button></li>
                </ul>
                
                <!-- Reply body-->
                <br><br>
                回复:&nbsp;{{$reply->body}}
                <hr>
            </article>
            @endforeach
        </div>
        
        <!-- Reply box-->   
        <div class="reply-box form box-block">
            {!! Form::open(['route' => 'replies.store', 'id' => 'reply-form', 'method' => 'post']) !!}
            <input type="hidden" name="article_id" value="{{ $article->id }}" />

            <div class="form-group">
            @if(Auth::check())
            {!! Form::textarea('body', null, ['class' => 'form-control',
                                                         'rows' => 3,
                                                         'placeholder' => '请发布评论，@用户将收到通知',
                                                         'style' => "overflow:hidden",
                                                         'id' => 'reply_content']) !!}
            @else
            {!! Form::textarea('body', null, ['class' => 'form-control', 'disabled' => 'disabled', 
                                                         'rows' => 3,
                                                         'placeholder' => '请先登陆后发布评论',
                                                         'style' => "overflow:hidden",
                                                         'id' => 'reply_content']) !!}
            @endif
            </div>

            <div class="form-group status-post-submit">
            @if(Auth::check())
            {!! Form::submit('回复', ['class' => 'btn btn-primary', 'id' => 'reply-create-submit']) !!}
            @endif
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    @include('sidebar')
@stop

