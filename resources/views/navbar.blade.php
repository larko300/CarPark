<nav class="navbar navbar-light bg-light">
    <form class="form-inline">
        <a href="{{ route('car.index') }}"><button class="btn btn-sm btn-outline-secondary" type="button">Cars list</button></a>
        @role('manager')
        <a href="{{ route('carpark.index') }}"><button class="btn btn-sm btn-outline-secondary" type="button">Car park list</button></a>
        @endrole
    </form>
</nav>
