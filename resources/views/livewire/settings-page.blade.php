<main class="create-room layout">
    <div class="container">
        <div class="layout__box">
            <div class="layout__boxHeader">
                <div class="layout__boxTitle">
                    <a href="{{ route('home') }}" wire:navigate>
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                            <path
                                d="M13.723 2.286l-13.723 13.714 13.719 13.714 1.616-1.611-10.96-10.96h27.625v-2.286h-27.625l10.965-10.965-1.616-1.607z" />
                        </svg>
                    </a>
                    <h3>Settings</h3>
                </div>
            </div>

            <div class="settings layout__body">
                <div class="settings__avatar" x-data="{ file: null, preview: '{{ $avatar ? asset('storage/avatars/' . $avatar) : asset('assets/avatar.svg') }}' }">
                    <div class="avatar avatar--large active">
                        <img :src="preview" id="preview-avatar"
                            class="w-full h-full object-cover rounded-full" />
                    </div>

                    <input type="file" id="avatar" class="form__hide"
                        accept="image/png, image/jpeg, image/jpg, image/gif" wire:model.live="newAvatar"
                        @change="file = $event.target.files[0]; if (file) preview = URL.createObjectURL(file);" />
                </div>

                <form class="form" wire:submit.prevent="updateSettings" enctype="multipart/form-data">
                    <div class="form__group form__avatar">
                        <label for="avatar">Upload Avatar</label>
                        <input id="avatar" type="file" accept="image/png, image/gif, image/jpeg"
                            class="form__hide" wire:model.live="newAvatar" />
                        @error('newAvatar')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form__group">
                        <label for="name">Full Name</label>
                        <input id="fullname" name="fullname" type="text" placeholder="e.g. Mena Ehab"
                            wire:model="name" />
                        @error('name')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form__group">
                        <label for="email">Email</label>
                        <input id="email" name="email" type="email" placeholder="e.g. user@domain.com"
                            wire:model="email" />
                        @error('email')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form__group">
                        <label for="about">About</label>
                        <textarea id="about" name="about" placeholder="Write about yourself..." wire:model="about"></textarea>
                        @error('about')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form__action">
                        <a class="btn btn--dark" href="profile.html">Cancel</a>
                        <button type="submit" class="btn btn--main" wire:loading.attr="disabled"
                            wire:target="newAvatar">
                            Update Settings
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
