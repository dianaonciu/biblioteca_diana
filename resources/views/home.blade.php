@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Filtrar libros</div>
                <div class="card-body">
                    <form method="GET" action=home.blade.php>
                        <div class="form-group row">
                            <input class="col-md-4 col-form-label text-md-right" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection