<div class="container mt-5">
  <h2>Project Assignments</h2>

  <!-- Tab Navigation -->
  <ul class="nav nav-tabs mb-4" id="assignmentTabs">
      <li class="nav-item">
          <a class="nav-link active" data-bs-toggle="tab" href="#supervisors-tab">Supervisors</a>
      </li>
      <li class="nav-item">
          <a class="nav-link" data-bs-toggle="tab" href="#interns-tab">Interns</a>
      </li>
  </ul>

  <!-- Tab Content -->
  <div class="tab-content">
      <!-- Supervisors Tab -->
      <div class="tab-pane fade show active" id="supervisors-tab">
          <!-- Assignment Form -->
          <form id="supervisorAssignmentForm" class="mb-4">
              @csrf
              <input type="hidden" name="role" value="supervisor">
              <div class="row g-3 align-items-end">
                  <div class="col-md-5">
                      <label for="supervisorProject" class="form-label">Project</label>
                      <select class="form-select" id="supervisorProject" name="project_id" required>
                          <option value="">Select project</option>
                          <!-- Dynamically populated via AJAX -->
                      </select>
                  </div>
                  <div class="col-md-5">
                      <label for="supervisorUser" class="form-label">Supervisor</label>
                      <select class="form-select" id="supervisorUser" name="user_id" required>
                          <option value="">Select supervisor</option>
                          <!-- Dynamically populated via AJAX -->
                      </select>
                  </div>
                  <div class="col-md-2">
                      <button type="submit" class="btn btn-primary w-100">Assign</button>
                  </div>
              </div>
          </form>

          <!-- Supervisors Table -->
          <div class="table-responsive">
              <table class="table table-bordered table-hover">
                  <thead class="table-light">
                      <tr>
                          <th width="5%">#</th>
                          <th width="45%">Project</th>
                          <th width="35%">Supervisor</th>
                          <th width="15%">Actions</th>
                      </tr>
                  </thead>
                  <tbody id="supervisorsTableBody">
                      <!-- Dynamically populated via AJAX -->
                  </tbody>
              </table>
          </div>
      </div>

      <!-- Interns Tab -->
      <div class="tab-pane fade" id="interns-tab">
          <!-- Assignment Form -->
          <form id="internAssignmentForm" class="mb-4">
              @csrf
              <input type="hidden" name="role" value="intern">
              <div class="row g-3 align-items-end">
                  <div class="col-md-5">
                      <label for="internProject" class="form-label">Project</label>
                      <select class="form-select" id="internProject" name="project_id" required>
                          <option value="">Select project</option>
                          <!-- Dynamically populated via AJAX -->
                      </select>
                  </div>
                  <div class="col-md-5">
                      <label for="internUser" class="form-label">Intern</label>
                      <select class="form-select" id="internUser" name="user_id" required>
                          <option value="">Select intern</option>
                          <!-- Dynamically populated via AJAX -->
                      </select>
                  </div>
                  <div class="col-md-2">
                      <button type="submit" class="btn btn-primary w-100">Assign</button>
                  </div>
              </div>
          </form>

          <!-- Interns Table -->
          <div class="table-responsive">
              <table class="table table-bordered table-hover">
                  <thead class="table-light">
                      <tr>
                          <th width="5%">#</th>
                          <th width="45%">Project</th>
                          <th width="35%">Intern</th>
                          <th width="15%">Actions</th>
                      </tr>
                  </thead>
                  <tbody id="internsTableBody">
                      <!-- Dynamically populated via AJAX -->
                  </tbody>
              </table>
          </div>
      </div>
  </div>
</div>


<script>
  // This script handles tab switching, AJAX setup, dynamic dropdown loading, assignment CRUD, and UI feedback via Bootstrap Alerts
    $(document).ready(function() {
    // --- CSRF Token Setup for Laravel AJAX requests ---
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // --- Initialize the currently active tab ---
    let currentTab = window.location.hash || '#supervisors-tab';
    $(`a[href="${currentTab}"]`).tab('show');

    // --- Load data on initial page load ---
    loadDropdowns();
    loadAssignments();

    // --- Update tab in URL and reload assignments when user switches tabs ---
    $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
        window.location.hash = e.target.hash;
        loadAssignments();
    });

    // --- Function to display Bootstrap alerts instead of toastr ---
    function showAlert(message, type = 'success') {
        const alertBox = $('#alertBox');
        alertBox
        .removeClass('d-none alert-success alert-danger alert-warning alert-info')
        .addClass(`alert alert-${type}`)
        .html(message);
        setTimeout(() => alertBox.addClass('d-none'), 5000); // auto-hide after 5 seconds
    }

    // --- Function to load dropdown values for project, supervisor, intern ---
    function loadDropdowns() {
        // Load Projects
        $.ajax({
        url: "{{ route('assignments.projects') }}",
        method: 'GET',
        beforeSend: function() {
            $('#supervisorProject, #internProject').html('<option value="">Loading projects...</option>');
        },
        success: function(projects) {
            let options = '<option value="">Select project</option>';
            projects.forEach(project => {
            options += `<option value="${project.id}">${project.name}</option>`;
            });
            $('#supervisorProject, #internProject').html(options);
        },
        error: function() {
            $('#supervisorProject, #internProject').html('<option value="">Error loading projects</option>');
            showAlert('Failed to load projects', 'danger');
        }
        });

        // Load Supervisors
        $.ajax({
        url: "{{ route('assignments.supervisors') }}",
        method: 'GET',
        beforeSend: function() {
            $('#supervisorUser').html('<option value="">Loading supervisors...</option>');
        },
        success: function(supervisors) {
            let options = '<option value="">Select supervisor</option>';
            supervisors.forEach(s => {
            options += `<option value="${s.id}">${s.name}</option>`;
            });
            $('#supervisorUser').html(options);
        },
        error: function() {
            $('#supervisorUser').html('<option value="">Error loading supervisors</option>');
            showAlert('Failed to load supervisors', 'danger');
        }
        });

        // Load Interns
        $.ajax({
        url: "{{ route('assignments.interns') }}",
        method: 'GET',
        beforeSend: function() {
            $('#internUser').html('<option value="">Loading interns...</option>');
        },
        success: function(interns) {
            let options = '<option value="">Select intern</option>';
            interns.forEach(i => {
            options += `<option value="${i.id}">${i.name}</option>`;
            });
            $('#internUser').html(options);
        },
        error: function() {
            $('#internUser').html('<option value="">Error loading interns</option>');
            showAlert('Failed to load interns', 'danger');
        }
        });
    }

    // --- Function to load current supervisor and intern assignments into respective tables ---
    function loadAssignments() {
        const isSupervisorTab = $('.nav-link.active').attr('href') === '#supervisors-tab';
        const loadingText = isSupervisorTab ? 
        '<tr><td colspan="4" class="text-center">Loading supervisors...</td></tr>' :
        '<tr><td colspan="4" class="text-center">Loading interns...</td></tr>';

        if (isSupervisorTab) {
        $('#supervisorsTableBody').html(loadingText);
        } else {
        $('#internsTableBody').html(loadingText);
        }

        $.ajax({
        url: "{{ route('assignments.assignments') }}",
        method: 'GET',
        success: function(assignments) {
            $('#supervisorsTableBody, #internsTableBody').empty();
            let supCount = 1, internCount = 1;

            assignments.forEach(project => {
            // Supervisors
            project.supervisors.forEach(supervisor => {
                $('#supervisorsTableBody').append(`
                <tr data-project-id="${project.id}" data-user-id="${supervisor.id}">
                    <td>${supCount++}</td>
                    <td>${project.project_name}</td>
                    <td>${supervisor.name}</td>
                    <td>
                    <button class="btn btn-sm btn-danger remove-assignment" 
                        data-project-id="${project.id}"
                        data-user-id="${supervisor.id}"
                        data-role="supervisor">
                        Remove
                    </button>
                    </td>
                </tr>
                `);
            });

            // Interns
            project.interns.forEach(intern => {
                $('#internsTableBody').append(`
                <tr data-project-id="${project.id}" data-user-id="${intern.id}">
                    <td>${internCount++}</td>
                    <td>${project.project_name}</td>
                    <td>${intern.name}</td>
                    <td>
                    <button class="btn btn-sm btn-danger remove-assignment" 
                        data-project-id="${project.id}"
                        data-user-id="${intern.id}"
                        data-role="intern">
                        Remove
                    </button>
                    </td>
                </tr>
                `);
            });
            });

            // Empty States
            if ($('#supervisorsTableBody').is(':empty')) {
            $('#supervisorsTableBody').html('<tr><td colspan="4" class="text-center text-muted">No supervisor assignments found</td></tr>');
            }
            if ($('#internsTableBody').is(':empty')) {
            $('#internsTableBody').html('<tr><td colspan="4" class="text-center text-muted">No intern assignments found</td></tr>');
            }
        },
        error: function(xhr) {
            const msg = xhr.responseJSON?.message || 'Failed to load assignments';
            const errRow = `<tr><td colspan="4" class="text-center text-danger">${msg}</td></tr>`;
            isSupervisorTab ? $('#supervisorsTableBody').html(errRow) : $('#internsTableBody').html(errRow);
            showAlert(msg, 'danger');
        }
        });
    }

    // --- AJAX form submission for assigning supervisors and interns ---
    $('#supervisorAssignmentForm, #internAssignmentForm').on('submit', function(e) {
        e.preventDefault();
        const form = $(this);
        const btn = form.find('button[type="submit"]');
        const originalText = btn.html();

        btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status"></span> Processing...');

        $.ajax({
        url: "{{ route('assignments.store') }}",
        method: 'POST',
        data: form.serialize(),
        success: function(response) {
            if (response.success) {
            form.trigger('reset');
            loadAssignments();
            showAlert(response.message, 'success');
            } else {
            showAlert(response.message || 'Error creating assignment', 'danger');
            }
        },
        error: function(xhr) {
            const errors = xhr.responseJSON?.errors;
            if (errors) {
            Object.values(errors).forEach(e => showAlert(e[0], 'danger'));
            } else {
            showAlert(xhr.responseJSON?.message || 'Error processing request', 'danger');
            }
        },
        complete: function() {
            btn.prop('disabled', false).html(originalText);
        }
        });
    });

    // --- Remove assignment via AJAX on button click ---
    $(document).on('click', '.remove-assignment', function() {
        const btn = $(this);
        const projectId = btn.data('project-id');
        const userId = btn.data('user-id');
        const role = btn.data('role');

        if (!confirm(`Are you sure you want to remove this ${role} assignment?`)) return;

        btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status"></span>');

        $.ajax({
        url: `{{ route('assignments.destroy', '') }}/${projectId}`,
        method: 'DELETE',
        data: {
            user_id: userId,
            role: role
        },
        success: function(response) {
            if (response.success) {
            loadAssignments();
            showAlert(response.message, 'success');
            } else {
            showAlert(response.message || 'Error removing assignment', 'danger');
            btn.prop('disabled', false).html('Remove');
            }
        },
        error: function(xhr) {
            showAlert(xhr.responseJSON?.message || 'Error processing request', 'danger');
            btn.prop('disabled', false).html('Remove');
        }
        });
    });
    });

</script>


<style>
  .nav-tabs .nav-link {
      font-weight: 500;
  }
  .table th {
      white-space: nowrap;
  }
  .remove-assignment {
      min-width: 80px;
  }
  .table-responsive {
      overflow-x: auto;
  }
</style>