<div class="container mt-4">
  <h2>Manage Users & Roles</h2>

  <!-- Tabs -->
  <ul class="nav nav-tabs" id="userRoleTabs">
    <li class="nav-item">
      <a class="nav-link active" id="usersTab" href="#">Users</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="rolesTab" href="#">Roles</a>
    </li>
  </ul>

  <!-- Users Section -->
  <div id="usersSection" class="mt-3">
    <h3>Manage Users</h3>
    <form id="userForm">
      @csrf
      <input type="hidden" id="userId">
      <div class="mb-3">
        <label for="userName" class="form-label">Name</label>
        <input type="text" class="form-control" id="userName" name="name" placeholder="Enter full name" required>
      </div>
      <div class="mb-3">
        <label for="userEmail" class="form-label">Email</label>
        <input type="email" class="form-control" id="userEmail" name="email" placeholder="Enter email" required>
      </div>
      <div class="mb-3">
        <label for="userRole" class="form-label">Role</label>


        <ul>
          @foreach($roles as $role)
          <li>
            <label class="checkbox">
              <input type="checkbox" name="role[]" value="{{ $role->id }}">
              {{ $role->name }}
            </label>
          </li>
          @endforeach

          @if(count($roles) == 0)
          <li>
            <p>No roles available</p>
          </li>
          @endif
        </ul>
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
      </div>

      <div class="mb-3">
        <label for="password_confirmation" class="form-label">Re-enter Password</label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Re-enter your password" required>
      </div>


      <button type="submit" class="btn btn-primary" id="saveUserBtn">Save User</button>

    </form>
  </div>

  <!-- Roles Section (Initially Hidden) -->
  <div id="rolesSection" class="mt-3" style="display: none;">
    <h3>Manage Roles</h3>

    <!-- Add Role Form -->
    <div class="mb-3">
      <label for="roleName" class="form-label">New Role</label>
      <input type="text" class="form-control" id="roleName" placeholder="Enter role name">
      <button class="btn btn-success mt-2" id="addRoleBtn">Add Role</button>
    </div>

    <!-- Roles List -->
    <h4>Existing Roles</h4>
    <p id="msg"></p>
    <ul id="rolesList" class="list-group">
      <!-- Roles will be dynamically added here -->
    </ul>
  </div>



  <hr class="my-5">

  <!-- Users Table -->
  <h4>Existing Users</h4>
  <table class="table table-bordered" id="usersTable">
    <thead class="table-light">
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <!-- Users will be dynamically loaded here -->
    </tbody>
  </table>
</div>



<script>
  $(document).ready(function() {


    $('#userForm').on('submit', function(e) {
      e.preventDefault();

      $.ajax({
        type: 'POST',
        url: "{{ route('saveUser') }}",
        data: $(this).serialize(),
        dataType: 'JSON',
        success: function(response) {
          alert('User created successfully');
          // Reset form or redirect as needed
          $('#userForm')[0].reset();
        },
        error: function(xhr) {
          if (xhr.status === 422) {
            const errors = xhr.responseJSON.error;
            $.each(errors, function(key, value) {
              alert(value[0]);
              console.log(value[0]);
            });
          } else {
            console.log('An error occurred. Please try again.');
          }
        }
      });
    });


    // Tab Switching
    $("#usersTab").click(function() {
      $("#usersSection").show();
      $("#rolesSection").hide();
      $("#usersTab").addClass("active");
      $("#rolesTab").removeClass("active");
    });

    $("#rolesTab").click(function() {
      $("#rolesSection").show();
      $("#usersSection").hide();
      $("#rolesTab").addClass("active");
      $("#usersTab").removeClass("active");
    });


    // Load existing roles on page load
    loadRoles();

    // Add new role
    $('#addRoleBtn').click(function() {
      const roleName = $('#roleName').val().trim();

      if (!roleName) {
        alert('Please enter a role name');
        return;
      }

      $.ajax({
        url: "{{ route('roles.store') }}",
        method: 'POST',
        data: {
          name: roleName,
          _token: '{{ csrf_token() }}'
        },
        success: function(response) {
          if (response.success) {
            $('#roleName').val(''); // Clear input
            loadRoles(); // Refresh list
            $('#msg').html(response.message).addClass('animated slideInLeft alert alert-success');

            setTimeout(function() {
              $('#msg').removeClass('slideInLeft').addClass('animated slideOutRight');
            }, 5000);
          }
        },

        error: function(xhr) {
          const errors = xhr.responseJSON.errors;
          if (errors && errors.name) {
            alert(errors.name[0]);
          } else {
            alert('An error occurred. Please try again.');
          }
        }
      });
    });

    // Function to load all roles
    function loadRoles() {
      $.get("{{ route('roles.index') }}", function(response) {
        const rolesList = $('#rolesList');
        rolesList.empty(); // Clear existing items

        if (response.length > 0) {
          response.forEach(function(role) {
            rolesList.append(`
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            ${role.name}
                            <span class="badge bg-primary rounded-pill">ID: ${role.id}</span>
                        </li>
                    `);
          });
        } else {
          rolesList.append('<li class="list-group-item">No roles found</li>');
        }
      });
    }
  });
</script>