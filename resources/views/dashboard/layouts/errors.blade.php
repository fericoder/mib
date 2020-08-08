@if ($errors->any())
    <div style="margin: 10px!important;" class="alert alert-danger">
        <ul style="padding: 15px">
            @foreach ($errors->all() as $error)
                <li style="padding: 5px;">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
