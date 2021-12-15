@extends('layout.layout')

@section('sidebar')
@parent

<!-- <p>這邊會附加在主要的側邊欄。</p> -->
@endsection

@section('contents')
<button class="crud-btn" onclick="open_modal('create_hotel')"><i class="fa fa-plus"></i></button>
<table class="usersTable">
    <thead>
        <tr>
            <th width="20%">旅店名稱</th>
            <th width="20%">旅店簡介</th>
            <th width="20%">旅店地址</th>
            <th width="20%">旅店電話</th>
            <th width="20%" class="lastTH"></th>
        </tr>
    </thead>

    <tbody>
        @foreach ($hotels as $hotel)
        <tr>
            <td>{{ $hotel->name }}</td>
            <td>{{ $hotel->intro }}</td>
            <td>{{$hotel->address}}</td>
            <td>{{$hotel->phone}}</td>
            <td class="lastTD">
                <button class="crud-btn" onclick="open_modal('edit_hotel{{ $hotel->id }}')"><i class="fas fa-pen"></i></button>
                <button class="crud-btn" form="delete_hotel_{{$hotel->id}}" type="submit"><i  class="fas fa-trash"></i></button>
                <form action="/delete-hotel/{{$hotel->id}}" method="POST" id="delete_hotel_{{$hotel->id}}" style="display: none;">
                    @csrf
                    @method('delete')
                </form>
            </td>
        </tr>

        <div id="edit_hotel{{ $hotel->id }}" class="modal">
            <div class="modal-content">
                <span class="close" onclick="close_modal('edit_hotel{{ $hotel->id }}')">&times;</span>
                <form method="POST" action="/edit-hotel/{{$hotel->id}}">
                    @csrf
                    @method('patch')
                    <div class="results">
                        @if(Session::get('success'))
                        <div class="alert alert-success">
                            {{Session::get('success')}}
                        </div>
                        @endif
                        @if(Session::get('fail'))
                        <div class="alert alert-danger">
                            {{Session::get('fail')}}
                        </div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="form-label">旅店名稱</label>
                        <input class="form-control" value="{{$hotel->name}}" name="name" type="text" required><br />
                        <span class="text-danger">@error('name'){{$message}}@enderror</span><br />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" id="introduction">旅店簡介</label>
                        <textarea class="form-control" name="intro" type="url">{{$hotel->intro}}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">旅店地址</label>
                        <input class="form-control" value="{{$hotel->address}}" name="address" type="text" required><br />
                        <span class="text-danger">@error('address'){{$message}}@enderror</span><br />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">旅店電話</label>
                        <input class="form-control" value="{{$hotel->phone}}" name="phone" type="text"><br />
                    </div>
                    <br />
                    <button class="btn btn-warning" type="submit" id="submit">儲存</button>
                </form>
            </div>
        </div>

        @endforeach
    </tbody>
    <div id="create_hotel" class="modal">
        <div class="modal-content">
            <span class="close" onclick="close_modal('create_hotel')">&times;</span>
            <form method="POST" action="/create-hotel">
                @csrf
                <div class="results">
                    @if(Session::get('success'))
                    <div class="alert alert-success">
                        {{Session::get('success')}}
                    </div>
                    @endif
                    @if(Session::get('fail'))
                    <div class="alert alert-danger">
                        {{Session::get('fail')}}
                    </div>
                    @endif
                </div>
                <div class="mb-3">
                    <label class="form-label">旅店名稱</label>
                    <input class="form-control" name="name" type="text" required><br />
                    <span class="text-danger">@error('name'){{$message}}@enderror</span><br />
                </div>
                <div class="mb-3">
                    <label class="form-label" id="introduction">旅店簡介</label>
                    <textarea class="form-control" name="intro" type="url"></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">旅店地址</label>
                    <input class="form-control" name="address" type="text" required><br />
                    <span class="text-danger">@error('address'){{$message}}@enderror</span><br />
                </div>
                <div class="mb-3">
                    <label class="form-label">旅店電話</label>
                    <input class="form-control" name="phone" type="text"><br />
                    <span class="text-danger">@error('address'){{$message}}@enderror</span><br />
                </div>
                <br />
                <button class="btn btn-warning" type="submit" id="submit">儲存</button>
            </form>
        </div>
    </div>
</table>
@endsection
<script src="https://kit.fontawesome.com/8c1847b6ed.js" crossorigin="anonymous"></script>
<script>
    function open_modal(id) {
        var modal = document.getElementById(id);
        modal.style.display = "block";

    }

    function close_modal(id) {
        var modal = document.getElementById(id);
        modal.style.display = "none";
    }
</script>

<style>
    .crud-btn {
        background-color: DodgerBlue;
        /* Blue background */
        border: none;
        /* Remove borders */
        color: white;
        /* White text */
        padding: 12px 16px;
        /* Some padding */
        font-size: 16px;
        /* Set a font size */
        cursor: pointer;
        /* Mouse pointer on hover */
    }

    .modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 1;
        /* Sit on top */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.4);
        /* Black w/ opacity */
    }

    /* Modal Content/Box */
    .modal-content {
        background-color: #fefefe;
        margin: 10% auto;
        /* 15% from the top and centered */
        padding: 20px;
        border: 1px solid #888;
        width: 60%;
        /* Could be more or less, depending on screen size */
        border-radius: 15px;
       
        text-align: right;
    }

    /* table */
    .usersTable {
        margin: auto;
        width: 80%;
        text-align: center;
    }

    .usersTable tbody {
        overflow-x: hidden;
        overflow-y: auto;
    }

    .usersTable th {
        padding: 15px 0px;
        background-color: #a9d08d;
        border-right: #007500 solid 2px;
    }

    .usersTable td {
        padding: 15px 0px;
        border-right: 2px #bbb solid;
    }

    .usersTable th.lastTH {
        border-right: none;
    }

    .usersTable tr:nth-child(odd) {
        background-color: rgb(230, 230, 230);
    }

    .usersTable tr:nth-child(even) {
        background-color: rgb(246, 246, 246);
    }

    .usersTable tr:hover {
        background-color: rgb(222, 222, 222);
    }

    .usersTable td.lastTD {
        border-right: none;
        cursor: pointer;
        display: block;
    }

    .usersTable td.lastTD label {
        cursor: pointer;
    }

    /* modidy */
    .modal-content label {
        font-size: 16px;
    }

    .modal-content input {
        margin-right: 25%;
        width: 400px;
        padding: 10px;
        font-size: 16px;
        border-radius: 8px;
        border: #a9d08d solid 2px;
        margin-top: 10px;
        margin-bottom: 25px;
    }

    .modal-content textarea {
        margin-right: 25%;
        width: 400px;
        padding: 10px;
        font-size: 16px;
        border-radius: 8px;
        border: #a9d08d solid 2px;
        margin-top: 10px;
        margin-bottom: 25px;
    }

    #submit {
        padding: 10px;
        font-size: 16px;
        border-radius: 8px;
        border: #a9d08d solid 2px;
        width: 200px;
        color: #007500;
        background-color: #a9d08d;
        cursor: pointer;
        margin-right: 40%;
        margin-bottom: 30px;
    }

    .close {
        text-align: left;
        font-size: 24px;
        cursor: pointer;
        display: block;
        width: 30px;
    }
    #introduction{
        position:relative;
        bottom:70;
    }
</style>