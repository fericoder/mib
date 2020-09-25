@if ($errors->any())
    <div style="margin: 30px!important;" class="alert alert-danger">
        <ul style="padding: 5px">
            @foreach ($errors->all() as $error)
                <li style="padding: 5px;font-size: 15px">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
