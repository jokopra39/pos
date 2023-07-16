<!DOCTYPE html>
<html>

<head>
    <title>Laravel 8 Form Example Tutorial</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@0.7.4/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
</head>

<body>
    <div class="container flex mt-4 justify-center">
        <div class="card w-2/5">
            <div class="card-header text-center font-weight-bold">
                Fotokopi Mawar
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="text" id="email" name="email" class="form-control" required="">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Password</label>
                    <input type="password" id="password" name="password" class="form-control" required="">
                </div>
                <button type="submit" id="login" class="btn btn-primary">Login</button>
            </div>
        </div>
    </div>
</body>
<script>
    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $("#login").click(function(e) {
          e.preventDefault();
            login()
            console.log("ppp", $("#email").val())
        })

        function login() {
            $.ajax({
                url: "/api/login",
                type: 'POST',
                data: {
                    email: $("#email").val(),
                    password: $("#password").val()
                },
                // headers: {
                //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                //     "Authorization": localStorage.getItem('token')
                // },
                error: function(err) {
                    console.log('Error!', err)
                },
                success: function(data) {
                    console.log('Success!', data)
                    localStorage.setItem('token', data.access_token);
                    //window.location.href = "/dashboard";
                    window.location.replace('/dashboard')
                    
                }
            });
        }

    });
</script>

</html>
