@extends('app')

@section('content')
<style>
    body{
            background: #f6f6f6;
    }
    #content{
            float:none;
        margin:0 auto;
        min-width:300px;
        max-width:600px;
    }
    .panel-heading{
        border-bottom:1px solid #f6f6f6;
    }
    .next-page{
        left: 75%;
    }
    .pre-page{
        left:18%;
    }
    .page a:hover,.page a{
        color:white !important;
        text-decoration: none; 
    }
    .page:hover{
        background-color:rgba(0,0,0,0.5);
    }
    .page{
        height:100px;
        width:100px;
        border-radius:10px;
        background-color:rgba(0,0,0,0.1);
        position: absolute;     
        top: 50%;
        font-size:80px;
        text-align:center;
        color:white !important;
        text-decoration: none; 
    }
</style>
    @if($datas['prepage'])
    <div class="pre-page page">
         ＜
    </div>
    @endif
	<div class="row">
	<div  id="content" >
        <div class="panel ">
            <!-- Default panel contents -->
            <div class="panel-heading" style="font-size:20px;">{{$datas['title']}}</div>
    		<ul class="list-group" >
            @foreach($datas['content'] as  $topstory)
                <a class="list-group-item" style="height:100px;" target="_blank" href="detail-{{$topstory['id']}}">
                <span class="col-md-10 col-lx-12  " >{{$topstory['title']}}</span>
                @if(array_key_exists('image',$topstory))
                    <img src="url?url={{$topstory['image']}}" style="width:80px;height:80px"  /> 
                @elseif(array_key_exists('images',$topstory))
                    @foreach($topstory['images'] as $img)
                    <img src="url?url={{$img}}" style="width:80px;height:80px"  /> 
                    @endforeach
                
                @endif
                 </a>
            @endforeach
            </ul>
	   </div>	
	</div>
    </div>
    @if($datas['nextpage'])
    <div class="next-page page">
        <a href="{{$datas['type']}}-{{$datas['nextpage']}}"> ＞ </a>
    </div>
    @endif
    
@endsection
