<div id="custom-search-input">

    <form id="custom-search-input" class="form-inline" method="GET" action="{{url(trans('isearch::common.url'))}}">

        <div class="input-group">
            <span class="input-group-btn">
                <button type="submit" class="btn btn-default">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>
            <input type="text" class="form-control" placeholder="{{trans('isearch::common.search')}} " name="q" id="term" maxlength="64" required>
        </div>

    </form>

</div>

