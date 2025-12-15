@props([
    'name',
    'show' => false,
    'maxWidth' => '2xl'
])

@php
$widthClasses = [
    'sm' => 'modal-sm',
    'md' => '',
    'lg' => 'modal-lg',
    'xl' => 'modal-xl',
    '2xl' => 'modal-xl',
][$maxWidth] ?? '';
@endphp

<!-- Bootstrap Modal -->
<div class="modal fade" id="modal-{{ $name }}" tabindex="-1" aria-labelledby="modal-{{ $name }}-label" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog {{ $widthClasses }}">
        <div class="modal-content">
            {{ $slot }}
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.addEventListener('open-modal', function(e) {
            if (e.detail === '{{ $name }}') {
                const modal = new bootstrap.Modal(document.getElementById('modal-{{ $name }}'));
                modal.show();
            }
        });
        
        window.addEventListener('close-modal', function(e) {
            if (e.detail === '{{ $name }}') {
                const modal = bootstrap.Modal.getInstance(document.getElementById('modal-{{ $name }}'));
                if (modal) modal.hide();
            }
        });
    });
</script>
