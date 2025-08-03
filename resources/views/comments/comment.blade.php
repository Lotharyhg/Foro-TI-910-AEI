{{-- CREACIÓN DE VISTA PARA LOS COMENTARIOS BY JORGE ALDAIR PÉREZ --}}
@if($level > 0)
    <div class="flex">
        <div class="w-8 flex-shrink-0 relative">
            <div class="absolute left-4 top-0 bottom-0 w-0.5 bg-gray-300 dark:bg-gray-600"></div>
        </div>
        <div class="flex-1">
@endif
<div class="comment-item {{ $level === 0 ? 'mb-8 pb-6 border-b-2 border-gray-200 dark:border-gray-700 last:border-b-0 last:pb-0' : 'mb-4' }}">
    <div class="flex space-x-3 py-2">
        <div class="flex-shrink-0">
        {{-- Imagen de perfil en comentario by Osacar and  @mandarinnaa tiene que estar autenticado--}} 
@auth
    <img src="{{ Auth::user()->profile_photo_url }}" class="w-8 h-8 rounded-full object-cover">
@endauth

        </div>
        
        <div class="flex-1 min-w-0">
            <div class="flex items-center space-x-2 mb-1">

                <span class="font-medium text-gray-900 dark:text-gray-100 text-sm">
                    {{ $comment->user->name }}
                </span>
                <span class="text-gray-500 dark:text-gray-400 text-xs">
                    {{ $comment->created_at->diffForHumans() }}
                </span>
                @unless ($comment->created_at->eq($comment->updated_at))
                    <span class="text-gray-400 dark:text-gray-500 text-xs">• editado</span>
                @endunless
            </div>
            
            <div id="comment-content-{{ $comment->id }}" class="text-gray-800 dark:text-gray-200 text-sm leading-relaxed mb-2">
                {{ $comment->content }}
            </div>
            
            @can('update', $comment)
            <div id="edit-form-{{ $comment->id }}" class="hidden mb-2">
                <form action="{{ route('comments.update', $comment) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-3 border border-gray-200 dark:border-gray-600">
                        <textarea name="content"
                                  class="w-full border-0 bg-transparent resize-none focus:ring-0 text-sm dark:text-white placeholder-gray-500 dark:placeholder-gray-400"
                                  rows="3"
                                  style="outline: none; box-shadow: none;">{{ $comment->content }}</textarea>
                        <div class="flex justify-end space-x-2 mt-2">
                            <button type="button" onclick="toggleEditForm({{ $comment->id }})" 
                                    class="px-3 py-1 text-xs text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 transition-colors">
                                Cancelar
                            </button>
                            <button type="submit" 
                                    class="px-3 py-1 bg-blue-600 text-white text-xs rounded-md hover:bg-blue-700 transition-colors">
                                Guardar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            @endcan
            
            <div class="flex items-center space-x-4">
                <button onclick="toggleReplyForm({{ $comment->id }})" 
                        class="flex items-center space-x-1 text-gray-500 hover:text-blue-600 dark:text-gray-400 dark:hover:text-blue-400 text-xs font-medium transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.76c0 1.6 1.123 2.994 2.707 3.227 1.068.157 2.148.279 3.238.364.466.037.893.281 1.153.671L12 21l2.652-3.978c.26-.39.687-.634 1.153-.67 1.09-.086 2.17-.208 3.238-.365 1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                    </svg>
                    <span>Responder</span>
                </button>
                
                @can('update', $comment)
                    <button onclick="toggleEditForm({{ $comment->id }})" 
                            class="flex items-center space-x-1 text-gray-500 hover:text-green-600 dark:text-gray-400 dark:hover:text-green-400 text-xs font-medium transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                        </svg>
                        <span>Editar</span>
                    </button>
                @endcan
                
                @can('delete', $comment)
                    <button type="button" onclick="showDeleteModal({{ $comment->id }})"
                            class="flex items-center space-x-1 text-gray-500 hover:text-red-600 dark:text-gray-400 dark:hover:text-red-400 text-xs font-medium transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                        <span>Eliminar</span>
                    </button>
                    
                    <form id="delete-form-{{ $comment->id }}" action="{{ route('comments.destroy', $comment) }}" method="POST" class="hidden">
                        @csrf
                        @method('DELETE')
                    </form>
                @endcan
            </div>
        </div>
    </div>
    
    <div id="reply-form-{{ $comment->id }}" class="hidden {{ $level > 0 ? 'ml-11' : 'ml-11' }} mb-3">
        <form action="{{ route('comments.reply', $comment) }}" method="POST">
            @csrf
            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-3 border border-gray-200 dark:border-gray-600">
                <textarea name="content"
                          placeholder="Escribe tu respuesta..."
                          class="w-full border-0 bg-transparent resize-none focus:ring-0 text-sm dark:text-white placeholder-gray-500 dark:placeholder-gray-400"
                          rows="2"
                          style="outline: none; box-shadow: none;"></textarea>
                <div class="flex justify-end space-x-2 mt-2">
                    <button type="button" onclick="toggleReplyForm({{ $comment->id }})" 
                            class="px-3 py-1 text-xs text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 transition-colors">
                        Cancelar
                    </button>
                    <button type="submit" 
                            class="px-3 py-1 bg-blue-600 text-white text-xs rounded-md hover:bg-blue-700 transition-colors">
                        Responder
                    </button>
                </div>
            </div>
        </form>
    </div>
    
    @if($comment->allReplies->count() > 0)
        <div class="mt-3">
            @foreach ($comment->allReplies as $reply)
                @include('comments.comment', ['comment' => $reply, 'level' => $level + 1])
            @endforeach
        </div>
    @endif
</div>
@if($level > 0)
        </div>
    </div>
@endif

<div id="delete-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white dark:bg-gray-800 rounded-lg p-6 max-w-md w-full mx-4 transform transition-all">
        <div class="flex items-center justify-center w-12 h-12 mx-auto bg-red-100 dark:bg-red-900/20 rounded-full mb-4">
            <svg class="w-6 h-6 text-red-600 dark:text-red-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
            </svg>
        </div>
        
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white text-center mb-2">
            Eliminar comentario
        </h3>
        
        <p class="text-gray-600 dark:text-gray-300 text-center mb-6">
            ¿Estás seguro de que quieres eliminar este comentario? Esta acción no se puede deshacer.
        </p>
        
        <div class="flex space-x-3 justify-end">
            <button type="button" onclick="hideDeleteModal()" 
                    class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-md transition-colors">
                Cancelar
            </button>
            <button type="button" onclick="confirmDelete()" 
                    class="px-4 py-2 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-md transition-colors">
                Eliminar
            </button>
        </div>
    </div>
</div>

<script>
let currentCommentId = null;

function toggleReplyForm(commentId) {
    const form = document.getElementById(`reply-form-${commentId}`);
    form.classList.toggle('hidden');
    
    if (!form.classList.contains('hidden')) {
        const textarea = form.querySelector('textarea');
        textarea.focus();
    }
}

function toggleEditForm(commentId) {
    const content = document.getElementById(`comment-content-${commentId}`);
    const editForm = document.getElementById(`edit-form-${commentId}`);
    
    content.classList.toggle('hidden');
    editForm.classList.toggle('hidden');
    
    if (!editForm.classList.contains('hidden')) {
        const textarea = editForm.querySelector('textarea');
        textarea.focus();
        textarea.setSelectionRange(textarea.value.length, textarea.value.length);
    }
}

function showDeleteModal(commentId) {
    currentCommentId = commentId;
    const modal = document.getElementById('delete-modal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function hideDeleteModal() {
    const modal = document.getElementById('delete-modal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    currentCommentId = null;
}

function confirmDelete() {
    if (currentCommentId) {
        const form = document.getElementById(`delete-form-${currentCommentId}`);
        form.submit();
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('delete-modal');
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            hideDeleteModal();
        }
    });
    
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
            hideDeleteModal();
        }
    });
});
</script>