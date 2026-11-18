@props(['status'])

<span class="badge {{ $status === 'berhasil' ? 'badge-success' : 'badge-warning' }}">
    {{ ucfirst($status) }}
</span>
