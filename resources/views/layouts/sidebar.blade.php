<ul class="space-y-2">
      <li>
          <a href="{{ route('dashboard') }}"
              class="flex items-center hover:bg-blue-500 px-3 py-2 rounded transition
              {{ request()->routeIs('dashboard') ? 'bg-blue-100 text-blue-700 font-bold' : 'text-white' }}">
              <i class="fas fa-home text-lg w-5 text-center"></i>
              <span x-show="sidebarOpen" class="ml-2 whitespace-nowrap">Dashboard</span>
          </a>
      </li>

    <li>
        <a href="{{ route('employees.index') }}"
           class="flex items-center hover:bg-blue-500 px-3 py-2 rounded transition
           {{ request()->routeIs('employees.index') ? 'bg-blue-100 text-blue-700 font-bold' : 'text-white' }}">
            <i class="fas fa-users text-lg w-5 text-center"></i>
            <span x-show="sidebarOpen" class="ml-2 whitespace-nowrap">Employees</span>
        </a>
    </li>

    <li>
        <a href="{{ route('attendances.index') }}"
           class="flex items-center hover:bg-blue-500 px-3 py-2 rounded transition
           {{ request()->routeIs('attendances.index') ? 'bg-blue-100 text-blue-700 font-bold' : 'text-white' }}">
            <i class="fas fa-calendar-days text-lg w-5 text-center"></i>
            <span x-show="sidebarOpen" class="ml-2 whitespace-nowrap">Attendances</span>
        </a>
    </li>

    <li>
        <a href="{{ route('attendance.summary') }}"
           class="flex items-center hover:bg-blue-500 px-3 py-2 rounded transition
           {{ request()->routeIs('attendance.summary') ? 'bg-blue-100 text-blue-700 font-bold' : 'text-white' }}">
            <i class="fa fa-list-alt text-lg w-5 text-center"></i>
            <span x-show="sidebarOpen" class="ml-2 whitespace-nowrap">Monthly Attendance</span>
        </a>
    </li>

    <li>
        <a href="{{ route('payslips.index') }}"
           class="flex items-center hover:bg-blue-500 px-3 py-2 rounded transition
           {{ request()->routeIs('payslips.index') ? 'bg-blue-100 text-blue-700 font-bold' : 'text-white' }}">
            <i class="fa-solid fa-file-invoice-dollar text-lg w-5 text-center"></i>
            <span x-show="sidebarOpen" class="ml-2 whitespace-nowrap">Payslips</span>
        </a>
    </li>

    <li>
        <a href="#" class="flex items-center hover:bg-blue-500 px-3 py-2 rounded transition text-white">
            <i class="fas fa-person-walking-arrow-right text-lg w-5 text-center"></i>
            <span x-show="sidebarOpen" class="ml-2 whitespace-nowrap">Holiday Requests</span>
        </a>
    </li>
</ul>
