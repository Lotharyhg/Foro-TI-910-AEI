{{-- Módulo de actualizar y eliminar la imagen by Michelle Adriana Flores Mora--}}
@if($post->image)
<div class="space-y-6">
    <div class="relative group transition-all duration-300 hover:shadow-lg">
        <div class="overflow-hidden rounded-xl shadow-md border-2 border-gray-100 dark:border-gray-700 bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-900 p-1">
            <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image / Imagen del post" 
                 class="w-full h-64 object-contain rounded-lg">
        </div>
        
        {{-- Boton de eliminar by Michelle Adriana Flores Mora  --}}
        <div class="mt-4 text-center">
            <button type="button" onclick="document.getElementById('remove_image').value = '1'; this.disabled = true; this.classList.add('opacity-50', 'cursor-not-allowed')"
                    class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:from-red-600 hover:to-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-all duration-200 shadow-md hover:shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
                {{ __('Delete Image') }} 
            </button>
            <input type="hidden" name="remove_image" id="remove_image" value="0">
        </div>
    </div>
</div>
@endif