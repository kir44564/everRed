

@auth
<h1>{{ Auth::user()->name }}, welcome to your Dashboard</h1>
@endauth

<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="stylesheet" href="{{ asset('/css/dash.css') }}">



<div class="members">
<div class="table-responsive">
  <div class="table-scroll">
      <table role="grid">
        <thead>
          <tr>
            <th></th>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Created At</th>
          </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
          <tr>

            <td><img src="{{ asset('/images/crashtest.webp') }}" alt=""/></td>

            <td>{{ $user->id }}</td>

            <td>{{ $user->name }}</td>

            <td>{{ $user->email }}</td>

            <td>{{ $user->created_at->format('Y-m-d') }}</td>

          </tr>
            @empty
          <tr>
            <td colspan="5">Nu users found.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>

<a>
    <svg
        class="w-9"
        viewBox="0 0 969 955"
        fill="none"
        xmlns="http://www.w3.org/2000/svg">
    <circle
            cx="161.191"
            cy="320.191"
            r="133.191"
            stroke="currentColor"
            stroke-width="20"></circle>
    <circle
            cx="806.809"
            cy="320.191"
            r="133.191"
            stroke="currentColor"
            stroke-width="20"></circle>
    <circle
            cx="695.019"
            cy="587.733"
            r="31.4016"
            fill="currentColor"></circle>
    <circle
            cx="272.981"
            cy="587.733"
            r="31.4016"
            fill="currentColor"></circle>
    <path
            d="M564.388 712.083C564.388 743.994 526.035 779.911 483.372 779.911C440.709 779.911 402.356 743.994 402.356 712.083C402.356 680.173 440.709 664.353 483.372 664.353C526.035 664.353 564.388 680.173 564.388 712.083Z"
            fill="currentColor"></path>
    <rect
            x="310.42"
            y="448.31"
            width="343.468"
            height="51.4986"
            fill="#FF1E1E"></rect>
    <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M745.643 288.24C815.368 344.185 854.539 432.623 854.539 511.741H614.938V454.652C614.938 433.113 597.477 415.652 575.938 415.652H388.37C366.831 415.652 349.37 433.113 349.37 454.652V511.741L110.949 511.741C110.949 432.623 150.12 344.185 219.845 288.24C289.57 232.295 384.138 200.865 482.744 200.865C581.35 200.865 675.918 232.295 745.643 288.24Z"
            fill="currentColor"></path>
    </svg>
</a>

<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Logout</button>
</form>