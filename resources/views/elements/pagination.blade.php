<div class="col-lg-12">
    <div class="room-pagination">
        {{ $records->appends(Request::except('page'))->links('pagination.custom_pagination') }}
    </div>
</div>