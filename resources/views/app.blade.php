<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>知乎</title>

	<link href="./css/app.css" rel="stylesheet">

	<!-- Fonts -->
  <link href='http://fonts.useso.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
  <style>
  .dropdown a,.dropdown a:hover{
    color: #fff;
  }
  .nav a:hover ,.nav .open > a{
    background-color:rgba(0,0,0,0.1) !important;
  }
  .active{
    background-color:#5BB8FF !important;
    border:1px solid #5BB8FF !important;
  }
  #themelist,#columnlist{
        position:absolute;
        top: 105%;
        display:none;
  }
  .toshowmenu{
    float:left;
    padding: 12px 25px;
    color: #ffffff;
  }
  .littlespan{
    color: rgba(51, 51, 51, 0.48);
    font-size: 5px;
    margin-left: 20px;
}  
    </style>
</head>
<body>
	<nav class="navbar navbar-default">
        <div class="toshowmenu" id="toshowmenu" onclick="showmenu(this,'themelist');">
            <span class="glyphicon glyphicon-align-justify "></span>主题
                <div class="list-group unshow " id="themelist" style="display:none; z-index: 100;">
                     @foreach($datas['themes']['others'] as $other)
                          <a href="theme-{{$other['id']}}" class="list-group-item ">{{$other['name']}}<span class="littlespan">{{$other['description']}}</span></a>
                     @endforeach
                </div> 
        </div>
        <div class="toshowmenu" id="toshowcolumn" onclick="showmenu(this,'columnlist');">
            <span class="glyphicon glyphicon-align-justify "></span>栏目总览
                <div class="list-group unshow " id="columnlist" style="display:none; z-index: 100;">
                     @foreach($datas['column']['data'] as $other)
                          <a href="section-{{$other['id']}}" class="list-group-item ">{{$other['name']}}<span class="littlespan">{{$other['description']}}</span></a>
                     @endforeach
                </div> 
        </div>
        
		<div class="container-fluid">      			
            <div class="navbar-header" style="margin:0 auto;width:110px">
				
				
				<!--<button class="btn btn-default dropdown-toggle"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">"知乎日报"
                    
                </button>-->
                <ul class="nav nav-pills">
                  <li role="presentation" class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" style="margin: 5px 0;">
                      "知乎日报" <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                      <li><a href="home-top">头条消息</a></li>
                      <li><a href="home-latest">最新消息</a></li>
                      <li><a href="home-hot">熱門消息</a></li>

                    </ul>
                  </li>
                </ul>

                
			</div>
		</div>
	</nav>

	@yield('content')

	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <script>
       
        $('body').click(function(){
            if($('.unshow').css("display") != 'none'){
                    $('.unshow').hide();
            }           
        })

        function showmenu(_this,target){
            event.stopPropagation();
            $('.unshow').not($('#'+target)).hide();
            if($('#'+target).css("display") != 'none'){
                    $('#'+target).hide();
            }else{
                $('#'+target).show();
            }
            
        }
    </script>
</body>
</html>

