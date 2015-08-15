<?php namespace App\Http\Controllers;
                 
use App\Article;
use App\Vote;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use Carbon\Carbon;
use Illuminate\HttpResponse;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Requests\ArticleRequest;

class ArticlesController extends Controller {


	public function __construct(){
		$this->middleware('auth', ['except' => ['index', 'show']]);
	}


	public function index()
	{
        //DB危险
		$articles = DB::table('articles')->orderBy('updated_at', 'desc')->paginate(30);
        //http://example.com/custom/url?page=N, you should pass custom/url to the setPath
		$articles->setPath('articles');

		return view('articles.index',compact('articles'));
	}

	public function show(\App\Article $article)
	{
		$article->increment('view_count', 1);
		return view('articles.show',compact('article'));
	}

	public function create()
	{
		$tags = \App\Tag::lists('name', 'id');
		
		return view('articles.create', compact('tags'));
	}

	/**
	 * [store description]
	 * @param  ArticleRequest
	 * @return [type]
	 */
	public function store(ArticleRequest $request)
	{
	  
        $this->createArticle($request);
 
		return redirect('articles')->with([
                'flash_message' => 'good job!你的文章成功创建！',
                'flash_message_important' => true
			]);
	}


	public function edit(\App\Article $article)
	{
        $tags = \App\Tag::lists('name', 'id');
		return view('articles.edit', compact('article', 'tags'));
	}


	public function update(\App\Article $article, ArticleRequest $request)
	{

		$article->update($request->all());

		$this->syncTags($article, $request->input('tag_list'));

		return redirect('articles');
	}
    	/**
	 * Sync up the list of tags in the database
	 *
	 * @param  Article $article
	 * @param  array   $tags
	 */
	private function syncTags(\App\Article $article, array $tags)
	{
		$article->tags()->sync($tags);
	}

	/**
	 * Save a new article
	 * @param  ArticleRequest $request
	 * @return mixed
	 */
	private function createArticle(ArticleRequest $request)
	{
 
        
		$article = Auth::user()->articles()->create($request->all());

		$this->syncTags($article, $request->input('tag_list', []));
        
        //获取收到“image”并存储
		$imageName = $article->id . '.' . 
        $request->file('image')->getClientOriginalExtension();
        $request->file('image')->move(
        base_path() . '/public/images/catalog/', $imageName
    );  
        Image::make(base_path() . '/public/images/catalog/' . $imageName)
        ->resize(460, null, function ($constraint) {$constraint->aspectRatio();})
        ->insert(base_path() . '/public/images/catalog/watermark.jpg', 'right')
        ->save(base_path() . '/public/images/catalog/' . $imageName);
        
        //保存存储名字和extension
        $article->photo = $imageName;
        $article->save();
		return $article;
	}

   public function upvote($id)
    {
        $article = Article::find($id);
        if ($article->votes()->ByWhom(Auth::id())->WithType('upvote')->count()) {
            // click twice for remove upvote
            $article->votes()->ByWhom(Auth::id())->WithType('upvote')->delete();
           $article->decrement('vote_count', 1);
        } else {
            // first time click
            $article->votes()->create(['user_id' => Auth::id(), 'is' => 'upvote']);
            $article->increment('vote_count', 1);}
            return $article->vote_count;
    }
}
    // public function downvote($id)
    // {
    //     $article = Article::find($id);
    //     App::make('good\Vote\Voter')->articleDownVote($article);
    //     return Redirect::route('articles.show', $article->id);
    // }
