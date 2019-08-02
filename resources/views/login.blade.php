
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
                    <div class="container login-form">
                            <form method="post">
                                <h3>Admin Login</h3>
                               <div class="row">
                                    <div class="col-md-12">
                                        
                                        <div class="form-group">
                                            <input type="text" id="userEmail" name="txtEmail" class="form-control" placeholder="Email *" value="" />
                                        </div>
                                        <div class="form-group">
                                            <input type="password" id="userPassword" name="txtPassword" class="form-control" placeholder="Password *" value="" />
                                        </div>
                                        <div class="form-group">
                                            <input type="button" onclick="Login()" name="btnSubmit" class="btnContact" value="Login" />
                                        </div>
                                        <label style="color:white;background-color:red;padding:3px 8px;display:none" id="errorMessage"></label>
                                        <label style="color:white;background-color:green;padding:3px 8px;display:none" id="successMessage"></label>
                                    </div>
                                </div>
                            </form>
                </div>


            </div>
        </body>
        </html>
        <script>
                function Login(){


                    var userEmail = document.getElementById("userEmail").value;
                    var userPassword = document.getElementById("userPassword").value;
                    let formData=new FormData()
                    formData.append('email',userEmail)
                    formData.append('password',userPassword)
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', 'http://localhost:8000/api/auth/login', true);
                    let self=this
                    let successMsg= document.getElementById("successMessage");
                    let error= document.getElementById("errorMessage");
                    successMsg.style.display="none"
                    error.style.display="none"

                    xhr.onload = function () {
                        let response=this.responseText
                        let res=JSON.parse(response)
                        console.log(res)
                        let statusCode=res.status
                        if(statusCode=='ok'){
                            let token=res.token
                            window.localStorage.setItem('cini_token', token);
                            successMsg.innerHTML="You have been successfully logged in 😎"
                            successMsg.style.display="block"
                            setTimeout(()=>{
                                window.location.href = "/dashboard?token="+token;
                            },500)
                        }else{
                            error.innerHTML="username or password is incorrect message ❌"
                            error.style.display="block"
                        }
                    };
                    xhr.send(formData);
                }
        </script>
        
        <style>
                body{
                    background-image:url('/images/booking-back.jpg');
                }
                .login-form{
                    background: #d9d9d9;
                    margin-top: 5%;
                    margin-bottom: 5%;
                    width: 40%;
                }
                .login-form .form-control{
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
                .login-form form{
                    padding: 14%;
                }
                .login-form form .row{
                    margin-bottom: -7%;
                }
                .login-form h3{
                    margin-bottom: 8%;
                    margin-top: -10%;
                    text-align: center;
                    color: #0062cc;
                }
                .login-form .btnContact {
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