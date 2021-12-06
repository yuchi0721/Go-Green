@extends('layout.layout')

@section('sidebar')
@parent

<!-- <p>這邊會附加在主要的側邊欄。</p> -->
@endsection

@section('contents')
<table>
    <thead>
        <tr>
            <td>使用者名稱</td>
            <td>帳號</td>
            <td>信箱</td>
            <td></td>
        </tr>
    </thead>

    <tbody>
        @foreach ($users as $u)
        <tr>
            <td>{{ $u->name }}</td>
            <td>{{ $u->account }}</td>
            <td>{{$u->email}}</td>
            <td><label for="" onclick="open_modal('edit_user{{ $u->id }}')">修改</label></td>
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
                    <button class="btn btn-warning" type="submit">儲存</button>
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
      margin: 15% auto;
      /* 15% from the top and centered */
      padding: 20px;
      border: 1px solid #888;
      width: 80%;
      /* Could be more or less, depending on screen size */
    }
</style>