@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif
@error ('status')
<div class="alert alert-success" role="alert">
    {{ $message }}
</div>
@enderror
