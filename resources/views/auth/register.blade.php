<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <div class="pt-5"></div>
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Type -->
            <div>
                <x-label for="type" :value="__('I am a')" />
                <select name="type" id="" class="form-input w-full shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none font-medium text-gray-700" type="text" name="type" :value="old('type')" required autofocus>
                    <option value="Student">Student</option>
                    <option value="Teacher">Teacher</option>
                    <option value="Visitor">Visitor</option>
                </select>
                {{-- <x-input id="role" class="form-input w-full shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none font-medium text-gray-700" type="role" name="role" :value="old('role')" required /> --}}
            </div>


            <!-- Name -->

            
            <div class="mt-4">
                <x-label for="lname" :value="__('FULL NAME')" />
            </div>

            <div class="flex items-center justify-between mt-4">

                <div class='w-full md:w-1/2 px-2 mb-6'>
                    <x-label for="lname" :value="__('Last Name')" />
                    <x-input id="lname" class="form-input w-full shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none font-medium text-gray-700" 
                             type="text" name="lname" :value="old('lname')" required />
                </div>

                <div class='w-full md:w-1/2 px-3 mb-6'>
                    <x-label for="fname" :value="__('First Name')" />
                    <x-input id="fname" class="form-input w-full shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none font-medium text-gray-700" 
                             type="text" name="fname" :value="old('fname')" required />
                </div>
            </div>

            {{-- <div  class="mt-4">
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="form-input w-full shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none font-medium text-gray-700" type="text" name="name" :value="old('name')" required autofocus />
            </div> --}}

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="form-input w-full shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none font-medium text-gray-700" 
                         type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="form-input w-full shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none font-medium text-gray-700"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="form-input w-full shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none font-medium text-gray-700"
                                type="password"
                                name="password_confirmation" required />
            </div>
            <hr class="mt-4">
            <!-- Address -->
            <div class="mt-4">
                <x-label for="address" :value="__('ADDRESS')" />
            </div>

            <div class="flex items-center justify-between mt-4">

                <div class='w-full md:w-1/2 px-3 mb-6'>
                    <x-label for="brgy" :value="__('Barangay')" />
                    <x-input class="form-input w-full shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none font-medium text-gray-700" type="text" name="brgy" :value="old('brgy')" required />
                </div>

                <div class='w-full md:w-1/2 px-3 mb-6'>
                    <x-label for="city_town" :value="__('City/Town')" />
                    <x-input class="form-input w-full shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none font-medium text-gray-700" type="text" name="city_town" :value="old('city_town')" required />
                </div>
                <div class='w-full md:w-1/2 px-3 mb-6'>
                    <x-label for="province" :value="__('Province')" />
                    <x-input class="form-input w-full shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none font-medium text-gray-700" type="text" name="province" :value="old('province')" required />
                </div>
            </div>
            

            <!-- Phone Number -->
            <div class="mt-4">
                <x-label for="phone_number" :value="__('Phone Number')" />

                <x-input id="phone_number" class="form-input w-full shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none font-medium text-gray-700" type="text" name="phone_number" :value="old('phone_number')" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-buttons.button class="ml-4">
                    {{ __('Register') }}
                </x-buttons.button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
