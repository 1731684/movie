<html>
    <head>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    </head>
    <body>
        <div>
                <div class="container-fluid" style="height:120px;background-color:#090405" >
                        <div class="container">
                            <nav class="navbar navbar-light">
                                <a class="navbar-brand" href="/"  >
                                    <!-- <img src="/docs/4.3/assets/brand/bootstrap-solid.svg" width="30" height="30" class="d-inline-block align-top" alt=""> -->
                                <img src="/images/logo.png" height="80">
                                </a>
                            </nav>
                        </div>
                    </div>
        </div>
            <nav class="navbar navbar-default navbar-static-top">
                    <div class="container-fluid">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="#">
                                Welcome {{$user->name}}
                            </a>
                        </div>
                
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">			
                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="/" target="_blank">Visit Site</a></li>
                                <li class="dropdown">
                                    <a href="/" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                        Logout
                                    </a>
                                        
                                    </li>
                                </ul>
                            </div><!-- /.navbar-collapse -->
                        </div><!-- /.container-fluid -->
                    </nav>
                    <div class="container-fluid main-container">
                        <div class="col-md-2 sidebar">
                            <ul class="nav nav-pills nav-stacked">
                                <li><a onclick="redirectPage('')">Home</a></li>
                                <li><a onclick="redirectPage('/bookings')">Bookings</a></li>
                                <li class="active"><a onclick="redirectPage('/movies')">Movies</a></li>
                            </ul>
                        </div>
                        <div class="col-md-10 content">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Movies
                                </div>
                                <div class="container">    
                            </div>
                        </div>
                        <div class="row container-fluid main-container">
                        <div class="container contact-form">
                    <form method="post">
                        <h3>Booking</h3>
                       <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="hidden" id="movieId" name="txtName" class="form-control" placeholder="Your Name *" value="{{$movieInfo[0]->id}}" />
                                </div>
                                <div class="form-group">
                                    <input type="text" id="movieName" name="txtName" class="form-control" placeholder="Your Name *" value="{{$movieInfo[0]->movie_name}}" />
                                </div>
                                <div class="form-group">
                                    <input type="text" id="language" name="txtName" class="form-control" placeholder="Your Name *" value="{{$movieInfo[0]->language}}" />
                                </div>
                                <div class="form-group">
                                    <input type="text" disabled id="userName" name="txtName" class="form-control" placeholder="Your Name *" value="{{$movieInfo[0]->theatre->name}}" />
                                </div>
                                <div class="form-group">
                                    <input type="text" disabled id="userName" name="txtName" class="form-control" placeholder="Your Name *" value="{{$movieInfo[0]->city->city}}" />
                                </div>
                                <div class="form-group">
                                    <input type="date" id="dateFrom" name="bookDate" class="form-control" placeholder="Date *" value="{{$movieInfo[0]->date_from}}"/>
                                </div>
                                <div class="form-group">
                                    <input type="date" id="dateTo" name="bookDate" class="form-control" placeholder="Date *" value="{{$movieInfo[0]->date_to}}"/>
                                </div>
                                <div class="form-group">
                                    <input type="button" onclick="UpdateMovie({{$movieInfo[0]->id}})" name="btnSubmit" class="btnContact" value="Update Now" />
                                </div>
                                <label style="color:white;background-color:red;padding:3px 8px;display:none" id="errorMessage"></label>
                                <label style="color:white;background-color:green;padding:3px 8px;display:none" id="successMessage"></label>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div >
                                        <img style="width:60%;" alt="{{$movieInfo[0]->movie_name}}" src="/images/movies/{{$movieInfo[0]->image}}">
                                    </div>
                                    <p>Theatre:<b>{{$movieInfo[0]->theatre->name}}</b></p>
                                    <p>Movie Name: <b>{{$movieInfo[0]->movie_name}}</b></p>
                                    <p>Time:<b>{{$movieInfo[0]->time}}</b></p>
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
                        </div>
                    </div>
                        <footer class="pull-left footer">
                            <p class="col-md-12">
                                <hr class="divider">
                            </p>
                        </footer>
                    </div>
    </body>
</html>
<script>
function redirectPage(page){
    // let token=this.window.location.search
    // debugger
    var url_string = this.window.location.href
    var url = new URL(url_string);
    var token = url.searchParams.get("token");
    window.location.href = "/dashboard"+page+'?token='+token;
    console.log(token)
}
function UpdateMovie(movieId){
        var movieName = document.getElementById("userName").value;
        var language = document.getElementById("language").value;
        var dateFrom = document.getElementById("dateFrom").value;
        var dateTo = document.getElementById("dateTo").value;

        let formData=new FormData()
        formData.append('movieId',movieId)
        formData.append('language',language)
        formData.append('movieName',movieName)
        formData.append('dateFrom',dateFrom)
        formData.append('dateTo',dateTo)

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'http://localhost:8000/api/updateMovie', true);
        let self=this
        xhr.onload = function () {
            let response=this.responseText
            console.log(response)
            let res=JSON.parse(response)
            let statusCode=res.status
            if(statusCode=='200'){
                let successMsg= document.getElementById("successMessage");
                successMsg.innerHTML="You have successfully updated"
                successMsg.style.display="block"
                var url_string = self.window.location.href
                var url = new URL(url_string);
                var token = url.searchParams.get("token");
                setTimeout(() => {
                    window.location.href = "/dashboard/movies?token="+token;
                }, 500);
            }else{
                let error= document.getElementById("errorMessage");
                error.innerHTML="Check your fields"
                error.style.display="block"
            }
        };
        xhr.send(formData);

    }
</script>