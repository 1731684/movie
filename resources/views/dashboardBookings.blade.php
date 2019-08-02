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
                                <li class="active"><a onclick="redirectPage('/bookings')">Bookings</a></li>
                                <li><a onclick="redirectPage('/movies')">Movies</a></li>
                            </ul>
                        </div>
                        <div class="col-md-10 content">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Bookings
                                </div>
                                <div class="container">    
                            </div>
                        </div>
                        <div class="row container-fluid main-container">
                            <div class="span5">
                                <table class="table table-striped table-condensed">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Customer Name</th>
                                        <th>Movie Name</th>                                          
                                        <th>Date</th>
                                        <th>Num of Bookings</th>
                                        <th>Verification Code</th>
                                    </tr>
                                </thead>   
                                <tbody>
                                @foreach($bookings as $booking)
                                    <tr>
                                        <td><h5>{{$loop->iteration}}</h5></td>
                                        <td><h5>{{$booking->username}}</h5></td>
                                        <td><span class="label label-success">{{$booking->movie->movie_name}}</span></td>
                                        <td><h5>{{$booking->date}}</h5></td>
                                        <td><h5>{{$booking->num_of_bookings}}</h5></td>
                                        <td><h5>{{$booking->verification_code}}</h5></td>
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
function redirectPage(page){
    let token=this.window.location.search
    window.location.href = "/dashboard"+page+token;
    console.log(token)
}
</script>