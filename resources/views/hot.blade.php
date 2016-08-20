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
</style>
	<div class="row">
	<div  id="content" >
        <div class="panel ">
            <!-- Default panel contents -->
            <div class="panel-heading" style="font-size:20px;">{{$datas['title']}}</div>
    		<ul class="list-group" >
            @foreach($datas['content'] as  $topstory)
                <a class="list-group-item" style="height:100px;" target="_blank" href="detail-{{$topstory['news_id']}}">
                <span class="col-md-10 col-lx-12  " >{{$topstory['title']}}</span>
                    <img src="url?url={{$topstory['thumbnail']}}" style="width:80px;height:80px"  /> 
                 </a>
            @endforeach
            </ul>
	   </div>	
	</div>
    </div>
    
@endsection
