<div id="message">This message will disappear after 5 seconds.</div>
<script>
    const message = document.getElementById('message');

    if (message) {
        setTimeout(() => {
            message.style.display = 'none';
            console.log('Tmessage hidden');
        }, 5000); // 5 seconds
    }
</script>

<!--
    {{-- @if (session('success'))
            <div id="success-message" class="alert alert-success alert-dismissible fade show" role="alert">
                {!! session('success') !!}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
    @endif --}}

    {{-- <form class="favorite-form"
    action="{{ route('countries.favorites', $country->id) }}" method="POST">
    @csrf
    <button type="submit" class="custom-btn">
        @if ($country->is_favorite)
            <img src="/svg-icons/heart-filled.svg" alt="Unfavorite" width="20"
                height="20">
        @else
            <img src="/svg-icons/heart-outline.svg" alt="Favorite" width="20"
                height="20">
        @endif
    </button>
</form> --}}
-->
<!-- {{-- <button type="submit" class="custom-btn">
    <img src="/svg-icons/heart-filled.svg" alt="Unfavorite" width="20" height="20">
</button> --}} -->