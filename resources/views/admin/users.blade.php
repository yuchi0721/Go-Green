@extends('layout.layout')

@section('sidebar')
@parent

<!-- <p>這邊會附加在主要的側邊欄。</p> -->
@endsection

@section('contents')
<table class="usersTable">
    <thead>
        <tr>
            <th width="25%" >使用者名稱</th>
            <th width="25%" >帳號</th>
            <th width="36%" >信箱</th>
            <th width="10%" class="lastTH"></th>
        </tr>
    </thead>

    <tbody>
        @foreach ($users as $u)
        <tr>
            <td>{{ $u->name }}</td>
            <td>{{ $u->account }}</td>
            <td>{{$u->email}}</td>
            <td class="lastTD"><label for="" onclick="open_modal('edit_user{{ $u->id }}')">修改</label></td>
        </tr>
        
        <div id="edit_user{{ $u->id }}" class="modal">
            <div class="modal-content">
                <span class="close" onclick="close_modal('edit_user{{ $u->id }}')">&times;</span>
                <form method="POST" action="/">
                    <div class="mb-3">
                        <label class="form-label">使用者名稱</label>
                        <input class="form-control" value="{{$u->name}}" name="update_keyword" type="text" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">帳號</label>
                        <input class="form-control" value="{{$u->account}}" name="update_origin_url" type="url" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">email</label>
                        <input class="form-control" value="{{$u->email}}" name="update_customer" type="text" required>
                    </div>
                    <br />
                    <button class="btn btn-warning" type="submit" id="submit">儲存</button>
                </form>
            </div>
        </div>

        @endforeach
    </tbody>
</table>
@endsection
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
    border-radius:15px;
    height:50%;
    text-align: center;
    }
    /* table */
    .usersTable{
        margin:auto;
        width:80%;
        text-align: center;
    }
    .usersTable tbody{
        overflow-x:hidden;
        overflow-y:auto;
    }
    .usersTable th{
        padding:15px 0px;
        background-color:#a9d08d;
        border-right:#007500 solid 2px;
    }
    .usersTable td{
        padding:15px 0px;
        border-right: 2px #bbb solid;
    }
    .usersTable th.lastTH{
        border-right:none;
    }
    .usersTable tr:nth-child(odd){
        background-color: rgb(230, 230, 230);
    }
    .usersTable tr:nth-child(even){     
        background-color: rgb(246, 246, 246);
    }
    .usersTable tr:hover{
        background-color: rgb(222, 222, 222);
    }
    .usersTable td.lastTD{
        border-right:none;
        cursor: pointer;
        display: block;
    }
    .usersTable td.lastTD label{
        cursor: pointer;
    }
    /* modidy */
    .modal-content label {
        font-size: 16px;
    }

    .modal-content input {

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
    }
    .close{
        text-align:left;
        font-size: 24px;
        cursor: pointer;
        display:block;
        width:30px;
    }
</style>