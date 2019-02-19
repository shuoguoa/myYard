@extends('/backyard/backyard')
@section('content')
    <div class="container">
        <div class="row row-offcanvas row-offcanvas-right">
            <div class="col-xs-12 col-sm-9">
                <p class="pull-right visible-xs">
                    <button class="btn btn-primary btn-xs" type="button" data-toggle="offcanvas">
                    Toggle nav
                    </button>
                </p>
                <div class="jumbotorn">
                    <h1>思维笔记</h1>
                    <p>思维笔记，记录的生活变化</p>
                </div>
            </div>
            @include('backyard.include.sidebar')
        </div>
    </div>
@endsection
