<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('user_update') }}">
            @csrf

            <div>
                <x-jet-label for="shop_id" value="{{ '店番' }}" />
                <x-jet-input id="shop_id" class="block mt-1 w-full" type="text" name="shop_id" value="{{ $user->shop_id }}" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="name" value="{{ '店名' }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $user->name }}" required autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" autocomplete="new-password" placeholder="変更する場合は入力してください"/>
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" autocomplete="new-password" />
            </div>
            
            <div class="mt-4">
                <x-jet-label for="target_num" value="{{ '予約目標数' }}" />
                <x-jet-input id="target_num" class="block mt-1 w-full" type="number" name="target_num" value="{{ $user->target_num }}"/>
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms"/>

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <x-jet-button  type="button" class="ml-4" onClick='history.back()'>
                    {{ '戻る' }}
                </x-jet-button>

                <x-jet-button class="ml-4">
                    {{ '更新する' }}
                </x-jet-button>
            </div>
        </form>
        
        <script>
            let password = document.getElementById('password');
            let password2 = document.getElementById('password_confirmation');
            password2.addEventListener('input', function(e) {
                let value = e.target.value;
                if(value != '') {
                    password.required = true;
                } else if(value == '') {
                    password.required = false;
                }
            });
        </script>


    </x-jet-authentication-card>
</x-guest-layout>
