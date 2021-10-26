<div class="col-12">
    @if (session()->has('success'))
        <div class="aler alert-success">{{ session()->get('success') }}</div>
    @elseif (session()->has('error'))
        <div class="aler alert-danger">{{ session()->get('error') }}</div>
    @endif
</div>
