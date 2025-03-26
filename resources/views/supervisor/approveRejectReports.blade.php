<div class="container mt-4">
  <h3>Approve/Reject Intern Reports</h3>

  <div id="reportsContainer" class="mt-4">
    <p>Loading reports...</p>
  </div>
</div>

<script>
$(document).ready(function() {

  /** ---------- MOCK DATA ---------- **/
  const mockMode = true; // 🔄 Toggle to false to switch to real backend!

  const mockReports = [
    {
      id: '101',
      title: 'Weekly Update - Website Redesign',
      intern_name: 'Alice Johnson',
      project_name: 'Website Redesign',
      submitted_at: '2025-03-01',
      summary: 'Completed the homepage and started the contact page.'
    },
    {
      id: '102',
      title: 'Progress Report - Mobile App',
      intern_name: 'Bob Smith',
      project_name: 'Mobile App Development',
      submitted_at: '2025-03-02',
      summary: 'API integration is halfway done. Working on push notifications.'
    }
  ];
  /** -------------------------------- **/

  function loadReports() {
    $('#reportsContainer').html('<p>Loading reports...</p>');

    if (mockMode) {
      // ✅ MOCK DATA
      setTimeout(() => {
        renderReports(mockReports);
      }, 600);

    } else {
      // ✅ REAL BACKEND
      $.ajax({
        url: '../api/reports.php',
        method: 'GET',
        data: { status: 'Pending' },
        dataType: 'json',
        success: function(reports) {
          renderReports(reports);
        },
        error: function() {
          $('#reportsContainer').html('<p>Failed to load reports.</p>');
        }
      });
    }
  }

  function renderReports(reports) {
    if (reports.length === 0) {
      $('#reportsContainer').html('<p>No pending reports found.</p>');
      return;
    }

    let html = `
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Title</th>
            <th>Intern</th>
            <th>Project</th>
            <th>Submitted on</th>
            <th>Summary</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
    `;
    $.each(reports, function(_, report) {
      html += `
        <tr>
          <td>${report.title}</td>
          <td>${report.intern_name}</td>
          <td>${report.project_name}</td>
          <td>${report.submitted_at}</td>
          <td>${report.summary}</td>
          <td class="d-flex justify-content-start gap-3">
            <button class="btn btn-success btn-sm approveBtn" data-id="${report.id}">Approve</button>
            <button class="btn btn-danger btn-sm rejectBtn" data-id="${report.id}">Reject</button>
          </td>
        </tr>
      `;
    });
    html += `
        </tbody>
      </table>
    `;

    $('#reportsContainer').html(html);
  }

  $('#reportsContainer').on('click', '.approveBtn, .rejectBtn', function() {
    const reportId = $(this).data('id');
    const action = $(this).hasClass('approveBtn') ? 'approve' : 'reject';

    if (confirm(`Are you sure you want to ${action} this report?`)) {

      if (mockMode) {
        // ✅ MOCK DATA
        setTimeout(() => {
          alert(`Mock: Report ${reportId} has been ${action}d.`);
          loadReports();
        }, 500);

      } else {
        // ✅ REAL BACKEND
        $.ajax({
          url: '../api/reports.php',
          method: 'POST',
          data: { id: reportId, action: action },
          dataType: 'json',
          success: function(response) {
            if (response.success) {
              loadReports();
            } else {
              alert('Error: ' + response.message);
            }
          },
          error: function() {
            alert('An error occurred. Please try again.');
          }
        });
      }

    }
  });

  // Initialize
  loadReports();

});
</script>
