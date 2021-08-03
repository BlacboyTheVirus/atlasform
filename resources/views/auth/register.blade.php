<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
</head>
<body>

    <div class = "container">
        <div class="row" style="margin-top: 45px">
            <div class="col-md-4 col-md-offset-4">
                <h4>Register</h4><hr>
                
                <form action="{{ route('auth.save') }}" method="post">
                    @csrf

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('fail'))
                        <div class="alert alert-danger">
                            {{ session('fail') }}
                        </div>
                    @endif

                    <div class="form-group">
                        <label>Company Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter company name" value="{{ old('name') }}">
                        <span class="text-danger">@error('name') {{ $message }} @enderror</span>
                    </div>

                    <div class="form-group">
                        <label>Vendor Code</label>
                        <input type="text" class="form-control" name="vendor_code" placeholder="Enter vendor code" value="{{ old('vendor_code') }}">
                        <span class="text-danger">@error('vendor_code') {{ $message }} @enderror</span>
                    </div>
                    
                    <div class="form-group">
                        <label>Primary Email</label>
                        <input type="text" class="form-control" name="email" placeholder="Enter email address" value="{{ old('email') }}">
                        <span class="text-danger">@error('email') {{ $message }} @enderror</span>
                    </div>

                    {{-- <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter password">
                        <span class="text-danger">@error('password') {{ $message }} @enderror</span>
                    </div> --}}

                    <button type="submit" class="btn btn-block btn-primary">Register</button>
                    <br>
                    <a href="{{ route('auth.login') }}">Sign In</a>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>