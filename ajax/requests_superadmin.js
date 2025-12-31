document.addEventListener('DOMContentLoaded', function () {
    const tableBody = document.querySelector('#requestsTable tbody');
    const resultDiv = document.getElementById('requests_result');

    if (!tableBody) return;

    loadRequests();

    tableBody.addEventListener('click', function (e) {
        const approveBtn = e.target.closest('.btn-approve');
        const rejectBtn  = e.target.closest('.btn-reject');

        if (!approveBtn && !rejectBtn) return;

        const row = e.target.closest('tr');
        const id  = row.getAttribute('data-id');
        const action = approveBtn ? 'approve' : 'reject';

        handleRequestAction(id, action, row, resultDiv);
    });
});

function loadRequests() {
    const tableBody = document.querySelector('#requestsTable tbody');
    const resultDiv = document.getElementById('requests_result');

    fetch('../api/requestsList.php')
        .then(r => r.json())
        .then(data => {
            if (!data.success) {
                resultDiv.textContent = data.error || 'Could not load requests.';
                resultDiv.style.color = 'red';
                return;
            }

            tableBody.innerHTML = '';
            data.data.forEach(req => {
                const tr = document.createElement('tr');
                tr.setAttribute('data-id', req.requestID);

                tr.innerHTML = `
                    <td>#${req.requestID}</td>
                    <td>
                        <strong>${escapeHtml(req.name)}</strong><br>
                        <small>${escapeHtml(req.email)}</small>
                    </td>
                    <td>${escapeHtml(req.message)}</td>
                    <td>
                        <span class="status-badge status-${req.status}">
                            ${capitalize(req.status)}
                        </span>
                    </td>
                    <td><small>${req.created_at}</small></td>
                    <td>
                        ${req.status === 'pending'
                            ? `<button class="btn btn-success btn-approve">Approve</button>
                               <button class="btn btn-danger btn-reject">Reject</button>`
                            : `<small>No actions</small>`}
                    </td>
                `;
                tableBody.appendChild(tr);
            });
        })
        .catch(err => {
            console.error(err);
            resultDiv.textContent = 'Network error while loading requests.';
            resultDiv.style.color = 'red';
        });
}

function handleRequestAction(id, action, row, resultDiv) {
    const formData = new FormData();
    formData.append('request_id', id);

    const url = action === 'approve'
        ? '../api/requestApprove.php'
        : '../api/requestReject.php';

    fetch(url, {
        method: 'POST',
        body: formData
    })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                resultDiv.textContent = data.message;
                resultDiv.style.color = 'green';

                const statusBadge = row.querySelector('.status-badge');
                if (action === 'approve') {
                    statusBadge.textContent = 'Approved';
                    statusBadge.className = 'status-badge status-approved';
                } else {
                    statusBadge.textContent = 'Rejected';
                    statusBadge.className = 'status-badge status-rejected';
                }

                const actionsCell = row.querySelector('td:last-child');
                actionsCell.innerHTML = '<small>No actions</small>';
            } else {
                resultDiv.textContent = data.error || 'Something went wrong.';
                resultDiv.style.color = 'red';
            }
        })
        .catch(err => {
            console.error(err);
            resultDiv.textContent = 'Network error.';
            resultDiv.style.color = 'red';
        });
}

function escapeHtml(str) {
    return String(str || '')
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;');
}

function capitalize(str) {
    str = String(str || '');
    return str.charAt(0).toUpperCase() + str.slice(1);
}
