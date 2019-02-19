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
                <h3>笔记类别添加</h3>
                <input type="hidden" id="domain" value="http://7u2r8g.coml.z0.glb.clouddn.com">
                <input type="hidden" id="token_url" value="/admin.php/uptoken">
                <form class="form-horizontal" role="form" method="POST" action="{{url('/web/categoryadd')}}">
                    <div class="form-group">
                        <label class="col-md-4 control-label">类别名称</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="name" id="inputEmail3" placeholder="text">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <input type="submit" class="btn btn-default" value="添加"/>
                        </div>
                    </div>
                </form>

            </div>
            @include('backyard.include.sidebar')
        </div>
    </div>
@endsection
