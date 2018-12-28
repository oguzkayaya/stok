<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container">    
    <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
        <div class="panel panel-info" >
    <div class="panel-heading">
        <div class="panel-title">Sign In</div>
    </div>     
    <div style="padding-top:30px" class="panel-body" >
        <form class="form-horizontal" method="POST" action="/login">
            {{ csrf_field() }}
            <div style="margin-bottom: 25px" class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input id="login-username" type="text" class="form-control" name="email" value="" placeholder="Email">                                        
            </div>
                
            <div style="margin-bottom: 25px" class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <input id="login-password" type="password" class="form-control" name="password" placeholder="password">
            </div>
                    
            <div style="margin-top:10px" class="form-group">
                <!-- Button -->
                <div class="col-sm-12 controls">
                    <button type="submit" class="btn btn-success">Login </button>
                </div>
            </div>

            <div style="padding:10px;">
                @include('partials.errors')
            </div>

            <div class="form-group">
                <div class="col-md-12 control">
                    <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                        Don't have an account! 
                    <a href="/register">
                        Sign Up Here
                    </a>
                </div>
            </div>
        </form>     



    </div>                     
    </div>  
    </div>
        

               
               
                
    </div> 
    </div>
    