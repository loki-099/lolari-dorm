@extends('layouts.app')

@section('title', 'Welcome')

@section('main-content')
    <div class="w-full min-h-screen flex flex-col md:flex-row">
        <div style="background-image: url('/images/placeholder.svg')"
            class='flex-1 md:flex-3 h-screen block bg-cover bg-center p-4 md:p-10'>
            <h2 class="font-bold text-white text-xl text-center md:text-left md:text-2xl mb-4 md:mb-10">LDorm</h2>
            <h1 class="font-bold text-white text-center md:text-left text-3xl md:text-8xl">Lolari Dorm Management System</h1>
        </div>
        <div class="flex-3 md:flex-2 px-4 py-8 md:pt-40">
            <div class="mx-auto md:w-[80%]">
                <h1 class="text-2xl font-bold text-heading text-center">Log In</h1>
                <hr class="h-px my-2 bg-neutral-quaternary border-0">
                <p class="text-center w-[90%] mx-auto text-body">Welcome back! Please enter your details below</p>
                <div class="px-4 py-6 bg-gray-100 dark:bg-gray-700 mt-6 rounded-xl">
                    <form class="max-w-sm mx-auto" action="{{ route('admin.dashboard') }}"> {{-- Route to Controller in the future --}}
                        <div class="mb-5">
                            <label for="email-alternative" class="block mb-2.5 text-sm font-medium text-heading">Your
                                email</label>
                            <input type="email" id="email-alternative"
                                class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow placeholder:text-body"
                                placeholder="name@flowbite.com" required />
                        </div>
                        <div class="mb-5">
                            <label for="password-alternative" class="block mb-2.5 text-sm font-medium text-heading">Your
                                password</label>
                            <input type="password" id="password-alternative"
                                class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow placeholder:text-body"
                                placeholder="••••••••" required />
                        </div>
                        <button type="submit"
                            class="text-white bg-brand box-border border border-transparent hover:bg-brand-strong focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none w-full">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
