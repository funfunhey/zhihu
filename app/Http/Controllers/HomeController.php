<?php namespace App\Http\Controllers;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	
	public function __construct()
	{
		//$this->middleware('auth');
		$this->url = 'http://news-at.zhihu.com/api/4/news/';
		$this->themeurl = 'http://news-at.zhihu.com/api/4/themes';
		$this->shorturl = 'http://news-at.zhihu.com/api/4/';
		$this->hoturl = 'http://news-at.zhihu.com/api/3/news/hot';
		$this->columnurl = 'http://news-at.zhihu.com/api/3/sections';
		$this->columndetailurl = 'http://news-at.zhihu.com/api/3/section/';
	}


	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index($type,$id=null,$date=null)//id 某些情况是date
	{
		$data['themes'] = $this->getUrlContent($this->themeurl);
		$data['column'] = $this->getUrlContent($this->columnurl);
		$data['prepage'] = $data['nextpage'] = null;
		$data['type'] =$type;

		switch ($type) {
			case 'latest':
				$data['title']  = '最新';			
				//http://news.at.zhihu.com/api/4/news/before/20131119
				$isbefore = $this->beforedate($data,$id);
				if($isbefore){//过去时间点
					$data['title']  = '最新-'.$id;
					$news = json_decode(@file_get_contents($this->url.'before/'.$id),true);
				}else{
					$news = json_decode(@file_get_contents($this->url.'latest'),true);
				}			
				$data['content']  = $news['stories'];	
				break;
			case 'top':
				$data['title']  = '头条';
				$news = json_decode(@file_get_contents($this->url.'latest'),true);
				$data['content']   = $news['top_stories'];
				break;
			case 'oldnews':
				$data['title']  = '20131119'.'内容';
				$news = json_decode(@file_get_contents($this->url.'latest'),true);
				$data['content']  = $news['stories'];
				break;
			case 'theme':
				$news = json_decode(@file_get_contents($this->shorturl.'theme/'.$id),true);
				$data['title']  = $news['name'];
				$data['content']  = $news['stories'];
				
				break;
			case 'section':	
				//http://news-at.zhihu.com/api/3/section/1/before/1398780001	
				$isbefore = $this->beforedate($data,$date,20);//20天前的数据

				if(!$isbefore){
					$news = json_decode(@file_get_contents($this->columndetailurl.$id),true);
				}else{
					$news = json_decode(@file_get_contents($this->columndetailurl.$id.'/before/'.$date),true);
				}	
				
				$data['title'] = $news['name'];
				$data['content'] = $news['stories'];			
				break;
			//http://news-at.zhihu.com/api/3/news/hot
			case 'hot':
				$news = json_decode(@file_get_contents($this->hoturl),true);
				$data['title']  = '热门';
				$data['content']  = $news['recent'];
				return view('hot')->with('datas',$data);
				break;
			default:
				abort(404);
				break;
			
		}

		return view('home')->with('datas',$data);
       // var_dump(file_get_contents('http://p2.zhimg.com/10/7b/107bb4894b46d75a892da6fa80ef504a.jpg'));
		
	}

	private function beforedate(&$data,$id=null,$date=1){
		if((preg_match("/^20[0-9]{6}$/",$id)&& (date('Ymd',time()) >= $id))||  ((preg_match("/^[0-9]{10}$/",$id)) && time()>=$id) ){
				$data['prepage'] = date('Ymd' , strtotime($id.' +'.$date.' day'));
				$data['nextpage'] = date('Ymd' , strtotime($id.' -'.$date.' day'));	
				return true;			
		}else{
			$data['nextpage'] = date('Ymd' , strtotime('-'.$date.' day'));
			
		}
		return false;
	}
	private function getUrlContent($kindurl){
		$themes = json_decode(@file_get_contents($kindurl),true);
		return $themes;
	}
/*
	private function filterimg($data,$multi=null){//是否有多种图片
		//过滤内容
		if($multi){
			foreach($data as $data_key=>$data_v){
				if(array_key_exists('images',$data_v)){
					foreach($data_v['images'] as $img_k=>$img_v){
							$data[$data_key]['images'][$img_k] = 'url?url='.urlencode(stripcslashes($img_v)) ;
					} 
				}

			}			
		}else{
			foreach($data as $data_key=>$data_v){
				if(array_key_exists( 'image',$data_v)){
				 	$data[$data_key]['image'] = 'url?url='.urlencode(stripcslashes($data_v['image'])) ;
				}else if(array_key_exists( 'thumbnail',$data_v)){
					$data[$data_key]['thumbnail'] = 'url?url='.urlencode(stripcslashes($data_v['thumbnail'])) ;
				}
			}			
		}
		return $data;
	}

	private function filterOneimg(&$data){
		$data = 'url?url='.urlencode(stripcslashes($data)) ;
		return $data;
	}
*/
	public function urlToimg(){
		$url = $_GET['url'];
		if(preg_match("/^http(.*).zhimg.com(.*).[jpg|png]$/",$url)){
			$urlResource = @file_get_contents($url);
			header('content-type:image;');
			echo $urlResource;
		}
		
	}


	public function detail($id){
		$data['themes'] = $this->getUrlContent($this->themeurl);
		$data['column'] = $this->getUrlContent($this->columnurl);
		$data['content'] = json_decode(file_get_contents($this->url.$id),true);
		// $data = file_get_contents('http://news-at.zhihu.com/api/4/news/'.$id);
		
		$data['content']['body'] = preg_replace("/(http:(.*?).zhimg.com(.*?).[jpg|png])/",'url?url='.stripcslashes('$1'),$data['content']['body']);
		return view('detail')->with('datas',$data);
	}

}
