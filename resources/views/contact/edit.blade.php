@extends('layouts._layout')
@section('style')
<style>
    .image-area {
        position: relative;
        width: 50%;
        background: #333;
    }
    .image-area img{
        max-width: 100%;
        height: auto;
    }
    .remove-image {
        display: none;
        position: absolute;
        top: -10px;
        right: -10px;
        border-radius: 10em;
        padding: 2px 6px 3px;
        text-decoration: none;
        font: 700 21px/20px sans-serif;
        background: #555;
        border: 3px solid #fff;
        color: #FFF;
        box-shadow: 0 2px 6px rgba(0,0,0,0.5), inset 0 2px 4px rgba(0,0,0,0.3);
        text-shadow: 0 1px 2px rgba(0,0,0,0.5);
        -webkit-transition: background 0.5s;
        transition: background 0.5s;
    }
    .remove-image:hover {
        background: #E54E4E;
        padding: 3px 7px 5px;
        top: -11px;
        right: -11px;
    }
    .remove-image:active {
        background: #E54E4E;
        top: -10px;
        right: -11px;
    }
</style>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Edit Contact</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form action="{{route('update-contact', $contact[0]->filename)}}" method="post" enctype="multipart/form-data">@csrf
                        <div class="form-body">
                            <div class="row p-t-20">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Name</label>
                                        <input type="text" name="name" id="name" class="form-control" value="{{ $contact[0]->name }}" placeholder="" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Email</label>
                                        <input type="email" name="email" id="email" class="form-control" value="{{ $contact[0]->email }}" placeholder="" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Date of Birth</label>
                                        <input type="text" name="date" id="date" class="form-control date" value="{{ $contact[0]->birthdate }}" placeholder="" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Phone</label>
                                        <input type="tel" name="phone" id="phone" class="form-control" value="{{ $contact[0]->phone }}" placeholder="" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Gender</label>
                                        <select name="gender" id="gender" class="form-control custom-select">
                                            <option value="">Unselected</option>
                                            @if ($contact[0]->gender == "Male")
                                                <option value="Male" selected>Male</option>
                                                <option value="Female">Female</option>
                                            @else
                                                <option value="Male">Male</option>
                                                <option value="Female" selected>Female</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Upload Photo</label><br>
                                        @if ($contact[0]->photo == NULL)    
                                        @else
                                            <div class="image-area">
                                                <img src="{{$contact[0]->url_photo}}" alt="Preview">
                                                <a class="remove-image" href="{{route('delete-image-contact', $contact[0]->filename)}}" style="display: inline;">&#215;</a>
                                            </div>
                                        @endif
                                        <input type="file" name="photo" id="photo" class="form-control" placeholder="">
                                        <p style="color:red; float:right; font-size:10px;">Max Upload 2Mb</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Submit</button>
                            <a href="{{route('contact')}}" class="btn btn-inverse">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.id.min.js"></script>
<script src="{{URL::asset('assets')}}/node_modules/select2/dist/js/select2.js"></script>
<script>
$(document).ready(function() {
    $('.select2').select2();
    $('.date').datepicker({
        autoclose: true,
        language: 'id',
        locale: 'id',
        format: 'dd-mm-yyyy',
        orientation: 'auto'
    });
});
</script>
@endsection