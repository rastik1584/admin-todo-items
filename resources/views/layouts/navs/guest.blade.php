<nav class="flex flex-col bg-gray-200 dark:bg-gray-900 w-64 px-12 pt-4 pb-6">
    <!-- SideNavBar -->

    <div class="flex flex-row border-b items-center justify-between pb-2">
        <!-- Hearder -->
        <span class="text-lg font-semibold capitalize dark:text-gray-300">
				my admin
        </span>
    </div>

    <ul class="mt-2 text-gray-600">
        <!-- Links -->
        <li class="mt-8">
            <a href="{{ route('login.index') }}" class="flex {{ Request::routeIs('login.index') ? 'shadow py-2 bg-white dark:bg-gray-200 rounded-lg -ml-4' : ''}}">
                <svg class="fill-current h-5 w-5" viewBox="0 0 24 24">
                    <path
                        d="M12 4a4 4 0 014 4 4 4 0 01-4 4 4 4 0 01-4-4 4 4 0
							014-4m0 10c4.42 0 8 1.79 8 4v2H4v-2c0-2.21 3.58-4
							8-4z"></path>
                </svg>
                <span
                    class="ml-2 capitalize font-medium text-black
						dark:text-gray-300">
						Login
					</span>
            </a>
        </li>

        <li class="mt-8 {{ Request::routeIs('register.index') ? 'shadow py-2 bg-white dark:bg-gray-200 rounded-lg -ml-4' : ''}}">
            <a href="{{ route('register.index') }}" class="flex">
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
						Register
					</span>
            </a>
        </li>
    </ul>
</nav>

