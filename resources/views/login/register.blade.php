<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container">    
    
    <div id="signupbox" style="margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="panel-title">Sign Up</div>
                    </div>  
                    <div class="panel-body" >
                        <form class="form-horizontal" method="POST" action="/register">
                            {{ csrf_field() }}
                            @include('partials.errors')
                                
                            <div class="form-group">
                                <label for="email" class="col-md-4   control-label">Email</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="email" placeholder="Email Address">
                                </div>
                            </div>
                                
                            <div class="form-group">
                                <label for="firstname" class="col-md-4   control-label">Name</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="name" placeholder="Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-md-4    control-label">Password</label>
                                <div class="col-md-8">
                                    <input type="password" class="form-control" name="password" placeholder="password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="passwd_confirmation" class="col-md-4     control-label">Password Confirm</label>
                                <div class="col-md-8">
                                    <input type="password" class="form-control" name="password_confirmation" placeholder="password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="firstname" class="col-md-4   control-label">Telephone</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="telephone" placeholder="Telephone">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="firstname" class="col-md-4  control-label">Company</label>
                                <div class="col-md-8">
                                    <select name="company" class="form-control">
                                        <option disabled selected hidden value="">Select Company...</option>
                                        @foreach ($companies as $company)
                                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <!-- Button -->                                        
                                <div class="col-md-offset-4 col-md-8">
                                    <button type="submit" class="btn btn-info"><i class="icon-hand-right"></i> &nbsp Sign Up</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            
            
            
        </div> 
</div>
