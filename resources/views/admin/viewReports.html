<div class="container mt-5">
<h2>Project Reports</h2>

<!-- Export Buttons -->
<div class="mb-3">
    <button class="btn btn-success" id="exportCSV">Export CSV</button>
    <button class="btn btn-danger" id="exportPDF">Export PDF</button>
</div>

<!-- Reports Table -->
<table class="table table-bordered" id="reportsTable">
    <thead class="table-light">
    <tr>
        <th>#</th>
        <th>Project Name</th>
        <th>Supervisor</th>
        <th>Completion (%)</th>
        <th>Intern Performance</th>
        <th>Attendance</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <!-- Reports will be dynamically loaded here -->
    </tbody>
</table>
</div>

<script>
    $(document).ready(function() {
    
        let reportCount = 0;
    
        function getGrade(score) {
            if (score >= 86) return 'A+';
            if (score >= 76) return 'A';
            if (score >= 68) return 'B+';
            if (score >= 62) return 'B';
            if (score >= 56) return 'C+';
            if (score >= 50) return 'C';
            if (score >= 40) return 'D+';
            return 'D';
        }
    
        function loadReports() {
            $('#reportsTable tbody').empty();
            reportCount = 0;
    
            // Active dummy data with a fourth abysmal record
            const dummyReports = [
                { id: 1, project_name: 'Project Alpha', supervisor: 'John Doe', completion: 85, intern_performance: 90, attendance: 95 },
                { id: 2, project_name: 'Project Beta', supervisor: 'Jane Smith', completion: 70, intern_performance: 75, attendance: 80 },
                { id: 3, project_name: 'Project Gamma', supervisor: 'Richard Roe', completion: 60, intern_performance: 65, attendance: 50 },
                { id: 4, project_name: 'Project Delta', supervisor: 'Emily Davis', completion: 35, intern_performance: 40, attendance: 45 } // Abysmal performance
            ];
    
            $.each(dummyReports, function(_, report) {
                reportCount++;
    
                const completionGrade = getGrade(report.completion);
                const performanceGrade = getGrade(report.intern_performance);
                const attendanceGrade = getGrade(report.attendance);
    
                // Apply color coding based on your grade range
                const completionClass = report.completion >= 68 ? 'bg-success' : (report.completion >= 50 ? 'bg-warning' : 'bg-danger');
                const performanceClass = report.intern_performance >= 68 ? 'bg-success' : (report.intern_performance >= 50 ? 'bg-warning' : 'bg-danger');
                const attendanceClass = report.attendance >= 68 ? 'bg-success' : (report.attendance >= 50 ? 'bg-warning' : 'bg-danger');
    
                $('#reportsTable tbody').append(`
                    <tr data-id="${report.id}">
                        <td>${reportCount}</td>
                        <td>${report.project_name}</td>
                        <td>${report.supervisor}</td>
                        <td>
                            <div class="progress">
                                <div class="progress-bar ${completionClass}" role="progressbar" style="width: ${report.completion}%;">
                                    ${report.completion}%
                                </div>
                            </div>
                            <span class="badge bg-secondary grade-badge">${completionGrade}</span>
                        </td>
                        <td>
                            <div class="progress">
                                <div class="progress-bar ${performanceClass}" role="progressbar" style="width: ${report.intern_performance}%;">
                                    ${report.intern_performance}%
                                </div>
                            </div>
                            <span class="badge bg-secondary grade-badge">${performanceGrade}</span>
                        </td>
                        <td>
                            <div class="progress">
                                <div class="progress-bar ${attendanceClass}" role="progressbar" style="width: ${report.attendance}%;">
                                    ${report.attendance}%
                                </div>
                            </div>
                            <span class="badge bg-secondary grade-badge">${attendanceGrade}</span>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-danger deleteBtn">Delete</button>
                        </td>
                    </tr>
                `);
            });
    
            /*
            // Uncomment this block to switch back to real AJAX data
            $.ajax({
                url: 'ajax.viewReports.php',
                method: 'GET',
                data: { action: 'read' },
                dataType: 'json',
                success: function(reports) {
                    $.each(reports, function(_, report) {
                        reportCount++;
    
                        const completionGrade = getGrade(report.completion);
                        const performanceGrade = getGrade(report.intern_performance);
                        const attendanceGrade = getGrade(report.attendance);
    
                        const attendanceClass = report.attendance >= 75 ? 'bg-success' : (report.attendance >= 50 ? 'bg-warning' : 'bg-danger');
                        const performanceClass = report.intern_performance >= 75 ? 'bg-success' : (report.intern_performance >= 50 ? 'bg-warning' : 'bg-danger');
    
                        $('#reportsTable tbody').append(`
                            <tr data-id="${report.id}">
                                <td>${reportCount}</td>
                                <td>${report.project_name}</td>
                                <td>${report.supervisor}</td>
                                <td>
                                    <div class="progress">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: ${report.completion}%;">
                                            ${report.completion}%
                                        </div>
                                    </div>
                                    <span class="badge bg-secondary grade-badge">${completionGrade}</span>
                                </td>
                                <td>
                                    <div class="progress">
                                        <div class="progress-bar ${performanceClass}" role="progressbar" style="width: ${report.intern_performance}%;">
                                            ${report.intern_performance}%
                                        </div>
                                    </div>
                                    <span class="badge bg-secondary grade-badge">${performanceGrade}</span>
                                </td>
                                <td>
                                    <div class="progress">
                                        <div class="progress-bar ${attendanceClass}" role="progressbar" style="width: ${report.attendance}%;">
                                            ${report.attendance}%
                                        </div>
                                    </div>
                                    <span class="badge bg-secondary grade-badge">${attendanceGrade}</span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-danger deleteBtn">Delete</button>
                                </td>
                            </tr>
                        `);
                    });
                }
            });
            */
        }
    
        loadReports();
    
        $('#reportsTable').on('click', '.deleteBtn', function() {
            const row = $(this).closest('tr');
            const id = row.data('id');
    
            if (confirm('Are you sure you want to delete this report?')) {
                $.ajax({
                    url: 'ajax.viewReports.php?action=delete',
                    method: 'POST',
                    data: { id: id },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            row.remove();
                            loadReports();
                        } else {
                            alert('Error: ' + response.message);
                        }
                    }
                });
            }
        });
    
        $('#exportCSV').click(function() {
            window.location.href = 'ajax.viewReports.php?action=exportCSV';
        });
    
        $('#exportPDF').click(function() {
            window.location.href = 'ajax.viewReports.php?action=exportPDF';
        });
    
    });
</script>
    