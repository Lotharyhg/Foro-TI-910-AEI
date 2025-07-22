{{-- Módulo de agregar imagen by Michelle Adriana Flores Mora --}}
<div class="mt-8 space-y-4">
    <label class="flex items-center text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
        {{ __('Add Image to Post') }}
    </label>

    <div x-data="{ imagePreview: null }" class="flex flex-col items-center justify-center border-2 border-dashed border-slate-400 dark:border-slate-500 rounded-3xl p-8 bg-white/60 dark:bg-slate-800/50 backdrop-blur-md hover:border-slate-500 transition duration-300 shadow-md hover:shadow-xl">

        <template x-if="imagePreview">
            <img :src="imagePreview" alt="Vista previa" class="rounded-2xl max-h-40 mb-4 shadow-md border border-gray-300 dark:border-slate-700">
        </template>

        <label class="cursor-pointer flex flex-col items-center space-y-3 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-slate-400 dark:text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
            </svg>

            <span class="text-sm text-gray-600 dark:text-slate-400 leading-tight">
                <span class="font-semibold text-slate-600 dark:text-slate-400">{{ __('Click to upload') }}</span><br>
                {{ __('or drag and drop') }}
            </span>

            <span class="text-xs text-gray-500 dark:text-slate-500 italic">
                PNG, JPG • Max 2MB
            </span>

            <input type="file" name="image" class="hidden" @change="
                const file = $event.target.files[0];
                if(file){
                    const reader = new FileReader();
                    reader.onload = (e) => imagePreview = e.target.result;
                    reader.readAsDataURL(file);
                }
            ">
        </label>
    </div>

    <x-input-error :messages="$errors->get('image')" class="mt-3" />
</div>