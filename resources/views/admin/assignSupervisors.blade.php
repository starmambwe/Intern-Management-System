<div class="container mt-5">
    <h2>Project Assignments</h2>
  
    @php
        $isSupervisor = $currentUser->roles->pluck('name')->contains('Supervisor');
    @endphp
  
    <!-- Tab Navigation -->
    <ul class="nav nav-tabs mb-4" id="assignmentTabs">
        @unless($isSupervisor)
        <li class="nav-item">
            <a class="nav-link {{ !$isSupervisor ? 'active' : '' }}" data-bs-toggle="tab" href="#supervisors-tab">Supervisors</a>
        </li>
        @endunless
        <li class="nav-item">
            <a class="nav-link {{ $isSupervisor ? 'active' : '' }}" data-bs-toggle="tab" href="#interns-tab">Interns</a>
        </li>
    </ul>
  
    <!-- Tab Content -->
    <div class="tab-content">
        @unless($isSupervisor)
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
                        </select>
                    </div>
                    <div class="col-md-5">
                        <label for="supervisorUser" class="form-label">Supervisor</label>
                        <select class="form-select" id="supervisorUser" name="user_id" required>
                            <option value="">Select supervisor</option>
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
                    </tbody>
                </table>
            </div>
        </div>
        @endunless
  
        <!-- Interns Tab -->
        <div class="tab-pane fade {{ $isSupervisor ? 'show active' : '' }}" id="interns-tab">
            <form id="internAssignmentForm" class="mb-4">
                @csrf
                <input type="hidden" name="role" value="intern">
                <div class="row g-3 align-items-end">
                    <div class="col-md-5">
                        <label for="internProject" class="form-label">Project</label>
                        <select class="form-select" id="internProject" name="project_id" required>
                            <option value="">Select project</option>
                        </select>
                    </div>
                    <div class="col-md-5">
                        <label for="internUser" class="form-label">Intern</label>
                        <select class="form-select" id="internUser" name="user_id" required>
                            <option value="">Select intern</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">Assign</button>
                    </div>
                </div>
            </form>
  
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>
  </div>
  
  <script>
      $(document).ready(function () {
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
  
          let currentTab = window.location.hash || '{{ $isSupervisor ? "#interns-tab" : "#supervisors-tab" }}';
          $(`a[href="${currentTab}"]`).tab('show');
  
          loadDropdowns();
          loadAssignments();
  
          $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
              window.location.hash = e.target.hash;
              loadAssignments();
          });
  
          function showAlert(message, type = 'success') {
              const alertBox = $('#alertBox');
              alertBox.removeClass('d-none alert-success alert-danger alert-warning alert-info')
                  .addClass(`alert alert-${type}`)
                  .html(message);
              setTimeout(() => alertBox.addClass('d-none'), 5000);
          }
  
          function loadDropdowns() {
              $.ajax({
                  url: "{{ route('assignments.projects') }}",
                  method: 'GET',
                  success: function (projects) {
                      let options = '<option value="">Select project</option>';
                      projects.forEach(p => options += `<option value="${p.id}">${p.name}</option>`);
                      $('#supervisorProject, #internProject').html(options);
                  }
              });
  
              $.ajax({
                  url: "{{ route('assignments.supervisors') }}",
                  method: 'GET',
                  success: function (supers) {
                      let options = '<option value="">Select supervisor</option>';
                      supers.forEach(s => options += `<option value="${s.id}">${s.name}</option>`);
                      $('#supervisorUser').html(options);
                  }
              });
  
              $.ajax({
                  url: "{{ route('assignments.interns') }}",
                  method: 'GET',
                  success: function (interns) {
                      let options = '<option value="">Select intern</option>';
                      interns.forEach(i => options += `<option value="${i.id}">${i.name}</option>`);
                      $('#internUser').html(options);
                  }
              });
          }
  
          function loadAssignments() {
              const isSupervisorTab = $('.nav-link.active').attr('href') === '#supervisors-tab';
              const loading = isSupervisorTab ?
                  '<tr><td colspan="4" class="text-center">Loading supervisors...</td></tr>' :
                  '<tr><td colspan="4" class="text-center">Loading interns...</td></tr>';
  
              if (isSupervisorTab) $('#supervisorsTableBody').html(loading);
              else $('#internsTableBody').html(loading);
  
              $.ajax({
                  url: "{{ route('assignments.assignments') }}",
                  method: 'GET',
                  success: function (assignments) {
                      $('#supervisorsTableBody, #internsTableBody').empty();
                      let sc = 1, ic = 1;
  
                      assignments.forEach(project => {
                          project.supervisors.forEach(s => {
                              $('#supervisorsTableBody').append(`
                                  <tr data-project-id="${project.id}" data-user-id="${s.id}">
                                      <td>${sc++}</td>
                                      <td>${project.project_name}</td>
                                      <td>${s.name}</td>
                                      <td><button class="btn btn-sm btn-danger remove-assignment"
                                          data-project-id="${project.id}"
                                          data-user-id="${s.id}"
                                          data-role="supervisor">Remove</button></td>
                                  </tr>`);
                          });
  
                          project.interns.forEach(i => {
                              $('#internsTableBody').append(`
                                  <tr data-project-id="${project.id}" data-user-id="${i.id}">
                                      <td>${ic++}</td>
                                      <td>${project.project_name}</td>
                                      <td>${i.name}</td>
                                      <td><button class="btn btn-sm btn-danger remove-assignment"
                                          data-project-id="${project.id}"
                                          data-user-id="${i.id}"
                                          data-role="intern">Remove</button></td>
                                  </tr>`);
                          });
                      });
  
                      if ($('#supervisorsTableBody').is(':empty')) {
                          $('#supervisorsTableBody').html('<tr><td colspan="4" class="text-center text-muted">No supervisor assignments found</td></tr>');
                      }
                      if ($('#internsTableBody').is(':empty')) {
                          $('#internsTableBody').html('<tr><td colspan="4" class="text-center text-muted">No intern assignments found</td></tr>');
                      }
                  },
                  error: function (xhr) {
                      const msg = xhr.responseJSON?.message || 'Failed to load assignments';
                      const err = `<tr><td colspan="4" class="text-center text-danger">${msg}</td></tr>`;
                      isSupervisorTab ? $('#supervisorsTableBody').html(err) : $('#internsTableBody').html(err);
                      showAlert(msg, 'danger');
                  }
              });
          }
  
          $('#supervisorAssignmentForm, #internAssignmentForm').on('submit', function (e) {
              e.preventDefault();
              const form = $(this);
              const btn = form.find('button[type="submit"]');
              const original = btn.html();
  
              btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status"></span> Processing...');
  
              $.ajax({
                  url: "{{ route('assignments.store') }}",
                  method: 'POST',
                  data: form.serialize(),
                  success: function (res) {
                      if (res.success) {
                          form.trigger('reset');
                          loadAssignments();
                          showAlert(res.message, 'success');
                      } else {
                          showAlert(res.message || 'Error creating assignment', 'danger');
                      }
                  },
                  error: function (xhr) {
                      const errors = xhr.responseJSON?.errors;
                      if (errors) {
                          Object.values(errors).forEach(e => showAlert(e[0], 'danger'));
                      } else {
                          showAlert(xhr.responseJSON?.message || 'Error processing request', 'danger');
                      }
                  },
                  complete: function () {
                      btn.prop('disabled', false).html(original);
                  }
              });
          });
  
          $(document).on('click', '.remove-assignment', function () {
              const btn = $(this);
              const projectId = btn.data('project-id');
              const userId = btn.data('user-id');
              const role = btn.data('role');
  
              if (!confirm(`Are you sure you want to remove this ${role} assignment?`)) return;
  
              btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status"></span>');
  
              $.ajax({
                  url: `{{ route('assignments.destroy', '') }}/${projectId}`,
                  method: 'DELETE',
                  data: { user_id: userId, role },
                  success: function (res) {
                      if (res.success) {
                          loadAssignments();
                          showAlert(res.message, 'success');
                      } else {
                          showAlert(res.message || 'Error removing assignment', 'danger');
                          btn.prop('disabled', false).html('Remove');
                      }
                  },
                  error: function (xhr) {
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
  