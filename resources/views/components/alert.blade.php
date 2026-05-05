<div x-data="{ show: @entangle('showAlert') }" x-show="show" x-transition class="alert alert-success alert-dismissible fade show position-fixed" style="top: 20px; right: 20px; z-index: 9999; min-width: 300px;" role="alert">
    {{ $slot }}
    <button type="button" class="btn-close" x-on:click="show = false"></button>
</div>
<script>
    setTimeout(() => {
        if (window.livewire) {
            window.livewire.emit('alertHide');
        }
    }, 5000);
</script>
