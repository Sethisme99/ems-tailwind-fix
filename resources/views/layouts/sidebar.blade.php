<ul class="space-y-4">
    <li>
      <a href="{{ route('dashboard') }}" class="flex items-center gap-2 hover:bg-blue-500 px-3 py-2 rounded transition
      {{ request()->routeIs('dashboard') ? 'bg-blue-100 text-blue-700 font-bold' : 'text-white' }}">
        <i class="fas fa-home"></i> Dashboard
      </a>
    </li>
    <li>
      <a href="{{ route('employees.index') }}" class="flex items-center gap-2 hover:bg-blue-500 px-3 py-2 rounded transition
      {{ request()->routeIs('employees.index') ? 'bg-blue-100 text-blue-700 font-bold' : 'text-white' }}">
        <i class="fas fa-users"></i> Employees
      </a>
    </li>
</ul>