@if ($paginator->hasPages())
        & ditampilkan dari <b>{{ $paginator->firstItem() }}</b> sampai <b>{{ $paginator->lastItem()}}</b>
@endif
