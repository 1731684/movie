
<html>
<head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body onload="filterTheatre(event)">
    <div class="container-fluid " style="background-color:#090405" >
        <div class="container">
            <nav class="navbar navbar-light">
                <a class="navbar-brand" href="/"  >
                    <!-- <img src="/docs/4.3/assets/brand/bootstrap-solid.svg" width="30" height="30" class="d-inline-block align-top" alt=""> -->
                <img src="/images/logo.png" height="80">
                    Cine Movies
                </a>
            </nav>
        </div>
    </div>
    <section style="height:150px;overflw:hidden">
        <div style="height:250px;overflow:hidden">
            <img src="/images/back.jpg" class="d-block w-100" alt="...">
        </div>
    </section>
    <section class="search-sec">
        <div class="container">
            <form method="post" novalidate="novalidate">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                            <select onchange="filterTheatre(event)" class="form-control search-slt" id="cityList">
                            @foreach ($cities as $city)
                            
                                    <option id="city_{{$city->id}}" value="{{$city->id}}">{{$city->city}}</option>
                            @endforeach
                                </select>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                            <select onchange="filterMovies()" class="form-control search-slt" id="theatreList">
                                    <option>Select Theatres</option>
                                </select>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                                <select  class="form-control search-slt" id="MovieList">
                                    <option>Select Movie</option>
                                </select>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                                <button type="button" onclick="bookMovie()" class="btn btn-danger wrn-btn">Book</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <div class="container">
    <div class="row">
         @foreach ($movies as $movie)
                

        <div class="col-sm-3">
            <article class="col-item">
                <div style="width:100%;overflow:hidden;height:150px;">
                    <div class="photo" class="width:100px;">
                                <div style="width:100%;heigh:10px;background-color:#f70202;color:white;padding:0 5px;font-size:13px;text-align:center">
                                        {{$movie->theatre->name}} - ({{$movie->time}})
                                </div>
                        <a> <img src="/images/movies/{{$movie->image}}" class="img-responsive" alt="Product Image" /> </a>
                    </div>
                </div>
        		<div class="info">
        			<div class="row">
        				<div class="price-details col-md-12">
        					<p class="details">
        						<h5>{{$movie->movie_name}}</h1>
                            </p>
        				</div>
                            <a style="width:90%;margin:auto" href="/booking/{{$movie->id}}" class="btn btn-primary">Book Now</a>
        			</div>
        		</div>
        	</article>
        </div>
        @endforeach 
        
	</div>

        
    </div>
    </div>

</body>
</html>

<script>
    function filterTheatre(event){
        let selectedId = document.getElementById("cityList").value;
        let formData=new FormData()
        formData.append('city_id',selectedId)
        let self=this
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'http://localhost:8000/api/filterTheatres', true);
        xhr.onload = function () {
            // do something to response
            // debugger
            let response=this.responseText
            let res=JSON.parse(response)
            
            var select = document.getElementById("theatreList");
            var length = select.options.length;
            for (i = 0; i <= length; i++) {
                select.options[0]=null
                // select.options[i].innerHTML = "yes";
                // select.options[i].id = 'theatre-'+i;
            }
            if(res.length>0){
                for(i=0;i<res.length;i++){
                    // debugger
                    var option = document.createElement("option");
                    option.text=res[i].name;
                    option.value='theatre-'+res[i].id;
                    option.id=res[i].id
                    select.add(option)
                }
            }else{
                var option = document.createElement("option");
                option.text="No Theatres";
                select.add(option)
            }
            // debugger
            self.filterMovies()
        };
        xhr.send(formData);
    }

    function filterMovies(){
        let selectedId = document.getElementById("theatreList").value;
        let formData=new FormData()
        console.log(selectedId.substring(8,selectedId.length))
        formData.append('theatre_id',selectedId.substring(8,selectedId.length))
        console.log(selectedId)

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'http://localhost:8000/api/filterMovies', true);
        xhr.onload = function () {
            // do something to response
            // debugger
            let response=this.responseText
            let res=JSON.parse(response)
            
            var select = document.getElementById("MovieList");
            var length = select.options.length;
            for (i = 0; i <= length; i++) {
                select.options[0]=null
                // select.options[i].innerHTML = "yes";
                // select.options[i].id = 'theatre-'+i;
            }
            // debugger
            if(res.length>0){
                for(i=0;i<res.length;i++){
                    // debugger
                    var option = document.createElement("option");
                    option.text=res[i].movie_name+' ('+res[i].time+')';
                    option.value='mov-'+res[i].id;
                    option.id=res[i].id
                    select.add(option)
                }
            }else{
                var option = document.createElement("option");
                option.text="No Movies";
                select.add(option)
            }
        };
        xhr.send(formData);

    }
    function bookMovie(){
        console.log("bookMovie")
        var selected_movie = document.getElementById("MovieList").value;
        let id= selected_movie.substring(4,selected_movie.length)
        window.location.href = "/booking/"+id;
    }
</script>

<style>
    body{
        background-color:black;
    }
</style>