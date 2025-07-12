@props(['title', 'count', 'color'])

<div class="col-md-3 mb-3">
    <div class="card text-white bg-{{ $color }}">
        <div class="card-header">{{ $title }}</div>
        <div class="card-body">
            <h5 class="card-title">{{ $count }}</h5>
        </div>
    </div>
</div>
