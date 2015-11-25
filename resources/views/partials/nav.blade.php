  <nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <a class="navbar-brand" href="{{ url('articles') }}"><i class="glyphicon glyphicon-home"></i>&nbsp;&nbsp;GoodGoto好去处</a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav hoverwhite">
           <li><a href="{{ url('tags/hot') }}"><i class="glyphicon glyphicon-picture" aria-hidden="true"></i>&nbsp;&nbsp;热门</a></li>
           <li><a href="{{ url('articles/create') }}"><i class="glyphicon glyphicon-pencil" aria-hidden="true"></i>&nbsp;&nbsp;投稿</a></li>
           <li><a href="{{ url('guestbook') }}"><i class="glyphicon glyphicon-comment" aria-hidden="true"></i>&nbsp;&nbsp;留言</a></li>
           <li class="dropdown ">
             <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-tags" aria-hidden="true"></i>&nbsp;&nbsp;标签<span class="caret"></span></a>
               <ul class="dropdown-menu" role="menu">           
               <li>
               <a href="{{ url('tags/amaze') }}">新奇哒</a>
               </li>     
               <li>
               <a href="{{ url('tags/cool') }}">酷酷哒</a>
               </li>
               <li>
               <a href="{{ url('tags/cute') }}">萌萌哒</a>
               </li>
               <li>
               <a href="{{ url('tags/shy') }}">羞羞哒</a>
               </li>                  
               <li>
               <a href="{{ url('tags/GIF') }}">GIF</a>
               </li>  
               </ul>
           </li>

           <li><a href="javascript:void(0)" class="dropdown-toggle" id="nav-search"><i class="glyphicon glyphicon-search" aria-hidden="true"></i>&nbsp;&nbsp;搜索<span class="caret"></span></a>
               <div class = "nav-search">
                 {!!Form::open(['method'=>'GET','class'=>'inner-addon  form-control-nav right-addon'])!!}
                    <i class="glyphicon glyphicon-search"aria-hidden="true"></i>
                    {!!Form::input('search','q',null,['placeholder'=>'搜索','class'=>'form-control'])!!}
                 {!!Form::close()!!}
                 </div>
           </li>
      </ul>   

      <ul class="nav navbar-nav navbar-right">          
        @if (Auth::check())
         <li>
            <a href="{{ route('notifications.index') }}" class="text-warning"> 
            <span class="badge-notification-count">          
                    {{ Auth::user()->notification_count }} 
            </span>          
            </a>
         </li>
         
         <li class="dropdown">
         <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="padding-top: 10px;padding-bottom: 0px;">
              <div class="avatar-container-nav">
              @if(file_exists(public_path('/images/avatar/avatar'.Auth::id().'.jpg'))) 
                 <img src="/images/avatar/30avatar{{Auth::id()}}.jpg" id="avatar">
              @else
                 <img src="/images/avatar/30avatardefault.jpg" id="avatar"> 
              @endif
              </div>
         </a>
      
         <ul class="dropdown-menu" role="menu">
         <li><a href="/users/{{Auth::user()->id}}/articles" >
         <span class="glyphicon glyphicon-inbox" aria-hidden="true"></span>
         我的收藏</a></li>
         <li class="divider"></li> 
  
         <li><a href="/settings" >
         <span class="glyphicon glyphicon-wrench" aria-hidden="true"></span>
         我的设置</a></li>
         <li class="divider"></li> 

         <li><a id="bookmark-link" href="javascript:void(0)">
         <span class="glyphicon glyphicon-bookmark"aria-hidden="true"></span>
         续看书签</a></li>
         
         <li class="divider"></li>
         <li><a href="/auth/logout"><span class="glyphicon glyphicon-remove"aria-hidden="true"></span>
         退出</a></li>
         </ul>
         </li>

        @else        
         <li><a style="cursor: pointer;" data-toggle="modal" data-target="#myModallogin"><span class="glyphicon glyphicon-check"aria-hidden="true"></span>
         登陆</a></li>
         <li><a style="cursor: pointer;" data-toggle="modal" data-target="#myModalregister"><span class="glyphicon glyphicon-edit"aria-hidden="true"></span>
         简单注册</a></li>
        @endif
      </ul>
    </div>
  </div>
</nav>
<br>
<!-- Modal login-->
<div class="modal fade" id="myModallogin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">     
      <div style="margin: 10px 20px;">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">登录
            <p><small>社交登录</small></p></h4>
            <ul class="oauth-wrap">
              <li style="height:50px;"><a href="/auth/qq"><i class ="iconfont icon-qq" style="font-size: 50px;"></i></a></li>
              <li style="height:50px;"><a href="/auth/weixin"><i class ="iconfont icon-weixin" style="font-size: 50px;"></i></a></li>
              <li style="height:50px;"><a href="/auth/weibo"><i class ="iconfont icon-weibo" style="font-size: 50px;"></i></a></li>
            </ul>
            <div class="clearfix"></div>
      </div>
      <div class="modal-body">
            <h4><p><small>邮箱登录</small></p></h4>
              <form role="form" method="POST" action="/auth/login">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="form-group">
                      <input type="email" class="form-control" placeholder="E-Mail 地址" name="email" value="{{ old('email') }}">
                  </div>
                  <div class="form-group">
                      <input type="password" class="form-control" placeholder="密码" name="password">
                  </div>     
                  <div class="form-group">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" name="remember"> Remember Me
                        </label>
                      </div>
                  </div>          
                  <div class="form-group">
                      <button  style = "float:left;margin-right:30px;" type="submit" class="btn btn-primary" style="margin-right: 15px;">
                        登陆
                      </button>
                      <div style = "padding-top:7px;">
                      &nbsp;<a href="/auth/register">简单注册</a>
                      &nbsp;&nbsp; • &nbsp;&nbsp;
                      <a href="/password/email">忘记密码？</a>
                      </div>
                  </div>
              </form>
         


        </div>
      </div> 
      </div>
    </div>
  </div>
</div>

<!-- Modal signup-->
<div class="modal fade" id="myModalregister" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">     
      <div style="margin: 10px 20px;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">同志好！</h4>

      </div>    
      <div class="modal-body">
        <form class="form-horizontal" role="form" method="POST" action="/auth/register">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
              <label class="col-sm-3 control-label">名字</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="name">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">E-Mail</label>
              <div class="col-sm-9">
                <input type="email" class="form-control" name="email">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">密码</label>
              <div class="col-sm-9">
                <input type="password" class="form-control" name="password">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">确定密码</label>
              <div class="col-sm-9">
                <input type="password" class="form-control" name="password_confirmation">
              </div>
            </div>
            <div class="form-group">
              <div class = "col-sm-3"></div>
              <div class = "col-sm-9">
                <button type="submit" class="btn btn-primary btn-lg">
                  注册
                </button>
              </div>
            </div>
        </form>
      </div> 
      </div>
    </div>
  </div>
</div>
  

