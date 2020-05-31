@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="p-2"><h5 class="card-title">Add car park</h5></div>
                            <div class="ml-auto p-2"><a href="{{ route('carpark.index') }}"><button type="submit" class="btn btn-secondary">Back</button></a></div>
                        </div>
                        <form action="{{ route('carpark.store') }}" method="post">
                        @csrf
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">Name</span>
                            </div>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">Address</span>
                            </div>
                            <input type="text" name="address" value="{{ old('address') }}" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">Working hours</span>
                            </div>
                            <input type="text" name="working_hours" value="{{ old('working_hours') }}" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                        </div>

                        <carscreate></carscreate>
                        <button type="submit" class="btn btn-success">Create</button>
                        @include('errors')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
