<nav class="flex flex-col bg-gray-200 dark:bg-gray-900 w-64 px-12 pt-4 pb-6">
    <!-- SideNavBar -->

    <div class="flex flex-row border-b items-center justify-between pb-2">
        <!-- Hearder -->
        <span class="text-lg font-semibold capitalize dark:text-gray-300">
            my admin
        </span>
    </div>

    <div class="mt-8">
        <!-- User info -->
        <h2
            class="mt-4 text-xl dark:text-gray-300 font-extrabold capitalize">
            Hello <br> {{ Auth::user()->name }}
        </h2>

    </div>

    <ul class="mt-2 text-gray-600">
        <!-- Links -->
        <li class="mt-8">
            <a href="{{ route('dashboard') }}" class="flex ">
                <svg
                    class="fill-current h-5 w-5 dark:text-gray-300"
                    viewBox="0 0 24 24">
                    <path
                        d="M16 20h4v-4h-4m0-2h4v-4h-4m-6-2h4V4h-4m6
							4h4V4h-4m-6 10h4v-4h-4m-6 4h4v-4H4m0 10h4v-4H4m6
							4h4v-4h-4M4 8h4V4H4v4z"></path>
                </svg>
                <span
                    class="ml-2 capitalize font-medium text-black
						dark:text-gray-300">
						Dashboard
					</span>
            </a>
        </li>

        <li class="mt-8">
            <a href="{{ route('todo-items.index') }}" class="flex">
                <svg
                    class="fill-current h-5 w-5 dark:text-gray-300"
                    viewBox="0 0 24 24">
                    <path
                        d="M19 19H5V8h14m-3-7v2H8V1H6v2H5c-1.11 0-2 .89-2
							2v14a2 2 0 002 2h14a2 2 0 002-2V5a2 2 0
							00-2-2h-1V1m-1 11h-5v5h5v-5z"></path>
                </svg>
                <span
                    class="ml-2 capitalize font-medium text-black
						dark:text-gray-300">
						Todo items
					</span>
            </a>
        </li>
        <li class="mt-8">
            <a href="{{ route('todo-categories.index') }}" class="flex">
                <svg
                    class="fill-current h-5 w-5 dark:text-gray-300"
                    viewBox="0 0 24 24">
                    <path
                        d="M19 19H5V8h14m-3-7v2H8V1H6v2H5c-1.11 0-2 .89-2
							2v14a2 2 0 002 2h14a2 2 0 002-2V5a2 2 0
							00-2-2h-1V1m-1 11h-5v5h5v-5z"></path>
                </svg>
                <span
                    class="ml-2 capitalize font-medium text-black
						dark:text-gray-300">
						Todo categories
					</span>
            </a>
        </li>
    </ul>

    <div class="mt-auto flex items-center text-red-700 dark:text-red-400">
        <!-- important action -->
        {{ html()->form('POST', route('logout'))->open() }}
        <button type="submit" class="flex items-center">
            <svg class="fill-current h-5 w-5" viewBox="0 0 24 24">
                <path
                    d="M16 17v-3H9v-4h7V7l5 5-5 5M14 2a2 2 0 012
						2v2h-2V4H5v16h9v-2h2v2a2 2 0 01-2 2H5a2 2 0 01-2-2V4a2 2
						0 012-2h9z"></path>
            </svg>
            <span class="ml-2 capitalize font-medium">log out</span>
        </button>
        {{ html()->form()->close() }}


    </div>
</nav>
