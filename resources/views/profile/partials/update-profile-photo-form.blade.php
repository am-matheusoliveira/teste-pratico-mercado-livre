<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">{{ __('Profile Photo') }}</h2>        
        <p class="mt-1 text-sm text-gray-600">{{ __("Update your profile picture.") }}</p>
    </header>
    
    <form method="post" action="{{ route('profile.updatePhoto') }}#profile-photo" class="mt-6 space-y-6" id="profile-form" enctype="multipart/form-data">
        @csrf
        @method('patch')
        
        <!-- Picture -->
        <x-picture-input />
    </form>
</section>
