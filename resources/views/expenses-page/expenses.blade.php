@extends('layouts.admin')

@section('title', 'Expenses')

@section('main-content')
    <div class="flex pt-16 overflow-hidden bg-gray-50 dark:bg-gray-900">
        <aside id="sidebar"
            class="fixed top-0 left-0 z-20 flex flex-col flex-shrink-0 hidden w-64 h-full pt-16 font-normal duration-75 lg:flex transition-width"
            aria-label="Sidebar">
            <div
                class="relative flex flex-col flex-1 min-h-0 pt-0 bg-white border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                <div class="flex flex-col flex-1 pt-5 pb-4 overflow-y-auto">
                    <div
                        class="flex-1 px-3 space-y-1 bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                        <ul class="pb-2 space-y-2">
                            <li>
                                <form action="#" method="GET" class="lg:hidden">
                                    <label for="mobile-search" class="sr-only">Search</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0  flex items-center pl-3 pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <input type="text" name="email" id="mobile-search"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-200 dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Search">
                                    </div>
                                </form>
                            </li>
                            <li>
                                <a href="{{ route('admin.dashboard') }}"
                                    class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                                    <svg class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                                        <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                                    </svg>
                                    <span class="ml-3" sidebar-toggle-item>Dashboard</span>
                                </a>
                            </li>
                            <li>
                                <button type="button"
                                    class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700"
                                    aria-controls="dropdown-crud" data-collapse-toggle="dropdown-crud">
                                    <svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M16 11c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm-8 0c1.657 0 3-1.343 3-3S9.657 5 8 5 5 6.343 5 8s1.343 3 3 3zm0 2c-2.667 0-8 1.333-8 4v3h16v-3c0-2.667-5.333-4-8-4zm8 0c-.29 0-.577.017-.858.05 1.177.943 1.858 2.225 1.858 3.95v3h8v-3c0-2.667-5.333-4-8-4z">
                                        </path>
                                    </svg>
                                    <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>Users</span>
                                    <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                                <ul id="dropdown-crud" class="space-y-2 py-2 hidden ">
                                    <li>
                                        <a href=""
                                            class="text-base text-gray-900 rounded-lg flex items-center p-2 group hover:bg-gray-100 transition duration-75 pl-11 dark:text-gray-200 dark:hover:bg-gray-700 ">Staff</a>
                                    </li>
                                    <li>
                                        <a href=""
                                            class="text-base text-gray-900 rounded-lg flex items-center p-2 group hover:bg-gray-100 transition duration-75 pl-11 dark:text-gray-200 dark:hover:bg-gray-700 ">Boarders</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href=""
                                    class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700 ">
                                    <svg class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M3 9v12h18V9H3zm2 2h2v2H5v-2zm4 0h2v2H9v-2zm4 0h2v2h-2v-2zm4 0h2v2h-2v-2zM3 3h18v4H3V3z">
                                        </path>
                                    </svg>
                                    <span class="ml-3" sidebar-toggle-item>Rooms</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/expenses') }}"
                                    class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700 ">
                                    <svg class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M3 2h18v20l-3-3-3 3-3-3-3 3-3-3V2zm2 2v14l1.5-1.5L8 18l1.5-1.5L11 18l1.5-1.5L14 18l1.5-1.5L18 18V4H5z">
                                        </path>
                                    </svg>
                                    <span class="ml-3" sidebar-toggle-item>Expenses</span>
                                </a>
                            </li>
                            <li>
                                <button type="button"
                                    class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700"
                                    aria-controls="dropdown-playground" data-collapse-toggle="dropdown-playground">
                                    <svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M21 7H3V5a2 2 0 012-2h14a2 2 0 012 2v2zm0 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2v-8h18zm-3 2a1 1 0 100 2 1 1 0 000-2z">
                                        </path>
                                    </svg>
                                    <span class="flex-1 ml-3 text-left whitespace-nowrap"
                                        sidebar-toggle-item>Finances</span>
                                    <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                                <ul id="dropdown-playground" class="space-y-2 py-2 hidden ">
                                    <li>
                                        <a href=""
                                            class="text-base text-gray-900 rounded-lg flex items-center p-2 group hover:bg-gray-100 transition duration-75 pl-11 dark:text-gray-200 dark:hover:bg-gray-700 ">Transaction</a>
                                    </li>
                                    <li>
                                        <a href=""
                                            class="text-base text-gray-900 rounded-lg flex items-center p-2 group hover:bg-gray-100 transition duration-75 pl-11 dark:text-gray-200 dark:hover:bg-gray-700 ">Payments</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href=""
                                    class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700 ">
                                    <svg class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
                                        aria-hidden="true">
                                        <path clip-rule="evenodd" fill-rule="evenodd"
                                            d="M8.34 1.804A1 1 0 019.32 1h1.36a1 1 0 01.98.804l.295 1.473c.497.144.971.342 1.416.587l1.25-.834a1 1 0 011.262.125l.962.962a1 1 0 01.125 1.262l-.834 1.25c.245.445.443.919.587 1.416l1.473.294a1 1 0 01.804.98v1.361a1 1 0 01-.804.98l-1.473.295a6.95 6.95 0 01-.587 1.416l.834 1.25a1 1 0 01-.125 1.262l-.962.962a1 1 0 01-1.262.125l-1.25-.834a6.953 6.953 0 01-1.416.587l-.294 1.473a1 1 0 01-.98.804H9.32a1 1 0 01-.98-.804l-.295-1.473a6.957 6.957 0 01-1.416-.587l-1.25.834a1 1 0 01-1.262-.125l-.962-.962a1 1 0 01-.125-1.262l.834-1.25a6.957 6.957 0 01-.587-1.416l-1.473-.294A1 1 0 011 10.68V9.32a1 1 0 01.804-.98l1.473-.295c.144-.497.342-.971.587-1.416l-.834-1.25a1 1 0 01.125-1.262l.962-.962A1 1 0 015.38 3.03l1.25.834a6.957 6.957 0 011.416-.587l.294-1.473zM13 10a3 3 0 11-6 0 3 3 0 016 0z">
                                        </path>
                                    </svg>
                                    <span class="ml-3" sidebar-toggle-item>Settings</span>
                                </a>
                            </li>
                        </ul>
                        <div class="pt-2 space-y-2">

                        </div>
                    </div>
                </div>
                <div class="absolute bottom-0 left-0 justify-center hidden w-full p-4 space-x-4 bg-white lg:flex dark:bg-gray-800"
                    sidebar-bottom-menu>
                    <span class="flex items-center px-3 text-sm text-gray-500 dark:text-gray-400">
                        © lolari dorm 2026
                    </span>
                    <div id="tooltip-settings" role="tooltip"
                        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                        Lolari dorm
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                </div>
            </div>
        </aside>

        <div class="fixed inset-0 z-10 hidden bg-gray-900/50 dark:bg-gray-900/90" id="sidebarBackdrop"></div>

        <div id="main-content" class="relative w-full h-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900">
            <main>
                <div class="px-4 pt-6">
                    <!-- Success Message -->
                    @if(session('success'))
                        <div class="mb-4 p-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                            role="alert">
                            <span class="font-medium">Success!</span> {{ session('success') }}
                        </div>
                    @endif

                    <!-- Total Expenses Card -->
                    <div class="grid gap-4 mb-4 xl:grid-cols-1">
                        <div
                            class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 dark:bg-gray-800">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Total Expenses</h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">All time expenses</p>
                                </div>
                                <div class="text-right">
                                    <span
                                        class="text-3xl font-bold text-gray-900 dark:text-white">₱{{ number_format($totalExpenses, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div
                        class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                        <!-- Card header -->
                        <div class="items-center justify-between lg:flex">
                            <div class="mb-4 lg:mb-0">
                                <h3 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">Expenses</h3>
                                <span class="text-base font-normal text-gray-500 dark:text-gray-400">This is a list of all
                                    expenses</span>
                            </div>
                            <div class="items-center sm:flex">
                                <!-- Add Expense Button -->
                                <button type="button" data-modal-toggle="add-expense-modal"
                                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-primary-700 rounded-lg hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    Add Expense
                                </button>
                            </div>
                        </div>

                        <!-- Table -->
                        <div class="flex flex-col mt-6">
                            <div class="overflow-x-auto rounded-lg">
                                <div class="inline-block min-w-full align-middle">
                                    <div class="overflow-hidden shadow sm:rounded-lg">
                                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                                            <thead class="bg-gray-50 dark:bg-gray-700">
                                                <tr>
                                                    <th scope="col"
                                                        class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                                        Description
                                                    </th>
                                                    <th scope="col"
                                                        class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                                        Amount
                                                    </th>

                                                    <th scope="col"
                                                        class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                                        Date & Time
                                                    </th>
                                                    <th scope="col"
                                                        class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                                        Staff
                                                    </th>
                                                    <th scope="col"
                                                        class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                                        Actions
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white dark:bg-gray-800">
                                                @forelse($expenses as $index => $expense)
                                                    <tr class="{{ $index % 2 === 0 ? 'bg-gray-50 dark:bg-gray-700' : '' }}">
                                                        <td
                                                            class="p-4 text-sm font-normal text-gray-900 whitespace-nowrap dark:text-white">
                                                            {{ $expense['description'] }}
                                                        </td>
                                                        <td
                                                            class="p-4 text-sm font-semibold text-gray-900 whitespace-nowrap dark:text-white">
                                                            ₱{{ number_format($expense['amount'], 2) }}
                                                        </td>
                                                        <td
                                                            class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                            {{ \Carbon\Carbon::parse($expense['created_at'])->timezone('Asia/Manila')->format('M d, Y h:i A') }}
                                                        </td>
                                                        <td
                                                            class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                            {{ $expense['staff'] }}
                                                        </td>
                                                        <td class="p-4 whitespace-nowrap">
                                                            <!-- Edit Button -->
                                                            <button type="button" data-modal-toggle="edit-expense-modal"
                                                                data-expense-id="{{ $expense['id'] }}"
                                                                data-description="{{ $expense['description'] }}"
                                                                data-amount="{{ $expense['amount'] }}"
                                                                data-staff="{{ $expense['staff'] }}"
                                                                class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 inline-flex items-center mr-2">
                                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                                                    </path>
                                                                </svg>
                                                            </button>
                                                            <!-- Delete Button -->
                                                            <form action="{{ route('expenses.destroy', $expense['id']) }}"
                                                                method="POST" class="inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300"
                                                                    onclick="return confirm('Are you sure you want to delete this expense?')">
                                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path fill-rule="evenodd"
                                                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                                            clip-rule="evenodd"></path>
                                                                    </svg>
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="5"
                                                            class="p-4 text-center text-gray-500 dark:text-gray-400">
                                                            No expenses found.
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <p class="my-10 text-sm text-center text-gray-500">
                &copy; 2026 <a href="https://flowbite.com/" class="hover:underline" target="_blank">LolariDorm</a>. All
                rights reserved.
            </p>
        </div>
    </div>

    <!-- Add Expense Modal -->
    <div id="add-expense-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full h-full bg-black/20 flex items-center justify-center">
        <div class="relative p-4 w-full max-w-md">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
                <!-- Modal header -->
                <div class="flex justify-between items-center p-4 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Add New Expense
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-close="add-expense-modal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <form action="{{ route('expenses.store') }}" method="POST" class="p-4">
                    @csrf
                    <div class="grid gap-4 mb-4 sm:grid-cols-1">
                        <div>
                            <label for="add-description"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                            <input type="text" name="description" id="add-description"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Enter expense description" required>
                        </div>
                        <div>
                            <label for="add-amount"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Amount</label>
                            <input type="number" name="amount" id="add-amount" step="0.01" min="0"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="0.00" required>
                        </div>
                        <div>
                            <label for="add-staff"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Staff</label>
                            <input type="text" name="staff" id="add-staff"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Enter staff name" required>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Add Expense
                        </button>
                        <button type="button" data-modal-close="add-expense-modal"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-300 border border-gray-200 rounded-lg text-sm px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="edit-expense-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full h-full bg-black/20 flex items-center justify-center">
        <div class="relative p-4 w-full max-w-md">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
                <!-- Modal header -->
                <div class="flex justify-between items-center p-4 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Edit Expense
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-close="edit-expense-modal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form id="edit-expense-form" method="POST" class="p-4">
                    @csrf
                    @method('PUT')
                    <div class="grid gap-4 mb-4 sm:grid-cols-1">
                        <div>
                            <label for="edit-description"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                            <input type="text" name="description" id="edit-description"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Enter expense description" required>
                        </div>
                        <div>
                            <label for="edit-amount"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Amount</label>
                            <input type="number" name="amount" id="edit-amount" step="0.01" min="0"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="0.00" required>
                        </div>
                        <div>
                            <label for="edit-staff"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Staff</label>
                            <input type="text" name="staff" id="edit-staff"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Enter staff name" required>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Update Expense
                        </button>
                        <button type="button" data-modal-close="edit-expense-modal"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-300 border border-gray-200 rounded-lg text-sm px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Flowbite JS for Modal -->
    <script src="https://cdn.jsdelivr.net/npm/flowbite/dist/flowbite.min.js"></script>

    <script>
        // Manual modal toggle functionality
        document.addEventListener('DOMContentLoaded', function () {
            // Add Expense Modal
            const addModal = document.getElementById('add-expense-modal');
            const addOpenButtons = document.querySelectorAll('[data-modal-toggle="add-expense-modal"]');
            const addCloseButtons = document.querySelectorAll('[data-modal-close="add-expense-modal"]');

            // Open add modal
            addOpenButtons.forEach(button => {
                button.addEventListener('click', function () {
                    addModal.classList.remove('hidden');
                    addModal.setAttribute('aria-hidden', 'false');
                });
            });

            // Close add modal on close button click
            addCloseButtons.forEach(button => {
                button.addEventListener('click', function () {
                    addModal.classList.add('hidden');
                    addModal.setAttribute('aria-hidden', 'true');
                });
            });

            // Close add modal on backdrop click
            addModal.addEventListener('click', function (e) {
                if (e.target === addModal) {
                    addModal.classList.add('hidden');
                    addModal.setAttribute('aria-hidden', 'true');
                }
            });

            // Edit Expense Modal
            const editModal = document.getElementById('edit-expense-modal');
            const editOpenButtons = document.querySelectorAll('[data-modal-toggle="edit-expense-modal"]');
            const editCloseButtons = document.querySelectorAll('[data-modal-close="edit-expense-modal"]');
            const editForm = document.getElementById('edit-expense-form');

            // Open edit modal and populate data
            editOpenButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const expenseId = button.getAttribute('data-expense-id');
                    const description = button.getAttribute('data-description');
                    const amount = button.getAttribute('data-amount');
                    const staff = button.getAttribute('data-staff');

                    // Set form action
                    editForm.action = '/expenses/' + expenseId;

                    // Populate form fields
                    document.getElementById('edit-description').value = description;
                    document.getElementById('edit-amount').value = amount;
                    document.getElementById('edit-staff').value = staff;

                    // Show modal
                    editModal.classList.remove('hidden');
                    editModal.setAttribute('aria-hidden', 'false');
                });
            });

            // Close edit modal on close button click
            editCloseButtons.forEach(button => {
                button.addEventListener('click', function () {
                    editModal.classList.add('hidden');
                    editModal.setAttribute('aria-hidden', 'true');
                });
            });

            // Close edit modal on backdrop click
            editModal.addEventListener('click', function (e) {
                if (e.target === editModal) {
                    editModal.classList.add('hidden');
                    editModal.setAttribute('aria-hidden', 'true');
                }
            });

            // Close modals on Escape key
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') {
                    if (!addModal.classList.contains('hidden')) {
                        addModal.classList.add('hidden');
                        addModal.setAttribute('aria-hidden', 'true');
                    }
                    if (!editModal.classList.contains('hidden')) {
                        editModal.classList.add('hidden');
                        editModal.setAttribute('aria-hidden', 'true');
                    }
                }
            });
        });
    </script>

    <script async defer src="https://buttons.github.io/buttons.js"></script>
@endsection