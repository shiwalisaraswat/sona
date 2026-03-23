<div class="d-flex justify-content-end">
    <div class="dataTables_info me-3">
        Page {{ $records->currentPage() }} of {{ $records->lastPage() }}, showing {{ $records->count() }} record(s) out of {{ $records->total() }} total
    </div>

    <div class="dataTables_paginate">
        <!-- pagination -->
		{!! $records->appends(Request::except('page'))->links() !!}
    </div>
</div>