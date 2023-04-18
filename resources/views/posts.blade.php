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
        <a class="btn btn-primary mx-1" href="/table">Posts</a>
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
        <div class="col">
            <button type="button" class="btn btn-primary mt-3 mb-3 float-right" data-toggle="modal" data-target="#modal1">
            POST
            </button>
        </div>
    </div>

    @foreach($items as $item)
        @if($item->post_user == Auth::user()->name)
            <div class="row">
                <div class="col border rounded">
                    <div class="row bg-light">
                        <div class="col mt-2">
                            <h4>{{ $item->post_user }}</h4>
                        </div>
                    </div>
                    <div class="row bg-light">
                        <div class="col-2"></div>
                        <div class="col border rounded pb-3 pt-3">
                            <pre>{{ $item->post_content }}</pre>
                        </div>
                        <div class="col-1">
                            <a href="?id={{ $item->id }}" class="edititem btn bg-success"><img src="https://www.freeiconspng.com/uploads/edit-icon-orange-pencil-0.png" height="15px" width="10px"></a>
                            <a href="{{ route('deletePost', $item->id) }}" class="sub_but btn bg-danger" onclick="return confirm('Are you sure you want to delete this item?')"><img src="https://cdn-icons-png.flaticon.com/512/1345/1345874.png" height="15px" width="10px"></a>
                        </div>
                        <div class="col-1"></div>
                    </div>
                    <div class="row bg-light">
                        <div class="col">
                            <div class="float-right">{{ $item->created_at }}<div>
                        </div>
                    </div>
                    <hr class="mt-4">
        @else
                    <div class="row bg-light">
                        <div class="col mt-2">
                            <h4>{{ $item->post_user }}</h4>
                        </div>
                    </div>
                    <div class="row bg-light">
                        <div class="col-2"></div>
                        <div class="col border rounded pb-3 pt-3">
                            <pre>{{ $item->post_content }}</pre>
                        </div>
                        <div class="col-2"></div>
                    </div>
                    <div class="row bg-light">
                        <div class="col">
                            <div class="float-right">{{ $item->created_at }}<div>
                        </div>
                    </div>
                    <hr class="mt-4">
                </div>
            </div>
        @endif
    @endforeach


    <!--POST-->
    <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="POST" enctype="multipart/form-data" action="{{ route('savePost') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">What's on your mind <span class="text-primary">{{ Auth::user()->name }}</span>??? </h5>
                    </div>
                    <div class="modal-body">
                        <input type="text" name="post_user" value="{{ Auth::user()->name }}" hidden>
                        <textarea class="active form-control" type="text" name="post_content" placeholder="What's on your mind?" ></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" name="post" value="Post">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!--POST-->

    <!--EDIT POST-->
    <div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="POST" enctype="multipart/form-data" action="{{ route('saveUpdatePost') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Editting post.</h5>
                    </div>
                    <div class="modal-body">
                        <input type="text" id="id" name="id" hidden>
                        <input type="text" id="post_user" name="ipost_user" hidden>
                        <textarea class="active form-control" type="text" id="post_content" name="ipost_content"></textarea>
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:history.go(-1)" class="btn btn-outline-secondary">Cancel</a>
                        <input type="submit" class="btn btn-primary" name="post" value="Edit">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!--EDIT POST-->
    @foreach ($items as $item)
        @if($id == $item->id)
            <script>
            var modal2 = new bootstrap.Modal(document.getElementById('modal2'), {
                keyboard: false
            });
            document.querySelector('#id').value=`{{$item->id}}`;
            document.querySelector('#post_user').value=`{{$item->post_user}}`;
            document.querySelector('#post_content').value=`{{$item->post_content}}`;
            
            modal2.show();
            </script>
        @endif
    @endforeach
</div>

<script>
const txs = document.getElementsByClassName("active");
for (let i = 0; i < txs.length; i++) {
    txs[i].setAttribute("style", "height:" + (txs[i].scrollHeight) + "px;overflow-y:hidden;resize:none;height:auto");
    txs[i].addEventListener("input", OnInput, false);
}
function OnInput() {
    this.style.height = 0;
    this.style.height = (this.scrollHeight) + "px";
}
</script>
@else
    <script>window.location = "/";</script>
@endif
@endsection