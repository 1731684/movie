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
                                <label style="color:white;background-color:red;padding:3px 8px;display:none" id="errorMessage"></label>
                                <label style="color:white;background-color:green;padding:3px 8px;display:none" id="successMessage"></label>
                        </div>
                        <div class="row container-fluid main-container">
                            <div class="span5">
                                <table class="table table-striped table-condensed">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Movie</th>
                                        <th>Language</th>                                          
                                        <th>Time</th>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>   
                                <tbody>
                                @foreach($Movies as $movie)
                                    <tr>
                                        <td><h5>{{$loop->iteration}}</h5></td>
                                        <td><h5>{{$movie->movie_name}}</h5></td>
                                        <td><span class="label label-success">{{$movie->language}}</span></td>
                                        <td><h5>{{$movie->time}}</h5></td>
                                        <td><h5>{{$movie->date_from}}</h5></td>
                                        <td><h5>{{$movie->date_to}}</h5></td>
                                        <td>
                                            <button onclick="redirectPage('/movies/edit',{{$movie->id}})" class="label label-success">Edit</button></h,MovieId5>
                                            <button onclick="DeleteMovie({{$movie->id}})" class="label label-success">delete</button></h5>
                                        </td>
                                    </tr>                                   
                                @endforeach
                                </tbody>
                                </table>
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
function redirectPage(page,MovieId){
    let token=this.window.location.search
    if(MovieId){
        window.location.href = "/dashboard"+page+'?id='+MovieId+'&'+(token).substring(1,token.length);
        // window.location.href = "/dashboard/movies/edit?+token;
    }else{
        window.location.href = "/dashboard"+page+token;
    }
}

function DeleteMovie(movieId){
        let formData=new FormData()
        formData.append('movieId',movieId)

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'http://localhost:8000/api/deleteMovie', true);
        let self=this
        xhr.onload = function () {
            let response=this.responseText
            console.log(response)
            let res=JSON.parse(response)
            let statusCode=res.status
            if(statusCode=='200'){
                let successMsg= document.getElementById("successMessage");
                successMsg.innerHTML="You have successfully deleted"
                successMsg.style.display="block"
                var url_string = self.window.location.href
                var url = new URL(url_string);
                var token = url.searchParams.get("token");
                setTimeout(() => {
                    window.location.href = "/dashboard/movies?token="+token;
                }, 300);
            }else{
                let error= document.getElementById("errorMessage");
                error.innerHTML="Check your fields"
                error.style.display="block"
            }
        };
        xhr.send(formData);

    }
</script>