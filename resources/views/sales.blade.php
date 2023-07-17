<!DOCTYPE html>
<html>

<head>
    <title>Fotokopi Mawar</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css"
        integrity="sha256-FdatTf20PQr/rWg+cAKfl6j4/IY3oohFAJ7gVC3M34E=" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"
        integrity="sha256-AFAYEOkzB6iIKnTYZOdUf9FFje6lOTYdwRJKwTN5mks=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <style>
      .select2-container--default .select2-selection--single {
          width: 385px;
      }
  </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Sales</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/api/logout">Logout</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Menu
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="/purchase-order">Purchase Order</a></li>
                            <li><a class="dropdown-item" href="/sales">Sales</a></li>
                            <li><a class="dropdown-item" id="newsales" href="#">+ New</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">

        <div style="margin-top: 10px;">
            <table id="grid_po" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Invoice</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
            </table>
        </div>

        <div class="modal fade" id="modal-po" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content flex">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Invoice</label>
                            <div class="col-sm-10 flex">
                                <select class="select_invoice w-full"></select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Product</label>
                            <div class="col-sm-10 flex">
                                <select class="select_product w-full"></select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Qty</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="qty" placeholder="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Price</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="price" placeholder="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Sub total</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="subtotal" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary close-modal"
                            data-dismiss="modal">Close</button>
                        <button type="button" id="save" class="btn btn-primary px-5">Save</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

</body>
<script>
    $(function() {
        $("#newsales").click(function(e) {
            $('#modal-po').modal('show');
        })

        $(".close-modal").click(function(e) {
            $('#modal-po').modal('hide');
        })


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                "Authorization": localStorage.getItem('token')
            }
        });

        $('.select_product').select2({
            ajax: {
                url: '/api/product',
                processResults: function(data) {
                    // Transforms the top-level key of the response object from 'items' to 'results'
                    let res = data.data
                    let narr = []
                    for (let i in res) {
                        narr.push({
                            id: res[i].product_id,
                            text: res[i].product_name
                        })
                    }
                    return {
                        results: narr
                    };
                }
            }
        });

        $('.select_invoice').select2({
            ajax: {
                url: '/api/invoice',
                processResults: function(data) {
                    // Transforms the top-level key of the response object from 'items' to 'results'
                    let res = data.data
                    let narr = []
                    for (let i in res) {
                        narr.push({
                            id: res[i].invoice_id,
                            text: res[i].invoice_id
                        })
                    }
                    return {
                        results: narr
                    };
                }
            }
        });

        var grid = new DataTable('#grid_po', {
            ajax: '/api/sales',
            columns: [{
                    data: 'invoice_id'
                },
                {
                    data: 'unit_price'
                },
                {
                    data: 'product_id'
                },
                {
                    data: 'quantity'
                },
                {
                    data: 'sub_total'
                }
            ]
        });

        $("#save").click(function(e) {
            //e.preventDefault();
            save()
        })

        function save() {
            $.ajax({
                url: "/api/sales",
                type: 'POST',
                data: {
                    invoice_id: $(".select_invoice").val(),
                    unit_price: $("#price").val(),
                    product_id: $(".select_product").val(),
                    quantity: $("#qty").val(),
                    sub_total: $("#subtotal").val()
                },
                error: function(err) {
                    console.log('Error!', err)
                },
                success: function(data) {
                    $('#modal-po').modal('hide');
                    grid.ajax.reload();
                }
            });
        }

    });
</script>

</html>
