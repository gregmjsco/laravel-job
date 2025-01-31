<form class="block mx-5 md:mx-auto md:space-x-2 space-y-3 md:space-y-0" method="GET" action="{{ route('jobs.search') }}">
    <input
      type="text"
      name="keywords"
      placeholder="Keywords"
      class="w-full sm:w-80 md:w-72 px-4 py-3 focus:outline-none"
      value="{{ request('keywords') }}"
    />
    <input
      type="text"
      name="location"
      placeholder="Location"
      class="w-full sm:w-80 md:w-72 px-4 py-3 focus:outline-none"
      value="{{ request('location') }}"
    />
    <button
      class="w-full sm:w-80 md:w-auto bg-blue-700 hover:bg-blue-600 text-white px-4 py-3 focus:outline-none"
    >
      <i class="fa fa-search mr-1"></i> Search
    </button>
</form>