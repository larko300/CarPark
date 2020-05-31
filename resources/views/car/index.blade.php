@extends('layouts.app')

@section('content')
    <div class="container">
        @include('navbar')
        <main class="py-4">
            <a href="{{ route('car.create') }}"><button type="button" class="btn btn-success float-right">Add</button><a/>
            <h2 class="title">Cars:</h2>
            @foreach($cars as $car)
                <div class="card m-1">
                    <div class="card-body">
                        @role('manager')
                        <form class="float-right m-1" action="{{ route('car.destroy', $car->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                        @endrole
                        <a href="{{ route('car.edit', $car->id) }}"><button type="button" class="btn btn-primary float-right m-1">Edit</button><a/>
                        <h5 class="card-title">Number: {{ $car->number }}</h5>
                        <h5 class="card-title">Driver name: {{ $car->driver }}</h5>
                        @if(count($car->carParks) > 0)
                            <h5 class="card-title">Car parks: </h5>
                            @foreach($car->carParks as $carPark)
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">{{ $carPark->name }}</li>
                                </ul>
                            @endforeach
                        @endif
                    </div>
                </div>
            @endforeach
        </main>
    </div>
@endsection
