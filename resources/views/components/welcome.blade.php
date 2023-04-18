<div class="p-6 lg:p-8 bg-white border-b border-gray-200">

    <h1 class="text-2xl font-medium text-gray-900">
        Welcome {{ Auth::user()->name }}!
    </h1>

    <p class="mt-6 text-gray-500 leading-relaxed">
        This is a simple Dashboard for you to use.
    </p>
</div>

<div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
    <div>
        <div class="flex items-center">
            <h2 class="ml-3 text-xl font-semibold text-gray-900">
            <a href="{{ route('home') }}">Inventory</a>
            </h2>
        </div>

        <p class="mt-4 text-gray-500 text-sm leading-relaxed">
            Inventory system where you can manage your items in your shop. <br>
            There are 2 types of Inventory. The first one is Private without search 
            and the other is Public with search but only viewing of items.
        </p>

        <p class="mt-4 text-sm">
            <a href="{{ route('home') }}" class="inline-flex items-center font-semibold text-indigo-700">
                Explore the inventory

                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="ml-1 w-5 h-5 fill-indigo-500">
                    <path fill-rule="evenodd" d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z" clip-rule="evenodd" />
                </svg>
            </a>
        </p>
    </div>

    <div>
        <div class="flex items-center">
            <h2 class="ml-3 text-xl font-semibold text-gray-900">
            <a href="{{ route('home2') }}">Posts</a>
            </h2>
        </div>

        <p class="mt-4 text-gray-500 text-sm leading-relaxed">
            Post what you feel or like and share it to everyone. <br>
            Express yourself and be more confident.
        </p>

        <p class="mt-4 text-sm">
            <a href="{{ route('home2') }}" class="inline-flex items-center font-semibold text-indigo-700">
                Explore the posts

                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="ml-1 w-5 h-5 fill-indigo-500">
                    <path fill-rule="evenodd" d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z" clip-rule="evenodd" />
                </svg>
            </a>
        </p>
    </div>

    <div>
        <div class="flex items-center">
            <h2 class="ml-3 text-xl font-semibold text-gray-900">
            <a href="{{ route('chat') }}">Chats</a>
            </h2>
        </div>

        <p class="mt-4 text-gray-500 text-sm leading-relaxed">
            Connect to everyone and contact them through our Chat System.
        </p>

        <p class="mt-4 text-sm">
            <a href="{{ route('chat') }}" class="inline-flex items-center font-semibold text-indigo-700">
                Explore the chat

                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="ml-1 w-5 h-5 fill-indigo-500">
                    <path fill-rule="evenodd" d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z" clip-rule="evenodd" />
                </svg>
            </a>
        </p>
    </div>

</div>
