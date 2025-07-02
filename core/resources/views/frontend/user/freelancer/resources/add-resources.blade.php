@extends('frontend.layout.master')
@section('site_title', __('Add Resources'))
@section('style')
    <x-summernote.summernote-css/>
    <x-select2.select2-css/>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">

            <div>
                <form action="{{ url('freelancer/resource/import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" required>
                    <button type="submit">Import Resources</button>
                </form>
                
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Add Resources') }}</h4>
                </div>
                <div class="card-body">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ url('freelancer/resource/store') }}" method="post" enctype="multipart/form-data">
        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">{{ __('Resource Name') }}</label>
                                    <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                                    @error('title')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status">{{ __('Status') }}</label>
                                    <select name="status" class="form-control">
                                        <option value="">{{ __('Select Status') }}</option>
                                        <option value="1">{{ __('Active') }}</option>
                                        <option value="0">{{ __('Inactive') }}</option>
                                    </select>
                                    @error('status')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ __('Description') }}</label>
                            <textarea name="description" class="form-control" id="description" cols="30" rows="10">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="role">{{ __('Role') }}</label>
                                    <select name="role" id="role" class="form-control">
                                        <option value="">{{ __('Select Role') }}</option>
                                        <option value="Developer">{{ __('Developer') }}</option>
                                        <option value="Tester">{{ __('Tester') }}</option>
                                        <option value="Other">{{ __('Other') }}</option>
                                    </select>
                                    @error('role')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group" id="custom_role_group" style="display: none;">
                                    <label for="custom_role">{{ __('Custom Role') }}</label>
                                    <input type="text" name="custom_role" id="custom_role" class="form-control" value="{{ old('custom_role') }}">
                                    @error('custom_role')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="specification">{{ __('Specification') }}</label>
                                    <input type="text" name="specification" class="form-control" value="{{ old('specification') }}">
                                    @error('specification')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="monthly_salary">{{ __('Monthly Rate') }}</label>
                                    <input type="text" name="monthly_salary" id="monthly_salary" class="form-control" value="{{ old('monthly_salary') }}">
                                    @error('monthly_salary')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="hourly_salary">{{ __('Hourly Rate') }}</label>
                                    <input type="text" name="hourly_salary" id="hourly_salary" class="form-control" value="{{ old('hourly_salary') }}">
                                    @error('hourly_salary')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="experience">{{ __('Experience') }}</label>
                                    <select name="experience" class="form-control">
                                        <option value="">{{ __('Select Experience') }}</option>
                                        <option value="1-2">{{ __('1 to 2 years') }}</option>
                                        <option value="2-4">{{ __('2 to 4 years') }}</option>
                                        <option value="4-6">{{ __('4 to 6 years') }}</option>
                                        <option value="6-8">{{ __('6 to 8 years') }}</option>
                                        <option value="8-10">{{ __('8 to 10 years') }}</option>
                                        <option value="10+">{{ __('More than 10 years') }}</option>
                                    </select>
                                    @error('experience')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    {{-- @include('frontend.user.client.resources.add-resources-js') --}}
    <x-summernote.summernote-js-function />
    <x-select2.select2-js/>
    <script>
        document.getElementById('role').addEventListener('change', function() {
            var role = this.value;
            var customRoleGroup = document.getElementById('custom_role_group');
            if (role === 'Other') {
                customRoleGroup.style.display = 'block';
            } else {
                customRoleGroup.style.display = 'none';
                document.getElementById('custom_role').value = '';
            }
        });
    </script>
@endsection
