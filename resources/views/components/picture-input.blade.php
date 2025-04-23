<div class="flex items-center" x-data="picturePreview()">
  @auth
    <div class="flex flex-col w-full gap-4">
      <div>
        @if(isset(Auth::user()->profile_photo_path))
          <img id="preview" src="{{ asset('storage/'.Auth::user()->profile_photo_path) }}" alt="Avatar" class="w-24 h-24 rounded-md object-cover bg-gray-200">
        @else      
          <img id="preview" src="{{ asset('img/profile/default-profile-image.png') }}" alt="" class="w-24 h-24 rounded-md object-cover bg-gray-200">
        @endif
      </div>
      
      <x-upload-input-error />

      <div class="w-full flex flex-col md:flex-row justify-between items-start md:items-center gap-4">      
        <div class="flex justify-start gap-4">
          <!-- BOTÃO REMOVER FOTO FUNCIONAL -->
          <x-button @click="removePicture()" type="button" class="relative">
            <div class="flex items-center gap-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
              </svg>
              <span class="leading-none">{{ __('Remove Picture') }}</span>
            </div>
          </x-button>
          
          <!-- BOTÃO CARREGAR FOTO -->
          <x-button @click="document.getElementById('picture').click()" class="relative">
            <div class="flex items-center gap-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
              </svg>                
              <span class="leading-none">{{ __('Upload Picture') }}</span>
            </div>
            <input @change="showPreview(event)" type="file" name="picture" id="picture" class="absolute inset-0 -z-10 opacity-0">
          </x-button>
        </div>
        
        <div class="flex justify-end items-center gap-4">
          <x-primary-button>{{ __('Save') }}</x-primary-button>
            @if (session('status') === 'profile-photo-updated')
              <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600"> {{ __('Saved.') }} </p>
            @endif
        </div>
      </div>
    </div>
  @endauth
  
  @guest
    <div class="rounded-md bg-gray-200 mr-2">
      <img id="preview" src="{{ asset('img/profile/default-profile-image.png') }}" alt="" class="w-24 h-24 rounded-md object-cover">
    </div>
    <div class="flex flex-col justify-end gap-4">
      <!-- BOTÃO REMOVER FOTO FUNCIONAL -->
      <x-button @click="removePicture()" type="button" class="relative">
        <div class="flex items-center gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
          </svg>
          <span class="leading-none">{{ __('Remove Picture') }}</span>
        </div>
      </x-button>
      
      <!-- BOTÃO CARREGAR FOTO -->
      <x-button @click="document.getElementById('picture').click()" class="relative">
        <div class="flex items-center gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
          </svg>
          <span class="leading-none">{{ __('Upload Picture') }}</span>
        </div>
        <input @change="showPreview(event)" type="file" name="picture" id="picture" class="absolute inset-0 -z-10 opacity-0">
      </x-button>
    </div>    
  @endguest
</div>

<x-slot name="customJsCode">
  <script>
    const URLProfileIMG = "{{ asset('img/profile/default-profile-image.png') }}";
  </script>
</x-slot>
