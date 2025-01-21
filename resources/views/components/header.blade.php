<header class="bg-blue-900 text-white p-4" x-data="{ open: false }">
    <div class="container mx-auto flex justify-between items-center">
        <h1 class="text-3xl font-semibold">
            <a href="{{url('/')}}">Jobs in Japan</a>
        </h1>
        <nav class="hidden md:flex items-center space-x-4">
            <x-nav-link url="/" :active="request()->is('/')">Home</x-nav-link>
            <x-nav-link url="/jobs" :active="request()->is('jobs')">All Jobs</x-nav-link>
            @auth
            <x-nav-link url="/jobs/saved" :active="request()->is('jobs/saved')">Saved Jobs</x-nav-link>
            <x-nav-link url="/dashboard" :active="request()->is('dashboard')" icon="gauge">Dashboard</x-nav-link>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-white">
                  <i class="fa fa-sign-out"></i> Logout
                </button>
              </form>
            <x-button-link url="/jobs/create" icon="edit">Create Job</x-button-link>
            @else
            <x-nav-link url="/login" :active="request()->is('login')">Login</x-nav-link>
            <x-nav-link url="/register" :active="request()->is('register')">Register</x-nav-link>
            @endauth
        </nav>
        <button @click="open = !open"  class="text-white md:hidden flex items-center ">
            <i class="fa fa-bars text-2xl"></i>
        </button>
    </div>
    <!-- Mobile Menu -->
    <nav x-show="open" @click.away="open = false" x-transition class="md:hidden bg-blue-900 text-white mt-5 pb-4 space-y-2">
        <x-nav-link url="/" :active="request()->is('/')">Home</x-nav-link>
        <x-nav-link url="/jobs" :active="request()->is('jobs')" :mobile="true">All Jobs</x-nav-link>
        @auth
        <x-nav-link url="/jobs/saved" :active="request()->is('jobs/saved')" :mobile="true">Saved Jobs</x-nav-link>
        <x-nav-link url="/dashboard" :active="request()->is('dashboard')" :mobile="true">Dashboard</x-nav-link>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-white">
              <i class="fa fa-sign-out"></i> Logout
            </button>
          </form>
          <div class="py-2">
              <x-button-link url="/jobs/create" icon="edit" :block="true">Create Job</x-button-link>
          </div>
          @else
        <x-nav-link url="/login" :active="request()->is('login')" :mobile="true">Login</x-nav-link>
        <x-nav-link url="/register" :active="request()->is('register')" :mobile="true">Register</x-nav-link>
        @endauth
        
    </nav>
</header>
