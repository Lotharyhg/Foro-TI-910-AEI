{{-- Módulo de Agregar Imágenes by Michelle Adriana Flores Mora --}}
<div class="mt-6 space-y-3">
    <label class="flex items-center text-sm font-medium text-gray-700 dark:text-gray-300">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
        {{ __('Add Image to Post') }}
    </label>
    
    <div class="flex items-center gap-4">
        <label class="flex-1 cursor-pointer bg-white dark:bg-gray-800 rounded-xl border-2 border-dashed border-gray-300 dark:border-gray-600 hover:border-indigo-400 dark:hover:border-indigo-500 transition-all duration-300 p-6 hover:shadow-md">
            <div class="flex flex-col items-center justify-center space-y-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                </svg>
                <span class="text-sm text-gray-600 dark:text-gray-400 text-center">
                    <span class="font-medium text-indigo-600 dark:text-indigo-400">
                        {{ __('Click to upload') }}
                    </span>
                    <br>
                    {{ __('or drag and drop') }} 
                </span>
                <span class="text-xs text-gray-500 dark:text-gray-500">
                    PNG, JPG ({{ __('max') }} 2MB) 
                </span>
            </div>
            <input type="file" name="image" class="hidden">
        </label>
    </div>
    
    <x-input-error :messages="$errors->get('image')" class="!mt-2" />
</div>