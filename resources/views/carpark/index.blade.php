@extends('layouts.app')

@section('content')
    <div class="container">
        @include('navbar')
        <main class="py-4">
            <a href="{{ route('carpark.create') }}"><button type="button" class="btn btn-success float-right">Add</button><a/>
            <h2 class="title">Car parks:</h2>
            @foreach($carParks as $carPark)
                <div class="card m-1">
                    <div class="card-body">
                        <form class="float-right m-1" action="{{ route('carpark.destroy', $carPark->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                        <a href="{{ route('carpark.edit', $carPark->id) }}"><button type="button" class="btn btn-primary float-right m-1">Edit</button><a/>
                        <h5 class="card-title">Name: {{ $carPark->name }}</h5>
                        <h5 class="card-title">Address: {{ $carPark->address }}</h5>
                        @if($carPark->working_hours)
                            <h5 class="card-title">Working hours: {{ $carPark->working_hours }}</h5>
                        @endif
                        @if(count($carPark->cars) > 0)
                            <h5 class="card-title">Cars:</h5>
                            @foreach($carPark->cars as $car)
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">{{ $car->number }}</li>
                                </ul>
                            @endforeach
                        @endif
                    </div>
                </div>
            @endforeach
        </main>
    </div>
@endsection
