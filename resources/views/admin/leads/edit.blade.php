@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/js/plugins/dropzone/dist/min/dropzone.min.css') }}"/>
@endsection
@section('content')

    <div class="app-title">
        <div>
            <h1><i class="fa fa-shopping-bag"></i> {{ $pageTitle }} - {{ $subTitle }}</h1>
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row user">
        <div class="col-md-3">
            <div class="tile p-0">
                <ul class="nav flex-column nav-tabs user-tabs">
                    <li class="nav-item"><a class="nav-link active" href="#general" data-toggle="tab">General</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-9">
            <div class="tab-content">
                <div class="tab-pane active" id="general">
                    <div class="tile">
                        <form action="{{ route('admin.leads.update') }}" method="POST" role="form">
                            @csrf
                            <h3 class="tile-title">Lead Information</h3>
                            <hr>
                            <div class="tile-body">

                                <div class="form-group">
                                    <label class="control-label" for="name">Title</label>
                                    <input
                                        class="form-control @error('title') is-invalid @enderror"
                                        type="text"
                                        placeholder="Enter Lead Title"
                                        id="title"
                                        name="title"
                                        value="{{ old('title', $lead->title) }}"
                                    />
                                    <input type="hidden" name="lead_id" value="{{ $lead->id }}">
                                    <div class="invalid-feedback active">
                                        <i class="fa fa-exclamation-circle fa-fw"></i> @error('title') <span>{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                    
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label" for="categories">Category</label>
                                            <select name="category_id" id="categories" class="form-control" >
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                               <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label" for="country">Category</label>
                                            <select name="country" id="country" class="form-control" >
                                                <option value="">Select Country </option>
                                                @foreach($countries as $country)
                                                    <option value="{{ $country }}">{{ $country }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                               
                               <div class="form-group">
                                    <label class="control-label" for="email">Email</label>
                                    <input
                                        class="form-control @error('email') is-invalid @enderror"
                                        type="text"
                                        placeholder="Enter email"
                                        id="email"
                                        name="email"
                                        value="{{ old('email' , $lead->email) }}"
                                    />
                                    <div class="invalid-feedback active">
                                        <i class="fa fa-exclamation-circle fa-fw"></i> @error('email') <span>{{ $message }}</span> @enderror
                                    </div>
                                </div>
                               
                               <div class="form-group">
                                    <label class="control-label" for="phone_num">Phone number</label>
                                    <input
                                        class="form-control @error('phone_num') is-invalid @enderror"
                                        type="text"
                                        placeholder="Enter Lead Phone Number"
                                        id="phone_num"
                                        name="phone_num"
                                        value="{{ old('phone_num', $lead->phone_num) }}"
                                    />
                                    <div class="invalid-feedback active">
                                        <i class="fa fa-exclamation-circle fa-fw"></i> @error('phone_num') <span>{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label" for="description">Description</label>
                                    <textarea name="description" id="description" rows="8" class="form-control">{{ old('description', $lead->description) }}</textarea>
                                </div>
                                <div class="form-group">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input"
                                                   type="checkbox"
                                                   id="status"
                                                   name="status"
                                                   {{ $lead->status == 1 ? 'checked' : '' }}
                                                />Status
                                        </label>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="tile-footer">
                                <div class="row d-print-none mt-2">
                                    <div class="col-12 text-right">
                                        <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update Lead</button>
                                        <a class="btn btn-danger" href="{{ route('admin.leads.index') }}"><i class="fa fa-fw fa-lg fa-arrow-left"></i>Go Back</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>




            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('backend/js/plugins/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/plugins/dropzone/dist/min/dropzone.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/plugins/bootstrap-notify.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/app.js') }}"></script>
    <script>
    
        CKEDITOR.replace( 'description' );
        
        Dropzone.autoDiscover = false;
        
        $( document ).ready(function() {
           
                                               
            var selected_category =  "{{ $lead->category_id}}";
            $("#categories option[value='"+selected_category+"']").attr('selected','selected');     
            
            var selected_country =  "{{ $lead->country }}";
            $("#country option[value='"+selected_country+"']").attr('selected','selected');
            
            
  
           
            
        });

        

    </script>
@endpush
