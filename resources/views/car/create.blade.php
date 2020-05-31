@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('car.store') }}" method="post">
                            @csrf
                            <div class="d-flex">
                                <div class="p-2"><h5 class="card-title">Add car</h5></div>
                                <div class="ml-auto p-2"><a href="{{ route('car.index') }}"><button type="submit" class="btn btn-secondary">Back</button></a></div>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Car number</span>
                                </div>
                                <input type="text" name="number" class="form-control" value="{{ old('number') }}" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Driver</span>
                                </div>
                                <input type="text" name="driver" class="form-control" value="{{ old('driver') }}" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                            </div>
                            <button type="submit" class="btn btn-success">Create</button>
                            @include('errors')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
