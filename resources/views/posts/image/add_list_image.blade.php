{{-- Mostrar en la lista las imagenes by Michelle Adriana Flores Mora --}}
@if($post->image)
<div class="mt-4 transition-all duration-300 hover:scale-[1.01]">
    <div class="relative group">
        <img src="{{ asset('storage/' . $post->image) }}" 
             alt="Post Image / Imagen del post" 
             class="rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 w-full max-h-40 object-contain">
        <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 group-hover:opacity-100 rounded-xl transition-opacity duration-300 flex items-end p-4">
            <span class="text-white text-sm font-medium">
                {{ __('Post Image') }}
            </span>
        </div>
    </div>
</div>
@endif