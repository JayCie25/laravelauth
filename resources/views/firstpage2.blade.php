@extends('layouts.layout')

@section('content')
@if(!empty(Auth::user()->name))
<div class="container-fluid">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand btn btn-success" href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
        {{ __('Dashboard') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="btn btn-primary mx-1" href="/firstpage">Personal Inv</a>
        <a class="btn btn-primary mx-1" href="/firstpage2">Public Inv</a>
        <a class="btn btn-primary mx-1" href="/posts">Posts</a>
        <a class="btn btn-primary mx-1" href="/chat">Chat</a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <div class="dropdown-item disabled">
                        <h4>{{ __('Manage Account') }}</h4>
                        </div>
                        <div class="dropdown-item disabled text-dark">{{ Auth::user()->email }}</div>
                        <hr>
                        <a class="dropdown-item" href="{{ route('profile.show') }}">{{ __('Profile') }}</a>
                        
                        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                        <a class="dropdown-item" href="{{ route('api-tokens.index') }}">
                        {{ __('API Tokens') }}
                        </a>
                        @endif
                        <a class="dropdown-item" href="{{ route('logout') }}" @click.prevent="$root.submit();">
                            {{ __('Log Out') }}
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <div class="row">
        <div class="col text-center"></div>
        <div class="col text-center form-inline">
            <h4 class="mt-2 mb-3 bg-success rounded">{{ session('msg') }}</h4><h4 class="mt-2 mb-3 bg-warning rounded">{{ session('msgs') }}</h4><h4 class="mt-2 mb-3 bg-danger rounded">{{ session('msgss') }}</h4>
        </div>
        <div class="col">
            
        </div>
    </div>
    
    <hr class="tablehr">

    <!-- ADD ITEM MODAL -->
    <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="POST" enctype="multipart/form-data" action="{{ route('saveItem') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Item</h5>
                        <!--
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        -->
                    </div>
                    <div class="modal-body">
                        <input type="text" name="item_owner" value="{{ Auth::user()->name }}">
                        <label>Item Name:</label>
                        <input type="text" class="form-control w-50" name="iname" placeholder="Item Name.." required>
                        <hr>
                        <label>Item Image:</label>
                        <input type="file" class="form-control w-50" name="ipic" accept=".jpg, .png, .jpeg">
                        <hr>
                        <label>Item Quantity:</label>
                        <input type="number" class="form-control w-50" name="iquantity" placeholder="Item Quantity.."required>
                        <hr>
                        <label>Item Price:</label>
                        <input type="number" class="form-control w-50" name="iprice" placeholder="Item Price.."required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- EDIT ITEM MODAL -->
    <div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="POST" enctype="multipart/form-data" action="{{ route('saveUpdate')}}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Item</h5>
                        <!--
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        -->
                    </div>
                    <div class="modal-body">
                        <input type="text" id="iid" name="id" hidden>
                        <label>Item Name:</label>
                        <input type="text" class="form-control w-50" id="iname" name="uiname">
                        <hr>
                        <label>Item Image:</label>
                        <input type="file" class="form-control w-75" id="ipic" name="uipic" accept=".jpg, .png, .jpeg">
                        <hr>
                        <label>Item Quantity:</label>
                        <input type="number" class="form-control w-50" id="iquantity" name="uiquantity">
                        <hr>
                        <label>Item Price:</label>
                        <input type="number" class="form-control w-50" id="iprice" name="uiprice">
                    </div>
                    <div class="modal-footer">
                        <a onclick="history.back()" class="btn btn-secondary text-light">Close</a>
                        <input type="submit" class="btn btn-primary" name="update" value="Update">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col tablecolumn">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>Item Name</th>
                        <th>Image</th>
                        <th>Quantity</th>
                        <th>Item Price</th>
                        <th>Item Owner</th>
                        <th style="width:300px">
                        <form action="" method="POST"><input typ="text" name="search" id="search" class="form-control" placeholder="Search for item name..."></form></th>
                        <th style="width:100px">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#modal1">
                            Add Item
                            </button>
                        </th>
                    </tr>
                </thead>
                <tbody class="tbody">
                    
                </tbody>
            </table>
        </div>

    @foreach ($items as $item)
        @if($id == $item->id)
            <script>
            var modal2 = new bootstrap.Modal(document.getElementById('modal2'), {
                keyboard: false
            });
            document.querySelector('#iid').value=`{{$item->id}}`;
            document.querySelector('#iname').value=`{{$item->item_name}}`;
            document.querySelector('#iquantity').value=`{{$item->item_quantity}}`;
            document.querySelector('#iprice').value=`{{$item->item_price}}`;
            
            modal2.show();
            </script>
        @endif
    @endforeach

            <script>
                var hamburger = document.getElementById('hamburger');
                var menu = document.getElementById('navbar--middle');
                menu.style.display = "none";
                hamburger.addEventListener('click', function() {
                    this.classList.toggle("change");
                    if (menu.style.display === "none") {
                        menu.style.display = "block";
                    } else {
                        menu.style.display = "none";
                    }
                })
            </script>

            <script>
            $('#search').on('keyup', function(){
                search();
            });
            search();
            function search(){
                var keyword = $('#search').val();
                $.post('{{ route("firstpage2.search") }}',
                {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    keyword:keyword
                },
                function(data){
                    table_post_row(data);
                    console.log(data);
                });
            }
            // table row with ajax
            function table_post_row(res){
                let htmlView = '';
                if(res.employees.length <= 0){
                    htmlView+= `
                    <tr>
                    <td colspan="4">No data.</td>
                    </tr>`;
                }
                
                for(let i = 0; i < res.employees.length; i++){
                        htmlView += `
                        <tr>
                        <td>`+res.employees[i].item_name+`</td>
                        <td><img class="imgs" src="/imgs/`+res.employees[i].item_image+`"></td>
                        <td>`+res.employees[i].item_quantity+`</td>
                        <td>`+res.employees[i].item_price+`</td>
                        <td>`+res.employees[i].item_owner+`</td>
                        <td>
                        <a class="edititem btn bg-success disabled"><img src="https://www.freeiconspng.com/uploads/edit-icon-orange-pencil-0.png" height="40px" width="30px"></a>
                        <a class="sub_but btn bg-danger disabled" onclick="return confirm('Are you sure you want to delete this item?')"><img src="https://cdn-icons-png.flaticon.com/512/1345/1345874.png" height="40px" width="30px"></a>
                        </td>
                        </tr>`;
                    }
                $('tbody').html(htmlView);
            }
            </script>

</div>
@else
    <script>window.location = "/";</script>
@endif

@endsection