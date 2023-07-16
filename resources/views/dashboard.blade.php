<!DOCTYPE html>
<html>

<head>
    <title>Laravel 8 Form Example Tutorial</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@0.7.4/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>    
</head>

<body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
              <a class="navbar-brand" href="#">Mawar</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/api/logout">Logout</a>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Menu
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                      <li><a class="dropdown-item" href="/purchase-order">Purchase Order</a></li>
                      <li><a class="dropdown-item" href="/sales">Sales</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
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
