{{-- Paginacioon con uso de lastest() by @mandarinnaa--}}
<div class="mt-10 flex justify-center">
    {{ $posts->onEachSide(1)->links('vendor.pagination.tailwind') }}
</div>
