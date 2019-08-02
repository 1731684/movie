
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
    <div>
            <div class="container contact-form">
                    <form method="post">
                        <h3>Booking</h3>
                       <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="hidden" id="movieId" name="txtName" class="form-control" placeholder="Your Name *" value="{{$movieInfo[0]->id}}" />
                                </div>
                                <div class="form-group">
                                    <input type="text" id="userName" name="txtName" class="form-control" placeholder="Your Name *" value="" />
                                </div>
                                <div class="form-group">
                                    <input type="date" id="bookingDate" name="bookDate" class="form-control" placeholder="Date *" value="" />
                                </div>
                                <div class="form-group">
                                    <input type="number" id="numOfBookings" name="numOfBookings" class="form-control" placeholder="Number of seats *" value="" />
                                </div>
                                <div class="form-group">
                                    <input type="text" id="userEmail" name="txtEmail" class="form-control" placeholder="Your Email *" value="" />
                                </div>
                                <div class="form-group">
                                    <input type="text" id="userPhone" name="txtPhone" class="form-control" placeholder="Your Phone Number *" value="" />
                                </div>
                                <div class="form-group">
                                    <input type="button" onclick="BookMovie()" name="btnSubmit" class="btnContact" value="Book Now" />
                                </div>
                                <label style="color:white;background-color:red;padding:3px 8px;display:none" id="errorMessage"></label>
                                <label style="color:white;background-color:green;padding:3px 8px;display:none" id="successMessage"></label>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div >
                                        <img style="width:100%;" alt="{{$movieInfo[0]->movie_name}}" src="/images/movies/{{$movieInfo[0]->image}}">
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
</body>
</html>

<script>
    function BookMovie(){
        var movieId = document.getElementById("movieId").value;
        var userName = document.getElementById("userName").value;
        var bookingDate = document.getElementById("bookingDate").value;
        var numOfBookings = document.getElementById("numOfBookings").value;
        var userEmail = document.getElementById("userEmail").value;
        var userPhone = document.getElementById("userPhone").value;
        if(this.ValidateNullFields(userName) && this.ValidateNullFields(bookingDate) && this.ValidateNullFields(numOfBookings) && this.ValidateNullFields(userEmail)&& this.ValidateNullFields(userPhone)){
            console.log(userName,bookingDate,userEmail,userPhone)
            let formData=new FormData()
            formData.append('movieId',movieId)
            formData.append('userName',userName)
            formData.append('bookingDate',bookingDate)
            formData.append('numOfBookings',numOfBookings)
            formData.append('userEmail',userEmail)
            formData.append('userPhone',userPhone)
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'http://localhost:8000/api/bookMovie', true);
            let self=this
            xhr.onload = function () {
                let response=this.responseText
                console.log(response)
                let res=JSON.parse(response)
                let statusCode=res.status
                if(statusCode=='200'){
                    let successMsg= document.getElementById("successMessage");
                    successMsg.innerHTML="You have successfully booked. Enjoy the movie with 🍿snacks!🍟"
                    self.setFieldsNull()
                    successMsg.style.display="block"
                }else{
                    let error= document.getElementById("errorMessage");
                    error.innerHTML="Check your fields"
                    error.style.display="block"
                }
            };
            xhr.send(formData);
        }

    }
    function ValidateNullFields(Value){
        let error= document.getElementById("errorMessage");
        if(Value==''){
            error.innerHTML="Check your fields"
            error.style.display="block"
            return false
        }
        error.innerHTML=""
        error.style.display="none"
        return true
    }
    function setFieldsNull(){
        document.getElementById("userName").value=''
        document.getElementById("bookingDate").value=''
        document.getElementById("numOfBookings").value=''
        document.getElementById("userEmail").value=''
        document.getElementById("userPhone").value=''
    }
    
</script>
<style>
        body{
            background-image:url('/images/booking-back.jpg');
        }
        .contact-form{
            background: #d9d9d9;
            margin-top: 5%;
            margin-bottom: 5%;
            width: 70%;
        }
        .contact-form .form-control{
            border-radius:0;
        }
        .contact-image{
            text-align: center;
        }
        .contact-image img{
            border-radius: 6rem;
            width: 11%;
            margin-top: -3%;
            transform: rotate(29deg);
        }
        .contact-form form{
            padding: 14%;
        }
        .contact-form form .row{
            margin-bottom: -7%;
        }
        .contact-form h3{
            margin-bottom: 8%;
            margin-top: -10%;
            text-align: center;
            color: #0062cc;
        }
        .contact-form .btnContact {
            width: 100%;
            border: none;
            padding: 1.5%;
            background: #dc3545;
            font-weight: 600;
            color: #fff;
            cursor: pointer;
        }
        .btnContactSubmit
        {
            width: 50%;
            border-radius: 1rem;
            padding: 1.5%;
            color: #fff;
            background-color: #0062cc;
            border: none;
            cursor: pointer;
        }
</style>