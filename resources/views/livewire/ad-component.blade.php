<div class="">
    @if ($ad && $ad?->status == 1 && $ad->expire_at > now())
        <a class="ad d-flex justify-content-center align-items-center py-1 px-2" href="{{ $ad->link }}" target="_blank" >
            <img src="{{ $ad->image }}" style="max-height: {{ $height ?? 'inherit' }}"  alt="">
        </a>
    @endif
</div>
