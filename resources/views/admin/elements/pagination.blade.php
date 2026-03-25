<div class="d-flex justify-content-between align-items-center flex-wrap mt-3">
    <div class="text-purple small mb-2 mb-sm-0">
        Showing {{ $records->firstItem() }} to {{ $records->lastItem() }} of {{ $records->total() }} results 
        <span class="ms-2">(Page {{ $records->currentPage() }} of {{ $records->lastPage() }})</span>
    </div>

    <nav class="dataTables_paginate">
        {{ $records->appends(Request::except('page'))->links('pagination::bootstrap-4') }}
    </nav>
</div>