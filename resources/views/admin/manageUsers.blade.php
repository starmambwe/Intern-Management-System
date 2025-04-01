<style>
  .badge {
    margin-right: 3px;
  }

  .text-muted {
    font-style: italic;
    color: #6c757d;
  }

  #rolesCheckboxGroup {
    max-height: 300px;
    overflow-y: auto;
    padding: 10px;
    border: 1px solid #dee2e6;
    border-radius: 5px;
  }

  .form-check {
    margin-bottom: 8px;
    padding: 5px;
    border-bottom: 1px solid #f0f0f0;
  }

  .form-check:last-child {
    border-bottom: none;
  }


  .updated-highlight {
    animation: highlight-fade 2s;
    background-color: rgba(40, 167, 69, 0.1);
  }

  @keyframes highlight-fade {
    0% {
      background-color: rgba(40, 167, 69, 0.3);
    }

    100% {
      background-color: transparent;
    }
  }

  .user-roles {
    min-width: 150px;
  }

  .badge {
    margin-bottom: 3px;
    display: inline-flex;
    align-items: center;
  }
</style>

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
        <th>Roles</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($users as $user)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td class="user-roles">
          @foreach($user->roles as $role)
          <span class="badge bg-primary">{{ $role->name }}</span>
          @if(!$loop->last) , @endif
          @endforeach
          @if($user->roles->isEmpty())
          <span class="text-muted">No roles assigned</span>
          @endif
        </td>
        <td>
          <button class="btn btn-sm btn-warning edit-user" data-id="{{ $user->id }}">
            <i class="fas fa-edit"></i> Edit
          </button>

          <button class="btn btn-sm btn-primary manage-roles"
            data-user-id="{{ $user->id }}"
            data-user-name="{{ $user->name }}">
            <i class="fas fa-user-cog"></i> Manage Roles
          </button>

        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>



<div class="modal fade" id="rolesModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Manage Roles for: <span id="userName"></span></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="rolesForm">
          @csrf
          <input type="hidden" id="modalUserId">
          <div class="mb-3">
            <label class="form-label">Available Roles</label>
            <div id="rolesCheckboxGroup">
              @foreach($roles as $role)
              <div class="form-check">
                <input class="form-check-input role-checkbox"
                  type="checkbox"
                  name="roles[]"
                  value="{{ $role->id }}"
                  id="role-{{ $role->id }}">
                <label class="form-check-label" for="role-{{ $role->id }}">
                  {{ $role->name }}
                </label>
              </div>
              @endforeach
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="saveRolesBtn">Save Changes</button>
      </div>
    </div>
  </div>
</div>



<script>
  $(document).ready(function() {

    // Show modal with user's current roles
    $(document).on('click', '.manage-roles', function() {
      const userId = $(this).data('user-id');
      const userName = $(this).data('user-name');

      $('#modalUserId').val(userId);
      $('#userName').text(userName);

      // Reset all checkboxes
      $('.role-checkbox').prop('checked', false);

      // Fetch user's current roles
      $.get(`/users/${userId}/roles`, function(response) {
        response.roles.forEach(roleId => {
          $(`#role-${roleId}`).prop('checked', true);
        });

        $('#rolesModal').modal('show');
      });
    });

    // Save role changes
    $('#saveRolesBtn').click(function() {
      const userId = $('#modalUserId').val();
      const roles = $('input[name="roles[]"]:checked').map(function() {
        return this.value;
      }).get();


      $('#saveRolesBtn').prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Saving...');

      $.ajax({
        url: `/users/${userId}/roles`,
        method: 'PUT',
        data: {
          roles: roles,
          _token: '{{ csrf_token() }}'
        },
        success: function(response) {
          $('#saveRolesBtn').prop('disabled', false).html('Save Changes');
          $('#rolesModal').modal('hide');

          // Update the UI directly
          updateUserRolesUI(userId, response.user.roles);

          toastr.success(`${userName}'s roles updated successfully`);
        },
        error: function(xhr) {
          toastr.error(xhr.responseJSON.message || 'Error saving roles');
        }
      });
    });

    function updateUserRolesUI(userId, roles) {
      // Find the user's row in the table
      const userRow = $(`button.manage-roles[data-user-id="${userId}"]`).closest('tr');

      // Clear existing roles
      userRow.find('.user-roles').empty();

      // Add new roles
      if (roles.length > 0) {
        roles.forEach((role, index) => {
          userRow.find('.user-roles').append(`
                <span class="badge bg-primary me-1">${role.name}</span>
            `);
        });
      } else {
        userRow.find('.user-roles').html(`
            <span class="text-muted">No roles assigned</span>
        `);
      }

      // Visual feedback
      userRow.addClass('updated-highlight');
      setTimeout(() => {
        userRow.removeClass('updated-highlight');
      }, 2000);
    }

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