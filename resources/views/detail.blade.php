@extends('app')

@section('content')
<style>
.answer{
        line-height: 2em;
}
body{
        background: #f6f6f6;
}
#content{
        background:#fff;
        padding:0 40px 20px;
        margin-top: -30px;
}
.row{
    float:none;
    margin:0 auto 50px;
    min-width:300px;
    max-width:600px;
}
.headline{
    padding-top: 40px;
    margin-bottom: -30px;
}
.img-wrap {
    position: relative;
    max-height: 375px;
    overflow: hidden;
    margin-top: -21px;
}
.content img {
    max-width: 100%;
    margin: 10px 0;
    display: block;
}
.question-title{
    padding-top: 50px;
}
.img-wrap .headline-title {
    margin: 20px 0;
    bottom: 10px;
    z-index: 1;
    position: absolute;
    color: white;
    text-shadow: 0px 1px 2px rgba(0,0,0,0.3);
    font-size: 30px;
    line-height: 1.2em;
    padding: 0 40px;
}
.img-mask {
    position: absolute;
    top: 0;
    width: 100%;
    height: 100%;
    background: -moz-linear-gradient(top, rgba(0,0,0,0) 25%, rgba(0,0,0,0.6) 100%);
    background: -webkit-gradient(linear, left top, left bottom, color-stop(25%,rgba(0,0,0,0)), color-stop(100%,rgba(0,0,0,0.6)));
    background: -webkit-linear-gradient(top, rgba(0,0,0,0) 25%,rgba(0,0,0,0.6) 100%);
    background: -o-linear-gradient(top, rgba(0,0,0,0) 25%,rgba(0,0,0,0.6) 100%);
    background: -ms-linear-gradient(top, rgba(0,0,0,0) 25%,rgba(0,0,0,0.6) 100%);
    background: linear-gradient(to bottom, rgba(0,0,0,0) 25%,rgba(0,0,0,0.6) 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#00000000', endColorstr='#99000000',GradientType=0 );
}
.img-wrap .img-source {
    position: absolute;
    bottom: 10px;
    z-index: 1;
    font-size: 12px;
    color: rgba(255,255,255,.6);
    right: 40px;
    text-shadow: 0px 1px 2px rgba(0,0,0,.3);
}
</style>
	<div class="row">

        <div class="img-wrap">
            <h1 class="headline-title">{{$datas['content']['title']}}</h1>
            @if(array_key_exists('image_source',$datas['content']))
            <span class="img-source">图片：{{$datas['content']['image_source']}}</span>
            @endif
            @if(array_key_exists('image',$datas['content']))
            <img src="url?url={{stripcslashes($datas['content']['image'])}}" alt="">
            @endif
            <div class="img-mask"></div>
        </div>
    	<div  id="content"  >
            
                <?php echo $datas['content']['body']  ?>
    	   
    	</div>
    </div> 
    
@endsection
