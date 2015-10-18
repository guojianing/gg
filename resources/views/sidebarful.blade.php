<div class="col-md-4 side-bar">
    <div id="side-bar-related-height">
		<div id="carousel-example-generic" class="carousel slide" data-ride="carousel" style="width:100%;">
		  <!-- Indicators -->
		  <ol class="carousel-indicators">
		    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
		    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
		    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
		  </ol>

		  <!-- Wrapper for slides -->
		  <div class="carousel-inner" role="listbox">
		    <div class="item active">
		      <img src="/images/catalog/rock.jpg">
		    </div>
		    <div class="item">
		      <img src="/images/catalog/grooves.jpg">
		    </div>
		    <div class="item">
		      <img src="/images/catalog/arch.jpg">
		    </div>
		  </div>

		  <!-- Controls -->
		  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
		    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
		    <span class="sr-only">Previous</span>
		  </a>
		  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
		    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
		    <span class="sr-only">Next</span>
		  </a>
		</div>
				<p style="text-align: center" class="text-info">
			    这里投放广告， 联系方式QQ:401789679。
			    </p>
			    <br>
		    
		    <div class = "width100">
		        <ul class="hot-tabs bule-line-top">	    
				<li id="tab-votes" class = "current" >热门投票</li>
				<li id="tab-replies" class ="hot_tab_last">热门评论</li>
			    </ul>
			    <div class="clearfix"></div>
		        
		        <div class = "hot-list-item hot-list-item-current" id = "list-votes">
		        <br>
				@foreach($hotimgs as $index =>$hot)
				<article class="list-item side-bar-hot panel panel-default">
			       <div class= "panel-heading">
			       <h5 style="margin-bottom: 0px; margin-top: -5px;"><a href="/users/{{$hot->user_id}}/articles">{{\App\User::find($hot->user_id)->name}}</a>的图片
				   <a href="{{ action('ArticlesController@show', [$hot->photo])}}"target="_blank" >{{$hot->title}}<span class="label label-warning inline-block pull-right">#{{$index+1}}</span></a></h5>
				   </div>
				   <img src="/images/catalog/{{$hot->photo}}{{$hot->type}}" class = "side-bar-hot-img" alt="{{$hot->title}}">
			       <div class = "show_more">展开</div>
				</article>
				@endforeach
				</div>


		        
		        <div class = "hot-list-item" id = "list-replies">
		        <br>
				@foreach($hotreplies as  $index =>$hot)
				<article class="list-item side-bar-hot panel panel-default">
			       <div class= "panel-heading">
			       <h5 style="margin-bottom: 0px; margin-top: -5px;"><a href="/users/{{$hot->article->user_id}}/articles">{{\App\User::find($hot->article->user_id)->name}}</a>的发布
		           <a href="{{ action('ArticlesController@show', [$hot->article->photo])}}"target="_blank" >{{$hot->article->title}}
				   <a href="{{ action('ArticlesController@show', [$hot->photo])}}"target="_blank" >{{$hot->title}}<span class="label label-warning inline-block pull-right">#{{$index+1}}</span></a></h5>
		           </div>
		           <div class="panel-body">
			       <h5 style="padding-bottom: 0px; margin-top: 0px;"><a href="/users/{{$hot->user_id}}/articles">{{\App\User::find($hot->user_id)->name}}</a>	
				   回复:{{$hot->body}}</a></h5>
				   </div>
				</article>
				@endforeach
				</div>

			</div>

	</div>

	<div class = "sticky" style="position: static; top: 0px;">
	    <img src="/images/catalog/sunset.jpg" class = "width100">
	    <p style="text-align: center" class="text-info">
	    <br>
	    联系方式QQ:401789679，现在备案中，诚邀共同合作等等。
	    </p>
	</div>

          
</div>