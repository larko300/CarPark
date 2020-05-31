@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('car.update', $car->id) }}" method="post">
                            @method('PATCH')
                            @csrf
                            <div class="d-flex">
                                <div class="p-2"><h5 class="card-title">Edit car</h5></div>
                                <div class="ml-auto p-2"><a href="{{ route('car.index') }}"><button type="submit" class="btn btn-secondary">Back</button></a></div>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Car number</span>
                                </div>
                                <input type="text" name="number" value="{{ old('number', $car->number) }}" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Driver</span>
                                </div>
                                <input type="text" name="driver" class="form-control" value="{{ old('driver', $car->driver) }}" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                            </div>
                            <button type="submit" class="btn btn-success">Edit</button>
                            @include('errors')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
